<?php

namespace App\Models;

use App\Models\Floor;
use App\Models\LocationSelection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Holding extends Model
{
    use HasFactory;
    public function Category ()
{
    return $this->belongsTo(Building_Category::class, 'category_id');
}
public function User ()
{
    return $this->belongsTo(User::class,'user_id');
}
public function floors()
{
    return $this->hasMany(Floor::class);
}

// Holding.php
// Holding.php
public function location()
{
    return $this->hasOne(LocationSelection::class, 'holding_id', 'id');
}


}
