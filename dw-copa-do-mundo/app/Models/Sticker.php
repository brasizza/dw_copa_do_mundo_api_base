<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OpenApi\Annotations as OA;



class Sticker extends Model
{
    use HasFactory;


    protected $fillable = [
'sticker_code',
'sticker_name',
'sticker_number',
'sticker_image',
'token'
    ];


}
