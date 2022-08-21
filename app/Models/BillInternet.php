<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Masseges;
use App\Models\User;
use App\Models\Company;
use App\Models\CompanyInternet;
class BillInternet extends Model
{
    use HasFactory;
    protected $table='bill_internets';
    protected $fillable = [
        'user_id',
        'number',
        'full_name',
        'mobile_number',
        'companyInternet_id',
        'price',
        'status',
        'messages',
        'name_admin',

    
    ];
    public function user(){
        return $this -> belongsTO(User::class,'user_id','id');
    }
    public function companyinter(){
        return $this -> belongsTO(CompanyInternet::class,'companyInternet_id','id');
    }
    public function messagesinfo(){
        return $this -> belongsTO(Masseges::class,'messages','id');
    }
}
