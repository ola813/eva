@extends('front.home.home')
@section('title','عمليات الشراء')
@section('content')
<section class="bg0 p-t-120 p-b-40 dir" id="products">
<h2 class=" m-b-22 p-r-6 txt-right font-charge style-charge title-320">{{trans('order/order.my order')}}</h2>
      <div class="table-responsive">
      
          <table class="table table-bordered text-center dir" id="datatable2">
            <thead class="table-danger text-white  text-center">
              <tr>
                <td>{{trans('order/order.product number')}}</td>
                <td>{{trans('order/order.product name')}}</td>
                <td>{{trans('order/order.product price')}}</td>
                <td>{{trans('order/order.product quantity')}}</td>
                <td>{{trans('order/order.status')}}</td>
                <td>{{trans('order/order.date')}}</td>
                <td>{{trans('order/order.details')}}</td>
              </tr>
            </thead>
            <tbody class="">
            @forelse($orders as $order)
              <tr>
                <td>{{$order->ordernum}}</td>
                <td>{{$order->product->title}}</td>
                @if($order->price !=0 && $order->price_point ==0)
                <td>{{$order->product->selling_price}} ل.س</td>              
                @elseif(($order->price !=0 && $order->price_point !=0))
                <td>{{$order->price}}ل.س +             
                {{$order->price_point}} {{trans('cart/cart.point')}} 
                </td>           
                @elseif(($order->price ==0 && $order->price_point !=0))
                <td>{{$order->price_point}} {{trans('cart/cart.point')}}  </td>  
                @endif        
                <td>{{$order->product_qty}}</td>
                <td >
                    @if ($order->status == '0')
                    <span class="pending">{{trans('order/order.pending')}}</span>
                    @elseif($order->status == '1')
                      <span class="complete">{{trans('order/order.Completed')}}</span>
                    @elseif($order->status == '2')
                    <span class="cancel">{{trans('order/order.Cancel')}}</span>
                    @endif 
                </td>
                <td scope="row">{{date("F j, Y, g:i a" ,strtotime($order->created_at))}}</td>
             
                <td><a href="{{route('ShowOrderdetails',$order->id)}}" class="text-danger"><i class="fa fa-eye"></i></a></td>
              </tr>
              @empty
              <tr>
                <th colspan='7' class="text-center">لا يوجد بيانات في الجدول</th>
              </tr>
              @endforelse
            </tbody>
          </table>
      </div>
</section>   

@endsection
