<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\electronic;
use App\Models\User;
use App\Models\Masseges;
use App\Models\tolalcharge;
use Illuminate\Support\Facades\Auth;
class ElectronicController extends Controller
{
    public function OrderElectronic(){
        $electronics=electronic::where('status','0')->get();
      
        return view('admin.Billes.Electricity.order',compact('electronics'));
    }
    public function detailsorder($id){
            $electronics=electronic::where('id',$id)->get();
            foreach($electronics as $electronic){
                $user_id= $electronic->user_id;
                $value= DB::table('totalcharge')->where('user_id',$user_id)->sum('total_charge');
                $name_admin = User::where('id',Auth::id())->first();
                $name=$name_admin->fname;
                $messages=Masseges::get();
                return view('admin.Billes.Electricity.detailsOrder',compact('electronics','name','value','messages'));
               
            }
            
    }
    public function  updateElectronic(Request $request ,$id){
        $electronics=electronic::where('id',$id)->get();
        $message=$request->message;
        foreach($electronics as $electronic){
        $user_id= $electronic->user_id;
        $commission= $electronic->commission;
        $price= $electronic->price;
        $value= DB::table('totalcharge')->where('user_id',$user_id)->sum('total_charge');
        $name_admin = User::where('id',Auth::id())->first();
        $name=$name_admin->fname;
        
        $electronics=electronic::where('id',$id)->update([
            'price'=>$request->input('price'),
            'status'=> $request->input('status'),
            'name_admin'=>$name,
            'message'=>$message,
            'commission'=>$request->input('commission'),
            
        ]);
        $electronics=electronic::where('id',$id)->get();
        foreach($electronics as $electronic){
                $status=$electronic->status;
        }
            if($status ==1){
                
                $minus_total= $value - ($price + $commission)  ;
                tolalcharge::where('user_id',$user_id)->update([
                    'total_charge'=>$minus_total,
                ]);
                return redirect('Bills/Electornic/Accept')->with('status','تم قبول الطلب بنجاح');
            }
            else{
                return redirect('Bills/Electornic/Cancel')->with('status','تم قبول الطلب بنجاح');
                
            
        }
    }
}
    public function Acceptorder(){
        $electronics=electronic::where('status','1')->get();
        return view('admin.Billes.Electricity.Aceeptorder',compact('electronics'));
    }


    public function CancelElectronic(){
    $electronics=electronic::where('status','2')->get();

    return view('admin.Billes.Electricity.CancelElectronic',compact('electronics'));
    }

    public function DetailsAllElectronic($id){
    $electronics=electronic::where('id',$id)->get();
    return view('admin.Billes.Electricity.DetailsAllElectronic',compact('electronics'));
    }

    public function orderPower(){
        $electronics =electronic::where('user_id',Auth::id())->get();
        return view('front.home.orderBills.electronic',compact('electronics'));
    }
    public function vieworderfatora(){
        return view('front.home.orderFatora');
    }
    public function ShowElectronicdetails($id){
        $electronics =electronic::where('user_id',Auth::id())->where('id',$id)->get();
        return view('front.home.orderBills.electronic-details',compact('electronics'));
    }


}
