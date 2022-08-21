<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class Product extends Model
{
    use HasFactory;
    protected $table='products';
    protected $fillable=[
        'id',
        'title',
        'commission',
        'price_act',
        'orginal_price',
        'selling_price',
        'price_point',
        'type_product',
        'point',
        'quantity',
        'category_id',
        'photo',
        'status',
    ];
    public function category(){
        return $this -> belongsTO(Category::class,'category_id','id');
    }
    
}
