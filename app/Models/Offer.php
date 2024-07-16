<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Offer extends Model
{
    use HasFactory;
    use Translatable;
    protected $fillable  = ['slug', 'photo', 'status', 'price', 'serial_number', 'product_number'];
    public $translatedAttributes = ['name', 'title', 'description'];
}
