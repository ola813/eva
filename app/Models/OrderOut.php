<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Masseges;
class OrderOut extends Model
{
    use HasFactory;
    protected $table='order_outs';
    protected $fillable = [
        'user_id',
        'message',
        'price_act',
        'price',
        'commission',
        'status',
        'notic',
        'name_admin',
    ];
    public function Userinfo()
    {
        return $this->belongsTO(User::class,'user_id','id');
    }
    public function messages(){
        return $this -> belongsTO(Masseges::class,'message','id');
    }

}
