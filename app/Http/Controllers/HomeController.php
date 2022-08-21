<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Imageoffer;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   $value= DB::table('totalcharge')->where('user_id',Auth::user()->id)->sum('total_charge');
         $pointuser= DB::table('pointuser')->where('user_id',Auth::user()->id)->sum('point');
    {  
        $Images=Imageoffer::get();
        return view('front.home.indexProduct',compact('value','Images','pointuser'));
    }
 

}}
