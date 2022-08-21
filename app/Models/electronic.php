<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Masseges;
use App\Models\User;
class electronic extends Model
{
    use HasFactory;
    protected $table='billselectron';
    protected $fillable = [
        'counter_number',
        'user_id',
        'ordernum',
        'recorde_register',
        'mobile_number',
        'country',
        'price',
        'type',
        'status',
        'message',
        'name_admin',

    
    ];
    public function user(){
        return $this -> belongsTO(User::class,'user_id','id');
    }
    public function messages(){
        return $this -> belongsTO(Masseges::class,'message','id');
    }

}
