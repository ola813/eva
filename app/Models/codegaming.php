<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class codegaming extends Model
{
   
    use HasFactory;
    protected $table='codegamings';
    protected $fillable = [
     
        'freefire110',
        'freefire231',
        'freefire583',
        'pubge60',
        'pubge325',
        'Roblox10',
        'Razar5',
        'Razar10',
        'Razar20',
        'ituns5',
        'ituns10',
        'ituns20',
        'oropa200',
        'oropa315',
        'oropa795',
   
    ];

    public function products(){
        return $this -> hasMany(Product::class);
    }
}
