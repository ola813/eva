<?php

namespace App\Http\Controllers;
use App\Exports\Export;
use App\Imports\UsersImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\tolalcharge;
use App\Models\Pointuser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class UsersController extends Controller
{
    public function getAllUsers(){

        $Users =  User::where('role_as',1)->get();//return collection
        foreach($Users as $user){
            $user_id =$user->id;
            
            $total_accounts=tolalcharge::where('user_id',$user_id)->get();
            foreach($total_accounts as $total_account){
                $user_account =$total_account->total_charge;
            
                
            }
            
            return view('admin.user.all',compact('Users'));
        }

}
    public function viewUser($id){
        // $Users =  User::where('role_as',1)->find($id);
        $Users =  User::find($id);//return collection
        // $user_password =$Users->password;
        // $password_user=Crypt::decryptString($user_password);
        // foreach($Users as $user){
            $user_id =$Users->id;
            $total_accounts=tolalcharge::where('user_id',$user_id)->get();
            $Pointusers=Pointuser::where('user_id',$user_id)->get();
            
            foreach($total_accounts as $total_account){
                $user_account =$total_account->total_charge;
            }       
            foreach($Pointusers as $Pointuser){
                $Point =$Pointuser->point;
            }       
            return view('admin.user.DetailsUser',compact('Users','user_account','Point'));
        // }
}
    public function EditUsers($id){
        $Edits = User::find($id);

        if(!$id)
        return redirect()->back();
    $Edits = User::find($id);
    $user_id =$Edits->id;
    $total_accounts=tolalcharge::where('user_id',$user_id)->get();
    $Pointusers=Pointuser::where('user_id',$user_id)->get();
    foreach($total_accounts as $total_account){
        $user_account =$total_account->total_charge;
    }
    foreach($Pointusers as $Pointuser){
        $Point =$Pointuser->point;
    }   
    return view('admin.user.edit',compact('Edits','user_account','Point'));
    }

    public function updateUsers(Request $request, $id){

    //check is offer exist
    $Update = User::find($id);
    if(!$id){

        return redirect()->back();
    }
    
    //update
    $Update->update($request -> all());
    $total_charge=$request->input('total_charge');
    $Point=$request->input('Point');
    tolalcharge::where('user_id',$id)->update([
        'total_charge' =>$total_charge,
    ]);
    Pointuser::where('user_id',$id)->update([
        'point' =>$Point,
    ]);
    User::where('id',$id)->update([
        'total-charge' =>$total_charge,
    ]);
    return redirect('/User/Show')->with('status','تم التحديث بنجاح');

}
//delete User
public function deleteUser($id){
    User::where('id',$id)->delete();

    // Coupon::where('id',$id)->delete();
        // $messages = 'Coupon has been delete successfully!';
        return redirect()->back()->with('status','تم الحذف بنجاح');;
}
public function getProfile(){
    $Users =  User::where('role_as',1)->get();//return collection
        return view('admin.profile',compact('Users'));
}
public function export(){
    return Excel::download(new Export, 'users.xlsx');
}

// import user
public function import_user(Request $request){
    $request->validate([
        'excel_file'=>'required|mimes:xlsx'
    ]);
    try {
        Excel::import(new UsersImport, $request->file('excel_file'));
        return redirect()->back()->with('status', 'تم إضافة المستخدمين بنجاح');
    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
         $failures = $e->failures();
         return redirect()->back()->with('import_error', $failures);

        
    }
    
    
}

}