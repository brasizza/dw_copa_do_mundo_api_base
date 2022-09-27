<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Country extends Model
{
    use HasFactory;

    protected $appends = ['flag'];



    protected $fillable = [


        'country_name',
        'country_code',
        'index',
        'stickers_start',
        'stickers_end',
    ];



    public function getFlagAttribute()
    {
        if (!empty($this->attributes['country_code'])) {
            return   asset(('flags/' . $this->attributes['country_code'] . '.png'));
        }
    }
}
