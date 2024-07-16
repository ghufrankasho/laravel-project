<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'native',
        'code',
        'icon',
        'direction',
        'is_default',
        'is_master'
    ];
}
