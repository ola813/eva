@extends('admin.admin')
@section('title','الطلبات المرفوضة')
@section('content')
  <div class="row table-responsive">
    <div class="col-md-12">
      <div class="card-header">
      <h2 class="text-white m-t-10 m-b-20">{{trans('order/order.Cancel Order')}}</h2>
      </div>
      <div class="card-body">
      <table class="table" id="datatable1">
         <thead class="table-dark">
          <tr>
          <td>{{trans('order/order.user name order')}}</td>
            <td>{{trans('order/order.product name')}}</td>
            <td>{{trans('order/order.product price')}}</td>
            <td>{{trans('order/order.status')}}</td>
            <td>{{trans('order/order.date')}}</td>
            <td>{{trans('order/order.name_admin')}}</td>
            <td>{{trans('order/order.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($orders as $order)
          <tr>
              <td>{{$order->userorder->fname}}</td>
            <td>{{$order->product->title}}</td>
            <td>{{$order->price}}</td>
            <td>
            @if ($order->status == '0')
             <span class="pending">{{trans('order/order.pending')}}</span>
            @elseif($order->status == '1')
              <span class="complete">{{trans('order/order.Completed')}}</span>
            @elseif($order->status == '2')
             <span class="cancel">{{trans('order/order.Cancel')}}</span>
            @endif
            </td>
            <td>{{date("F j, Y, g:i a" ,strtotime($order->created_at))}}</td>
            <td>{{$order->name_admin}}</td>
            <td><a href="{{route('detials-All-order',$order->id)}}"><i class="fa fa-eye"></i></a></td>
          </tr>
          @empty
            <tr>
              <th colspan='8'>لا يوجد بيانات في الجدول</th>
              </tr>
          @endforelse
        </tbody>
      </table>
      </div>
     
    </div>
  </div>
@endsection