<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sticker extends Model
{
    use HasFactory;


    protected $fillable = [
'sticker_code',
'sticker_player_name',
'sticker_number',
'sticker_image',
'token'
    ];


}
