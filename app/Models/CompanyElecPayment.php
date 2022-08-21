<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyElecPayment extends Model
{
    use HasFactory;
    protected $table='company_elec_payments';
    protected $fillable = [
        'id',
        'name',
    ];
}
