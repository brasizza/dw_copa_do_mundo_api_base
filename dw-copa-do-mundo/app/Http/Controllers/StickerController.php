<?php

namespace App\Http\Controllers;

use App\Helpers\RedimensionarImagem;
use App\Http\Requests\StickerRequest;
use App\Models\Sticker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StickerController extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    private function buildImage($file){


            $info = pathinfo($file->getClientOriginalName());
            if(!isset($info['extension'])){
                $extension = 'png';
            }else{
                $extension=  $info['extension'];
            }
            $nome = 'produto_' . uniqid() . '.' . $extension;
            $redimensionar = new RedimensionarImagem();
            $redimensionar->AdicionaTamanho(1000);
            $redimensionar->setQualityPhoto(0);
            $redimensionar->__set('ArqOrigem', (base64_encode($file->get()))); // adiciona um diretÃ³rio  de onde estÃ¡ o arquivo pra conversÃ£o
            $convertido = $redimensionar->executar();  //

            return $convertido;
    }


    public function store(StickerRequest $request)
    {

        $postData =  ($request->all());

        if($request->hasFile('sticker_image')){

            $image = $this->buildImage($request->sticker_image);
            $imageName = $request->sticker_player_code."_".$request->sticker_number.'.png';
            Storage::disk('public')->put('/stickers/'.$imageName, $image);
            dd($imageName);
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sticker  $sticker
     * @return \Illuminate\Http\Response
     */
    public function show(Sticker $sticker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sticker  $sticker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sticker $sticker)
    {
        //
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
}
