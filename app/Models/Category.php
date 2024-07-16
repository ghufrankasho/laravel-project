<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Category extends Model
{

    use Translatable;
    use HasFactory;
    public $translatedAttributes = ['title', 'summary'];
    protected $fillable = [
        'ordr',
        'slug',
        'photo',
        'is_parent',
        'is_main',
        'starts_from',
        'discount',
        'parent_id',
        'status'
    ];

    public static function shiftChild($categoryID)
    {
        return Category::whereIn('id', $categoryID)->update(['is_parent' => 1]);
    }

    // using without translations;
    public static function getChildByParentId($categoryID)
    {
        return Category::where('parent_id', $categoryID)->pluck('title', 'id');
    }

    // define relation {Category has many products}
    public  function products()
    {
        return $this->hasMany('App\Models\Product', 'cat_id', 'id');
        
    }
    public  function homeproducts()
    {
        return $this->hasMany('App\Models\Product', 'cat_id', 'id')->limit(16);
        
    }
    public  function banners()
    {
        return $this->hasMany('App\Models\Banner', 'cat_id', 'id');
    }
}
