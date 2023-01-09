<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddPayment extends Model
{
    use HasFactory;
    protected $table = 'add_payments';
    protected $guarded = [];
}
