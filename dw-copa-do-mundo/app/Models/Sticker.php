<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


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


    public function getStickerImageAttribute()
    {
        if (!empty($this->attributes['sticker_image'])) {
            return  asset(Storage::url($this->attributes['sticker_image']));
        }
    }
}
