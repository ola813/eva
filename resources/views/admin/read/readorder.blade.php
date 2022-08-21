@foreach($not as $order)

@if($order->type=='فاتورة جوال')
      <a href="{{route('ViewOrderMobile',$order->id)}}" class="dropdown-item  padd-r-l">
@elseif($order->type=="طلب فتح حساب جديد")
      <a href="{{route('detailsopenaccount',$order->id)}}" class="dropdown-item  padd-r-l">
@elseif($order->type=="طلب  شحن محفظة جديد")
      <a href="{{route('ViewOrdercharge',$order->id)}}" class="dropdown-item  padd-r-l">
@elseif($order->type=='فاتورة هاتف أرضي')
      <a href="{{route('ViewOrder',$order->id)}}" class="dropdown-item  padd-r-l">
@elseif($order->type=="طلب  دفع فاتورة انترنت جديدة")
      <a href="{{route('ViewOrderinternet',$order->id)}}" class="dropdown-item  padd-r-l">
@elseif($order->type=='طلب تحويل رصيد')
      <a href="{{route('ViewOrderBalance',$order->id)}}" class="dropdown-item  padd-r-l">
@elseif($order->type=='فاتورة الكهرباء')
      <a href="{{route('order-Electornic',$order->id)}}" class="dropdown-item  padd-r-l">
@elseif($order->type=="طلب خارجي جديد")
      <a href="{{route('detials-order-out',$order->id)}}" class="dropdown-item  padd-r-l">
@elseif($order->product_id !=null)
      <a href="{{route('detials-order',$order->id)}}" class="dropdown-item  padd-r-l">
@endif
            <!-- Message Start -->
             <div class="media">
              <img src="{{asset('front/logo/logo.png')}}" width='128' height='128' alt="User Avatar" class="img-size-50 ml-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title fs-10">
              تم إرسال طلب من قبل <span class="text-danger">{{$order->user}}</span> 
                </h3>
                <p class="text-sm fs-10">
                @if($order->product_id ==null)
                  {{$order->type}}
                  @elseif($order->type==null)  
                تم ارسال طلب شراء
                @endif
                </p>
                <small class="float-right fs-10 text-sm text-muted"><i class="fa fa-clock-o"></i>{{$order->created_at->diffForHumans()}}</small>
              </div>
            </div> 
            <!-- Message End -->
          </a> 
          <hr>
@endforeach