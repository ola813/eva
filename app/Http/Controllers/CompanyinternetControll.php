<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyInternet;
class CompanyinternetControll extends Controller
{
    public function showCompanyinter(){
        $companies =CompanyInternet::get();
        return view('admin.Company.Company_internet.show',compact('companies'));
    }

    public function Addcopanyinter(){

        return view('admin.Company.Company_internet.index');
    }

    public function newComInter(Request $request){

        $name =$request->input('name');
        CompanyInternet::create([
            'name'=>$name,
            ]
        );
        // return redirect('Bills/Blance/AllAccount')->with('status','Product Added Successfully');
        // return redirect()->back();
        return redirect('/CompanyInter/ShowComIner')->with('status', 'تم إضافة الشركة بنجاح');

    }
    public function deleteCompanyInter($id){
        CompanyInternet::where('id',$id)->delete();
    
        // Coupon::where('id',$id)->delete();
            // $messages = 'Coupon has been delete successfully!';
            return redirect()->back();
    }
}
