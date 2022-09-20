<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StickerUser extends Model
{
    protected $fillable = [
        'id_user',
        'id_sticker'
    ];


    public function sticker(){

        return  $this->hasOne(Sticker::class, 'id', 'id_sticker');


    }
}
