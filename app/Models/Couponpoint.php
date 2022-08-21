<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Couponpoint extends Model
{
    use HasFactory;
    protected $table='couponpoints';
    protected $fillable = [
        'id',
        'couponpoint_option',
        'point_code',
        'users',
        'couponpoint_type',
        'amount',
        'expiry_date',
        'status',
    ];
}
