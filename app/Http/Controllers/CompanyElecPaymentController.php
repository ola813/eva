<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyElecPayment;
class CompanyElecPaymentController extends Controller
{
    public function showPayELec(){
        $companies =CompanyElecPayment::get();
        return view('admin.Company.Company_Electronic.show',compact('companies'));
    }

    public function AddPayELectro(){
        return view('admin.Company.Company_Electronic.index');
    }

    public function newPayELec(Request $request){
        
        $name =$request->input('name');
        CompanyElecPayment::create([
            'name'=>$name,
        ]);
        return redirect('/PaymentElectronic/ShowPayELec')->with('status','تم إضافة الشركة بنجاح');

    }
    public function DeletePayELec($id){
        CompanyElecPayment::where('id',$id)->delete();
            return redirect()->back();
    }
}
