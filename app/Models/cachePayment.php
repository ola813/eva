<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Masseges;
class cachePayment extends Model
{
    use HasFactory;
    protected $table='cache_payments';
    protected $fillable = [
        'id',
        'user_id',
        'account_number',
        'method_payment',
        'Bill_price',
        'status',
        'messages',
        'name_admin',
        'commission',
        'type',
    ];
    
    public function User()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function messagesinfo(){
        return $this -> belongsTO(Masseges::class,'messages','id');
    }
}
