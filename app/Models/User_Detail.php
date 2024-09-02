<?php

namespace App\Models;

use App\Models\User;
use App\Models\Building;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User_Detail extends Model
{
    use HasFactory;
    public function User ()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    
    public function Buildings()
    {
        return $this->belongsTo(Building::class,'building_id');
    }
    public static function Option()
    {
        return self::pluck('holding','id')->toArray();
    }

}
