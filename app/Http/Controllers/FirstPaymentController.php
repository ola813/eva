<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\firstpayment;
use App\Models\User;
use App\Models\Masseges;
use App\Models\tolalcharge;
use App\Http\Requests\ChargeRequest;
use App\Models\CompanyElecPayment;
use App\Models\Notifcation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use rechargess;
class FirstPaymentController extends Controller
{
    public function pendingPayment(){

        return view('front.Payment.pendingstart');

    }
  
    public function storePaymentpending(ChargeRequest $request){
        $usernames=User::where('id',Auth::id())->get();
        $charge= new firstpayment();
        if($request->hasFile('image')){
            $file=$request->file('image');
            $ext = $file->getClientOriginalExtension();
            $file_name = time().'.'.$ext; 
            $file->move('assets/front/images/Payment',$file_name);
            $image=$file_name;
        }
        
        
        $user_id=Auth::id();
        $type=$request->input('type');
        $account =$request->input('account');  
        if($account >= 10000){
            $firstpayment=firstpayment::where('user_id',$user_id)->update([
                'type'=>$type,
                'account'=>$account,
                'image'=>$image,
                ]);
                foreach($usernames as $username ){
                    $fname=$username->fname;
                    $firstpayment_id=$firstpayment->id;
                    $notifcation=new Notifcation;
                            $notifcation->type="طلب فتح حساب جديد";
                            $notifcation->order_id=$firstpayment_id;
                            $notifcation->user=$fname;
                            $url=route('detailsopenaccount',$firstpayment_id);
                            $title=$fname;
                            $body="طلب فتح حساب جديد";
                            $user=User::where('role_as',0)->get();
                            if($notifcation->save()){
                                $notifcation->TOMutilDevices($user,$title,$body,null,$url);
                            }
        
                        } 
            return redirect('Pending-charge')->with('status',' تم إرسال طلب شحن المحفظة سيتم تفعيل الحساب بأقرب وقت ممكن');
            
        } 
        else{
            return redirect()->back()->with('status','يجب أن يكون مبلغ الشحن 10000 و أكثر ');

        }                                                                               
   }
   public function Paymentpending(){
    return view('front.Payment.pending');
    }
    public function getAllopenaccount(){
        $Payments=firstpayment::where('status','0')->get();
        return view('admin.open_account.recharge',compact('Payments'));
    }
    public function detailsopenaccount($id){
        $charges=firstpayment::where('id',$id)->get();
        $messages=Masseges::get();
        $name_admin = User::where('id',Auth::id())->first();
        $name=$name_admin->fname;
        return view('admin.open_account.detailsCharge',compact('charges','name','messages'));
    }
    public function updateopenaccount(Request $request ,$id){
        $name_admin = User::where('id',Auth::id())->first();
        $name=$name_admin->fname;
        firstpayment::whereId($id)->update([
            'status'=>$request->input('status'),
            'message'=>$request->input('message'),
            'name_admin'=>$name,
            
        ]);
        $charges=firstpayment::where('id',$id)->get();
        foreach($charges as $charge){
            $user_id= $charge->user_id;
            $account= $charge->account;
            $status= $charge->status;

            if($status == 1){
                
                $totals=tolalcharge::where('user_id',$user_id)->get();
                foreach($totals as $total){
                    $user_id_total= $total->user_id;
                    $total_price= $total->total_charge;
                }
                if($user_id_total == $user_id){
                    $total_charge=$total_price+ $account;    
                    tolalcharge::where('user_id',$user_id)->update([
                        'total_charge'=>$total_charge,
                    ]);
                    User::where('id',$user_id)->update([
                        'total-charge'=>$total_charge,
                        'role_as'=>1,
                    ]);
                    
                }
                return redirect('open-account/Accept-Charge')->with('status','تم قبول الطلب بنجاح');
            }else{
                
                return redirect('open-account/Cancel-Charge')->with('status','  تم رفض الطلب استقبال' );
            }
        }
    }    
    public function Acceptopenaccount(){
        $charge=firstpayment::where('status','1')->get();
        
        return view('admin.open_account.AcceptCharge',compact('charge'));
    }
            
    public function Cancelopenaccount(){
        $charge=firstpayment::where('status','2')->get();
        
        return view('admin.open_account.CancelCharge',compact('charge'));
    }
      
    public function DetailsAllopenaccount($id){
        // $charges=charge::find($id);
        $charges=firstpayment::where('id',$id)->get();
        return view('admin.open_account.DetailsAllCharge',compact('charges'));
    }
    public function gottohome(){
    $user=User::where('id',Auth::id())->get();
    foreach($user as $u){
        $role =$u->role_as;
    
        if($role == 1){
            $value= DB::table('charge')->where('user_id',Auth::user()->id)->sum('account');
            $Images=Imageoffer::get();
            return view('front.home.home',compact('value','Images'));
            
        }
        else{
            return redirect()->back()->with('status','لم يتم تفعيل الحساب بعد');
        }
    }
           
    }
    public function chargewallet(){
        $CompanyPays =CompanyElecPayment::all();
        return view('front.Payment.chargewallet',compact("CompanyPays"));
    }

}
