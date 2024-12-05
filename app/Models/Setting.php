<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;


class Setting extends Model implements HasMedia, TranslatableContract
{
    use HasFactory, Translatable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     */
    protected $translatedAttributes = [
        'setting_id',
        'locale',
        'address',
        'footer_description'
    ];

    protected $fillable = [
        'x',
        'name',
        'phone',
        'email',
        'facebook',
        'instagram',
        'linkedin',
        'whatsapp'
    ];

}
