<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Traits\ApiResponser;

class CountryController extends Controller
{
    use ApiResponser;


    /**
     * Mostrar o album completo ordenado por país
     *
     * @return \Illuminate\Http\Response
     * @OA\Get(
     *     path="/api/countries",
     *     tags={"Sticker User"},
     *     @OA\Response(
     *         response=200,
     *         description="Dados da figurinha"
     *     ),

     *  security={{ "apiAuth": {} }}
     * )

     */

    public function index()
    {

        $stickerController = new StickerUserController();
        $countries =   (Country::orderBy('index')->get());
        $user = Auth()->user();

        foreach ($countries as &$country) {


            $stickers = $stickerController->findStickersByCountry($user, $country['country_code']);
            $country['stickers'] = $stickers;
        }

        return $this->successResponse($countries);
    }

    public function calculateTotalStickers()
    {


        $total = Country::selectRaw('sum(stickers_end-stickers_start) as total_stickers')->first();
        return $total;
    }
    //
}
