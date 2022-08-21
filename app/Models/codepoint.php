<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class codepoint extends Model
{
    use HasFactory;
    protected $table='codepoints';
    protected $fillable = [
        'id',
        'user_id',
        'point_code',
        'count_pointcode',
    ];
    
    public function User()
    {
        return $this->belongTo(User::class,'user_id','id');
    }
}
