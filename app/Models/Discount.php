<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Discount extends Model
{
    use HasFactory;
    // use Translatable;
    protected $fillable  = ['name', 'value', 'period', 'type', 'code', 'status', 'store_id'];
    // public $translatedAttributes = ['title', 'description'];


    public function discount($total)
    {
        //    fixed 
        if ($this->type == "fixed") {
            return  $this->value;
            // percent
        } elseif ($this->type == "rate") {
            return ($this->value / 100) * $total;
        } else {
            return 0;
        }
    }
}
