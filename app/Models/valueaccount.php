<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\priceBalance;
class valueaccount extends Model
{
    use HasFactory;
    protected $table='valueaccount';
    protected $fillable = [
        'id',
        'value',
        'company_id',
        'price_id'
    ];

    public function company(){
        return $this -> belongsTO(Company::class,'company_id','id');
    }
    public function balanceprice(){
        return $this -> hasOne(priceBalance::class);
    }

}
