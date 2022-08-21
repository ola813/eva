<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blance_transfer;
use App\Models\valueaccount;
use App\Models\priceBalance;
use App\Models\tolalcharge;
use App\Models\Company;
use App\Models\Masseges;
use App\Models\User;
use App\Models\Notifcation;
use App\Http\Requests\BalanceRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class BalanceController extends Controller
{
    
    public function pageBalance(){
        $balances =valueaccount::get();
        $Company =Company::get();
        // foreach($Company as $company){
        //     $companyId=$company->id;
        // }
      
        return view('front.home.Billies.Mobile.Balance_transfer',compact('balances','Company'));
    }
    public function orderBalance(){
        $balances =Blance_transfer::get();
        return view('front.home.orderBills.Balance',compact('balances'));
    }
    public function OrderBalancepending(){
        $balances =Blance_transfer::where('status','0')->get();
        
        return view('admin.Billes.blance.order',compact('balances'));
    }

    public function AddBlance(BalanceRequest $request){
        $balances =Blance_transfer::where('user_id',Auth::id())->get();
        $usernames=User::where('id',Auth::id())->get();
        $value =$request->input('value');
        $mobile_number=$request->input('mobile_number');
        $company_id =$request->input('company_id');
        $valuetotal= DB::table('totalcharge')->where('user_id',Auth::id())->sum('total_charge');
        $price_blances=priceBalance::where('valueaccount_id',$value)->get();
        foreach($price_blances as $price_blance){

            $price=$price_blance->price;
            if($valuetotal >$price+500){
                $Balance=Blance_transfer::create([
                    'user_id'=>Auth::id(),
                    'company_id'=>$company_id,
                    'value'=>$value,
                    'mobile_number'=>$mobile_number,
                    'price'=>$price,
                    
                ]);
                $newValue= $valuetotal - $price;
                tolalcharge::where('user_id',Auth::id())->update([
                    'total_charge'=>$newValue,
                ]);
                foreach($usernames as $username ){
                    $fname=$username->fname;
                    
                    
               
                    
                    $Balance_id=$Balance->id;
                    
                    $notifcation=new Notifcation;
                            $notifcation->type='طلب تحويل رصيد';
                            $notifcation->order_id=$Balance_id;
                            $notifcation->user=$fname;
                            $url=route('ViewOrderBalance',$Balance_id);
                             $title=$fname;
                            $body="طلب تحويل رصيد جديد";
                            $user=User::where('role_as',0)->get();
                            if($notifcation->save()){
                                $notifcation->TOMutilDevices($user,$title,$body,null,$url);
                            }
                            
                        }
                
                return redirect('/Bills/Balance/Balance')->with('status',' تم ارسال طلب   تحويل الرصيد يمكنك الإطلاع على الطلب من طلبات الدفع الالكترونية');
            }
            else{
                return redirect('/Bills/Balance/Balance')->with('status','لا يمكن تحويل الرصيد لان رصيدك غير كافي يجب ان يكون رصيدك اكبر من قيمة التحويل ب 500 ل.س');
                
            }
        }
    
    
        // return redirect('Bills/Blance/orderBalance')->with('status','Product Added Successfully');

    }

    public function AccountPage(){
        return view('admin.Billes.blance.insert');
    }
    public function Addaccount(Request $request){
   
        
        $value =$request->input('value');
        $company_id =$request->input('company_id');
        $valuetotal= DB::table('totalcharge')->where('user_id',Auth::id())->sum('total_charge');
        $price =$request->input('price');
        $orginal_price =$request->input('orginal_price');
        
        $valueAcc= valueaccount::create([
            'value'=>$value,
            'company_id'=>$company_id,
        ]);
        priceBalance::create([
            'valueaccount_id'=>$valueAcc->id,
            'price'=>$price,
            'orginal_price'=>$orginal_price,
            'commission'=>$price -$orginal_price,
        ]);
        
        return redirect('Bills/Blance/AllAccount')->with('status','تم إضافة فئة الرصيد بنجاح');

    }
    public function AllAccount(){
        $Blances =valueaccount::get();
        return view('admin.Billes.blance.show',compact('Blances'));
    }

    public function view()
    {
        $companies = \DB::table('company')
            ->get();
        
        return view('front.home.Billies.Mobile.Balance_transfer', compact('companies'));
    }
    public function getBlance(Request $request)
    {
        $balance = \DB::table('valueaccount')
            ->where('company_id', $request->company_id)
            ->get();
        
        if (count($balance) > 0) {
            return response()->json($balance);
        }
    }

    public function getPrice(Request $request)
    {
        $prices = \DB::table('price_balances')
            ->where('valueaccount_id', $request->valueaccount_id)
            ->get();
        
        if (count($prices) > 0) {
            return response()->json($prices);
        }
    }
    public function deleteBalance($id){
        valueaccount::where('id',$id)->delete();
        priceBalance::where('id',$id)->delete();
        return redirect()->back();
    }
    public function detailsBalance($id){
        $Balances=Blance_transfer::where('id',$id)->get();
        $messages=Masseges::get();
        foreach($Balances as $Balance){
        $user_id= $Balance->user_id;
        $name_admin = User::where('id',Auth::id())->first();
        $name=$name_admin->fname;
        $value= DB::table('totalcharge')->where('user_id',$user_id)->sum('total_charge');
        return view('admin.Billes.blance.detailsOrder',compact('Balances','name','value','messages'));
    }
}
public function updateBalance(Request $request ,$id){
    $Balances=Blance_transfer::where('id',$id)->get();
    $status=$request->input('status');
    foreach($Balances as $Balance){
        $user_id= $Balance->user_id;
        $price= $Balance->price;
        $value= DB::table('totalcharge')->where('user_id',$user_id)->sum('total_charge');
        $name_admin = User::where('id',Auth::id())->first();
        $name=$name_admin->fname;
        Blance_transfer::where('id',$id)->update([
            'price'=>$price,
            'status'=> $request->input('status'),
            'name_admin'=>$name,
            'message'=>$request->input('message'),
            
        ]);
      
    
        return redirect('Bills/Blance/OrderBalance')->with('status','تم معالجة الطلب بنجاح');
    }
}
        public function AcceptBalance(){
            $Balances=Blance_transfer::where('status','1')->get();
            return view('admin.Billes.blance.Aceeptorder',compact('Balances'));
        }
        public function CancelBlanceOrder(){
            $Balances=Blance_transfer::where('status','2')->get();

            return view('admin.Billes.blance.CancelBalnce',compact('Balances'));
        }
        public function DetailsAllBalance($id){
            $Balances=Blance_transfer::where('id',$id)->get();
            return view('admin.Billes.blance.DetailsAllBlance',compact('Balances'));
        }
}