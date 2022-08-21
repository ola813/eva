@extends('admin.admin')
@section('title','تعديل تفاصيل اللعبة')
@section('content')
    <div class="container-fluid">
        <!-- <div class=" mt-3"> -->
            
              <form method="POST" action="{{route('update-Category',$category->id)}}" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                      <label class="text-white m-t-30">{{trans('category/category.title_en')}}</label>
                      <input type="text" class="form-control" placeholder="Enter title product" name='title_en' value="{{$category->title_en}}" required />
                      @error('title')
                      <small class='form-text text-danger'>{{$message}}</small>
                      @enderror
                  </div>
                  <div class="form-group">
                      <label class="text-white">{{trans('category/category.Category_ar')}}</label>
                      <input type="text" class="form-control" placeholder="Enter your category" name='category_ar' value="{{$category->category_ar}}" required />
                      @error('category')
                      <small class='form-text text-danger'>{{$message}}</small>
                      @enderror                    
                  </div>
                  <div class="form-group">
                      <label class="text-white">{{trans('category/category.Category_en')}}</label>
                      <input type="text" class="form-control" placeholder="Enter your category" name='category_en' value="{{$category->category_en}}" required/>
                      @error('category')
                      <small class='form-text text-danger'>{{$message}}</small>
                      @enderror                    
                  </div>
                <div class="form-group">
                <label class="text-white">{{trans('category/category.Category_image')}}</label><br>
                    @if($category->photo)
                    <img src="{{asset('assets/front/images/Category/' .$category->photo)}}" alt="category image"  width="300" height="300" required/>
                    @endif
                    
                    <input type="file" class="form-control" name='photo' value={{$category->photo}} />
                </div>
                    <button type="submit" class="btn btn-danger">{{trans('category/category.update Category')}}</button>
                    <a href="{{route('Categories')}}" type="submit" class="btn btn-success">{{trans('category/category.Back')}}</a>
                </form>
            
        <!-- </div> -->
    </div>
@endsection