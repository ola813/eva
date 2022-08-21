<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\File;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
        //create item 
        public function creatproduct(){
            return view ('admin.products.create');
        }
        //store item in DB
    public function storeproduct(Request $request){
        $product= new Product();
        if($request->hasFile('photo')){
            $file=$request->file('photo');
            $ext = $file->getClientOriginalExtension();
            $file_name = time().'.'.$ext; 
            $file->move('assets/front/images/products',$file_name);
            $product->photo=$file_name;
        }
        $product->title= $request->input('title');
        $product->price_act =$request->input('price_act');
        $product->orginal_price =$request->input('orginal_price');
        $product->selling_price =$request->input('selling_price');
        $product->point =$request->input('point');
        $product->quantity =$request->input('quantity');
        $product->price_point =$request->input('price_point');
        $product->category_id =$request->input('category_id');
        $product->type_product=$request->input('type_product');
        $product->status =$request->input('status');
        $product->commission=$product->selling_price - $product->price_act;
        $product->save();
       
        return redirect('/Categories')->with('status','تم إضافة الفئة بنجاح');
    }
    public function Editeproduct($id){
    $products = Product::find($id);
        return view('admin.products.edit',compact('products'));
}
public function updateproduct(Request $request, $id){

    //VAlidation 

    //check is offer exist
        $product= Product::find($id);
        if($request->hasFile('photo'))
        {
            $path= 'assets/front/images/products'.$product->photo;
            if(File::exists($path))
            {
                File::delete($path);
            }
            $file=$request->file('photo');
            $ext = $file->getClientOriginalExtension();
            $file_name = time().'.'.$ext; 
            $file->move('assets/front/images/products',$file_name);
            $product->photo=$file_name;
        }
        //update
        $product->title= $request->input('title');
        $product->orginal_price=$request->input('orginal_price');
        $product->selling_price=$request->input('selling_price');
        $product->price_act=$request->input('price_act');
        $product->quantity=$request->input('quantity');
        $product->price_point=$request->input('price_point');
        $product->point =$request->input('point');
        $product->category_id =$request->input('category_id');
        $product->type_product =$request->input('type_product');
        $product->status =$request->input('status');
        $product->update();
        return redirect('/Categories')->with(['status'=>'تم التحديث بنجاح']);

        }
        public function deleteproduct($id){
            $product =Product::find($id);
            $product -> delete();
            return redirect()->back()->with(['status'=>'تم الحذف بنجاح']);
        }

        //view Product detais
        public function ShowdetailsProduct($title_en,$peoduct_title){
            if(Category::where('title_en',$title_en)->exists()){
                if(Product::where('title',$peoduct_title)->exists()){
                    // $category=Category::where('title_en',$title_en)->first();
                   $products=Product::where('title',$peoduct_title)->first();
                   return view('front.home.productDetails',compact('products'));
                }else{
                    return redirect('/home')->with('status','Product Does not exists');
                }
        }else{
            return redirect('/home')->with('status','No such Category found');
        }
}

}