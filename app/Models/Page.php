<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Page extends Model
{
    use Translatable;
    use HasFactory;
    public $translatedAttributes = ['name', 'description'];
    protected $fillable = [
        'slug',
        'photo',
        'cover',
        'is_master',
        'in_main_menu',
        'in_side_menu',
        'in_bottom_menu',
        'status'
];
}
