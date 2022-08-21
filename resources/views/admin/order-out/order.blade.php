@extends('admin.admin')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card-header">
        <h2>New Order</h2>
      </div>
      <div class="card-body">
      <table class="table ">
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
          @forelse($orderouts as $orderout)
          <tr>
            <td >{{$orderout->Userinfo->fname}}</td>
            <td >{{$orderout->message}}</td>
            <td >{{$orderout->price}}</td>
            <td >
            @if ($orderout->status == '0')
             <span class="pending">{{trans('order/order.pending')}}</span>
            @elseif($orderout->status == '1')
              <span class="complete">{{trans('order/order.complete')}}</span>
            @elseif($orderout->status == '2')
             <span class="cancel">{{trans('order/order.Cancel')}}</span>
            @endif 
            </td>
            <td scope="row">{{date('d-m-Y' ,strtotime($orderout->created_at))}}</td>
            <td scope="row">
                <button type="button" class="btn btn-success p-r-l-8"><a href="{{route('detials-order-out',$orderout->id)}}" class="text-white f-z-10 ">معالجة الطلب </a></button>
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