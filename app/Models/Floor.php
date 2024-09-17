<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;
    public function holding ()
{
    return $this->belongsTo(Holding::class,'holding_id');
}
}
