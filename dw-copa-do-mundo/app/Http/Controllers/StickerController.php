<?php

/**
 * @OA\Info(
 *      version="1.0.0",
 *      x={
 *          "logo": {
 *              "url": "https://via.placeholder.com/190x90.png?text=L5-Swagger"
 *          }
 *      },
 *      title="L5 OpenApi",
 *      description="L5 Swagger OpenApi description",
 *      @OA\Contact(
 *          email="darius@matulionis.lt"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */

namespace App\Http\Controllers;

use App\Helpers\RedimensionarImagem;
use App\Http\Requests\StickerRequest;
use App\Models\Sticker;
use App\Traits\ApiResponser;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use OpenApi\Annotations as OA;

class StickerController extends Controller
{

    use ApiResponser;
     /**
     * Listar todas as figurinhas do sistema.
     *
     * @return \Illuminate\Http\Response
      * @OA\Get(
     *     path="/api/stickers",
     *     tags={"Sticker"},
 *     @OA\Response(
     *         response=200,
     *         description="Dados das figurinhas"
     *     ),

     *  security={{ "apiAuth": {} }}
     * )

     */
    public function index()
    {
        $sticker = Sticker::all();
        return  $this->successResponse($sticker);
    }


    private function buildImage($file)
    {

        $info = pathinfo($file->getClientOriginalName());
        if (!isset($info['extension'])) {
            $extension = 'png';
        } else {
            $extension =  $info['extension'];
        }
        $nome = 'produto_' . uniqid() . '.' . $extension;
        $redimensionar = new RedimensionarImagem();
        $redimensionar->AdicionaTamanho(1000);
        $redimensionar->setQualityPhoto(0);
        $redimensionar->__set('ArqOrigem', (base64_encode($file->get()))); // adiciona um diretÃ³rio  de onde estÃ¡ o arquivo pra conversÃ£o
        $convertido = $redimensionar->executar();  //

        return $convertido;
    }


    /**
     * Adicionar figurinhas ao sistema.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response

     * @OA\Post(
     *     path="/api/sticker",
     *     tags={"Sticker"},
     *     @OA\Response(
     *         response=422,
     *         description="Invalid input"
     *     ),
     * @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *
     *  @OA\Property(
     *                     description="Nome do Jogador",
     *                     property="sticker_name",
     *                     type="text",
     *                ),
     *  @OA\Property(
     *                     description="Código do país",
     *                     property="sticker_code",
     *                     type="text",
     *                ),
     *
     *  @OA\Property(
     *                     description="Número da figurinha",
     *                     property="sticker_number",
     *                     type="text",
     *                ),
     *
     *    @OA\Property(
     *                     description="file to upload",
     *                     property="sticker_image_upload",
     *                     type="file",
     *                ),

     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Figurinha inserida com sucesso"
     *     ),
     *  security={{ "apiAuth": {} }}
     * )
     */

    public function store(StickerRequest $request)
    {

        $postData =  ($request->all());
        if ($request->hasFile('sticker_image_upload')) {
            $image = $this->buildImage($request->sticker_image_upload);
            $imageName = $request->sticker_code . "_" . $request->sticker_number . '.png';
            $path_imagem = '/stickers/' . $imageName;
            Storage::disk('public')->put($path_imagem, $image);
        } else {
            $path_imagem = '';
        }

        $postData['sticker_image'] = $path_imagem;

        try {
            $sticker = Sticker::create($postData);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {

                return $this->errorResponse('This sticker is duplicated', Response::HTTP_CONFLICT);

                // houston, we have a duplicate entry problem
            }
        }
        return $this->successResponse($sticker);
        //
    }

    /**
     * Detalhe de uma figurinha específica.
     *
     * @return \Illuminate\Http\Response
      * @OA\Get(
     *     path="/api/sticker/{id}",
     *     tags={"Sticker"},
 *     @OA\Response(
     *         response=200,
     *         description="Dados da figurinha"
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id da figurinha",
     *         @OA\Schema(
     *             type="Int",
     *         )
     *     ),
     *  security={{ "apiAuth": {} }}
     * )

     */
    public function show($id)
    {
        $sticker = Sticker::findOrFail($id);
       return  $this->successResponse($sticker);
    }

    /**
     * Atualiza uma figurinha especifica
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sticker  $sticker
     * @return \Illuminate\Http\Response
     * @OA\Post(
     *     path="/api/sticker/{id}",
     *     tags={"Sticker"},
     *     @OA\Response(
     *         response=422,
     *         description="Invalid input"
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id da figurinha",
     *         @OA\Schema(
     *             type="Int",
     *         )
     *     ),

     * @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *
     *  @OA\Property(
     *                     description="Nome do Jogador",
     *                     property="sticker_name",
     *                     type="text",
     *                ),
     *  @OA\Property(
     *                     description="Código do país",
     *                     property="sticker_code",
     *                     type="text",
     *                ),
     *
     *  @OA\Property(
     *                     description="Número da figurinha",
     *                     property="sticker_number",
     *                     type="text",
     *                ),
     *
     *    @OA\Property(
     *                     description="file to upload",
     *                     property="sticker_image_upload",
     *                     type="file",
     *                ),

     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Figurinha inserida com sucesso"
     *     ),
     *  security={{ "apiAuth": {} }}
     * )
     */
    public function update($id, StickerRequest $request)
    {

        $sticker = Sticker::findOrFail($id);



        if ($request->hasFile('sticker_image_upload')) {

            if (!empty($sticker['sticker_image'])) {
                $old_image = $sticker->sticker_code . "_" . $sticker->sticker_number . '.png';
                $path_imagem_old = '/stickers/' . $old_image;
               Storage::disk('public')->delete([$path_imagem_old]);
            }
            $image = $this->buildImage($request->sticker_image_upload);
            $sticker->fill($request->all());
            $imageName = $request->sticker_code . "_" . $request->sticker_number . '.png';
            $path_imagem = '/stickers/' . $imageName;
            Storage::disk('public')->put($path_imagem, $image);
            $sticker['sticker_image'] = $path_imagem;
        }
        $sticker->save();
        return  $this->successResponse($sticker);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sticker  $sticker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sticker $sticker)
    {
        //
    }

  /**
     * Pesquisa figurinha por Codigo + numero.
     *
     * @return \Illuminate\Http\Response
      * @OA\Get(
     *     path="/api/sticker-search",
     *     tags={"Sticker"},
 *     @OA\Response(
     *         response=200,
     *         description="Dados da figurinha"
     *

     *     ),
      *     @OA\Parameter(
     *         name="sticker_code",
     *         in="query",
     *         description="Código do país",
     *         @OA\Schema(
     *             type="String",
     *         )
     * ),
     *     @OA\Parameter(
     *         name="sticker_number",
     *         in="query",
     *         description="Número do jogador",
     *         @OA\Schema(
     *             type="Int",
     *         )
     * ),
     *  security={{ "apiAuth": {} }}
     * )

     */
    public function find(Request $request){

      $sticker =   Sticker::where('sticker_code', $request->sticker_code)->where('sticker_number', $request->sticker_number)->first();

      if($sticker){
        return $this->successResponse($sticker);
      }
      return $this->errorResponse('Sticker not found' , Response::HTTP_NOT_FOUND);
    }
}
