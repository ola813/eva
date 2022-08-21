<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Cart;
use App\Models\tolalcharge;
use App\Models\Pointuser;
use App\Models\codepoint;
use App\Models\User;
use App\Models\Couponpoint;
use App\Models\codegaming;
use App\Models\Notifcation;
use View;
use Session;
class CartController extends Controller
{
    public function addTOCart(Request $request){
        
       
        $product_id =$request->input('product_id');
        $product_qty =$request->input('product_qty');

        $product_price =$request->product_price;
        $total_quantity = intval($product_qty);
        // echo $total_quantity;
        // die();
        $total_price = intval($product_price);
        $total_results = $total_quantity * $total_price;
       
        $name =$request->input('user_name');
        $number =$request->input('number');
        $unique =$request->input('unique');
        
        if(Auth::check()){
            $pro_check = Product::where('id',$product_id)->first();
            if($pro_check){
                if(Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists())
                {
                    return response()->json(['status'=>'المنتج موجود في سلة المشتريات']);
                    
                }
                else{
                    
                    // $cartusers=Cart::where('user_id',Auth::id())->get();
                    $countcart= DB::table('carts')->where('user_id',Auth::id())->sum('product_qty');
                    if($countcart == 0){
                        $Cartitem=new Cart();
                        $Cartitem->product_id=$product_id;
                        $Cartitem->product_price=$total_price;
                        $Cartitem->total_price=$total_results;
                        $Cartitem->user_id=Auth::id();
                        $Cartitem->total_id=Auth::id();
                        $Cartitem->product_qty=$total_quantity;
                        $Cartitem->user_name=$name;
                        $Cartitem->number=$number;
                        $Cartitem->save();
                        return response()->json(['status'=>'تم الاضافة لسلة المشتريات يرجى الانتقال للسلة لاتمام العملية']);
                    }
                    
                   
                                $Cartitem=new Cart();
                            if($countcart !=0 ){

                            
                            if(($countcart + $total_quantity) < 6){
                                $Cartitem->product_id=$product_id;
                                $Cartitem->product_price=$total_price;
                                $Cartitem->total_price=$total_results;
                                $Cartitem->user_id=Auth::id();
                                $Cartitem->total_id=Auth::id();
                                $Cartitem->product_qty=$total_quantity;
                                $Cartitem->user_name=$name;
                                $Cartitem->number=$number;
                                $Cartitem->save();
                                return response()->json(['status'=>'تم الاضافة لسلة المشتريات يرجى الانتقال للسلة لاتمام العملية']);
                    }
                    
                    else if(($countcart + $total_quantity) > 5){
                        return response()->json(['status'=>'لا يمكن الاضافة المنتج للسلة لان اجمالي السلة خمس منتجات فقط']);
                        $Cartitem->delete();
                        return redirect()->back();
                        
                    }
                }
            
               
                
             
            }
            }
            }
            else{return response()->json(['status'=>'يجب عليك تسجيل الدخول ']);}
    
}

public function viewCart(){
    $Cartitem=Cart::where('user_id',Auth::id())->get();
    $value= tolalcharge::where('user_id',Auth::id())->sum('total_charge');;
        return view('front.cart.cart',compact('Cartitem','value'));

    }

    public function deleteProduct(Request $request){
        if(Auth::check()){
            $prod_id= $request->input('product_id');
            if(Cart::where('product_id',$prod_id)->where('user_id',Auth::id())->exists()){
                $cartitem =Cart::where('product_id',$prod_id)->where('user_id',Auth::id())->first();
                $cartitem->delete();
                return response()->json(['status'=>'تم حذف المنتج من السلة بنجاح']);
            }
        }
        else{
            return response()->json(['status'=>'login to Continue']);
        }
    }
    
    public function updateCart(Request $request){
        $prod_id = $request->input('product_id');
        $prod_qty = $request->input('product_qty');
        
        if(Auth::check())
        {
            if(Cart::where('product_id',$prod_id)->where('user_id',Auth::id())->exists()){
                $cart = Cart::where('product_id',$prod_id)->where('user_id',Auth::id())->first();
                $cart->product_qty =$prod_qty;
                $cart->update();
                return response()->json(['status'=>'Quantity update']);
            }
        }
    }
    
