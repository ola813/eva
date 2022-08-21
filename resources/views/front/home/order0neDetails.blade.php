@extends('front.home.home')
@section('content')
<section class="bg0 p-t-120 p-b-40 dir" id="products">
<h2 class=" m-b-22 p-r-6 txt-right font-charge style-charge title-320">{{trans('order/order.Details Order')}}</h2>
      <div class="table-responsive">
      
          <table class="table table-bordered table-re text-center dir">
            <thead class="table-danger text-white  text-center">
              <tr>
                <td scope="col">{{trans('order/order.fname')}}</td>
                <td scope="col">{{trans('order/order.User_id')}}</td>
                <td>{{trans('order/order.product name')}}</td>
                <td>{{trans('order/order.product price')}}</td>
                <td>{{trans('order/order.product quantity')}}</td>
                <td>{{trans('order/order.status')}}</td>
                <td>{{trans('order/order.game code')}}</td>
                <td>{{trans('order/order.date')}}</td>
                <td>{{trans('order/order.Code')}}</td>
                <td>{{trans('order/order.couponAmount')}}</td>
                <td>{{trans('order/order.message')}}</td>
                <td>{{trans('order/order.name player')}}</td>
                <td>{{trans('order/order.number')}} (id)</td>
                <td>{{trans('order/order.details')}}</td>
                
                
                
              </tr>
            </thead>
            <tbody class="">
            @forelse($orders as $order)
              <tr >
                <td scope="row" data-label="{{trans('order/order.fname')}}">{{$order->userorder->fname}}</td>
                <td scope="row" data-label="{{trans('order/order.User_id')}}">{{$order->userorder->user_id}}</td>
                <td scope="row" data-label="{{trans('order/order.product name')}}">{{$order->product->title}}</td>
                <td scope="row" data-label="{{trans('order/order.product price')}}">{{$order->price}}</td>
                <td scope="row" data-label="{{trans('order/order.product quantity')}}">{{$order->product_qty}}</td>
                <td  scope="row" data-label="{{trans('order/order.status')}}">
                    @if ($order->status == '0')
                    <span class="pending">{{trans('order/order.pending')}}</span>
                    @elseif($order->status == '1')
                      <span class="complete">{{trans('order/order.Completed')}}</span>
                    @elseif($order->status == '2')
                    <span class="cancel">{{trans('order/order.Cancel')}}</span>
                    @endif 
                </td>
                @if($order->codegame==null)
                <td scope="row" data-label="{{trans('order/order.couponAmount')}}">{{trans('order/order.message no')}}</td>
                @else
                <td scope="row" data-label="{{trans('order/order.game code')}}">{{$order->codegame}}</td>
                @endif
                <td scope="row" data-label="{{trans('order/order.date')}}">{{date("F j, Y, g:i a" ,strtotime($order->created_at))}}</td>
                @if($order->code==null)
                <td scope="row" data-label="{{trans('order/order.Code')}}">{{trans('order/order.code no')}}</td>
                @else
                <td scope="row" data-label="{{trans('order/order.Code')}}">{{$order->code}}</td>
                @endif
                @if($order->couponAmount==null)
                <td scope="row" data-label="{{trans('order/order.couponAmount')}}">{{trans('order/order.couponAmount no')}}</td>
                @else
                <td scope="row" data-label="{{trans('order/order.couponAmount')}}">{{$order->couponAmount}}</td>
                @endif
                @if($order->messages==null)
                <td scope="row" data-label="{{trans('order/order.message')}}">{{trans('order/order.message no')}}</td>
                @else
                <td scope="row" data-label="{{trans('order/order.message')}}">{{$order->messages->message}}</td>
                @endif
                @if($order->user_name==null)
                <td scope="row" data-label="{{trans('order/order.name player')}}">{{trans('order/order.no player name')}}</td>
                @else
                <td scope="row" data-label="{{trans('order/order.name player')}}">{{$order->user_name}}</td>
                @endif
                @if($order->number==null)
                <td scope="row" data-label="{{trans('order/order.number')}}">{{trans('order/order.number no')}} </td>
                @else
                <td scope="row" data-label="{{trans('order/order.number')}}">{{$order->number}}</td>
                @endif
                <td scope="row" data-label="{{trans('order/order.details')}}"><a href="{{route('vieworder')}}" class="text-white btn btn-danger">{{trans('order/order.Back')}}</a></td>
              </tr>
              @empty
              <tr>
                <th colspan='11' class="text-center">لا يوجد بيانات في الجدول</th>
              </tr>
              @endforelse
            </tbody>
          </table>
      </div>
</section>   

@endsection
