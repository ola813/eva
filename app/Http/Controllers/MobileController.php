<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mobile;
use App\Models\User;
use App\Http\Requests\MobileRequest;
use App\Models\tolalcharge;
use App\Models\Masseges;
use App\Models\Notifcation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class MobileController extends Controller
{
    public function pageindex(){
        return view('front.home.Billies.Mobile.index');
    }
    public function pageMobile(){
        return view('front.home.Billies.Mobile.mobile');
    }
    public function BillMobile(MobileRequest $request){
        $company =$request->input('Company');
        $mobile_number =$request->input('mobile_number');
        $veryfiy_number =$request->input('veryfiy_number');
        $price =$request->input('price');
        $usernames=User::where('id',Auth::id())->get();
        $value= DB::table('totalcharge')->where('user_id',Auth::id())->sum('total_charge');
        if($value > $price){
           $mobile= Mobile::create([
                'user_id'=>Auth::id(),
                'Company'=>$company,
                'mobile_number'=>$mobile_number,
                'veryfiy_number'=>$veryfiy_number,
                'price'=>$price,
                
            ]);
            $minus_total= $value - ($price);
       
            tolalcharge::where('user_id',Auth::id())->update([
                'total_charge'=>$minus_total,
            ]);
            foreach($usernames as $username ){
                $fname=$username->fname;
                
                
           
                
                $mobile_id=$mobile->id;
                
                $notifcation=new Notifcation;
                        $notifcation->type='فاتورة جوال';
                        $notifcation->order_id=$mobile_id;
                        $notifcation->user=$fname;
                        $url=route('ViewOrderMobile',$mobile_id);
                         $title=$fname;
                        $body="طلب دفع فاتورة جوال جديدة";
                        $user=User::where('role_as',0)->get();
                        if($notifcation->save()){
                            $notifcation->TOMutilDevices($user,$title,$body,null,$url);
                        }
                        
                    }
                    return redirect('Bills/mobile/Bill-Mobile')->with(['status'=>'شكرا لتقديمك الطلب تم إرسال الطلب سيتم تنفيذه بأسرع وقت ']);
        }
        else{
            return redirect('Bills/mobile/Bill-Mobile')->with(['status'=>'لا يمكن دفع الفاتورة لان رصيدك غير كافي']);
            // return redirect()->back();
        }
    

    }
    public function orderBillMobile(){
        $mobiles=Mobile::where('user_id',Auth::id())->get();
        return view('front.home.orderBills.mobile',compact('mobiles'));
    }

    //function admin
    public function OrderPending(){
        $mobiles=Mobile::where('status','0')->get();
        return view('admin.Billes.mobile.order',compact('mobiles'));
    }
    public function detailsorder($id){
        $mobiles=Mobile::where('id',$id)->get();
        $messages=Masseges::get();
        foreach($mobiles as $mobile){
        $user_id= $mobile->user_id;
        $name_admin = User::where('id',Auth::id())->first();
        $name=$name_admin->fname;

        $value= DB::table('totalcharge')->where('user_id',$user_id)->sum('total_charge');
        return view('admin.Billes.mobile.detailsOrder',compact('mobiles','name','value','messages'));
    }
}
    public function Acceptorder(){
        $mobiles=Mobile::where('status','1')->get();
        return view('admin.Billes.mobile.Aceeptorder',compact('mobiles'));
    }
    public function updateMobile(Request $request ,$id){
        $mobiles=Mobile::where('id',$id)->get();
        foreach($mobiles as $mobile){
            $user_id= $mobile->user_id;
            $price= $mobile->price;
            $commission= $mobile->commission;
            $value= DB::table('totalcharge')->where('user_id',$user_id)->sum('total_charge');
            $name_admin = User::where('id',Auth::id())->first();
            $name=$name_admin->fname;
            Mobile::where('id',$id)->update([
                'price'=>$price,
                'commission'=>$request->input('commission'),
                'status'=> $request->input('status'),
                'name_admin'=>$name,
                'message'=>$request->input('message'),
                
            ]);
            $minus_total= $value -$commission;
            tolalcharge::where('user_id',$user_id)->update([
                'total_charge'=>$minus_total,
            ]);
            return redirect('Bills/Mobile/Accept')->with('status','تم قبول الطلب بنجاح');
        }
    }

            public function CancelMobileOrder(){
                $mobiles=Mobile::where('status','2')->get();

                return view('admin.Billes.mobile.Cancelorder',compact('mobiles'));
            }
            public function DetailsAllMoborder($id){
                $mobiles=Mobile::where('id',$id)->get();
                return view('admin.Billes.mobile.DetailsAllOrder',compact('mobiles'));
            }
            public function Showmobiledetails($id){
                $mobiles=Mobile::where('id',$id)->where('user_id',Auth::id())->get();
                return view('front..home.orderBills.mobile-details',compact('mobiles'));
            }


}
