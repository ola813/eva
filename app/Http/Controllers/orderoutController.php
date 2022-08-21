<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderOut;
use App\Models\tolalcharge;
use App\Models\Masseges;
use App\Models\User;
use App\Models\Notifcation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class orderoutController extends Controller
{
    public function orderOut(){
        return view('front.order out.insert');
    }
    public function AddOrderOut(Request $request){
        $message=$request->message;
        $price=$request->price;
               $newprice=0;
               $usernames=User::where('id',Auth::id())->get();
               $value= DB::table('totalcharge')->where('user_id',Auth::id())->sum('total_charge');
               if($value > $price){
                    $orderout=OrderOut::create([
                        'user_id'=>Auth::id(),
                        'message'=>$message,
                        'price'=>$price,
                    ]);
                    $newprice=$value - $price; 
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                    foreach($usernames as $username ){
                        $fname=$username->fname;
                        
                        
                   
                        
                        $orderout_id=$orderout->id;
                        
                        $notifcation=new Notifcation;
                                $notifcation->type="طلب خارجي جديد";
                                $notifcation->order_id=$orderout_id;
                                $notifcation->user=$fname;
                                $url=route('detials-order-out',$orderout_id);
                                 $title=$fname;
                                $body="طلب خارجي جديد";
                                $user=User::where('role_as',0)->get();
                                if($notifcation->save()){
                                    $notifcation->TOMutilDevices($user,$title,$body,null,$url);
                                }
            
                            }
                            
                            return redirect('order-out')->with(['status'=>'تم ارسال الطلب بنجاح']);
                    }
                    
                    else{
                        return redirect('order-out')->with(['status'=>'لا يمكن الشراء لان رصيدك غير كافي']);
                        
                    }
                    return redirect('/');
                }
                public function ShowOrderOut(){
                    $orderouts=OrderOut::where('user_id',Auth::id())->get();
                    return view('front.order out.show','orderouts');
                }

                //Admin
                public function vieworderout(){
                    $orderouts=OrderOut::where('status',0)->get();
                    return view('admin.order-out.order',compact('orderouts'));
                }
                public function detailsorderout($id){
                    $orderouts=OrderOut::where('id',$id)->get();
                    $messages=Masseges::get();
                    $name_admin = User::where('id',Auth::id())->first();
                    $name=$name_admin->fname;
                  
                    return view('admin.order-out.detailsOrder',compact('orderouts','name','messages'));
                }

                public function  updateorderOut(Request $request ,$id){
                    $orderouts=OrderOut::where('id',$id)->get();
                    $status=$request->input('status');
                    $notic=$request->notic;
                    $price_act=$request->input('price_act');
                    $name_admin = User::where('id',Auth::id())->first();
                    $name=$name_admin->fname;
                    foreach($orderouts as $orderout){
                        $price=$orderout->price;
                        $user_id=$orderout->user_id;
                        $newtotal=0;
                        $value= DB::table('totalcharge')->where('user_id',$user_id)->sum('total_charge');
                        OrderOut::where('id',$id)->update([
                            'name_admin'=>$name,
                            'status'=>$status,
                            'notic'=>$notic,
                            'price_act'=>$price_act,
                            'commission'=>$price -$price_act,
                            
                        ]);
                      
                      
                        if($status=='2'){
                            $newtotal=$value + $price;
                            tolalcharge::where('user_id',$user_id)->update([
                                'total_charge'=>$newtotal,
                            ]);
                        }
                    }
                    return redirect('orderOut/AllorderOut')->with('status','تم قبول الطلب بنجاح');
                }
                public function Acceptorder(){
                    $OrderOuts=OrderOut::where('status','1')->get();
                
                    return view('admin.order-out.Aceeptorder',compact('OrderOuts'));
                }
                public function Cancelorder(){
                    $OrderOuts=OrderOut::where('status','2')->get();
                
                    return view('admin.order-out.Cancelorder',compact('OrderOuts'));
                }
                public function DetailsAllOrder($id){
                    $OrderOuts=OrderOut::where('id',$id)->get();
                    return view('admin.order-out.DetailsAllOrder',compact('OrderOuts'));
                }
    }
