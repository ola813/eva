<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\User;
use App\Models\Couponpoint;
class CouponsController extends Controller
{
    public function getAllcoupons(){
        $coupons = Coupon::get();
        $couponspoints = Couponpoint::get();
        return view('admin.coupons.show',compact('coupons','couponspoints'));
    }
    public function updateCouponStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] =="Active"){
                $status = 0;
            }
            else{
                $status=1;
            }
            Coupon::where('id',$data['coupon_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'coupon_id'=>$data['coupon_id']]);
        }
    }
        public function EditCoupon(Request $request, $id=null){
            if($id==''){
                //Add Coupon
                $coupon=new Coupon;
                $title="Add Coupon";
                $selCats=array();
                $selUsers=array();
                $messages="Coupon added Sucessfully!";
            }
            else{
                //update Coupon
                $coupon = Coupon::find($id);
                $title="Edit Coupon";
                $selCats=explode(',',$coupon['products']);
                $selUsers=explode(',',$coupon['users']);
                $messages="Coupon Update Sucessfully!";
                 
            }
            if($request->isMethod('post')){
                $data=$request->all();
                if(isset($data['users'])){
                    $users = implode(',',$data['users']);
                }
                if(isset($data['products'])){
                    $products = implode(',',$data['products']);
                    
                }
                if($data['coupon_option'] == 'Automatic'){
                    $coupon_code=Str::random(8);
            }
            else{
                $coupon_code=$data['coupon_code'];
            }
            $coupon->coupon_option=$data['coupon_option'];
            $coupon->coupon_code=$coupon_code;
            $coupon->users=$users;
            $coupon->products=$products;
            $coupon->coupon_type=$data['coupon_type'];
            $coupon->amount_type=$data['amount_type'];
            $coupon->amount=$data['amount'];
            $coupon->expiry_date=$data['expiry_date'];
            $coupon->status=1;
            $coupon->save();
            return redirect('Coupons/show');
        }
            $Products = Product::get();
            $users= User::select('email')->where('role_as',1)->get();
            return view ('admin.coupons.add_edit_coupon',compact('coupon','title','Products','users','selCats','selUsers'));
        }

        public function DeleteCoupon($id){
            //Delete Coupon
            Coupon::where('id',$id)->delete();
            $messages = 'Coupon has been delete successfully!';
            return redirect()->back();
        }

   

}

