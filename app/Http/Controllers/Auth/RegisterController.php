<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\firstpayment;
use App\Models\Pointuser;
use App\Models\codepoint;
use App\Models\tolalcharge;
use App\Helpers\Helper;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::Pending;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user_id = Helper::IDGenerator(new User, 'user_id', 5, 'EVA'); /** Generate id */
  
        $user = User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' =>Hash::make($data['password']),
            'user_id'=>$user_id,
            
            
        ]);
        tolalcharge::create([
            'total_charge'=>0,
            'user_id'=>$user->id,
        ]);
        Pointuser::create([
            'point'=>10,
            'user_id'=>$user->id,
        ]);
        codepoint::create([
            'user_id'=>$user->id,
            ]);
            firstpayment::create([
            'user_id'=>$user->id,
            'account'=>0,
            ]);
       return $user;

    }
}
