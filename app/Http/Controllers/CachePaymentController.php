<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cachePayment;
use App\Models\User;
use App\Models\Masseges;
use App\Models\tolalcharge;
use App\Models\Notifcation;
use App\Http\Requests\CachePaymentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CachePaymentController extends Controller
{
    public function cache(){
        return view('front.home.Billies.chacePayment');
    }
    public function orderCache(){
        $caches =cachePayment::where('user_id',Auth::id())->get();
        return view('front.home.orderBills.cache',compact('caches'));
    }
    public function AddBillscahceorder(CachePaymentRequest $request){
        // $caches= new cachePayment();
        $usernames=User::where('id',Auth::id())->get();
        $method_payment= $request->input('method_payment');
        $account_number= $request->input('account_number');
        $user_id=Auth::user()->id;
        $Bill_price =$request->input('Bill_price');
        $value= DB::table('totalcharge')->where('user_id',Auth::id())->sum('total_charge');
        if($value > $Bill_price){
            $chache=cachePayment::create([
                'user_id'=>Auth::id(),
                'method_payment'=>$method_payment,
                'account_number'=>$account_number,
                'Bill_price'=>$Bill_price,
                
            ]);
            $price_discount =$Bill_price * (15/100); 
            $price =$price_discount +$Bill_price;
            $minus_total= $value - $price;
            tolalcharge::where('user_id',Auth::id())->update([
                'total_charge'=>$minus_total,
            ]);
            foreach($usernames as $username ){
                $fname=$username->fname;
                
                
           
                
                $chache_id=$chache->id;
                
                $notifcation=new Notifcation;
                        $notifcation->type="طلب دفع كاش جديد";
                        $notifcation->order_id=$chache_id;
                        $notifcation->user=$fname;
                        $url=route('ViewOrdercache',$chache_id);
                        $title=$fname;
                        $body="طلب دفع كاش جديد";
                        $user=User::where('role_as',0)->get();
                        if($notifcation->save()){
                            $notifcation->TOMutilDevices($user,$title,$body,null,$url);
                        }
    
                    }
    
        return redirect('Bills/cache/Payment')->with('status',' تم إرسال الطلب بنجاح يمكنك الإطلاع على الطلب من طلبات الدفع الإلكترونية');
    
            }
            else{
                return redirect('Bills/cache/Payment')->with('status',' لا يمكن  إرسال الطلب لان رصيدك غير كافي');
            
    }
    }
    public function ShowCacheorder($id){
        $caches=cachePayment::where('id',$id)->where('user_id',Auth::id())->get();
        return view('front.home.orderBills.cache-details',compact('caches'));
    }
    public function OrderPending(){
        $caches=cachePayment::where('status','0')->get();
        return view('admin.Billes.cache.order',compact('caches'));
    }
    public function detailsordercache($id){
        $caches=cachePayment::where('id',$id)->get();
        foreach($caches as $cache){
        $user_id= $cache->user_id;
        $name_admin = User::where('id',Auth::id())->first();
        $name=$name_admin->fname;
        $messagesAll=Masseges::get();
        $value= DB::table('totalcharge')->where('user_id',$user_id)->sum('total_charge');
        return view('admin.Billes.cache.detailsOrder',compact('caches','name','value','messagesAll'));
    }
}
public function updatecache(Request $request ,$id){
    $caches=cachePayment::where('id',$id)->get();
    $message=$request->messages;
    foreach($caches as $cache){
        $user_id= $cache->user_id;
        $price= $cache->Bill_price;
        $value= DB::table('totalcharge')->where('user_id',$user_id)->sum('total_charge');
        $commission= $cache->commission;
        $name_admin = User::where('id',Auth::id())->first();
        $name=$name_admin->fname;
        $cachepayments=cachePayment::where('id',$id)->update([
        'commission'=>$request->input('commission'),
        'status'=> $request->input('status'),
        'name_admin'=>$name,
        'messages'=>$message,

    ]);
    
    tolalcharge::where('user_id',$user_id)->update([
        'total_charge'=>$value,
    ]);
    return redirect('Bills/cache/order-cache-pending')->with('status','تم قبول الطلب بنجاح');
}
foreach($cachepayments as $cachepayment){
    $status=$cachepayment->status;
    if($status == 2){
        $price_discount =$Bill_price * (15/100); 
        $price =$price_discount +$Bill_price;
        $minus_total= $value +$price  ;
        tolalcharge::where('user_id',$user_id)->update([
            'total_charge'=>$minus_total,
        ]);
        return redirect('Bills/cache/order-cache-pending')->with('status','تم رفض الطلب بنجاح');  
    }
}
}

public function Acceptordercache(){
    $caches=cachePayment::where('status','1')->get();
    return view('admin.Billes.cache.Aceeptorder',compact('caches'));
}

public function CancelcacheOrder(){
    $caches=cachePayment::where('status','2')->get();

    return view('admin.Billes.cache.Cancelorder',compact('caches'));
}
public function DetailsAllcacheorder($id){
    $caches=cachePayment::where('id',$id)->get();
    return view('admin.Billes.cache.DetailsAllOrder',compact('caches'));
}

}
