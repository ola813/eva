<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\valueaccount;
class priceBalance extends Model
{
    use HasFactory;
    protected $table='price_balances';
    protected $fillable = [
        'id',
        'price',
        'orginal_price',
        'commission',
        'valueaccount_id',
    ];

    public function valueaccount(){
        return $this -> belongTo(valueaccount::class,'valueaccount_id','id');
    }
}
