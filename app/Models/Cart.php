<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\tolalcharge;
class Cart extends Model
{
    use HasFactory;
    protected $table='carts';
    protected $fillable = [
        'user_id',
        'total_id',
        'product_id',
        'product_price',
        'total_price',
        'product_qty',
        'user_name',
        'number',
        'unique',
    
    ];

    public function product(){
        return $this -> belongsTO(Product::class,'product_id','id');
    }

    public function totalCharge(){
        return $this -> belongsTO(tolalcharge::class,'total_id','user_id');
    }
}
