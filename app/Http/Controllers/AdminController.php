<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Models\tolalcharge;
class AdminController extends Controller
{
    public function ShowPage()
    {
        
        return view('admin.index')->with('status','اهلا بك');
    }
    public function getAllAdmin(){
        $admins =  User::where('role_as',0)->get();//return collection
        return view('admin.admin.all',compact('admins'));
    }
    public function EditAdmin($id){
        $Edits = User::find($id);

        if(!$id)
        return redirect()->back();
       $Edits = User::find($id);
       return view('admin.admin.edit',compact('Edits'));
    }

        public function updateAdmin(Request $request, $id){

        //VAlidation 

        //check is offer exist
        $Update = User::find($id);
        if(!$id){

            return redirect()->back();
        }

        //update
        $Update->update($request -> all());
        return redirect('/Show-admins')->with(['success'=>'تم التحديث بنجاح']);

    }
    //delete User
    public function deleteAdmin($id){
        User::where('id',$id)->delete();

        // Coupon::where('id',$id)->delete();
            $messages = 'Coupon has been delete successfully!';
            return redirect()->back();
        }
        // return redirect()->route(route:'admin.admin.all');
    // }

    public function viewAdmin($id){
        $admins =User::find($id);
        // $password=$admins->password;
        // $password_user=Crypt::dencryptString($password);
        return view('admin.admin.details',compact('admins'));
    }
}
