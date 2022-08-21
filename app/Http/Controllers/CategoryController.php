<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Models\Product;
class CategoryController extends Controller
{
    public function getAllCategory(){
        
        $Categories =  Category::select('id','title_en','category_ar','category_en','photo')->get();//return collection
        return view('admin.category.index',compact('Categories'));
        
    }
    public function createCategory(){
        return view ('admin.category.create');
    }
    public function storeCategory(CategoryRequest $request){

    //  $file_name= $this-> saveImage($request->photo,'assets/front/images/Category');
    $category= new Category();
    if($request->hasFile('photo')){
        $file=$request->file('photo');
        $ext = $file->getClientOriginalExtension();
        $file_name = time().'.'.$ext; 
        $file->move('assets/front/images/Category',$file_name);
        $category->photo=$file_name;
    }
       
     
        
    $category->title_en= $request->input('title_en');
    $category->category_ar =$request->input('category_ar');
    $category->category_en =$request->input('category_en');
    $category->save();
        return redirect('/Categories')->with('status','Category Added Successfully');
       
   }
    public function EditCategory($id){
        $category = Category::find($id);

        if(!$id)
        return redirect()->back();
        return view('admin.category.edit',compact('category'));
    }

    public function updateCategory(Request $request, $id){

        //VAlidation 


  //check is offer exist
  $category = Category::find($id);
        if($request->hasFile('photo'))
        {
            $path= 'assets/front/images/Category'.$category->photo;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file=$request->file('photo');
            $ext = $file->getClientOriginalExtension();
            $file_name = time().'.'.$ext; 
            $file->move('assets/front/images/Category',$file_name);
            $category->photo=$file_name;
        }
        //update
        $category->title_en= $request->input('title_en');
        $category->category_ar =$request->input('category_ar');
        $category->category_en =$request->input('category_en');
        $category->update();
        return redirect('/Categories')->with(['status'=>'تم التحديث بنجاح']);
    }
    //delete User
    public function deleteCategory($id){
        Category::where('id',$id)->delete();

        return redirect('/Categories')->with('status','Category Deleted Successfully');
    }
    
    public function ShowProduct($title_en){
        if(Category::where('title_en',$title_en)->exists()){
            $category=Category::where('title_en',$title_en)->first();
            $products=Product::where('category_id',$category->id)->get();
            return view('front.home.product',compact('category','products'));
        }
        else{
            return redirect('/home')->with('status','Product Does not exists');
        }
    }

    public function ShowProductCategory($caregory_id){
        $caregory = Category::find($caregory_id);
        $products = $caregory->products;
        return view('admin.products.all',compact('products'));
    }
}
