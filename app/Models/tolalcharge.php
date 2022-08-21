<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Charge;
class tolalcharge extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table='totalcharge';
    protected $fillable=[
        'id',
        'total_charge',
        'user_id',
        
    ];
    public function Charge()
    {
        return $this->hasMany(Charge::class);
    }

    public function User()
    {
        return $this->belongTo(User::class,'user_id','id');
    }

}
