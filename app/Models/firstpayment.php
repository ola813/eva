<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class firstpayment extends Model
{
    use HasFactory;
    protected $table='firstpayments';
    protected $fillable = [
        'id',
        'user_id',
        'type',
        'account',
        'image',
        'status',
        'message',
        'name_admin',
        'created_at'
    ];

    public function userCharge(){
        return $this->belongsTO(User::class,'user_id','id');
    }
    public function Company_pay(){
        return $this -> belongsTO(CompanyElecPayment::class);
    }
      public function messages(){
        return $this -> belongsTO(Masseges::class,'message','id');
    }
}
