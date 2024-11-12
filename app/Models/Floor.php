<?php

namespace App\Models;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Floor extends Model
{
    use HasFactory;
    public function holding ()
{
    return $this->belongsTo(Holding::class,'holding_id');
}
public function apartments()
{
    return $this->hasMany(Apartment::class);
}

}
