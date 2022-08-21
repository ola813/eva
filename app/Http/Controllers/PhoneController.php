<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\User;
use App\Models\Masseges;
use App\Models\tolalcharge;
use App\Models\Notifcation;
use App\Http\Requests\PhoneRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class PhoneController extends Controller
{
    public function pagephone(){
        return view('front.home.Billies.phon&internet.phone');
    }
    public function phoneInternet(){
        return view('front.home.Billies.phon&internet.index');
    }

    public function AddBillsphoneorder(PhoneRequest $request){
        $number=$request->input('number');
        $mobile_number=$request->input('mobile_number');
        $Phone= Phone::create([
            'user_id'=>Auth::id(),
            'number'=>$number,
            'mobile_number'=>$mobile_number,
            
        ]);
        $Phone_id=$Phone->id;
        $usernames=User::where('id',Auth::id())->get();
        foreach($usernames as $username ){
            $fname=$username->fname;
            $notifcation=new Notifcation;
                    $notifcation->type='فاتورة هاتف أرضي';
                    $notifcation->order_id=$Phone_id;
                    $notifcation->user=$fname;
                    $url=route('ViewOrder',$Phone_id);
                     $title=$fname;
                    $body="طلب دفع فاتورة هاتف أرضي جديد";
                    $user=User::where('role_as',0)->get();
                    if($notifcation->save()){
                        $notifcation->TOMutilDevices($user,$title,$body,null,$url);
                    }
                    
                    return redirect('Bills/phone/order-phone')->with('status','تم إرسال الطلب سيتم تنفيذه بأقرب وقت ممكن');
                }

    }

    public function orderPhone(){
        $phones =Phone::where('user_id',Auth::id())->get();
        return view('front.home.orderBills.phone',compact('phones'));
    }
    //Admin Function

    public function OrderPending(){
        $phones=Phone::where('status','0')->get();
        return view('admin.Billes.phone.order',compact('phones'));
    }
    public function detailsorder($id){
        $phones=Phone::where('id',$id)->get();
        foreach($phones as $phone){
        $user_id= $phone->user_id;
        $name_admin = User::where('id',Auth::id())->first();
        $name=$name_admin->fname;
        $messagesAll=Masseges::get();
        $value= DB::table('totalcharge')->where('user_id',$user_id)->sum('total_charge');
        return view('admin.Billes.phone.detailsOrder',compact('phones','name','value','messagesAll'));
    }
}
  
    public function updatePhone(Request $request ,$id){
        $Phones=Phone::where('id',$id)->get();
        $message=$request->messages;
        foreach($Phones as $phone){
            $user_id= $phone->user_id;
            $price= $phone->price;
            $value= DB::table('totalcharge')->where('user_id',$user_id)->sum('total_charge');
            $commission= $phone->commission;
            $name_admin = User::where('id',Auth::id())->first();
            $name=$name_admin->fname;
            Phone::where('id',$id)->update([
            'price'=>$request->input('price'),
            'commission'=>$request->input('commission'),
            'status'=> $request->input('status'),
            'name_admin'=>$name,
            'messages'=>$message,

        ]);
        
        $minus_total= $value - ($price+$commission)  ;
        tolalcharge::where('user_id',$user_id)->update([
            'total_charge'=>$minus_total,
        ]);
        return redirect('Bills/Phone/orderPhone')->with('status','تم قبول الطلب بنجاح');
    }
    }

    public function Acceptorder(){
        $phones=Phone::where('status','1')->get();
        return view('admin.Billes.phone.Aceeptorder',compact('phones'));
    }

    public function CancelPhoneOrder(){
        $phones=Phone::where('status','2')->get();
    
        return view('admin.Billes.phone.Cancelorder',compact('phones'));
    }
    public function DetailsAllPhoorder($id){
        $phones=Phone::where('id',$id)->get();
        return view('admin.Billes.phone.DetailsAllOrder',compact('phones'));
    }
    public function ShowCacheorder($id){
        $phones=Phone::where('id',$id)->where('user_id',Auth::id())->get();
        return view('front.home.orderBills.phone-details',compact('phones'));
    }

}
