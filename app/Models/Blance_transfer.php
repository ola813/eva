<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Masseges;
use App\Models\User;
use App\Models\Company;
use App\Models\valueaccount;
class Blance_transfer extends Model
{
        use HasFactory;
        protected $table='blance_transfers';
        protected $fillable = [
            'user_id',
            'company_id',
            'type',
            'value',
            'mobile_number',
            'price',
            'status',
            'message',
            'name_admin',
    
        
        ];
    
        public function user(){
            return $this -> belongsTO(User::class,'user_id','id');
        }
        public function company(){
            return $this -> belongsTO(Company::class,'company_id','id');
        }
        public function messages(){
            return $this -> belongsTO(Masseges::class,'message','id');
        }
        public function valueaccount(){
            return $this -> belongsTO(valueaccount::class,'value','id');
        }
}