    public function addorder(Request $request){
        $Cartitem=Cart::where('user_id',Auth::id())->get();
        $ordernums=Order::exists('ordernum');
        if($ordernums ==true){
            $ordernums=Order::get();
            foreach($ordernums as $ordernum){$ordernum =$ordernum->ordernum; }}
        else{$ordernum =5000; }
   
      
        $User=User::all();
        $total=$request->total;
        $totalpoint=$request->totalpoint;
        $price1=$request->product_price;
        $price2=$request->product_price2;
        $product_qty=$request->product_qty;
        $product_id=$request->product_id;
        $price_point1=$request->price_point1;
        $price_point2=$request->price_point2;
        $price_point3=$request->price_point3;
        $gift_point=$request->gift_point;
        $gift_point1=$request->gift_point1;
        $gift_point2=$request->gift_point2;
        $gift_point3=$request->gift_point3;
        $total_gift1 = intval($gift_point1);
     
        $total_gift2 = intval($gift_point2);
        $total_gift3 = intval($gift_point3);
        $total_gift_point=$total_gift1 + $total_gift2 + $total_gift3;
      
        $couponAmount=$request->coupontotal;
        $code=$request->code;
        
        if($code==null ||$couponAmount==null ){
            
           foreach($Cartitem as $item){
               $newprice=0;
               $newpoint=0;
               $value= DB::table('totalcharge')->where('user_id',Auth::id())->sum('total_charge');
               $pointuser= DB::table('pointuser')->where('user_id',Auth::id())->sum('point');
                $usernames=User::where('id',Auth::id())->get();
                foreach($usernames as $username ){
                    $fname=$username->fname;
                  //شراء منتج بسعر لوحده
                    if($price1 !=0 && $price_point1 ==0 && $price2 ==0 && $price_point2 ==0 && $price_point3 ==0){
                        
                    if($value > $total ){

                        $Cartitem=Cart::where('user_id',Auth::id())->get();
                        // echo $Cartitem;
                        
                        foreach($Cartitem as $item){
                        $endsells=Product::where('id',$item->product_id)->get();
                        $ordernum=$ordernum+1;
                        foreach($endsells as $endsell){
                            $pricefinal=$endsell->selling_price;
                            $pointfinal=$endsell->price_point;
                            $type_product=$endsell->type_product;
                            // echo $type_product;
                            // die();
                            $freefire110=codegaming::pluck('freefire110')->first();
                            $freefire231=codegaming::pluck('freefire231')->first();
                            $freefire583=codegaming::pluck('freefire583')->first();
                            $pubge60=codegaming::pluck('pubge60')->first();
                            $pubge325=codegaming::pluck('pubge325')->first();
                            $Roblox10=codegaming::pluck('Roblox10')->first();
                            $Razar5=codegaming::pluck('Razar5')->first();
                            $Razar10=codegaming::pluck('Razar10')->first();
                            $Razar20=codegaming::pluck('Razar20')->first();
                            $ituns5=codegaming::pluck('ituns5')->first();
                            $ituns10=codegaming::pluck('ituns10')->first();
                            $ituns20=codegaming::pluck('ituns20')->first();
                            $oropa200=codegaming::pluck('oropa200')->first();
                            $oropa315=codegaming::pluck('oropa315')->first();
                            $oropa795=codegaming::pluck('oropa795')->first();
                            // echo $pubge60=codegaming::pluck('pubge60')->count();
                            // die();
                        
                    if($type_product==1 && $freefire110 !=null){
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$freefire110,
                        
                    ]);
                    
                    $newprice=$value - $total; 
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$pointuser + $total_gift_point,
                    ]);
                    
                   codegaming::where('freefire110',$freefire110)->delete();
                               
                        }

                    elseif($type_product==2 && $freefire231!=null){
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$freefire231,
                        
                    ]);
                    
                    $newprice=$value - $total; 
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$pointuser + $total_gift_point,
                    ]);
                    
                   codegaming::where('freefire231',$freefire231)->delete();
                               
                        }
                    elseif($type_product==3 && $freefire583!=null){
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$freefire583,
                        
                    ]);
                    
                    $newprice=$value - $total; 
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$pointuser + $total_gift_point,
                    ]);
                    
                   codegaming::where('freefire583',$freefire583)->delete();
                               
                        }
                    elseif($type_product==4 && $pubge60!=null){
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$pubge60,
                        
                    ]);
                    
                    $newprice=$value - $total; 
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$pointuser + $total_gift_point,
                    ]);
                    
                   codegaming::where('pubge60',$pubge60)->delete();
                               
                        }
                    elseif($type_product==5 && $pubge325!=null){
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$pubge325,
                        
                    ]);
                    
                    $newprice=$value - $total; 
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$pointuser + $total_gift_point,
                    ]);
                    
                   codegaming::where('pubge325',$pubge325)->delete();
                               
                        }
                    elseif($type_product==6&& $Roblox10!=null){
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$Roblox10,
                        
                    ]);
                    
                    $newprice=$value - $total; 
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$pointuser + $total_gift_point,
                    ]);
                    
                   codegaming::where('Roblox10',$Roblox10)->delete();
                               
                        }
                    elseif($type_product==7 && $Razar5!=null){
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$Razar5,
                        
                    ]);
                    
                    $newprice=$value - $total; 
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$pointuser + $total_gift_point,
                    ]);
                    
                   codegaming::where('Razar5',$Razar5)->delete();
                               
                        }
                    elseif($type_product==8 && $Razar10!=null){
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$Razar10,
                        
                    ]);
                    
                    $newprice=$value - $total; 
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$pointuser + $total_gift_point,
                    ]);
                    
                   codegaming::where('Razar10',$Razar10)->delete();
                               
                        }
                    elseif($type_product==9 && $Razar20!=null){
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$Razar20,
                        
                    ]);
                    
                    $newprice=$value - $total; 
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$pointuser + $total_gift_point,
                    ]);
                    
                   codegaming::where('Razar20',$Razar20)->delete();
                               
                        }
                    elseif($type_product==10 && $ituns5!=null){
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$ituns5,
                        
                    ]);
                    
                    $newprice=$value - $total; 
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$pointuser + $total_gift_point,
                    ]);
                    
                   codegaming::where('ituns5',$ituns5)->delete();
                               
                        }
                    elseif($type_product==11 && $ituns10!=null){
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$ituns10,
                        
                    ]);
                    
                    $newprice=$value - $total; 
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$pointuser + $total_gift_point,
                    ]);
                    
                   codegaming::where('ituns10',$ituns10)->delete();
                               
                        }
                    elseif($type_product==12 && $ituns20!=null){
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$ituns20,
                        
                    ]);
                    
                    $newprice=$value - $total; 
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$pointuser + $total_gift_point,
                    ]);
                    
                   codegaming::where('ituns20',$ituns20)->delete();
                               
                        }
                    elseif($type_product==13 && $oropa200!=null){
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$oropa200,
                        
                    ]);
                    
                    $newprice=$value - $total; 
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$pointuser + $total_gift_point,
                    ]);
                    
                   codegaming::where('oropa200',$oropa200)->delete();
                               
                        }
                    elseif($type_product==14 && $oropa315!=null){
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$oropa315,
                        
                    ]);
                    
                    $newprice=$value - $total; 
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$pointuser + $total_gift_point,
                    ]);
                    
                   codegaming::where('oropa315',$oropa315)->delete();
                               
                        }
                    elseif($type_product==15 && $oropa795!=null){
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$oropa795,
                        
                    ]);
                    
                    $newprice=$value - $total; 
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$pointuser + $total_gift_point,
                    ]);
                    
                   codegaming::where('oropa795',$oropa795)->delete();
                               
                        }
                    
                        elseif($type_product==16 || $freefire110==null ||$freefire231 =null || $freefire583 =null || $pubge60==null ||$pubge325==null ||$Roblox10==null ||$Razar5==null ||$Razar10==null ||$Razar20==null ||$ituns5 ==null ||$ituns10 ==null || $ituns20==null ||$oropa200==null ||$oropa315==null ||$oropa795==null){
                         
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                            
                        
                                    ]);
                                    
                                    $newprice=$value - $total; 
                                    tolalcharge::where('user_id',Auth::id())->update([
                                        'total_charge'=>$newprice,
                                    ]);
                                    Pointuser::where('user_id',Auth::id())->update([
                                        'point'=>$pointuser + $total_gift_point,
                                    ]);
                               
                        }
                    
                        
                        
                    }
                  
                    
                }
                    $Cartitem=Cart::where('user_id',Auth::id())->get();
                    Cart::destroy($Cartitem);
                    //notficatio Add Order        
                    $notifcation=new Notifcation;
                    $notifcation->product_id=$product_id;
                    // $notifcation->product_id=$product_id;
                    $notifcation->order_id=$order->id;
                    
                    $notifcation->user=$fname;
                    $url=route('detials-order',$order->id);
                     $title=$fname;
                    $body="عملية شراء جديدة";
                    $user=User::where('role_as',0)->get();
                    if($notifcation->save()){
                        $notifcation->TOMutilDevices($user,$title,$body,null,$url);

                    }

                    return response()->json(['status'=>'تم ارسال طلب الشراء']);
           
            }
                else{
                    return response()->json(['status'=>'لا يمكن الشراء لان رصيدك غير كافي']);
                    
                }
            }

            //شراء منتج بسعر + منتج بسعرونقاط
               elseif($price1 !=0 && $price2 !=0 && $price_point2 !=0 && $price_point3 ==0) {
                
                   if($value > $total && $pointuser >= $totalpoint){ 
                       $Cartitem=Cart::where('user_id',Auth::id())->get();
                       foreach($Cartitem as $item){
                           $ordernum=$ordernum+1;
                        $endsells=Product::where('id',$item->product_id)->get();
                        foreach($endsells as $endsell){
                            $pricefinal=$endsell->selling_price;
                            $pointfinal=$endsell->price_point;
                            $pointgift=$endsell->point;
                            $type_product=$endsell->type_product;
                            // echo $type_product;
                            // die();
                            $freefire110=codegaming::pluck('freefire110')->first();
                            $freefire231=codegaming::pluck('freefire231')->first();
                            $freefire583=codegaming::pluck('freefire583')->first();
                            $pubge60=codegaming::pluck('pubge60')->first();
                            $pubge325=codegaming::pluck('pubge325')->first();
                            $Roblox10=codegaming::pluck('Roblox10')->first();
                            $Razar5=codegaming::pluck('Razar5')->first();
                            $Razar10=codegaming::pluck('Razar10')->first();
                            $Razar20=codegaming::pluck('Razar20')->first();
                            $ituns5=codegaming::pluck('ituns5')->first();
                            $ituns10=codegaming::pluck('ituns10')->first();
                            $ituns20=codegaming::pluck('ituns20')->first();
                            $oropa200=codegaming::pluck('oropa200')->first();
                            $oropa315=codegaming::pluck('oropa315')->first();
                            $oropa795=codegaming::pluck('oropa795')->first();
                            
                        
                    if($type_product==1 && $freefire110!=null){
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$freefire110,
                        
                    ]);
                    
                    $newprice=$value - $total; 
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                  
                    $newpoint1=$pointuser - $totalpoint; 
                    $newpoint2=$newpoint1+$total_gift_point; 
                    
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$newpoint2,
                    ]);
                    
                   codegaming::where('freefire110',$freefire110)->delete();
                               
                        }
                        elseif($type_product==2 && $freefire231!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$freefire231,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                tolalcharge::where('user_id',Auth::id())->update([
                                    'total_charge'=>$newprice,
                                ]);
                            
                                $newpoint1=$pointuser - $totalpoint; 
                                $newpoint2=$newpoint1+$total_gift_point; 
                                
                                Pointuser::where('user_id',Auth::id())->update([
                                    'point'=>$newpoint2,
                                ]);
                           codegaming::where('freefire231',$freefire231)->delete();
                                       
                                }
                            elseif($type_product==3 && $freefire583!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$freefire583,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint1=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint1+$total_gift_point; 
                            
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('freefire583',$freefire583)->delete();
                                       
                                }
                            elseif($type_product==4 && $pubge60!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$pubge60,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint1=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint1+$total_gift_point; 
                            
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('pubge60',$pubge60)->delete();
                                       
                                }
                            elseif($type_product==5 && $pubge325!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$pubge325,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint1=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint1+$total_gift_point; 
                            
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('pubge325',$pubge325)->delete();
                                       
                                }
                            elseif($type_product==6 && $Roblox10!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Roblox10,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint1=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint1+$total_gift_point; 
                            
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('Roblox10',$Roblox10)->delete();
                                       
                                }
                            elseif($type_product==7 && $Razar5!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Razar5,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint1=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint1+$total_gift_point; 
                            
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                           codegaming::where('Razar5',$Razar5)->delete();
                                       
                                }
                            elseif($type_product==8 && $Razar10!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Razar10,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint1=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint1+$total_gift_point; 
                            
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('Razar10',$Razar10)->delete();
                                       
                                }
                            elseif($type_product==9 && $Razar20!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Razar20,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint1=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint1+$total_gift_point; 
                            
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('Razar20',$Razar20)->delete();
                                       
                                }
                            elseif($type_product==10 && $ituns5!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$ituns5,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint1=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint1+$total_gift_point; 
                            
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('ituns5',$ituns5)->delete();
                                       
                                }
                            elseif($type_product==11 && $ituns10!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$ituns10,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint1=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint1+$total_gift_point; 
                            
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('ituns10',$ituns10)->delete();
                                       
                                }
                            elseif($type_product==12 && $ituns20!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$ituns20,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint1=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint1+$total_gift_point; 
                            
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('ituns20',$ituns20)->delete();
                                       
                                }
                            elseif($type_product==13 && $oropa200!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$oropa200,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint1=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint1+$total_gift_point; 
                            
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('oropa200',$oropa200)->delete();
                                       
                                }
                            elseif($type_product==14 && $oropa315!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$oropa315,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint1=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint1+$total_gift_point; 
                            
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('oropa315',$oropa315)->delete();
                                       
                                }
                            elseif($type_product==15 && $oropa795!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$oropa795,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint1=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint1+$total_gift_point; 
                            
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('oropa795',$oropa795)->delete();
                                       
                                }
                    elseif($type_product==16 || $freefire110==null ||$freefire231 ==null || $freefire583 ==null || $pubge60==null ||$pubge325==null ||$Roblox10==null ||$Razar5==null ||$Razar10==null ||$Razar20==null ||$ituns5 ==null ||$ituns10 ==null || $ituns20==null ||$oropa200==null ||$oropa315==null ||$oropa795==null){   
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        
                    ]);
                    $newprice=$value - $total; 
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                  
                    $newpoint1=$pointuser - $totalpoint; 
                    $newpoint2=$newpoint1+$total_gift_point; 
                    
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$newpoint2,
                    ]);
                }
                }
            }
                
                    $Cartitem=Cart::where('user_id',Auth::id())->get();
                    Cart::destroy($Cartitem);
                    //notficatio Add Order        
                    $notifcation=new Notifcation;
                    $notifcation->product_id=$product_id;
                    // $notifcation->product_id=$product_id;
                    $notifcation->order_id=$order->id;
                    $notifcation->user=$fname;
                    $url=route('detials-order',$order->id);
                    $title=$fname;
                    $body="عملية شراء جديدة";
                    $user=User::where('role_as',0)->get();
                    if($notifcation->save()){
                        $notifcation->TOMutilDevices($user,$title,$body,null,$url);

                    }

                    return response()->json(['status'=>' تم ارسال طلب الشراء بنجاح']);
                }
                else{
                    return response()->json(['status'=>' لا يمكن الشراء لان رصيدك غير كافي']);
                    
                }
            }
            //شراء منتج بسعر ونقاط لوحده
               elseif($price1 ==0 && $price2 !=0 && $price_point2 !=0  && $price_point3 ==null){
                   
                   if($value > $total && $pointuser >= $totalpoint){ 
                       //    echo $endsells;
                       //    die();
                       $Cartitem=Cart::where('user_id',Auth::id())->get();
                       foreach($Cartitem as $item){
                           $ordernum=$ordernum+1;
                        $endsells=Product::where('id',$item->product_id)->get();
                        foreach($endsells as $endsell){
                            $pricefinal=$endsell->selling_price;
                            $pointfinal=$endsell->price_point;
                            $type_product=$endsell->type_product;
                            // echo $type_product;
                            // die();
                            $freefire110=codegaming::pluck('freefire110')->first();
                            $freefire231=codegaming::pluck('freefire231')->first();
                            $freefire583=codegaming::pluck('freefire583')->first();
                            $pubge60=codegaming::pluck('pubge60')->first();
                            $pubge325=codegaming::pluck('pubge325')->first();
                            $Roblox10=codegaming::pluck('Roblox10')->first();
                            $Razar5=codegaming::pluck('Razar5')->first();
                            $Razar10=codegaming::pluck('Razar10')->first();
                            $Razar20=codegaming::pluck('Razar20')->first();
                            $ituns5=codegaming::pluck('ituns5')->first();
                            $ituns10=codegaming::pluck('ituns10')->first();
                            $ituns20=codegaming::pluck('ituns20')->first();
                            $oropa200=codegaming::pluck('oropa200')->first();
                            $oropa315=codegaming::pluck('oropa315')->first();
                            $oropa795=codegaming::pluck('oropa795')->first();
                            
                        
                    if($type_product==1 && $freefire110!=null){
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$freefire110,
                        
                    ]);
                    
                    $newprice=$value - $total; 
                                
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                    
                    $newpoint=$pointuser - $totalpoint; 
                    $newpoint2=$newpoint+$total_gift_point; 
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$newpoint2,
                    ]);
                    
                   codegaming::where('freefire110',$freefire110)->delete();
                               
                        }
                        elseif($type_product==2 && $freefire231!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$freefire231,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                           codegaming::where('freefire231',$freefire231)->delete();
                                       
                                }
                            elseif($type_product==3 && $freefire583!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$freefire583,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                                tolalcharge::where('user_id',Auth::id())->update([
                                    'total_charge'=>$newprice,
                                ]);
                                
                                $newpoint=$pointuser - $totalpoint; 
                                $newpoint2=$newpoint+$total_gift_point; 
                                Pointuser::where('user_id',Auth::id())->update([
                                    'point'=>$newpoint2,
                                ]);
                            
                           codegaming::where('freefire583',$freefire583)->delete();
                                       
                                }
                            elseif($type_product==4 && $pubge60!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$pubge60,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('pubge60',$pubge60)->delete();
                                       
                                }
                            elseif($type_product==5 && $pubge325!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$pubge325,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('pubge325',$pubge325)->delete();
                                       
                                }
                            elseif($type_product==6 && $Roblox10!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Roblox10,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                                tolalcharge::where('user_id',Auth::id())->update([
                                    'total_charge'=>$newprice,
                                ]);
                                
                                $newpoint=$pointuser - $totalpoint; 
                                $newpoint2=$newpoint+$total_gift_point; 
                                Pointuser::where('user_id',Auth::id())->update([
                                    'point'=>$newpoint2,
                                ]);
                            
                           codegaming::where('Roblox10',$Roblox10)->delete();
                                       
                                }
                            elseif($type_product==7 && $Razar5!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Razar5,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                           codegaming::where('Razar5',$Razar5)->delete();
                                       
                                }
                            elseif($type_product==8 && $Razar10!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Razar10,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                           codegaming::where('Razar10',$Razar10)->delete();
                                       
                                }
                            elseif($type_product==9 && $Razar20!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Razar20,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('Razar20',$Razar20)->delete();
                                       
                                }
                            elseif($type_product==10 && $ituns5!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$ituns5,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                                tolalcharge::where('user_id',Auth::id())->update([
                                    'total_charge'=>$newprice,
                                ]);
                                
                                $newpoint=$pointuser - $totalpoint; 
                                $newpoint2=$newpoint+$total_gift_point; 
                                Pointuser::where('user_id',Auth::id())->update([
                                    'point'=>$newpoint2,
                                ]);
                            
                           codegaming::where('ituns5',$ituns5)->delete();
                                       
                                }
                            elseif($type_product==11 && $ituns10!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$ituns10,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                                tolalcharge::where('user_id',Auth::id())->update([
                                    'total_charge'=>$newprice,
                                ]);
                                
                                $newpoint=$pointuser - $totalpoint; 
                                $newpoint2=$newpoint+$total_gift_point; 
                                Pointuser::where('user_id',Auth::id())->update([
                                    'point'=>$newpoint2,
                                ]);
                            
                           codegaming::where('ituns10',$ituns10)->delete();
                                       
                                }
                            elseif($type_product==12 && $ituns20!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$ituns20,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                                tolalcharge::where('user_id',Auth::id())->update([
                                    'total_charge'=>$newprice,
                                ]);
                                
                                $newpoint=$pointuser - $totalpoint; 
                                $newpoint2=$newpoint+$total_gift_point; 
                                Pointuser::where('user_id',Auth::id())->update([
                                    'point'=>$newpoint2,
                                ]);
                            
                           codegaming::where('ituns20',$ituns20)->delete();
                                       
                                }
                            elseif($type_product==13 && $oropa200!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$oropa200,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('oropa200',$oropa200)->delete();
                                       
                                }
                            elseif($type_product==14 && $oropa315!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$oropa315,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('oropa315',$oropa315)->delete();
                                       
                                }
                            elseif($type_product==15 && $oropa795!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$oropa795,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('oropa795',$oropa795)->delete();
                                       
                                }
                            elseif($type_product==16 || $freefire110==null ||$freefire231 ==null || $freefire583 ==null || $pubge60==null ||$pubge325==null ||$Roblox10==null ||$Razar5==null ||$Razar10==null ||$Razar20==null ||$ituns5 ==null ||$ituns10 ==null || $ituns20==null ||$oropa200==null ||$oropa315==null ||$oropa795==null){

                                $order=Order::create([
                                    'user_id'=>Auth::id(),
                                    'product_id'=>$item->product_id,
                                    'product_qty'=>$item->product_qty,
                                    'user_name'=>$item->user_name,
                                    'number'=>$item->number,
                                    'price'=>$item->total_price,
                                    'price_point'=>$pointfinal,
                                    'ordernum'=>$ordernum+7,
                                    
                                ]);
                                $newprice=$value - $total; 
                                
                                tolalcharge::where('user_id',Auth::id())->update([
                                    'total_charge'=>$newprice,
                                ]);
                                
                                $newpoint=$pointuser - $totalpoint; 
                                $newpoint2=$newpoint+$total_gift_point; 
                                Pointuser::where('user_id',Auth::id())->update([
                                    'point'=>$newpoint2,
                                ]);
                            }   
                }
            }
                    $Cartitem=Cart::where('user_id',Auth::id())->get();
                    Cart::destroy($Cartitem);
                    //notficatio Add Order        
                    $notifcation=new Notifcation;
                    $notifcation->product_id=$product_id;
                    // $notifcation->product_id=$product_id;
                    $notifcation->order_id=$order->id;
                    $notifcation->user=$fname;
                    $url=route('detials-order',$order->id);
                    $title=$fname;
                    $body="عملية شراء جديدة";
                    $user=User::where('role_as',0)->get();
                    if($notifcation->save()){
                        $notifcation->TOMutilDevices($user,$title,$body,null,$url);

                    }

                    return response()->json(['status'=>' تم ارسال طلب الشراء بنجاح']);
                }
                else{
                    return response()->json(['status'=>' لا يمكن الشراء لان رصيدك غير كافي']);
                    
                }
            }
            //شراء منتج بسعر فقط ومنتج بنقاط فقط
               elseif($price1 !=0 && $price2 ==null && $price_point2 ==null  && $price_point3 !=0){
                   
                   if($value > $total && $pointuser >= $totalpoint){ 
                       //    echo $endsells;
                       //    die();
                       $Cartitem=Cart::where('user_id',Auth::id())->get();
                       foreach($Cartitem as $item){
                           $ordernum=$ordernum+1;
                        $endsells=Product::where('id',$item->product_id)->get();
                        foreach($endsells as $endsell){
                            $pricefinal=$endsell->selling_price;
                            $pointfinal=$endsell->price_point;
                            $type_product=$endsell->type_product;
                            // echo $type_product;
                            // die();
                            $freefire110=codegaming::pluck('freefire110')->first();
                            $freefire231=codegaming::pluck('freefire231')->first();
                            $freefire583=codegaming::pluck('freefire583')->first();
                            $pubge60=codegaming::pluck('pubge60')->first();
                            $pubge325=codegaming::pluck('pubge325')->first();
                            $Roblox10=codegaming::pluck('Roblox10')->first();
                            $Razar5=codegaming::pluck('Razar5')->first();
                            $Razar10=codegaming::pluck('Razar10')->first();
                            $Razar20=codegaming::pluck('Razar20')->first();
                            $ituns5=codegaming::pluck('ituns5')->first();
                            $ituns10=codegaming::pluck('ituns10')->first();
                            $ituns20=codegaming::pluck('ituns20')->first();
                            $oropa200=codegaming::pluck('oropa200')->first();
                            $oropa315=codegaming::pluck('oropa315')->first();
                            $oropa795=codegaming::pluck('oropa795')->first();
                            
                        
                    if($type_product==1 && $freefire110!=null){
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$freefire110,
                        
                    ]);
                    
                    $newprice=$value - $total; 
                                
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                    
                    $newpoint=$pointuser - $totalpoint; 
                    $newpoint2=$newpoint+$total_gift_point; 
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$newpoint2,
                    ]);
                    
                   codegaming::where('freefire110',$freefire110)->delete();
                               
                        }
                        elseif($type_product==2 && $freefire231!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$freefire231,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                           codegaming::where('freefire231',$freefire231)->delete();
                                       
                                }
                            elseif($type_product==3 && $freefire583!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$freefire583,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                                tolalcharge::where('user_id',Auth::id())->update([
                                    'total_charge'=>$newprice,
                                ]);
                                
                                $newpoint=$pointuser - $totalpoint; 
                                $newpoint2=$newpoint+$total_gift_point; 
                                Pointuser::where('user_id',Auth::id())->update([
                                    'point'=>$newpoint2,
                                ]);
                            
                           codegaming::where('freefire583',$freefire583)->delete();
                                       
                                }
                            elseif($type_product==4 && $pubge60!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$pubge60,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('pubge60',$pubge60)->delete();
                                       
                                }
                            elseif($type_product==5 && $pubge325!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$pubge325,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('pubge325',$pubge325)->delete();
                                       
                                }
                            elseif($type_product==6 && $Roblox10!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Roblox10,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                                tolalcharge::where('user_id',Auth::id())->update([
                                    'total_charge'=>$newprice,
                                ]);
                                
                                $newpoint=$pointuser - $totalpoint; 
                                $newpoint2=$newpoint+$total_gift_point; 
                                Pointuser::where('user_id',Auth::id())->update([
                                    'point'=>$newpoint2,
                                ]);
                            
                           codegaming::where('Roblox10',$Roblox10)->delete();
                                       
                                }
                            elseif($type_product==7 && $Razar5!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Razar5,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                           codegaming::where('Razar5',$Razar5)->delete();
                                       
                                }
                            elseif($type_product==8 && $Razar10!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Razar10,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                           codegaming::where('Razar10',$Razar10)->delete();
                                       
                                }
                            elseif($type_product==9 && $Razar20!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Razar20,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('Razar20',$Razar20)->delete();
                                       
                                }
                            elseif($type_product==10 && $ituns5!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$ituns5,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                                tolalcharge::where('user_id',Auth::id())->update([
                                    'total_charge'=>$newprice,
                                ]);
                                
                                $newpoint=$pointuser - $totalpoint; 
                                $newpoint2=$newpoint+$total_gift_point; 
                                Pointuser::where('user_id',Auth::id())->update([
                                    'point'=>$newpoint2,
                                ]);
                            
                           codegaming::where('ituns5',$ituns5)->delete();
                                       
                                }
                            elseif($type_product==11 && $ituns10!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$ituns10,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                                tolalcharge::where('user_id',Auth::id())->update([
                                    'total_charge'=>$newprice,
                                ]);
                                
                                $newpoint=$pointuser - $totalpoint; 
                                $newpoint2=$newpoint+$total_gift_point; 
                                Pointuser::where('user_id',Auth::id())->update([
                                    'point'=>$newpoint2,
                                ]);
                            
                           codegaming::where('ituns10',$ituns10)->delete();
                                       
                                }
                            elseif($type_product==12 && $ituns20!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$ituns20,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                                tolalcharge::where('user_id',Auth::id())->update([
                                    'total_charge'=>$newprice,
                                ]);
                                
                                $newpoint=$pointuser - $totalpoint; 
                                $newpoint2=$newpoint+$total_gift_point; 
                                Pointuser::where('user_id',Auth::id())->update([
                                    'point'=>$newpoint2,
                                ]);
                            
                           codegaming::where('ituns20',$ituns20)->delete();
                                       
                                }
                            elseif($type_product==13 && $oropa200!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$oropa200,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('oropa200',$oropa200)->delete();
                                       
                                }
                            elseif($type_product==14 && $oropa315!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$oropa315,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('oropa315',$oropa315)->delete();
                                       
                                }
                            elseif($type_product==15 && $oropa795!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$oropa795,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('oropa795',$oropa795)->delete();
                                       
                                }
                elseif($type_product==16 || $freefire110==null ||$freefire231 ==null || $freefire583 ==null || $pubge60==null ||$pubge325==null ||$Roblox10==null ||$Razar5==null ||$Razar10==null ||$Razar20==null ||$ituns5 ==null ||$ituns10 ==null || $ituns20==null ||$oropa200==null ||$oropa315==null ||$oropa795==null){  
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        
                    ]);
                    $newprice=$value - $total; 
                    
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                  
                    $newpoint=$pointuser - $totalpoint; 
                    $newpoint2=$newpoint+$total_gift_point; 
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$newpoint2,
                    ]);
                }
                }
            }
                    $Cartitem=Cart::where('user_id',Auth::id())->get();
                    Cart::destroy($Cartitem);
                    //notficatio Add Order        
                    $notifcation=new Notifcation;
                    $notifcation->product_id=$product_id;
                    // $notifcation->product_id=$product_id;
                    $notifcation->order_id=$order->id;
                    $notifcation->user=$fname;
                    $url=route('detials-order',$order->id);
                    $title=$fname;
                    $body="عملية شراء جديدة";
                    $user=User::where('role_as',0)->get();
                    if($notifcation->save()){
                        $notifcation->TOMutilDevices($user,$title,$body,null,$url);

                    }

                    return response()->json(['status'=>' تم ارسال طلب الشراء بنجاح']);
                }
                else{
                    return response()->json(['status'=>' لا يمكن الشراء لان رصيدك غير كافي']);
                    
                }
            }
            //شراء منتج بسعر ونقاط  ومنتج بنقاط فقط
               elseif($price1 ==null && $price2 !=0 && $price_point2 !=0  && $price_point3 !=0){
                   
                   if($value > $total && $pointuser >= $totalpoint){ 
                       //    echo $endsells;
                       //    die();
                       $Cartitem=Cart::where('user_id',Auth::id())->get();
                       foreach($Cartitem as $item){
                           $ordernum=$ordernum+1;
                        $endsells=Product::where('id',$item->product_id)->get();
                        foreach($endsells as $endsell){
                            $pricefinal=$endsell->selling_price;
                            $pointfinal=$endsell->price_point;
                            $type_product=$endsell->type_product;
                            // echo $type_product;
                            // die();
                            $freefire110=codegaming::pluck('freefire110')->first();
                            $freefire231=codegaming::pluck('freefire231')->first();
                            $freefire583=codegaming::pluck('freefire583')->first();
                            $pubge60=codegaming::pluck('pubge60')->first();
                            $pubge325=codegaming::pluck('pubge325')->first();
                            $Roblox10=codegaming::pluck('Roblox10')->first();
                            $Razar5=codegaming::pluck('Razar5')->first();
                            $Razar10=codegaming::pluck('Razar10')->first();
                            $Razar20=codegaming::pluck('Razar20')->first();
                            $ituns5=codegaming::pluck('ituns5')->first();
                            $ituns10=codegaming::pluck('ituns10')->first();
                            $ituns20=codegaming::pluck('ituns20')->first();
                            $oropa200=codegaming::pluck('oropa200')->first();
                            $oropa315=codegaming::pluck('oropa315')->first();
                            $oropa795=codegaming::pluck('oropa795')->first();
                            
                        
                    if($type_product==1 && $freefire110!=null) {
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$freefire110,
                        
                    ]);
                    
                    $newprice=$value - $total; 
                                
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                    
                    $newpoint=$pointuser - $totalpoint; 
                    $newpoint2=$newpoint+$total_gift_point; 
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$newpoint2,
                    ]);
                    
                   codegaming::where('freefire110',$freefire110)->delete();
                               
                        }
                        elseif($type_product==2 && $freefire231!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$freefire231,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                           codegaming::where('freefire231',$freefire231)->delete();
                                       
                                }
                            elseif($type_product==3 && $freefire583!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$freefire583,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                                tolalcharge::where('user_id',Auth::id())->update([
                                    'total_charge'=>$newprice,
                                ]);
                                
                                $newpoint=$pointuser - $totalpoint; 
                                $newpoint2=$newpoint+$total_gift_point; 
                                Pointuser::where('user_id',Auth::id())->update([
                                    'point'=>$newpoint2,
                                ]);
                            
                           codegaming::where('freefire583',$freefire583)->delete();
                                       
                                }
                            elseif($type_product==4 && $pubge60!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$pubge60,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('pubge60',$pubge60)->delete();
                                       
                                }
                            elseif($type_product==5 && $pubge325!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$pubge325,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('pubge325',$pubge325)->delete();
                                       
                                }
                            elseif($type_product==6 && $Roblox10!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Roblox10,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                                tolalcharge::where('user_id',Auth::id())->update([
                                    'total_charge'=>$newprice,
                                ]);
                                
                                $newpoint=$pointuser - $totalpoint; 
                                $newpoint2=$newpoint+$total_gift_point; 
                                Pointuser::where('user_id',Auth::id())->update([
                                    'point'=>$newpoint2,
                                ]);
                            
                           codegaming::where('Roblox10',$Roblox10)->delete();
                                       
                                }
                            elseif($type_product==7 && $Razar5!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Razar5,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                           codegaming::where('Razar5',$Razar5)->delete();
                                       
                                }
                            elseif($type_product==8 && $Razar10!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Razar10,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                           codegaming::where('Razar10',$Razar10)->delete();
                                       
                                }
                            elseif($type_product==9 && $Razar20!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Razar20,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('Razar20',$Razar20)->delete();
                                       
                                }
                            elseif($type_product==10 && $ituns5!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$ituns5,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                                tolalcharge::where('user_id',Auth::id())->update([
                                    'total_charge'=>$newprice,
                                ]);
                                
                                $newpoint=$pointuser - $totalpoint; 
                                $newpoint2=$newpoint+$total_gift_point; 
                                Pointuser::where('user_id',Auth::id())->update([
                                    'point'=>$newpoint2,
                                ]);
                            
                           codegaming::where('ituns5',$ituns5)->delete();
                                       
                                }
                            elseif($type_product==11 && $ituns10!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$ituns10,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                                tolalcharge::where('user_id',Auth::id())->update([
                                    'total_charge'=>$newprice,
                                ]);
                                
                                $newpoint=$pointuser - $totalpoint; 
                                $newpoint2=$newpoint+$total_gift_point; 
                                Pointuser::where('user_id',Auth::id())->update([
                                    'point'=>$newpoint2,
                                ]);
                            
                           codegaming::where('ituns10',$ituns10)->delete();
                                       
                                }
                            elseif($type_product==12 && $ituns20!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$ituns20,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                                tolalcharge::where('user_id',Auth::id())->update([
                                    'total_charge'=>$newprice,
                                ]);
                                
                                $newpoint=$pointuser - $totalpoint; 
                                $newpoint2=$newpoint+$total_gift_point; 
                                Pointuser::where('user_id',Auth::id())->update([
                                    'point'=>$newpoint2,
                                ]);
                            
                           codegaming::where('ituns20',$ituns20)->delete();
                                       
                                }
                            elseif($type_product==13 && $oropa200!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$oropa200,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('oropa200',$oropa200)->delete();
                                       
                                }
                            elseif($type_product==14 && $oropa315!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$oropa315,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('oropa315',$oropa315)->delete();
                                       
                                }
                            elseif($type_product==15 && $oropa795!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$oropa795,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                                
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                            
                            $newpoint=$pointuser - $totalpoint; 
                            $newpoint2=$newpoint+$total_gift_point; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint2,
                            ]);
                            
                           codegaming::where('oropa795',$oropa795)->delete();
                                       
                                }
                 elseif($type_product==16 || $freefire110==null ||$freefire231 ==null || $freefire583 ==null || $pubge60==null ||$pubge325==null ||$Roblox10==null ||$Razar5==null ||$Razar10==null ||$Razar20==null ||$ituns5 ==null ||$ituns10 ==null || $ituns20==null ||$oropa200==null ||$oropa315==null ||$oropa795==null){  
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        
                    ]);
                    $newprice=$value - $total; 
                    
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                  
                    $newpoint=$pointuser - $totalpoint; 
                    $newpoint2=$newpoint+$total_gift_point; 
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$newpoint2,
                    ]);
                }
                }
            }
                    $Cartitem=Cart::where('user_id',Auth::id())->get();
                    Cart::destroy($Cartitem);
                    //notficatio Add Order        
                    $notifcation=new Notifcation;
                    $notifcation->product_id=$product_id;
                    // $notifcation->product_id=$product_id;
                    $notifcation->order_id=$order->id;
                    $notifcation->user=$fname;
                    $url=route('detials-order',$order->id);
                    $title=$fname;
                    $body="عملية شراء جديدة";
                    $user=User::where('role_as',0)->get();
                    if($notifcation->save()){
                        $notifcation->TOMutilDevices($user,$title,$body,null,$url);

                    }

                    return response()->json(['status'=>' تم ارسال طلب الشراء بنجاح']);
                }
                else{
                    return response()->json(['status'=>' لا يمكن الشراء لان رصيدك غير كافي']);
                    
                }
            }
            //شراء منتج بسعر ونقاط  ومنتج بنقاط فقط ومنتج بسعر فقط
               elseif($price1 !=0 && $price2 !=0 && $price_point2 !=0  && $price_point3 !=0){
                   
                   if($value > $total && $pointuser >= $totalpoint){ 
                       //    echo $endsells;
                       //    die();
                       $Cartitem=Cart::where('user_id',Auth::id())->get();
                     
                       foreach($Cartitem as $item){
                           $ordernum=$ordernum+1;
                        $endsells=Product::where('id',$item->product_id)->get();
                        foreach($endsells as $endsell){
                            $pricefinal=$endsell->selling_price;
                            $pointfinal=$endsell->price_point;
                            $pointgift=$endsell->point;
                            $type_product=$endsell->type_product;
                            // echo $type_product;
                            // die();
                            $freefire110=codegaming::pluck('freefire110')->first();
                            $freefire231=codegaming::pluck('freefire231')->first();
                            $freefire583=codegaming::pluck('freefire583')->first();
                            $pubge60=codegaming::pluck('pubge60')->first();
                            $pubge325=codegaming::pluck('pubge325')->first();
                            $Roblox10=codegaming::pluck('Roblox10')->first();
                            $Razar5=codegaming::pluck('Razar5')->first();
                            $Razar10=codegaming::pluck('Razar10')->first();
                            $Razar20=codegaming::pluck('Razar20')->first();
                            $ituns5=codegaming::pluck('ituns5')->first();
                            $ituns10=codegaming::pluck('ituns10')->first();
                            $ituns20=codegaming::pluck('ituns20')->first();
                            $oropa200=codegaming::pluck('oropa200')->first();
                            $oropa315=codegaming::pluck('oropa315')->first();
                            $oropa795=codegaming::pluck('oropa795')->first();
                            
                        
                    if($type_product==1 && $freefire110!=null){
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$freefire110,
                        
                    ]);
                    
                    $newprice=$value - $total; 
                    
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                  
                    $newpoint3=$pointuser -$totalpoint; 
                    $newpoint4=$newpoint3 + $total_gift_point; 
                 
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$newpoint4,
                    ]);
                    
                   codegaming::where('freefire110',$freefire110)->delete();
                               
                        }
                        elseif($type_product==2 && $freefire231!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$freefire231,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                    
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint3=$pointuser -$totalpoint; 
                            $newpoint4=$newpoint3 + $total_gift_point; 
                         
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint4,
                            ]);
                           codegaming::where('freefire231',$freefire231)->delete();
                                       
                                }
                            elseif($type_product==3 && $freefire583!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$freefire583,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                    
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint3=$pointuser -$totalpoint; 
                            $newpoint4=$newpoint3 + $total_gift_point; 
                         
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint4,
                            ]);
                            
                           codegaming::where('freefire583',$freefire583)->delete();
                                       
                                }
                            elseif($type_product==4 && $pubge60!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$pubge60,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                    
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint3=$pointuser -$totalpoint; 
                            $newpoint4=$newpoint3 + $total_gift_point; 
                         
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint4,
                            ]);
                            
                           codegaming::where('pubge60',$pubge60)->delete();
                                       
                                }
                            elseif($type_product==5 && $pubge325!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$pubge325,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                    
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint3=$pointuser -$totalpoint; 
                            $newpoint4=$newpoint3 + $total_gift_point; 
                         
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint4,
                            ]);
                            
                           codegaming::where('pubge325',$pubge325)->delete();
                                       
                                }
                            elseif($type_product==6 && $Roblox10!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Roblox10,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                    
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint3=$pointuser -$totalpoint; 
                            $newpoint4=$newpoint3 + $total_gift_point; 
                         
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint4,
                            ]);
                            
                           codegaming::where('Roblox10',$Roblox10)->delete();
                                       
                                }
                            elseif($type_product==7 && $Razar5!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Razar5,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                    
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint3=$pointuser -$totalpoint; 
                            $newpoint4=$newpoint3 + $total_gift_point; 
                         
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint4,
                            ]);
                           codegaming::where('Razar5',$Razar5)->delete();
                                       
                                }
                            elseif($type_product==8 && $Razar10!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Razar10,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                    
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint3=$pointuser -$totalpoint; 
                            $newpoint4=$newpoint3 + $total_gift_point; 
                         
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint4,
                            ]);
                           codegaming::where('Razar10',$Razar10)->delete();
                                       
                                }
                            elseif($type_product==9 && $Razar20!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Razar20,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                    
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint3=$pointuser -$totalpoint; 
                            $newpoint4=$newpoint3 + $total_gift_point; 
                         
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint4,
                            ]);
                            
                           codegaming::where('Razar20',$Razar20)->delete();
                                       
                                }
                            elseif($type_product==10 && $ituns5!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$ituns5,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                    
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint3=$pointuser -$totalpoint; 
                            $newpoint4=$newpoint3 + $total_gift_point; 
                         
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint4,
                            ]);
                            
                           codegaming::where('ituns5',$ituns5)->delete();
                                       
                                }
                            elseif($type_product==11 && $ituns10!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$ituns10,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                    
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint3=$pointuser -$totalpoint; 
                            $newpoint4=$newpoint3 + $total_gift_point; 
                         
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint4,
                            ]);
                           codegaming::where('ituns10',$ituns10)->delete();
                                       
                                }
                            elseif($type_product==12 && $ituns20!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$ituns20,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                    
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint3=$pointuser -$totalpoint; 
                            $newpoint4=$newpoint3 + $total_gift_point; 
                         
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint4,
                            ]);
                           codegaming::where('ituns20',$ituns20)->delete();
                                       
                                }
                            elseif($type_product==13 && $oropa200!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$oropa200,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                    
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint3=$pointuser -$totalpoint; 
                            $newpoint4=$newpoint3 + $total_gift_point; 
                         
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint4,
                            ]);
                           codegaming::where('oropa200',$oropa200)->delete();
                                       
                                }
                            elseif($type_product==14 && $oropa315!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$oropa315,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                    
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint3=$pointuser -$totalpoint; 
                            $newpoint4=$newpoint3 + $total_gift_point; 
                         
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint4,
                            ]);
                            
                           codegaming::where('oropa315',$oropa315)->delete();
                                       
                                }
                            elseif($type_product==15 && $oropa795!=null){
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>$item->total_price,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$oropa795,
                                
                            ]);
                            
                            $newprice=$value - $total; 
                    
                            tolalcharge::where('user_id',Auth::id())->update([
                                'total_charge'=>$newprice,
                            ]);
                          
                            $newpoint3=$pointuser -$totalpoint; 
                            $newpoint4=$newpoint3 + $total_gift_point; 
                         
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint4,
                            ]);
                            
                           codegaming::where('oropa795',$oropa795)->delete();
                                       
                                }
                elseif($type_product==16 || $freefire110==null ||$freefire231 ==null || $freefire583 ==null || $pubge60==null ||$pubge325==null ||$Roblox10==null ||$Razar5==null ||$Razar10==null ||$Razar20==null ||$ituns5 ==null ||$ituns10 ==null || $ituns20==null ||$oropa200==null ||$oropa315==null ||$oropa795==null){    
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$item->total_price,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        
                    ]);
                    $newprice=$value - $total; 
                    
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                  
                    $newpoint3=$pointuser -$totalpoint; 
                    $newpoint4=$newpoint3 + $total_gift_point; 
                 
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$newpoint4,
                    ]);
                }
                }
            }
                    $Cartitem=Cart::where('user_id',Auth::id())->get();
                    Cart::destroy($Cartitem);
                    //notficatio Add Order        
                    $notifcation=new Notifcation;
                    $notifcation->product_id=$product_id;
                    // $notifcation->product_id=$product_id;
                    $notifcation->order_id=$order->id;
                    $notifcation->user=$fname;
                    $url=route('detials-order',$order->id);
                    $title=$fname;
                    $body="عملية شراء جديدة";
                    $user=User::where('role_as',0)->get();
                    if($notifcation->save()){
                        $notifcation->TOMutilDevices($user,$title,$body,null,$url);

                    }

                    return response()->json(['status'=>' تم ارسال طلب الشراء بنجاح']);
                }
                else{
                    return response()->json(['status'=>' لا يمكن الشراء لان رصيدك غير كافي']);
                    
                }
            }
            //شراء المنتج بنقاط فقط
            elseif($price1 ==null && $price2 ==null && $price_point2 ==null  && $price_point3 !=0){

                   if($pointuser >= $totalpoint){
                    $Cartitem=Cart::where('user_id',Auth::id())->get();
                    foreach($Cartitem as $item){
                        $ordernum=$ordernum+1;
                     $endsells=Product::where('id',$item->product_id)->get();
                     foreach($endsells as $endsell){
                        //  $pricefinal=$endsell->selling_price;
                         $pointfinal=$endsell->price_point;
                         $type_product=$endsell->type_product;
                         // echo $type_product;
                         // die();
                         $freefire110=codegaming::pluck('freefire110')->first();
                         $freefire231=codegaming::pluck('freefire231')->first();
                         $freefire583=codegaming::pluck('freefire583')->first();
                         $pubge60=codegaming::pluck('pubge60')->first();
                         $pubge325=codegaming::pluck('pubge325')->first();
                         $Roblox10=codegaming::pluck('Roblox10')->first();
                         $Razar5=codegaming::pluck('Razar5')->first();
                         $Razar10=codegaming::pluck('Razar10')->first();
                         $Razar20=codegaming::pluck('Razar20')->first();
                         $ituns5=codegaming::pluck('ituns5')->first();
                         $ituns10=codegaming::pluck('ituns10')->first();
                         $ituns20=codegaming::pluck('ituns20')->first();
                         $oropa200=codegaming::pluck('oropa200')->first();
                         $oropa315=codegaming::pluck('oropa315')->first();
                         $oropa795=codegaming::pluck('oropa795')->first();
                         
                     
                 if($type_product==1 && $freefire110!=null){
            
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>0,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        'status'=>1,
                        'codegame'=>$freefire110,
                        
                    ]);
                    $newpoint=$pointuser - $totalpoint; 
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$newpoint + $total_gift_point,
                    ]);
                 
                codegaming::where('freefire110',$freefire110)->delete();
                            
                     }
                     elseif($type_product==2 && $freefire231!=null){
              
                        $order=Order::create([
                            'user_id'=>Auth::id(),
                            'product_id'=>$item->product_id,
                            'product_qty'=>$item->product_qty,
                            'user_name'=>$item->user_name,
                            'number'=>$item->number,
                            'price'=>0,
                            'price_point'=>$pointfinal,
                            'ordernum'=>$ordernum+7,
                            'status'=>1,
                            'codegame'=>$freefire231,
                            
                        ]);
                        $newpoint=$pointuser - $totalpoint; 
                        Pointuser::where('user_id',Auth::id())->update([
                            'point'=>$newpoint + $total_gift_point,
                        ]);
                        codegaming::where('freefire231',$freefire231)->delete();
                                    
                             }
                         elseif($type_product==3 && $freefire583!=null){
                 
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>0,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$freefire583,
                                
                            ]);
                            $newpoint=$pointuser - $totalpoint; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint + $total_gift_point,
                            ]);
                         
                        codegaming::where('freefire583',$freefire583)->delete();
                                    
                             }
                         elseif($type_product==4 && $pubge60!=null){
          
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>0,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$pubge60,
                                
                            ]);
                            $newpoint=$pointuser - $totalpoint; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint + $total_gift_point,
                            ]);
                         
                        codegaming::where('pubge60',$pubge60)->delete();
                                    
                             }
                         elseif($type_product==5 && $pubge325!=null){
                
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>0,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$pubge325,

                                
                            ]);
                            $newpoint=$pointuser - $totalpoint; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint + $total_gift_point,
                            ]);
                        codegaming::where('pubge325',$pubge325)->delete();
                                    
                             }
                         elseif($type_product==6 && $Roblox10!=null){
                    
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>0,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Roblox10,
                                
                            ]);
                            $newpoint=$pointuser - $totalpoint; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint + $total_gift_point,
                            ]);
                        codegaming::where('Roblox10',$Roblox10)->delete();
                                    
                             }
                         elseif($type_product==7 && $Razar5!=null){
                  
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>0,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Razar5,
                                
                            ]);
                            $newpoint=$pointuser - $totalpoint; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint + $total_gift_point,
                            ]);
                        codegaming::where('Razar5',$Razar5)->delete();
                                    
                             }
                         elseif($type_product==8 && $Razar10!=null){
                     
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>0,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$Razar10,
                                
                            ]);
                            $newpoint=$pointuser - $totalpoint; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint + $total_gift_point,
                            ]);
                        codegaming::where('Razar10',$Razar10)->delete();
                                    
                             }
                         elseif($type_product==9 && $Razar20!=null){
                     
                        $order=Order::create([
                            'user_id'=>Auth::id(),
                            'product_id'=>$item->product_id,
                            'product_qty'=>$item->product_qty,
                            'user_name'=>$item->user_name,
                            'number'=>$item->number,
                            'price'=>0,
                            'price_point'=>$pointfinal,
                            'ordernum'=>$ordernum+7,
                            'status'=>1,
                            'codegame'=>$Razar20,
                            
                        ]);
                        $newpoint=$pointuser - $totalpoint; 
                        Pointuser::where('user_id',Auth::id())->update([
                            'point'=>$newpoint + $total_gift_point,
                        ]);
                         
                        codegaming::where('Razar20',$Razar20)->delete();
                                    
                             }
                         elseif($type_product==10 && $ituns5!=null){
                       
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>0,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$ituns5,
                                
                            ]);
                            $newpoint=$pointuser - $totalpoint; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint + $total_gift_point,
                            ]);
                         
                        codegaming::where('ituns5',$ituns5)->delete();
                                    
                             }
                         elseif($type_product==11 && $ituns10!=null){
                     
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>0,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$ituns10,
                                
                            ]);
                            $newpoint=$pointuser - $totalpoint; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint + $total_gift_point,
                            ]);
                        codegaming::where('ituns10',$ituns10)->delete();
                                    
                             }
                         elseif($type_product==12 && $ituns20!=null){
                  
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>0,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$ituns20,
                                
                            ]);
                            $newpoint=$pointuser - $totalpoint; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint + $total_gift_point,
                            ]);
                        codegaming::where('ituns20',$ituns20)->delete();
                                    
                             }
                         elseif($type_product==13 && $oropa200!=null){
                    
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>0,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$oropa200,
                                
                            ]);
                            $newpoint=$pointuser - $totalpoint; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint + $total_gift_point,
                            ]);
                        codegaming::where('oropa200',$oropa200)->delete();
                                    
                             }
                         elseif($type_product==14 && $oropa315!=null){
                   
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>0,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$oropa315,
                                
                            ]);
                            $newpoint=$pointuser - $totalpoint; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint + $total_gift_point,
                            ]);
                         
                        codegaming::where('oropa315',$oropa315)->delete();
                                    
                             }
                         elseif($type_product==15 && $oropa795!=null){
                  
                            $order=Order::create([
                                'user_id'=>Auth::id(),
                                'product_id'=>$item->product_id,
                                'product_qty'=>$item->product_qty,
                                'user_name'=>$item->user_name,
                                'number'=>$item->number,
                                'price'=>0,
                                'price_point'=>$pointfinal,
                                'ordernum'=>$ordernum+7,
                                'status'=>1,
                                'codegame'=>$oropa795,
                                
                            ]);
                            $newpoint=$pointuser - $totalpoint; 
                            Pointuser::where('user_id',Auth::id())->update([
                                'point'=>$newpoint + $total_gift_point,
                            ]);
                         
                        codegaming::where('oropa795',$oropa795)->delete();
                                    
                             }
             elseif($type_product==16 || $freefire110==null ||$freefire231 ==null || $freefire583 ==null || $pubge60==null ||$pubge325==null ||$Roblox10==null ||$Razar5==null ||$Razar10==null ||$Razar20==null ||$ituns5 ==null ||$ituns10 ==null || $ituns20==null ||$oropa200==null ||$oropa315==null ||$oropa795==null){    
        
                    $order=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>0,
                        'price_point'=>$pointfinal,
                        'ordernum'=>$ordernum+7,
                        
                    ]);
                    $newpoint=$pointuser - $totalpoint; 
                    Pointuser::where('user_id',Auth::id())->update([
                        'point'=>$newpoint + $total_gift_point,
                    ]);
                     }
                     }
                    }
                    $Cartitem=Cart::where('user_id',Auth::id())->get();
                    Cart::destroy($Cartitem);
                    //notficatio Add Order        
                    $notifcation=new Notifcation;
                    $notifcation->product_id=$product_id;
                    // $notifcation->product_id=$product_id;
                    $notifcation->order_id=$order->id;
                    $notifcation->user=$fname;
                    $url=route('detials-order',$order->id);
                    $title=$fname;
                    $body="عملية شراء جديدة";
                    $user=User::where('role_as',0)->get();
                    if($notifcation->save()){
                        $notifcation->TOMutilDevices($user,$title,$body,null,$url);

                    }

                    return response()->json(['status'=>'تم ارسال طلب الشراء المنتج ']);
                }
                else{
                    return response()->json(['status'=>' لا يمكن الشراء لان رصيدك غير كافي']);
                    
                }
            }
            }
            
        }
        //if code coupon is not null
    } 
        else{
            $Cartitem=Cart::where('user_id',Auth::id())->get();
            $price1=$request->product_price1;
            $product_qty=$request->product_qty;
            foreach($Cartitem as $item){
                $newprice=0;
                $total=$request->total;
                $code=$request->code;
                $couponAmount=$request->coupontotal;
                $value= DB::table('totalcharge')->where('user_id',Auth::id())->sum('total_charge');
                if($value > $total){
                    $order1=Order::create([
                        'user_id'=>Auth::id(),
                        'product_id'=>$item->product_id,
                        'product_qty'=>$item->product_qty,
                        'user_name'=>$item->user_name,
                        'number'=>$item->number,
                        'price'=>$price1,
                        // 'price'=>$price,
                        'code'=>$code,
                        'count'=>$item->product_qty,
                        'couponAmount'=>$couponAmount,
                        
                    ]);
                    $newprice=$value - $total; 
                    tolalcharge::where('user_id',Auth::id())->update([
                        'total_charge'=>$newprice,
                    ]);
                    $Cartitem=Cart::where('user_id',Auth::id())->get();
                    Cart::destroy($Cartitem);
                            
                    return response()->json(['status'=>'تم ارسال طلب الشراء']);
                }
                
                else{
                    return response()->json(['status'=>'لا يمكن الشراء لان رصيدك غير كافي']);
                    
                }
            }
        }
    
}
        


    public function vieworder(){
        $orders=Order::where('user_id',Auth::id())->get();
        $Cartitem=Cart::where('user_id',Auth::id())->get();
        return view('front.home.orders',compact('orders','Cartitem'));
    }


    public function ApplyCoupon(Request $request){

        if($request->ajax()){
         $data=$request->all();
         $total_cart =$request->total_cart;
         $product_qty =$request->product_qty;
         $product_price =$request->product_price;
         $code =$request->code;
         $couponCount= Coupon::where('coupon_code',$data['code'])->count();
         if($couponCount==0){
             return response()->json([
                 'status'=>false,
                 'message'=>'هذا الكود غير متاح',
                ]);
         }
         else{
            //check for other coupon conditions
            //Get Coupon Details
            $couponDetails=Coupon::where('coupon_code',$data['code'])->first(); 

            //Check if Coupon inactive
            if($couponDetails->status==0){
                $message="هذا الكود غير مفعل حاليا";
            }

            //Check if Coupon is Expiry
            $expiry_date = $couponDetails->expiry_date;
            $current_date = date('Y-m-d');
            if($expiry_date<$current_date ){
                $message="انتهت صلاحية الكود يمكن تقديم طلب الحصول على كود جديد";
            }
            //signle time coupons
            if($couponDetails->coupon_type =="Single time"){

                $orders =Order::where('code',$code)->where('user_id',Auth::id())->sum('count');
               
                        if($orders==0){
                                if($orders +$product_qty = 1 ){
                            //$couponcounter=DB::table('order')->where('code',$codeSerial)->sum('count');
                            if($couponDetails->amount_type=="Fixed"){
                                $couponAmount = $couponDetails->amount;
                            }else{
                                $couponAmount =$product_price * ($couponDetails->amount/100); 
                                
                            }
                            $gruad_total = $total_cart - $couponAmount;
                            $message ="تم اضافة الكوبون بنجاح سوف يتم تطبيق الخصم على المنتج"; 
                            return response()->json([
                                'status'=>true,
                                'message'=>$message,
                                'couponAmount'=>$couponAmount,
                                'gruad_total'=>$gruad_total,
                                'view'=>View::make('front.cart.cart')->with(compact('couponAmount' ,'gruad_total'))
                            ]);
                        }
                        elseif($orders +$product_qty>1){
                            $message="لا يمكن شراء كمية اكبر من الكمية الذي تم تحديدها في الكوبون يرجى الالتزام بالقواعد المعطاة تجنبا حتى لايتم خسارة الكوبون يرجى الالتزام بالكمية او الشراء بدون الكوبون";
                        }
                    }


                        elseif($orders!==0){
                            $couponcounter=DB::table('order')->where('code',$code)->where('user_id',Auth::id())->sum('count');
                            if(($couponcounter+$product_qty) > 1){
                                $message="لا يمكن شراء كمية اكبر من الكمية الذي تم تحديدها في الكوبون يرجى الالتزام بالقواعد المعطاة تجنبا حتى لايتم خسارة الكوبون يرجى الالتزام بالكمية او الشراء بدون الكوبون";
                            }
                        }
                
                    }


                //====== ====================== Two time coupons======================//
                if($couponDetails->coupon_type =="Two time"){

                $orders =Order::where('code',$code)->where('user_id',Auth::id())->sum('count');
               
                        if($orders==0){
                                if($orders +$product_qty = 1 or $orders +$product_qty = 2){
                            //$couponcounter=DB::table('order')->where('code',$codeSerial)->sum('count');
                            if($couponDetails->amount_type=="Fixed"){
                                $couponAmount = $couponDetails->amount;
                            }else{
                                $couponAmount =$product_price * ($couponDetails->amount/100); 
                                
                            }
                            $gruad_total = $total_cart - $couponAmount;
                            $message ="تم اضافة الكوبون بنجاح سوف يتم تطبيق الخصم على المنتج"; 
                            return response()->json([
                                'status'=>true,
                                'message'=>$message,
                                'couponAmount'=>$couponAmount,
                                'gruad_total'=>$gruad_total,
                                'view'=>View::make('front.cart.cart')->with(compact('couponAmount' ,'gruad_total'))
                            ]);
                        }
                        elseif($orders +$product_qty > 2){
                            $message="لا يمكن شراء كمية اكبر من الكمية الذي تم تحديدها في الكوبون يرجى الالتزام بالقواعد المعطاة تجنبا حتى لايتم خسارة الكوبون يرجى الالتزام بالكمية او الشراء بدون الكوبون";
                        }
                    }
                    
                    
                        elseif($orders!==0){
                            $couponcounter=DB::table('order')->where('code',$code)->where('user_id',Auth::id())->sum('count');
                            if(($couponcounter+$product_qty) > 2){
                                $message="لا يمكن شراء كمية اكبر من الكمية الذي تم تحديدها في الكوبون يرجى الالتزام بالقواعد المعطاة تجنبا حتى لايتم خسارة الكوبون يرجى الالتزام بالكمية او الشراء بدون الكوبون";
                            }
                            elseif(($couponcounter+$product_qty) <= 2){
                                if($couponDetails->amount_type=="Fixed"){
                                    $couponAmount = $couponDetails->amount;
                                }else{
                                    $couponAmount =$product_price * ($couponDetails->amount/100); 
                                    
                                }
                                $gruad_total = $total_cart - $couponAmount;
                                $message ="تم اضافة الكوبون بنجاح سوف يتم تطبيق الخصم على المنتج"; 
                                return response()->json([
                                    'status'=>true,
                                    'message'=>$message,
                                    'couponAmount'=>$couponAmount,
                                    'gruad_total'=>$gruad_total,
                                    'view'=>View::make('front.cart.cart')->with(compact('couponAmount' ,'gruad_total'))
                                ]);
                            }
                        }
                        
                    }
                //====== ====================== Five time coupons======================//
                if($couponDetails->coupon_type =="Five time"){

                $orders =Order::where('code',$code)->where('user_id',Auth::id())->sum('count');
               
                        if($orders==0){
                                if($orders +$product_qty = 1 and $orders +$product_qty <= 5){
                            //$couponcounter=DB::table('order')->where('code',$codeSerial)->sum('count');
                            if($couponDetails->amount_type=="Fixed"){
                                $couponAmount = $couponDetails->amount;
                            }else{
                                $couponAmount =$product_price * ($couponDetails->amount/100); 
                                
                            }
                            $gruad_total = $total_cart - $couponAmount;
                            $message ="تم اضافة الكوبون بنجاح سوف يتم تطبيق الخصم على المنتج"; 
                            return response()->json([
                                'status'=>true,
                                'message'=>$message,
                                'couponAmount'=>$couponAmount,
                                'gruad_total'=>$gruad_total,
                                'view'=>View::make('front.cart.cart')->with(compact('couponAmount' ,'gruad_total'))
                            ]);
                        }
                        elseif($orders +$product_qty > 5){
                            $message="لا يمكن شراء كمية اكبر من الكمية الذي تم تحديدها في الكوبون يرجى الالتزام بالقواعد المعطاة تجنبا حتى لايتم خسارة الكوبون يرجى الالتزام بالكمية او الشراء بدون الكوبون";
                        }
                    }
                    
                    
                        elseif($orders!==0){
                            $couponcounter=DB::table('order')->where('code',$code)->where('user_id',Auth::id())->sum('count');
                            if(($couponcounter+$product_qty) > 5){
                                $message="لا يمكن شراء كمية اكبر من الكمية الذي تم تحديدها في الكوبون يرجى الالتزام بالقواعد المعطاة تجنبا حتى لايتم خسارة الكوبون يرجى الالتزام بالكمية او الشراء بدون الكوبون";
                            }
                            elseif(($couponcounter+$product_qty) <= 5){
                                if($couponDetails->amount_type=="Fixed"){
                                    $couponAmount = $couponDetails->amount;
                                }else{
                                    $couponAmount =$product_price * ($couponDetails->amount/100); 
                                    
                                }
                                $gruad_total = $total_cart - $couponAmount;
                                $message ="تم اضافة الكوبون بنجاح سوف يتم تطبيق الخصم على المنتج"; 
                                return response()->json([
                                    'status'=>true,
                                    'message'=>$message,
                                    'couponAmount'=>$couponAmount,
                                    'gruad_total'=>$gruad_total,
                                    'view'=>View::make('front.cart.cart')->with(compact('couponAmount' ,'gruad_total'))
                                ]);
                            }
                        }
                        
                    }
                    
                //====== ====================== Ten time coupons======================//
                if($couponDetails->coupon_type =="Ten time"){

                $orders =Order::where('code',$code)->where('user_id',Auth::id())->sum('count');
               
                        if($orders==0){
                                if($orders +$product_qty = 1 and $orders +$product_qty <= 10){
                            //$couponcounter=DB::table('order')->where('code',$codeSerial)->sum('count');
                            if($couponDetails->amount_type=="Fixed"){
                                $couponAmount = $couponDetails->amount;
                            }else{
                                $couponAmount =$product_price * ($couponDetails->amount/100); 
                                
                            }
                            $gruad_total = $total_cart - $couponAmount;
                            $message ="تم اضافة الكوبون بنجاح سوف يتم تطبيق الخصم على المنتج"; 
                            return response()->json([
                                'status'=>true,
                                'message'=>$message,
                                'couponAmount'=>$couponAmount,
                                'gruad_total'=>$gruad_total,
                                'view'=>View::make('front.cart.cart')->with(compact('couponAmount' ,'gruad_total'))
                            ]);
                        }
                        elseif($orders +$product_qty > 10){
                            $message="لا يمكن شراء كمية اكبر من الكمية الذي تم تحديدها في الكوبون يرجى الالتزام بالقواعد المعطاة تجنبا حتى لايتم خسارة الكوبون يرجى الالتزام بالكمية او الشراء بدون الكوبون";
                        }
                    }
                    
                    
                        elseif($orders!==0){
                            $couponcounter=DB::table('order')->where('code',$code)->where('user_id',Auth::id())->sum('count');
                            if(($couponcounter+$product_qty) > 10){
                                $message="لا يمكن شراء كمية اكبر من الكمية الذي تم تحديدها في الكوبون يرجى الالتزام بالقواعد المعطاة تجنبا حتى لايتم خسارة الكوبون يرجى الالتزام بالكمية او الشراء بدون الكوبون";
                            }
                            elseif(($couponcounter+$product_qty) <= 10){
                                if($couponDetails->amount_type=="Fixed"){
                                    $couponAmount = $couponDetails->amount;
                                }else{
                                    $couponAmount =$product_price * ($couponDetails->amount/100); 
                                    
                                }
                                $gruad_total = $total_cart - $couponAmount;
                                $message ="تم اضافة الكوبون بنجاح سوف يتم تطبيق الخصم على المنتج"; 
                                return response()->json([
                                    'status'=>true,
                                    'message'=>$message,
                                    'couponAmount'=>$couponAmount,
                                    'gruad_total'=>$gruad_total,
                                    'view'=>View::make('front.cart.cart')->with(compact('couponAmount' ,'gruad_total'))
                                ]);
                            }
                        }
                        
                    }
                //====== ====================== Ten time coupons======================//
                if($couponDetails->coupon_type =="Twenty time"){

                $orders =Order::where('code',$code)->where('user_id',Auth::id())->sum('count');
               
                        if($orders==0){
                                if($orders +$product_qty >= 1 and $orders +$product_qty <=5){
                            //$couponcounter=DB::table('order')->where('code',$codeSerial)->sum('count');
                            if($couponDetails->amount_type=="Fixed"){
                                $couponAmount = $couponDetails->amount;
                            }else{
                                $couponAmount =$product_price * ($couponDetails->amount/100); 
                                
                            }
                            $gruad_total = $total_cart - $couponAmount;
                            $message ="تم اضافة الكوبون بنجاح سوف يتم تطبيق الخصم على المنتج"; 
                            return response()->json([
                                'status'=>true,
                                'message'=>$message,
                                'couponAmount'=>$couponAmount,
                                'gruad_total'=>$gruad_total,
                                'view'=>View::make('front.cart.cart')->with(compact('couponAmount' ,'gruad_total'))
                            ]);
                        }
                        elseif($orders +$product_qty > 20){
                            $message="لا يمكن شراء كمية اكبر من الكمية الذي تم تحديدها في الكوبون يرجى الالتزام بالقواعد المعطاة تجنبا حتى لايتم خسارة الكوبون يرجى الالتزام بالكمية او الشراء بدون الكوبون";
                        }
                    }
                    
                    
                        elseif($orders!==0){
                            $couponcounter=DB::table('order')->where('code',$code)->where('user_id',Auth::id())->sum('count');
                            if(($couponcounter+$product_qty) > 20){
                                $message="لا يمكن شراء كمية اكبر من الكمية الذي تم تحديدها في الكوبون يرجى الالتزام بالقواعد المعطاة تجنبا حتى لايتم خسارة الكوبون يرجى الالتزام بالكمية او الشراء بدون الكوبون";
                            }
                            elseif(($couponcounter+$product_qty) <= 20){
                                if($couponDetails->amount_type=="Fixed"){
                                    $couponAmount = $couponDetails->amount;
                                }else{
                                    $couponAmount =$product_price * ($couponDetails->amount/100); 
                                    
                                }
                                $gruad_total = $total_cart - $couponAmount;
                                $message ="تم اضافة الكوبون بنجاح سوف يتم تطبيق الخصم على المنتج"; 
                                return response()->json([
                                    'status'=>true,
                                    'message'=>$message,
                                    'couponAmount'=>$couponAmount,
                                    'gruad_total'=>$gruad_total,
                                    'view'=>View::make('front.cart.cart')->with(compact('couponAmount' ,'gruad_total'))
                                ]);
                            }
                        }
                        
                    }
                //====== ====================== Ten time coupons======================//
                if($couponDetails->coupon_type =="Multi time"){
                                if($couponDetails->amount_type=="Fixed"){
                                    $couponAmount = $couponDetails->amount;
                                }else{
                                    $couponAmount =$product_price * ($couponDetails->amount/100); 
                                    
                                }
                                $gruad_total = $total_cart - $couponAmount;
                                $message ="تم اضافة الكوبون بنجاح سوف يتم تطبيق الخصم على المنتج"; 
                                return response()->json([
                                    'status'=>true,
                                    'message'=>$message,
                                    'couponAmount'=>$couponAmount,
                                    'gruad_total'=>$gruad_total,
                                    'view'=>View::make('front.cart.cart')->with(compact('couponAmount' ,'gruad_total'))
                                ]);
                            }
                    
                
                

         
            
             
            //Check if coupon is from select product
            //Get All Select Product from Coupon
            $catArr= explode(',',$couponDetails->products);
            
            //Get Cart Item
            $Cartitem=Cart::where('user_id',Auth::id())->get();
            
            //Check If Coupon belong to logged in user
            //Get all selected users of coupon
            $userArr = explode(',',$couponDetails->users);
         
            //Get User ID's of all selected users
            foreach($userArr as $key=>$user ){
                $getUserID =User::select('id')->where('email',$user)->first()->toArray();
                $userID[]=$getUserID['id'];
            }
            //Check if any item belong to coupon product and user 
            foreach($Cartitem as $key=>$item ){
                if(!in_array($item['product_id'],$catArr) ){
                    
                $message="هذا الكود ينتمي لمنتج واحد فقط اذا كنت تريد الاستفادة من الكود يجب عليك فقط شراء المنتج التابع للكود";
            }
            if(!in_array($item['user_id'],$userID) ){
                $message="هذا الكوبون ليس لهذا المستخدم";
            }
        }
        //message false
            if(isset($message)){
                $couponAmount = 0;
                return response()->json([
                    'status'=>false,
                    'message'=>$message,
                    'couponAmount'=>$couponAmount,
                    'view'=>View::make('front.cart.cart')->with(compact('couponAmount'))
                ]);
            }
                         
        }
    }  
 
}
//===================point coupon =========================
    public function ApplyCouponpoint(Request $request){
        $codetrue=1;
        if($request->ajax()){
            $data=$request->all();
            $codepoint =$request->codepoint;
            $couponCount= Couponpoint::where('point_code',$data['codepoint'])->count();
                    if($couponCount==0){
                        return response()->json([
                            'status'=>false,
                            'messages'=>'هذا الكود غير متاح',
                        ]);
                                    //check for other coupon conditions
                
                
                    }
            else{
                    
                //check for other coupon conditions
                //Get Coupon Details
                $couponDetailspoint=Couponpoint::where('point_code',$data['codepoint'])->first(); 
                //Check if Coupon inactive
                if($couponDetailspoint->status == 0){
                    $messages="هذا الكود غير مفعل حاليا";
                }
                
                //Check if Coupon is Expiry
                $timepoint = $couponDetailspoint->expiry_date;
                $current_date = date('Y-m-d');
                if( $timepoint < $current_date){
                    $messages=" هذا الكود منتهي الصلاحية ";
                }

                $items=User::where('id',Auth::id())->get();
                //Check If Coupon belong to logged in user
                //Get all selected users of coupon
                $userArr = explode(',',$couponDetailspoint->users);

                //Get User ID's of all selected users
                foreach($userArr as $key=>$user ){
                    $getUserID =User::select('id')->where('email',$user)->first()->toArray();
                    $userID[]=$getUserID['id'];
                }
                foreach($items as $key=>$item ){
                    if(!in_array($item['id'],$userID) ){
                        $messages="هذا الكوبون غير مخصص لهذا المستخدم";
                    }
                    
                    //signle time coupons
                    if($couponDetailspoint->couponpoint_type =="Single time" && $couponDetailspoint->status ==1 && $timepoint > $current_date && (in_array($item['id'],$userID))){
                        $Pointcodes=codepoint::where('point_code',$codepoint)->where('user_id',Auth::id())->exists();
                        $point= DB::table('pointuser')->where('user_id',Auth::id())->sum('point');
                        if($Pointcodes != $codetrue){
                            $Couponpointnumber=Couponpoint::where('point_code',$codepoint)->get();
                            foreach($Couponpointnumber as $Couponpoint){
                                $gruad_total = $Couponpoint->amount;
                                codepoint::where('user_id',Auth::id())->create([
                                    'user_id'=> Auth::id(),
                                    'count_pointcode'=>1,
                                    'point_code'=>$codepoint,
                                    
                                ]);
                                Pointuser::where('user_id',Auth::id())->update([
                                    'count_pointcode'=>1,
                                    'point_code'=>$codepoint,
                                'point'=>$point + $gruad_total,
                            ]);
                            $messages ="تم اضافة النقاط  بنجاح"; 
                            return response()->json([
                                'status'=>true,
                                'messages'=>$messages,
                                'Couponpointnumber'=>$Couponpointnumber,
                                'gruad_total'=>$gruad_total,
                                'view'=>View::make('front.layouts.header')->with(compact('Couponpointnumber' ,'gruad_total'))
                            ]);
                            
                        }
                    }
                    else{
                        $messages="تم انتهاء فعالية  كوبون النقاط";
                    }
                }
            }
        
            
          
        }
        }
        //message false
            if(isset($messages)){
                $Couponpointnumber = 0;
                return response()->json([
                    'status'=>false,
                    'messages'=>$messages,
                    'Couponpointnumber'=>$Couponpointnumber,
                    'view'=>View::make('front.layouts.header')->with(compact('Couponpointnumber'))
                ]);
            }
                         
        }
    }  
 

    
