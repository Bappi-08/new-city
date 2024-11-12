<?php

namespace App\Models;

use App\Models\Floor;
use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Apartment extends Model
{
    use HasFactory;
    public function floor()
    {
        return $this->belongsTo(Floor::class,'floor_id');
    }
    public function members()
{
    return $this->hasMany(Member::class);
}
}
