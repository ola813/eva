@extends('admin.admin')
@section('title','إضافة لعبة')
@section('content')
    <div class="container-fluid">
    <a href="{{route('Categories')}}" type="submit" class="btn btn-danger m-t-30">{{trans('category/category.Back')}}</a>
            @if(session('status'))
            <h6 class="alert alert-success">{{session('status')}}</h6>
                @endif
              <form method="POST" action="{{route('Add-Category')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                      <label  class="m-t-30">{{trans('category/category.title_en')}}</label>
                      <input type="text" required class="form-control" placeholder="{{trans('category/category.title_en')}}" name='title_en' />
                      @error('title_en')
                      <small class='form-text text-danger'>{{$message}}</small>
                      @enderror
                  </div>
                  <div class="form-group">
                      <label>{{trans('category/category.Category_ar')}}</label>
                      <input type="text" required class="form-control" placeholder="{{trans('category/category.Category_ar')}}" name='category_ar'/>
                      @error('category_ar')
                      <small class='form-text text-danger'>{{$message}}</small>
                      @enderror                    
                  </div>
                  <div class="form-group">
                      <label>{{trans('category/category.Category_en')}}</label>
                      <input type="text" required class="form-control" placeholder="{{trans('category/category.Category_en')}}" name='category_en'/>
                      @error('category_en')
                      <small class='form-text text-danger'>{{$message}}</small>
                      @enderror                    
                  </div>
                <div class="form-group">
                    <label >{{trans('category/category.Photo')}}</label>
                    <input type="file" class="form-control" name='photo'  required/>
                    @error('photo')
                        <small class='form-text text-danger'>{{$message}}</small>
                    @enderror  
                </div>
                    <button type="submit" class=" btn btn-danger m-r-t-89 ">{{trans('category/category.Add Category')}}</button><br>
                    

                </form>
       
    </div>
@endsection