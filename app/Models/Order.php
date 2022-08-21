<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use App\Models\Masseges;
use App\Models\codegaming;
class Order extends Model
{
    use HasFactory;
    protected $table='order';
    protected $fillable = [
        'user_id',
        'product_id',
        'product_qty',
        'code',
        'ordernum',
        'count',
        'couponAmount',
        'user_name',
        'number',
        'unique',
        'codegame',
        'price',
        'price_point',
        'status',
        'message',
        'name_admin',
        
    
    ];
    public function product(){
        return $this -> belongsTO(Product::class,'product_id','id');
    }
    public function userorder(){
        return $this -> belongsTO(User::class,'user_id','id');
    }
    public function messages(){
        return $this -> belongsTO(Masseges::class,'message','id');
    }
    public function codegaming(){
        return $this -> belongsTO(codegaming::class);
    }
}
