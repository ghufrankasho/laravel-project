<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Service extends Model
{

    use Translatable;
    use HasFactory;
    public $translatedAttributes = ['title', 'summary'];
    protected $fillable = [
        'slug',
        'photo',
        'is_parent',
        'parent_id',
        'status'
    ];

    public static function shiftChild($serviceId)
    {
        return Service::whereIn('id', $serviceId)->update(['is_parent' => 1]);
    }

    // using without translations;
    public static function getChildByParentId($serviceId)
    {
        return Service::where('parent_id', $serviceId)->pluck('title', 'id');
    }

    //get the service parent using self join
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

}
