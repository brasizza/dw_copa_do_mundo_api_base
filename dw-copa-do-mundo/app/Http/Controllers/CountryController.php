<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    use ApiResponser;


     /**
     * Mostrar todos os paises da copa do mundo
     *
     * @return \Illuminate\Http\Response
      * @OA\Get(
     *     path="/api/countries",
     *     tags={"Sticker"},
 *     @OA\Response(
     *         response=200,
     *         description="Dados da figurinha"
     *     ),

     *  security={{ "apiAuth": {} }}
     * )

     */

    public function index(){


        return  $this->successResponse(Country::all());
    }
    //
}
