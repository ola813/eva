<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masseges;
class MassegesController extends Controller
{
    public function showmessage(){
        $messages=Masseges::get();
        return view('admin.messages.show',compact('messages'));
    }
    public function Addmessage(){
        return view('admin.messages.insert');
    }
    public function newMessage(Request $request){
        $messages= new Masseges();
        $messages->message= $request->input('message');
        $messages->save();
            return redirect('Messages/message')->with('status','تم إضافة رد تلقائي جديد');
    }
    public function Editmessage($id){
    $Edits = Masseges::find($id);
    return view('admin.messages.edit',compact('Edits'));
    }
    //check is offer exist
    public function UpdateMessage(Request $request ,$id){
        $messages = Masseges::find($id);
        //update
        $messages->message= $request->input('message');
        $messages->update();
        return redirect('Messages/message')->with(['status'=>'تم التحديث بنجاح']);
    }
    public function Deletemessage($id){
        Masseges::where('id',$id)->delete();
        return redirect('Messages/message')->with('status','تم حذف الرد التلقائي بنجاح');
    }
}

