<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Masseges;
use App\Models\BillInternet;
use App\Models\tolalcharge;
use App\Models\Notifcation;
use App\Http\Requests\internetRequest;
class internetController extends Controller
{
    public function pageInternet(){
        return view('front.home.Billies.phon&internet.internet');
    }
    public function Addinterne(internetRequest $request){
        $usernames=User::where('id',Auth::id())->get();
        $company =$request->input('company');
        $number =$request->input('number');
        $mobile_number =$request->input('mobile_number');
        $price =$request->input('price');
        $full_name =$request->input('full_name');
        $value= DB::table('totalcharge')->where('user_id',Auth::id())->sum('total_charge');
        if($value > $price){
            $billinternet=BillInternet::create([
                'user_id'=>Auth::id(),
                'companyInternet_id'=>$company,
                'number'=>$number,
                'mobile_number'=>$mobile_number,
                'full_name'=>$full_name,
                'price'=>$price,
                
            ]);
            $price_discount =$price * (15/100); 
            $price =+$price_discount +$price;
            $minus_total= $value - $price;
            tolalcharge::where('user_id',Auth::id())->update([
                'total_charge'=>$minus_total,
            ]);
            foreach($usernames as $username ){
                $fname=$username->fname;
                
                
           
                
                $billinternet_id=$billinternet->id;
                
                $notifcation=new Notifcation;
                        $notifcation->type="طلب  دفع فاتورة انترنت جديدة";
                        $notifcation->order_id=$billinternet_id;
                        $notifcation->user=$fname;
                        $url=route('ViewOrderinternet',$billinternet_id);
                        $title=$fname;
                        $body="طلب  دفع فاتورة انترنت جديدة";
                        $user=User::where('role_as',0)->get();
                        if($notifcation->save()){
                            $notifcation->TOMutilDevices($user,$title,$body,null,$url);
                        }
    
                    }
            return redirect('Bills/Internet/order-internet')->with('status',' تم ارسال طلب  دفع الفاتورة يمكنك الإطلاع على الطلب من طلبات الدفع الإلكترونية');
            
        }
        else{
            return redirect('/Bills/Internet/Internet')->with('status',' لا يمكن دفع الفاتورة لان رصيدك غير كافي');
        
        }
    

    }

    public function orderinternet(){
        $internets =BillInternet::where('user_id',Auth::id())->get();
        return view('front.home.orderBills.internet',compact('internets'));
    }

      //Admin Function

      public function OrderPending(){
        $internets =BillInternet::where('status','0')->get();
        return view('admin.Billes.internet.order',compact('internets'));
    }
    public function detailsorder($id){
        $phones=BillInternet::where('id',$id)->get();
        $messages=Masseges::get();
        foreach($phones as $phone){
        $user_id= $phone->user_id;
        $fatora=$phone->price;
        $name_admin = User::where('id',Auth::id())->first();
        $name=$name_admin->fname;
        $commission =$fatora * (15/100); 
        $value= DB::table('totalcharge')->where('user_id',$user_id)->sum('total_charge');
        return view('admin.Billes.internet.detailsOrder',compact('phones','name','value','messages','commission'));
    }
}
public function updateinternet(Request $request ,$id){
    $Phones=BillInternet::find($id);
    $user_id= $Phones->user_id;
        $value= DB::table('totalcharge')->where('user_id',$user_id)->sum('total_charge');
        $name_admin = User::where('id',Auth::id())->first();
        $name=$name_admin->fname;
        BillInternet::where('id',$id)->update([
            'status'=> $request->input('status'),
            'name_admin'=>$name,
            'messages'=>$request->input('messages'),
            
        ]);
        
        $Phones=BillInternet::find($id);
        $minus_total= $value - $Phones->commission;
        tolalcharge::where('user_id',$user_id)->update([
            'total_charge'=>$minus_total,
        ]);
        return redirect('Bills/Internet/orderNet')->with('status','تم قبول الطلب بنجاح');
    }
    public function AcceptOrdernet(){
        $phones=BillInternet::where('status','1')->get();
        return view('admin.Billes.internet.Aceeptorder',compact('phones'));
    }

    public function CancelInternetOrder(){
        $internets=BillInternet::where('status','2')->get();

        return view('admin.Billes.internet.Cancelorder',compact('internets'));
    }
    public function DetailsAllInterorder($id){
        $internets=BillInternet::where('id',$id)->get();
        return view('admin.Billes.internet.DetailsAllOrder',compact('internets'));
    }
    public function Showinternetdetails($id){
        $internets=BillInternet::where('id',$id)->where('user_id',Auth::id())->get();
        return view('front.home.orderBills.internet-details',compact('internets'));
    }
}
