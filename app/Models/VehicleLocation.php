<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleLocation extends Model
{
   use HasFactory;
    protected $table = 'vehicle_locations';
    protected $guarded = [];
}
