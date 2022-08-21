<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imageoffer;
use Illuminate\Support\Facades\File;
class ImageOfferController extends Controller
{
    public function showAllImage(){
        $Images=Imageoffer::get();
        return view('admin.imageoffer.index',compact('Images'));
    }
    public function CreateNewImage(){
        return view('admin.imageoffer.create');
    }
    public function addImageOffer(Request $request){
        $Images= new Imageoffer();
        $file=$request->file('image');
        $ext = $file->getClientOriginalExtension();
        $file_name = time().'.'.$ext; 
        $file->move('assets/front/images/ImageOffer',$file_name);
        $Images->image=$file_name;
        $Images->save();
        return redirect('/ImageOffer/Show')->with('status','Images Added Successfully');
    
    }
    public function EditeImage($id){
        $Edite = Imageoffer::find($id);

        if(!$id)
        return redirect()->back();
        return view('admin.imageoffer.edit',compact('Edite'));
    }


    public function UpdateImage(Request $request, $id){

  //check is offer exist
  $Images = Imageoffer::find($id);
        if($request->hasFile('image'))
        {
            $path= 'assets/front/images/ImageOffer'.$Images->image;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file=$request->file('image');
            $ext = $file->getClientOriginalExtension();
            $file_name = time().'.'.$ext; 
            $file->move('assets/front/images/ImageOffer',$file_name);
            $Images->image=$file_name;
        }
        $Images->update();
        return redirect('/ImageOffer/Show')->with(['status'=>'تم التحديث بنجاح']);
    }

    public function DeleteImage($id){
        Imageoffer::where('id',$id)->delete();

        return redirect('/ImageOffer/Show')->with('status','Images Deleted Successfully');
    }
}
