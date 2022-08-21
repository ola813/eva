@extends('front.home.home')
@section('title','تفاصيل المنتج')
@section('content')
<a href="{{route('Home')}}"><button type="submit" class="btn btn-danger m-t-30 m-l-250 m-t-50">{{trans('Bills/Bills.Back')}}</button></a>

<section class="bg0 p-t-50 p-b-40 dir" id="products">
    <div class="container">
        <div class="card shadow product-data ">

          
            <div class="card-body">
                <div class="row">
                        <div class="col-md-6 card-product-img">
                            <img class="m-t-20 m-b-20 border-raduis-20" width="300px" height="300px"  alt="image" src="{{asset('assets/front/images/products/'.$products->photo)}}"/>
                        </div>
                        @if($products->quantity >=1)
                        <div class="col-md-6">
                                <p class="m-b-20 text-dark" >{{trans('product/product.title product')}} : {{$products->title}}</p>
                                @if($products->orginal_price !=0 && $products->selling_price !=0  && $products->price_point ==0)
                                <label class="m-b-20 text-dark">{{trans('product/product.orginal_price')}} : <s>{{$products->orginal_price}}</s></label><br>
                                <p class="m-b-20 text-dark">{{trans('product/product.selling_price')}} : <span class="product_price">{{$products->selling_price}}</span></p>
                                @elseif($products->orginal_price ==0 && $products->selling_price !=0  && $products->price_point ==0)
                                <p class="m-b-20 text-dark">{{trans('product/product.selling_price')}} : <span class="product_price">{{$products->selling_price}}</span></p><br>
                                @elseif($products->selling_price !=0  && $products->price_point !==0)
                                <span class="m-b-20 text-dark">{{trans('product/product.selling_price')}} : <span class="product_price">{{$products->selling_price}}</span> + </span>
                                <span class="m-b-20 text-danger price_point">{{$products->price_point}}</span> <small class="style-s-p">{{trans('product/product.points')}}</small><br>
                                @elseif($products->selling_price ==0  && $products->price_point !==0)
                                <span class="m-b-20 text-dark">{{trans('product/product.selling_price')}} :</span><span class="text-danger price_point">{{$products->price_point}}</span><span>{{trans('product/product.points')}}</span><br><br>
                                @endif
                                <span class="m-b-20  m-t-20 dis-inline-block">{{trans('product/product.gift point')}} :</span>
                                    <span class="span-point">
                                        <span class="gift_point text-white">{{$products->point}}</span><span class="text-white"> {{trans('product/product.points')}}</span>
                                    </span>
                                
                                <hr>
                                        <div class="row">
                                                <div>
                                                    <input type="hidden" value="{{$products->id}}" class="product_id">
                                                    <input type="hidden" value="{{$products->status}}" class="product_status">
                                                    <label for="Quentity" class="text-dark f-s-18 txt-center">{{trans('product/product.quantity')}}</label>
                                                        <div class="input-group text-enter input-r-30">
                                                            <button type="button" class="input-group-text decrease-btn btn btn-danger">-</button>
                                                            <input type="text" name="quantity" value="1" min="1" max ="3"class="form-control qty-input" />
                                                            <button type="button" class="input-group-text increnemt-btn btn btn-danger">+</button>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <button id='btn' type="submit" class="btn btn-danger m-l-73 m-r-73 m-t-20 m-r-110"><a class="link">{{trans('product/product.Add to cart')}}<a></button>
                                                        </div>
                                                    
                                                </div>
                                        </div>
                        </div>
                     @else
                     <div class="col-md-6">
                            <span class="text-center text-danger price_input float-end fs-23 style-new-price">{{trans('product/product.product no avilable')}}</span>
                    </div>
                    @endif
            </div>
            </div>
     


  <!-- Modal -->
<div class=" modal fade " id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content ">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <div class="modal-body ">
            <form class="modal-form ">
                @csrf
                <input type="hidden" value="{{$products->id}}" class="product_id">
                <input type="hidden" name="quantity" value='{{$products->quantity}}' class="foem-control qty-input" />
                <label for="username">{{trans('product/product.User name')}}</label>
                <input type="text" name='user_name'  class="name" id="username"/>
                <label for="usernumber">{{trans('product/product.number')}}</label>
                <input type="text"  class="number" id="usernumber"/>
                <!-- <p style="display:hidden">Selling Price: <span class="product_price">{{$products->selling_price}}</span></p> -->
                <!-- <label for="usernumber">unique</label>
                <input type="text"  class="unique"/> -->

            </form>
        </div>
        <div class="modal-footer">
            <button id="btn1" type="button" class="btn btn-danger addToCartBtn">{{trans('product/product.Add to cart')}}</button>
        </div>
    </div>
  </div>
</div>
		
</div>
    </div>	
</section>    
@endsection