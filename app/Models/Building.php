<?php

namespace App\Models;

// use App\Models\Building;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Building extends Model
{
    use HasFactory;
    public function Building_Categor ()
    {
        return $this->belongsTo(Building_Category::class, 'building_id');
    }
    
    public static function Bappi()
    {
        return self::pluck('holding','id')->toArray();
    }

}
