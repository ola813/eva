<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Charge;
use App\Models\User;
use App\Models\Masseges;
use App\Models\tolalcharge;
use App\Http\Requests\ChargeRequest;
use App\Models\CompanyElecPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifcation;
use Session;
use rechargess;
class RechargeController extends Controller



{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function AddCharge(){
        $CompanyPays =CompanyElecPayment::all();
        
        return view('front.Payment.charg-balance',compact("CompanyPays"));

    }
    public function getAllPayment(Request $request){
            $user=Auth::user();
            $Payments=Charge::where('user_id',Auth::id())->get();
            $totals=tolalcharge::where('user_id',Auth::id())->get();
            foreach($totals as $total){
                $paymenttotal=$total->total_charge;
                
            }
            return view('front.Payment.recharge',compact('Payments','user','paymenttotal'));
    }

    public function storePayment(ChargeRequest $request){
        $usernames=User::where('id',Auth::id())->get();
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
           $charge= Charge::where('user_id',$user_id)->update([
                'type'=>$type,
                'account'=>$account,
                'image'=>$image,
                'user_id'=>$user_id,
                ]);    
                foreach($usernames as $username ){
                    $fname=$username->fname;
                    
                    
               
                    
                    $charge_id=$charge->id;
                    
                    $notifcation=new Notifcation;
                            $notifcation->type="طلب  شحن محفظة جديد";
                            $notifcation->order_id=$charge_id;
                            $notifcation->user=$fname;
                            $url=route('ViewOrdercharge',$charge_id);
                            $title=$fname;
                            $body="طلب  شحن محفظة جديد";
                            $user=User::where('role_as',0)->get();
                            if($notifcation->save()){
                                $notifcation->TOMutilDevices($user,$title,$body,null,$url);
                            }
        
                        }                                                                            
     
        return redirect('Payment/view')->with('status','تم إرسال طلب  شحن المحفطة بنجاح');
   }
   else{
    return redirect()->back()->with('status','⭐إن أقل مبلغ للتحويل هي عشرة آلاف ليرة سورية⭐');

} 
   }

   public function operationAmount(Request $request){
        $user=Auth::user();
        // $value= DB::table('charge')->where('user_id',$user->id)->sum('account');
        $value = DB::table('charge')->where('user_id',$user->id)->value('account');
        return view('front.layouts.header',compact('value'));
        return $value;
    }

    public function getAllProduct(){
        $p=Charge::select('amount');
        return view('front.Payment.recharge',compact('p'));
    }
 
    public function getAllcharge(){
        $Payments=charge::where('status','0')->get();
        return view('admin.Payments.recharge',compact('Payments'));
    }

    public function myamount($user_id){
        
        // $user = Charge::where('user_id','=',$user_id)->first();
        // $account=$user->account;
        $value= DB::table('charge')->where('user_id',$user_id)->sum('account');
         return view('front.home.home',compact('value'));
    }

    public function detailscharge($id){
        $charges=charge::where('id',$id)->get();
        $messages=Masseges::get();
        $name_admin = User::where('id',Auth::id())->first();
        $name=$name_admin->fname;
        return view('admin.Payments.detailsCharge',compact('charges','name','messages'));
    }
    public function updateCharge(Request $request ,$id){
        $name_admin = User::where('id',Auth::id())->first();
        $name=$name_admin->fname;
        charge::whereId($id)->update([
            'status'=>$request->input('status'),
            'message'=>$request->input('message'),
            'name_admin'=>$name,
            
        ]);
        $charges=charge::where('id',$id)->get();
        foreach($charges as $charge){
            $user_id= $charge->user_id;
            $account= $charge->account;
            $status= $charge->status;
        }
        if($status==1){

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
                ]);
                
            }
        }else{

            return redirect('Payment/Cancel-Charge')->with('status','  تم رفض الطلب ' );
        }
            return redirect('Payment/Accept-Charge')->with('status','تم قبول الطلب بنجاح');
            // $totals->total_charge=$total_charge;
            
            // $charge->update();
            
            // second update
            // return $total_charge;
            // die;
            
        }  
        public function Acceptcharge(){
            $charge=charge::where('status','1')->get();
            
            return view('admin.Payments.AcceptCharge',compact('charge'));
        }
                
        public function Cancelcharge(){
            $charge=charge::where('status','2')->get();
            
            return view('admin.Payments.CancelCharge',compact('charge'));
        }
          
        public function DetailsAllOrder($id){
            // $charges=charge::find($id);
            $charges=charge::where('id',$id)->get();
            return view('admin.Payments.DetailsAllCharge',compact('charges'));
        }
    }
   

