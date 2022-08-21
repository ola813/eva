<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInternet extends Model
{
    use HasFactory;
    protected $table='company_internets';
    protected $fillable = [
        'id',
        'name',
    ];

}
