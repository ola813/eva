<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Masseges;
use App\Models\tolalcharge;
use App\Models\Notifcation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function ShowOrderdetails($id){
        $orders=Order::where('id',$id)->get();
        return view('front.home.order0neDetails',compact('orders'));
    }
    public function vieworder(){
        $orders=Order::where('status','0')->get();
        return view('admin.orders.order',compact('orders'));
    }
    public function detailsorder($id){
        $orders=Order::where('id',$id)->get();
        $messages=Masseges::get();
        $name_admin = User::where('id',Auth::id())->first();
        $name=$name_admin->fname;
        Notifcation::where('order_id',$id)->update([
            'read_at'=>date('Y-m-d H:i:s')
            
        ]);
        
        return view('admin.orders.detailsOrder',compact('orders','name','messages'));
    }
    public function  updateorder(Request $request ,$id){
        $orders=Order::where('id',$id)->get();
        // return $orders;
        // die();
        $status=$request->input('status');
        $message=$request->input('message');
        
        $name_admin = User::where('id',Auth::id())->first();
        $name=$name_admin->fname;
        foreach($orders as $order){
            $price=$order->price;
            $user_id=$order->user_id;
            $newtotal=0;
           
      
            $value= DB::table('totalcharge')->where('user_id',$user_id)->sum('total_charge');
            Order::where('id',$id)->update([
                'name_admin'=>$name,
                'status'=>$status,
                'message'=>$message,
                
            ]);
          
            
        
            if($status=='2'){
                $newtotal=$value + $price;
                tolalcharge::where('user_id',$user_id)->update([
                    'total_charge'=>$newtotal,
                ]);
            }
        }
        return redirect('orders/Allorder')->with('status','تم قبول الطلب بنجاح');
    }
    
    public function Acceptorder(){
        $orders=Order::where('status','1')->get();
    
        return view('admin.orders.Aceeptorder',compact('orders'));
    }
    public function Cancelorder(){
        $orders=Order::where('status','2')->get();
    
        return view('admin.orders.Cancelorder',compact('orders'));
    }
    public function DetailsAllOrder($id){
        $orders=Order::where('id',$id)->get();
        return view('admin.orders.DetailsAllOrder',compact('orders'));
    }
    public function readorder(Request $request){
        if($request->ajax()){
            $not=Notifcation::read();
            return view('admin.read.readorder',compact('not'));
        }
    }
}

