<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model
{
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['title', 'description' ,'color' ,'shipping_area'];
    protected $fillable = [
        // 'title',
        'slug',
        // 'summary',
        // 'description',
        // 'stock',
        'price',
        'old_price',
        'minimum_quantity',
        'discount',
        'conditions',
        'photo',
        'status',
        'is_hot',
        'cat_id',
        // 'vendor_id',
        'child_cat_id',
        'product_number',
        'dimension',
        // 'size'
        'color',
        'available',
        'shipping_area',
        'shipping_fee',
      
    ];



    // define relation {Brand has many products}
    public  function relatedProducts()
    {
        return $this->hasMany('App\Models\Product', 'cat_id', 'cat_id')->where('status', 'active');
    }


    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_detail')->withPivot('quantity');
    }

    public static function getProductByCart($id)
    {
        return self::where('id', $id)->with('properties')->get()->toArray();
    }

    public  function properties()

    {
        return $this->hasMany('App\Models\Property', 'product_id', 'id');
    }


    public function category()
    {
        return $this->belongsTo(Category::class,'cat_id', 'id');
    }
}
