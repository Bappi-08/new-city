<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building_Category extends Model
{
    use HasFactory;
    public static function CategoryOption()
    {
        return self::pluck('building_type','id')->toArray();
    }

}
