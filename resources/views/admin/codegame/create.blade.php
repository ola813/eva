@extends('admin.admin')
@section('title','إضافة كود لعبة')
@section('content')
    <div class="container-fluid">
    <a href="{{route('getAllcodegame')}}" type="submit" class="btn btn-danger m-t-30">{{trans('category/category.Back')}}</a>
           
              <form method="POST" action="{{route('newecodegame')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                      <label class="m-t-30">{{trans('coupon/coupon.code game')}}</label>
                      <input type="text" required class="form-control" placeholder="{{trans('coupon/coupon.Enter code game....')}}" name='code' />
                      @error('title')
                      <small class='form-text text-danger'>{{$message}}</small>
                      @enderror
                  </div>
                
        
                        <div class="form-group">
                            <label >{{trans('product/product.Category_game')}}</label>
                            <select name='type'class="form-control" required>
                                <option value="1">freefire-110</option>
                                <option value="2">freefire-231</option>
                                <option value="3">freefire-583</option>
                                <option value="4">pubge-60</option>
                                <option value="5">pubge-325</option>
                                <option value="6">Roblox-10</option>
                                <option value="7">Razar-5</option>
                                <option value="8">Razar-10</option>
                                <option value="9">Razar-20</option>
                                <option value="10">ituns-5</option>
                                <option value="11">ituns-10</option>
                                <option value="12">ituns-20</option>
                                <option value="13">oropa-200</option>
                                <option value="14">oropa-315</option>
                                <option value="15">oropa-795</option>
                       
                            </select>
                        
                        </div>
                  
                    <button type="submit" class="btn btn-danger m-r-t-89">{{trans('coupon/coupon.Add code game')}}</button>
                </form>

    </div>
@endsection