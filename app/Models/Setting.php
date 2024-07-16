<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'is_hidden',
        'title',
        'key',
        'value_actual',
        'value_default',
        'description',
        'type'
    ];
}