<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }

    public function mohollas()
    {
        return $this->hasMany(Moholla::class);
    }
}
