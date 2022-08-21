@extends('admin.admin')
@section('content')
  <div class="row table-responsive">
    <div class="col-md-12">
      <div class="card-header">
        <h2>New order</h2>
      </div>
      <div class="card-body">
      <table class="table">
         <thead class="table-dark ">
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
          @forelse($OrderOuts as $OrderOut)
          <tr>
            <td>{{$OrderOut->Userinfo->fname}}</td>
            <td>{{$OrderOut->message}}</td>
            <td>{{$OrderOut->price}}</td>
            <td>
            @if ($OrderOut->status == '0')
             <span class="pending">{{trans('order/order.pending')}}</span>
            @elseif($OrderOut->status == '1')
              <span class="complete">{{trans('order/order.Completed')}}</span>
            @elseif($OrderOut->status == '2')
             <span class="cancel">{{trans('order/order.Cancel')}}</span>
            @endif
            </td>
            <td>{{date('d-m-Y' ,strtotime($OrderOut->created_at))}}</td>
            <td>{{$OrderOut->name_admin}}</td>
            <td><a href="{{route('detials-All-order-out',$OrderOut->id)}}"><i class="fa fa-eye"></i></a></td>
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