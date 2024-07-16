<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Property extends Model
{
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['name'];
    protected $fillable = [
        'name',
        'value',
        'product_id',
    ];
    public  function products()
    {
        return $this->belongsTo('App\Models\Product', 'product_id')->withDefault();
    }
}