<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'mobile_number',
        'email',
        'country',
        'state',
        'city',
        'address',
        'sub_total',
        'total_amount',
        'status',
        'payment_method',
        'zip_code',
    ];

    public function products(){
        return $this->belongsToMany(Product::class,'order_details')->withPivot('quantity', 'price');
    }
}
