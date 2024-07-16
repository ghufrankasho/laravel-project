<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Blog extends Model
{

    use Translatable;
    use HasFactory;
    public $translatedAttributes = ['title', 'description'];
    protected $fillable = [
        'slug',
        'photo',
        'status'
    ];

    public  function relatedBlogs()
    {
        return $this->hasMany('App\Models\Blog','id','id')->where('status','active')->limit(10);
    } 
}
