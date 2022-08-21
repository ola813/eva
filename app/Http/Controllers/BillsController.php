<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\electronic;
use App\Models\User;
use App\Models\Notifcation;
use App\Http\Requests\ElectronicRequest;
use Illuminate\Support\Facades\Auth;
class BillsController extends Controller
{
    public function showBills(){
        return view('front.home.Billies.index');
    }
    public function Electronic(){
        return view('front.home.Billies.electronic');
    }
    public function AddBills(ElectronicRequest $request){

        $ordernums=electronic::exists('ordernum');
        if($ordernums ==true){
            $ordernums=electronic::get();
            foreach($ordernums as $ordernum){
                $ordernum =$ordernum->ordernum;
              
            }
        }
        else{
            $ordernum =5000;
         
           
        }
        $counter_number= $request->input('counter_number');
        $recorde_register =$request->input('recorde_register');
        $mobile_number =$request->input('mobile_number');
        $country =$request->input('country');
        $user_id=Auth::user()->id;
        $usernames=User::where('id',Auth::id())->get();
        $id =$request->id;
        // $type =$request->type;
        // echo $type;
        // die();
        foreach($usernames as $username ){
            $fname=$username->fname;
            
            
            $Bills=electronic::create([
                'counter_number'=>$counter_number,
                'recorde_register'=>$recorde_register,
                'mobile_number'=>$mobile_number,
                'country'=>$country,
                'ordernum'=>$ordernum,
                'user_id'=>$user_id,
               
            ]);
            
            $Bills_id=$Bills->id;
            
            $notifcation=new Notifcation;
                    $notifcation->type='فاتورة الكهرباء';
                    $notifcation->order_id=$Bills_id;
                    $notifcation->user=$fname;
                    $url=route('order-Electornic',$Bills);
                     $title=$fname;
                    $body="طلب دفع فاتورة الكهربا جديدة";
                    $user=User::where('role_as',0)->get();
                    if($notifcation->save()){
                        $notifcation->TOMutilDevices($user,$title,$body,null,$url);

                    }
                    
                }
                return redirect('Bills/electronic/Electornice')->with('status','تم ارسال الطلب بنجاح يمكنك الاطلاع على الطلب من طلبات الفواتير' );
                }
           

    

    public function vieworder(){
        return view('front.home.orderBills.index');
    }


}
