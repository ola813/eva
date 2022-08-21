<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Masseges;
use App\Models\CompanyInternet;
class Phone extends Model
{
    use HasFactory;
    protected $table='bille_phone';
    protected $fillable = [
        'user_id',
        'number',
        'mobile_number',
        'price',
        'status',
        'messages',
        'name_admin',

    
    ];
    public function user(){
        return $this -> belongsTO(User::class,'user_id','id');
    }
    public function messagesinfo(){
        return $this -> belongsTO(Masseges::class,'messages','id');
    }
}
