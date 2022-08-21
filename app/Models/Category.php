<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title_en',
        'category_ar',
        'category_en',
        'photo',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function products(){
        return $this -> hasMany(Product::class);
    }
}


