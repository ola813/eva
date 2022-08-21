@extends('front.home.home')
@section('title','سلة المشتريات')
@section('content')
<section class="bg0 p-t-120 p-b-40 product-data dir" id="products">
		<div class="container">
            <span  class=" fs-30 p-l-10 p-r-10 dis-inline-block text-white m-b-20 color-custom background-custom">{{trans('cart/cart.account')}} : {{$value}}</span>
        <div class="card shadow">
            @if($Cartitem->count() >0)
            <div class="card-body dir ">
                <h3 class="txt-center color-custom m-b-10">{{trans('cart/cart.cart')}}</h3>
                <form method="POST" action="{{route('orders')}}" id="AppendCartItem">
                    @csrf
                    @php $total=0; @endphp
                    @php $total1=0; @endphp
                    @php $total3=0; @endphp
                    <!-- @php $total2=0; @endphp -->
                    @foreach($Cartitem as $cartitem)
                   
                    <div class="row style-border">
                                    <div class="col-md-2 m-b-10 m-t-10">
                                        <span class=" txt-dark">{{trans('cart/cart.title')}} : </span>
                                        <span>
                                             {{$cartitem->product->title}}
                                            
                                        </span>
                                    </div>
                                    <div class="col-md-2 m-b-10">
                                        <input type="hidden" class="product_id" value="{{$cartitem->product_id}}" name="product_id">
                                        <div class="input-group text-enter">
                                        <span class="txt-dark" for="Quentity">{{trans('cart/cart.Quentity')}} : </span>
                                            <span class=quantity>{{$cartitem->product_qty}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2 m-b-10">
                                    <span class="txt-dark">{{trans('cart/cart.price')}} : </span>
                                    @if($cartitem->product->selling_price !=0  && $cartitem->product->price_point ==0)
                                    <span class="price1">{{$cartitem->product->selling_price * $cartitem->product_qty}}</span><br>
                                    <span class="price_point1 dis-none">0</span><br>
                                    <span class="gift_point1 text-white dis-none">{{$cartitem->product->point}}</span>
                                    @elseif($cartitem->product->selling_price !=0  && $cartitem->product->price_point !==0)
                                    <span class="price2">{{$cartitem->product->selling_price * $cartitem->product_qty}}</span>+
                                    <span class="price_point2">{{$cartitem->product->price_point * $cartitem->product_qty}}</span>{{trans('cart/cart.point')}}<br>
                                    <span class="gift_point2 text-white dis-none">{{$cartitem->product->point}}</span>
                                    @elseif($cartitem->product->selling_price ==0  && $cartitem->product->price_point !==0)
                                    <span class="price_point3">{{$cartitem->product->price_point * $cartitem->product_qty}}</span>{{trans('cart/cart.point')}}<br><br>
                                    <span class="gift_point3 text-white dis-none">{{$cartitem->product->point}}</span>
                                    @endif
                                    <span class="m-b-20 text-dark">{{trans('product/product.gift point')}} :</span>
                                    <span class="span-point">
                                            <span class="gift_point text-white">{{$cartitem->product->point}}</span><span class="text-white"> {{trans('product/product.points')}}</span>
                                    </span>        

                                    </div>
                                    
                                    <div class="col-md-2">
                                        <!----name --->
                                        @if($cartitem->user_name ==null) 
                                        <span style="display:none" class="dir txt-dark">{{trans('product/product.User name')}} : </span> <span style="display:none ">{{$cartitem->user_name}} </span>
                                        @else
                                        <span class="name dir txt-dark">{{trans('product/product.User name')}} : </span> <span>{{$cartitem->user_name}} </span><br>
                                        @endif
                                        <!----number --->
                                        @if($cartitem->number ==null) 
                                        <span style="display:none " class="dir txt-dark">{{trans('product/product.number')}} :</span> <span style="display:none" > {{$cartitem->number}} </span>
                                        @else
                                        <span class="number dir txt-dark">{{trans('product/product.number')}} :</span> <span> {{$cartitem->number}} </span><br>
                                        @endif
                                  
                                    </div >
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger delete-cart-item style-butt"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                                <hr>
                                @if($cartitem->product->selling_price !=0  && $cartitem->product->price_point ==0)
                                     @php $total+=$cartitem->product->selling_price * $cartitem->product_qty; @endphp
                                @elseif($cartitem->product->selling_price !=0  && $cartitem->product->price_point !==0)
                                    @php $total+=$cartitem->product->selling_price * $cartitem->product_qty; @endphp
                                    @php $total1+=$cartitem->product->price_point * $cartitem->product_qty; @endphp
                                @elseif($cartitem->product->selling_price ==0  && $cartitem->product->price_point !==0)
                                    @php $total1+=$cartitem->product->price_point * $cartitem->product_qty; @endphp
                                @endif
                                @endforeach
                                
                                
                               
                                <span class="m-b-20">{{trans('cart/cart.Total price')}} : 
                                    @if($total !=0 && $total1 !=0)
                                    <span class="total">{{$total}}</span>+
                                    <span class="totalpoint">{{$total1}}</span> <span >{{trans('cart/cart.point')}} </span>
                                       
                                    
                                    @elseif($total !=0 && $total1 ==0)
                                    <span class="total">{{$total}}</span>
                                    @elseif($total ==0 && $total1 !=0)
                                    <span class="totalpoint">{{$total1}}</span> <span >{{trans('cart/cart.point')}} </span>                                   
                                    @endif
                                       
                                
                               
                                        
                                        
                                        
                                     
                                   
                                       
             
                                        
                                
                                  
</span>
<hr>
                                <button class="btn btn-danger m-b-20" id="order">{{trans('cart/cart.Order')}}</button>
                                    
                                </form>
                    <form action="javascript:void(0);" method="post" id="ApplyCoupon">
                        @csrf
                        <div class="card-footer">
                            <span><strong>{{trans('cart/cart.Coupon Code')}} :</strong></span>
                            <input name="code" id="code" type="text" class="input-medium" placeholder="{{trans('cart/cart.Enter Coupon Code')}}">
                            <button class="btn btn-danger AddCoup coustom-coupon">{{trans('cart/cart.Add coupon')}}</button>
                            
                            <div class="card-footer">
                                <h6 id="total" class="couponAmount ">{{trans('cart/cart.Coupon Discount')}} :
                               
                                </h6>
                            </div>
                        </div>
                    </form>
                </div>
              
                    @else
                    <div class="card-body text-center color-custom">
                        <h2>{{trans('cart/cart.your cart is empty')}}</h2>
                        <a href="{{route('Home')}}" class="btn btn-danger m-t-30 link">{{trans('cart/cart.Continue Shopping')}}</a>
                    </div>
                    @endif
    </div>
</div>
</section>
<script src="{{asset('assets/front/plugin/jquery/jquery-3.2.1.min.js')}}"></script>
<script>
     $(document).ready(function() {
        $('#order').on('click', function(e){
        e.preventDefault();
                                        var product_id=$(this).closest('.product-data').find('.product_id').val();
                                        var product_qty=$(this).closest('.product-data').find('.quantity').text();
                                        var product_price=$(this).closest('.product-data').find('.price1').text();
                                        var product_price2=$(this).closest('.product-data').find('.price2').text();
                                        var price_point1=$(this).closest('.product-data').find('.price_point1').text();
                                        var price_point2=$(this).closest('.product-data').find('.price_point2').text();
                                        var price_point3=$(this).closest('.product-data').find('.price_point3').text();
                                        var gift_point1=$(this).closest('.product-data').find('.gift_point1').text();
                                        var gift_point2=$(this).closest('.product-data').find('.gift_point2').text();
                                        var gift_point3=$(this).closest('.product-data').find('.gift_point3').text();
                                        var gift_point=$(this).closest('.product-data').find('.gift_point').text();
                                        var total=$(this).closest('.product-data').find('.total').text();
                                        var totalpoint=$(this).closest('.product-data').find('.totalpoint').text();
                                        var coupontotal=$(this).closest('.product-data').find('.coupontotal').text();
                                        var code=$(this).closest('.product-data').find('#code').val();
                                        
                                        // alert();
                                        // alert(gift_point);
                                        // alert(gift_point1);
                                        // alert(gift_point2);
                                        // alert(gift_point3);
                                    $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                                 });
                                    $.ajax({
                                    type:'post',
                                    data:{
                                        'product_price':product_price,
                                        'product_price2':product_price2,
                                        'product_id':product_id,
                                        'product_qty':product_qty,
                                        'total':total,
                                        'totalpoint':totalpoint,
                                        'coupontotal':coupontotal,
                                        'code':code,
                                        'price_point1':price_point1,
                                        'price_point2':price_point2,
                                        'price_point3':price_point3,
                                        'gift_point1':gift_point1,
                                        'gift_point2':gift_point2,
                                        'gift_point3':gift_point3,
                                    },
                                    url:'/orders',
                                    success:function(response){
                                        swal(response.status)

                                        $('.swal-button--confirm').on('click',function(){
                                            window.location.href='/orders';
                                
                                        });
                                    },
                                    error:function(){
                                        alert("Error");
                                    },
                                });
                          });
                          });
                       
                          

     $('#ApplyCoupon').on('click','.AddCoup',function(){
        //  var total_cart=$('.alaa').text();
        var total_cart=$(this).closest('.product-data').find('.total').text();
        var product_qty=$(this).closest('.product-data').find('.quantity').text();
        var product_price=$(this).closest('.product-data').find('.price').text();
        var code =$("#code").val();
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        $.ajax({
            type:'post',
            data:{
                'code':code,
                'total_cart':total_cart,
                'product_qty':product_qty,
                'product_price':product_price,
            },
            url:'/apply-coupon',
            success:function(resp){
                if(resp.message!=""){
                    swal(resp.message);
                }
                //  $('#AppendCartItem').html(resp.view);
                if(resp.couponAmount >0){
                    // alert(resp.couponAmount)
                   $('.couponAmount').append('<span class="coupontotal">'+ resp.couponAmount + '</span>');
                   $('.total').empty();
                   $('.total').append('<span>'+ resp.gruad_total + '</span>');
                   $('.price').empty();
                   $('.price').append('<span>'+ resp.gruad_total + '</span>');
                   $('.swal-button--confirm').on('click',function(){
                    $('.AddCoup').prop('disabled', true);
                   
                  
                    });
             
                 }
             
            },
            error:function(){
                alert("Error");
            }
        });
       
    });
// });
</script>
@endsection