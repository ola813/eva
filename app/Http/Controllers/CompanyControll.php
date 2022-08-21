<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
class CompanyControll extends Controller
{
    public function showCompany(){
        $companies =Company::get();
        return view('admin.Company.Company_mobile.show',compact('companies'));
    }

    public function Addcopany(){

        return view('admin.Company.Company_mobile.index');
    }

    public function addCompany(Request $request){
        $name =$request->input('name');
        Company::create([
            'name'=>$name,
        ]);
        return redirect('Company/Show')->with('status','تم إضافة الشركة بنجاح');;

    }
    public function DeleteCompan($id){
        Company::where('id',$id)->delete();
            return redirect()->back();
    }
}
