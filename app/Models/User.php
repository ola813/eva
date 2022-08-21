<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Charge;
use App\Models\tolalcharge;
use Illuminate\Support\Facades\Cache;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'fname',
        'lname',
        'email',
        'password',
        'role_as',
        'phone',
        'device_token',
        'created_at',
        'updated_at',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
        'email_verified_at',
        'last_seen',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public function isOnline()
    {
        return Cache::has('user-is-online-'. $this->id);
    }
    public function Charge()
    {
        return $this->hasMany(Charge::class);
    }
    public function totalCharge()
    {
        return $this->belongTO(tolalcharge::class,);
    }
}
