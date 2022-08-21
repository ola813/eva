<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Couponpoint;
use App\Models\User;
class CouponsPointController extends Controller
{
    public function getAllcouponspoint(){
        $couponspoints = Couponpoint::get();
        return view('admin.coupons.show',compact('couponspoints'));
    }
    public function updateCouponPointStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] =="Active"){
                $status = 0;
            }
            else{
                $status=1;
            }
            Couponpoint::where('id',$data['couponspoint_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'couponspoint_id'=>$data['couponspoint_id']]);
        }
    }
        public function EditpointCoupon(Request $request, $id=null){
            if($id==''){
      
                //Add Coupon
                $couponspoints=new Couponpoint;
                $title="Add CouponPoint";
                $selUsers=array();
               
                //  $Users=array();
                $messages="تم إضافة الكوبون بنجاح";
            }
            else{
                //update Coupon
                $couponspoints = Couponpoint::find($id);
                $title="Edit CouponPoint";
                $selUsers=explode(',',$couponspoints['users']);
                $messages="تم تحديث الكوبون";
                 
            }
            if($request->isMethod('post')){
                $data=$request->all();
                if(isset($data['users'])){
                   
                    $users = implode(',',$data['users']);
  
                }
           
               
                if($data['couponpoint_option'] == 'Automatic'){
                    if($data['point_code'] ==null){

                        $point_code=Str::random(8);
                    }
                    else{
                        $point_code=$data['point_code'];
                    }
            }
            else{
                $point_code=$data['point_code'];
            }
            $couponspoints->couponpoint_option=$data['couponpoint_option'];
            $couponspoints->point_code=$point_code;
            $couponspoints->users=$users;
            $couponspoints->couponpoint_type=$data['couponpoint_type'];
            $couponspoints->amount=$data['amount'];
            $couponspoints->expiry_date=$data['expiry_date'];
            $couponspoints->status=1;
            $couponspoints->save();
            return redirect('Coupons/show');
        }
            
            $users= User::select('email')->where('role_as',1)->get();
            return view('admin.coupons.pointEditAdd',compact('couponspoints','title','users','selUsers'));
       
    }
        public function DeletepointCoupon($id){
            //Delete Coupon
            Couponpoint::where('id',$id)->delete();
            $messages = 'تم حذف الكوبون بنجاح';
            return redirect()->back();
        }

   

}

