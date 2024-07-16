<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Brand extends Model
{
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['title' , 'description'];
    protected $fillable = [
        'path',
        'status',
        'models',
        'type'
    ];
 

}
