@extends('admin.admin')
@section('title','إضافة فئة')
@section('content')
    <div class="container-fluid">
    <a href="{{route('Categories')}}" type="submit" class="btn btn-danger m-t-30">{{trans('category/category.Back')}}</a>
           
              <form method="POST" action="{{route('Add-item')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                      <label class="m-t-30">{{trans('product/product.title')}}</label>
                      <input type="text" required class="form-control" placeholder="{{trans('product/product.Enter title product....')}}" name='title' />
                      @error('title')
                      <small class='form-text text-danger'>{{$message}}</small>
                      @enderror
                  </div>
                        <div class="form-group">
                            <label >{{trans('product/product.price_act')}}</label>
                            <input type="number" required class="form-control" placeholder="{{trans('product/product.Enter your price_act')}}" name='price_act'/>
                            @error('price_act')
                             <small class='form-text text-danger'>{{$message}}</small>
                             @enderror
                        </div>
                        <div class="form-group">
                            <label >{{trans('product/product.commission')}}</label>
                            <input type="number"  class="form-control" disabled name='commission'/>
                        </div>
                        <div class="form-group">
                            <label >{{trans('product/product.orginal_price')}}</label>
                            <input type="number" required class="form-control" placeholder="{{trans('product/product.Enter your price....')}}" name='orginal_price'/>
                            @error('orginal_price')
                             <small class='form-text text-danger'>{{$message}}</small>
                             @enderror
                        </div>
                        <div class="form-group">
                            <label >{{trans('product/product.selling_price')}}</label>
                            <input type="number" required class="form-control" placeholder="{{trans('product/product.Enter your selling_price...')}}" name='selling_price'/>
                            @error('selling_price')
                             <small class='form-text text-danger'>{{$message}}</small>
                             @enderror
                        </div>
                        <div class="form-group">
                            <label >{{trans('product/product.price point')}}</label>
                            <input type="number" required class="form-control" placeholder="{{trans('product/product.Enter your point price...')}}" name='price_point'/>
                            @error('price_point')
                             <small class='form-text text-danger'>{{$message}}</small>
                             @enderror
                        </div>
                        <div class="form-group">
                            <label >{{trans('product/product.point')}}</label>
                            <input type="number" required class="form-control" placeholder="{{trans('product/product.Enter your point product...')}}" name='point'/>
                            @error('point')
                             <small class='form-text text-danger'>{{$message}}</small>
                             @enderror
                        </div>
                        <div class="form-group">
                            <label >{{trans('product/product.quantity')}}</label>
                            <input type="number" required class="form-control" placeholder="{{trans('product/product.Enter your quantity')}}" name='quantity'/>
                            @error('quantity')
                             <small class='form-text text-danger'>{{$message}}</small>
                             @enderror
                        </div>
                        <div class="form-group">
                            <label >{{trans('product/product.Category_game')}}</label>
                            <select name='status'class="form-control" required>
                                <option value="0">{{trans('product/product.Category one')}}</option>
                                <option value="1">{{trans('product/product.Category two')}}</option>
                                <!-- <option value="2">{{trans('product/product.Category three')}}</option> -->
                            </select>
                        
                        </div>
                        <div class="form-group">
                            <label >{{trans('product/product.category_id')}}</label>
                            <select name='category_id'class="form-control" required>
                            @foreach(\App\Models\Category::all() as $Category)
                                <option value="{{$Category->id}}"> {{$Category->title_ar}} - {{$Category->title_en}}</option>
                                @endforeach
                            </select>
                         
                        </div>

                        
                        <div class="form-group">
                            <label >{{trans('product/product.Category game')}}</label>
                            <select name='type_product'class="form-control" required>
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
                                <option value="16">لا تنتمي لإي تصنيف</option>
                            </select>
                        
                        </div>

                        <div class="form-group">
                    <label >{{trans('product/product.photo')}}</label>
                    <input type="file" class="form-control" name='photo'  required/>
                    @error('photo')
                        <small class='form-text text-danger'>{{$message}}</small>
                    @enderror  
                </div>
                    <button type="submit" class="btn btn-danger m-r-t-89">{{trans('product/product.Add play')}}</button>
                </form>

    </div>
@endsection