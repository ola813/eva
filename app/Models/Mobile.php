<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Masseges;
use App\Models\User;
use App\Models\Company;
class Mobile extends Model
{
    use HasFactory;
    protected $table='billemobile';
    protected $fillable = [
        'user_id',
        'Company',
        'mobile_number',
        'veryfiy_number',
        'price',
        'commission',
        'status',
        'message',
        'name_admin',

    
    ];

    public function user(){
        return $this -> belongsTO(User::class,'user_id','id');
    }
    public function company(){
        return $this -> belongsTO(Company::class,'Company','id');
    }
    public function messages(){
        return $this -> belongsTO(Masseges::class,'message','id');
    }
}
