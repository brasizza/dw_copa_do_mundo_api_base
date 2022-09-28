<?php

namespace App\Http\Controllers;

use App\Http\Requests\StickerUserRequest;
use App\Http\Requests\StickerUserRequestUpdate;
use App\Models\Sticker;
use App\Models\StickerUser;
use App\Models\User;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StickerUserController extends Controller
{

    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Cadastrar a figurinha escolhida para o usuário.
     *
     * @param  \App\Http\Requests\StickerUserRequest  $request
     * @return \Illuminate\Http\Response
     * @OA\Post(
     *     path="/api/user/sticker",
     *     tags={"Sticker User"},
     *     @OA\Response(
     *         response=422,
     *         description="Invalid input"
     *     ),

     *     @OA\Response(
     *         response=200,
     *         description="Figurinha inserida com sucesso"
     *     ),
     * @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="text/json",
     *             @OA\Schema(
     *
     *  @OA\Property(
     *                     description="Id da figurinha",
     *                     property="id_sticker",
     *                      example="2",
     *                     type="text",
     *                ),
     *
     *  @OA\Property(
     *                     description="Quantidade",
     *                     property="amount",
     *                      example="1",
     *                     type="text",
     *                ),
     * ),
     * ),
     * ),
     *  security={{ "apiAuth": {} }}
     * )
     */
    public function store(StickerUserRequest $request)
    {

        $user = Auth()->user();
        try {
            $sticker = Sticker::findOrFail($request->id_sticker);
        } catch (Exception $e) {
            return $this->errorResponse('Sticker not found', Response::HTTP_NOT_FOUND);
        }
        $creates = [];
        for ($i = 0; $i < $request->amount; $i++) {
            $creates[] = StickerUser::create([

                'id_user' => $user['id'],
                'id_sticker' => $request->id_sticker
            ]);
        }

        return $this->successResponse($creates);
    }

    /**
     * Pegar as figurinhas do usuário
     * @OA\Get(
     *     path="/api/user/stickers",
     *     tags={"Sticker User"},
     *     @OA\Response(
     *         response=422,
     *         description="Invalid input"
     *     ),
     *     @OA\Parameter(
     *         name="duplicate",
     *         in="query",
     *
     *         description="Mostrar somente duplicados? 1 para sim 0 para não",
     *         @OA\Schema(
     *             type="int",
     *         ),
     * ),

     *     @OA\Response(
     *         response=200,
     *         description="Figurinhas listadas"
     *     ),

     *  security={{ "apiAuth": {} }}
     * )
     */
    public function show(Request $request)
    {
        $user = Auth()->user();
        $duplicates = 0;
        if ($request->has('duplicate')) {
            $duplicates = $request->duplicate;
        }

        if ($duplicates == 1) {

            $stickers = StickerUser::with('sticker')->selectRaw('*,count(*)-1 as total_stickers')->having('total_stickers', '>', 0)->where('id_user', $user->id)->groupBy('id_sticker')->get();
        } else {

            $stickers = StickerUser::with('sticker')->selectRaw('*,count(*) as total_stickers')->where('id_user', $user->id)->groupBy('id_sticker')->get();
        }
        return $this->successResponse($stickers);
    }


    public function getStickerInformations()
    {
        $user = Auth()->user();
        $stickers = StickerUser::selectRaw(' count(*) -1 total_stickers')->where('id_user', $user->id)->groupBy('id_sticker')->get();
        return ($stickers->toArray());
    }


    public function findStickersByCountry(User $user, $country)
    {
        $stickerController = new StickerController();
        $stickers_ids = $stickerController->findByCountry($country);
        $stickers = StickerUser::with(['sticker' => function ($query) use ($stickers_ids) {
            return $query->whereIn('id', $stickers_ids);
        }])->selectRaw('*,count(*)-1 as duplicate_stickers , count(*) as total_stickers ')->where('id_user', $user->id)->whereIn('id_sticker', $stickers_ids)
            ->groupBy('id_sticker')->get()->toArray();
        foreach ($stickers as &$stick) {
            if ($stick['sticker'] == null) {
                continue;
            }
            $dados = ($stick['sticker']);
            unset($stick['sticker']);
            if ($dados != null) {
                $stick = array_merge($stick, $dados);
            }
        }
        return ($stickers);
    }
    /**
     * Atualizar a quantidade de figurinha escolhida de um usuário.
     *
     * @param  \App\Http\Requests\StickerUserRequest  $request
     * @param  \App\Models\StickerUser  $stickerUser
     * @return \Illuminate\Http\Response
     * @OA\Put(
     *     path="/api/user/sticker",
     *     tags={"Sticker User"},
     *     @OA\Response(
     *         response=422,
     *         description="Invalid input"
     *     ),

     *     @OA\Response(
     *         response=200,
     *         description="Quantidade atualizada com sucesso"
     *     ),
     * @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="text/json",
     *             @OA\Schema(
     *
     *  @OA\Property(
     *                     description="Id da figurinha",
     *                     property="id_sticker",
     *                      example="2",
     *                     type="text",
     *                ),
     *
     *  @OA\Property(
     *                     description="Quantidade",
     *                     property="amount",
     *                      example="1",
     *                     type="text",
     *                ),
     * ),
     * ),
     * ),
     *  security={{ "apiAuth": {} }}
     * )
     */
    public function update(StickerUserRequestUpdate $request)
    {
        $user = auth()->user();
        $id_sticker = $request->id_sticker;
        $amount = $request->amount;
        $stickers = StickerUser::where('id_sticker', $id_sticker)->where('id_user', $user->id)->get();

        $total_stickers = count($stickers);
        if ($total_stickers == 0) {
            return $this->errorResponse('Sticker not found', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        if ($amount == 0) {
            $deleted =  StickerUser::where('id_sticker', $id_sticker)->where('id_user', $user->id)->delete();
            return $this->successResponse(['msg' => 'All stickers deleted']);
        }
        $left = $amount - $total_stickers;

        if($left == 0){

            return $this->successResponse(['msg' => 'Nothing happened']);

        }
        if ($left > 0) {
            $stickerUserRequest = new StickerUserRequest(['id_sticker' => $id_sticker, 'amount' => $left]);
            return $this->store($stickerUserRequest);
        } else {
            $deleteAmount = abs($left);
            for ($deleteIndex = 0; $deleteIndex != $deleteAmount; $deleteIndex++) {
                $this->destroy($stickers[$deleteIndex]);
            }
            return $this->successResponse(['msg' => 'Stickers was downgraded']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StickerUser  $stickerUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(StickerUser $stickerUser)
    {
        $stickerUser->delete();
    }
}
