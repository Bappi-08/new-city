<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationSelection extends Model
{
    use HasFactory;

    protected $fillable = ['district_name', 'thana_name', 'ward_name', 'moholla_name'];
}
