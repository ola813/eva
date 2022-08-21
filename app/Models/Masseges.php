<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masseges extends Model
{
    use HasFactory;
    protected $table='masseges';
    protected $fillable = [
        'message',
    ];
}
