@extends('admin.admin')
@section('title','الطلبات الجديدة')
@section('content')
  <div class="row">
    <div class="col-md-12 table-responsive">
      <div class="card-header">
        <h2 class="text-white m-t-10 ">{{trans('order/order.New Order')}}</h2>
      </div>
      <div class="card-body">
      <table class="table" id="datatable1">
         <thead class="table-dark">
          <tr>
            <td scope="col" >{{trans('order/order.user name order')}}</td>
            <td scope="col">{{trans('order/order.product name')}}</td>
            <td scope="col">{{trans('order/order.product price')}}</td>
            <td scope="col">{{trans('order/order.status')}}</td>
            <td scope="col">{{trans('order/order.date')}}</td>
            <td scope="col">{{trans('order/order.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($orders as $order)
          <tr>
            <td >{{$order->userorder->fname}}</td>
            <td >{{$order->product->title}}</td>
            <td >{{$order->price}}</td>
            <td >
            @if ($order->status == '0')
             <span class="pending">{{trans('order/order.pending')}}</span>
            @elseif($order->status == '1')
              <span class="complete">{{trans('order/order.complete')}}</span>
            @elseif($order->status == '2')
             <span class="cancel">{{trans('order/order.Cancel')}}</span>
            @endif 
            </td>
            <td scope="row">{{date("F j, Y, g:i a" ,strtotime($order->created_at))}}</td>
            <td scope="row">
                <button type="button" class="btn btn-success p-r-l-8"><a href="{{route('detials-order',$order->id)}}" class="text-white f-z-10 ">معالجة الطلب </a></button>
            </td>
          </tr>
          @empty
            <tr>
              <th colspan='6'>لا يوجد بيانات في الجدول</th>
              </tr>
          @endforelse
        </tbody>
      </table>
      </div>
     
    </div>
  </div>
@endsection