<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Banner extends Model
{
    use HasFactory;
    use Translatable;
    protected $fillable  = ['slug','photo','status','type','cat_id'];
    public $translatedAttributes = ['title', 'description'];
    public function category()
    {
        return $this->belongsTo(Category::class,'cat_id', 'id');
    }
}
