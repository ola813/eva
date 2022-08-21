@extends('admin.admin')
@section('content')
<div class="table-responsive">
<h2 class="text-white p-t-10 m-b-20">{{trans('mobile/mobile.mobile cancel Order')}}</h2>
        <table class="table table-bordered" id="datatable1">
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
          @forelse($mobiles as $mobile)
          <tr>
              <td>{{$mobile->user->fname}}</td>
            <td>{{$mobile->type}}</td>
            <td>{{$mobile->price}}</td>
            <td>
            @if ($mobile->status == '0')
             <span class="pending">{{trans('order/order.pending')}}</span>
            @elseif($mobile->status == '1')
              <span class="complete">{{trans('order/order.Completed')}}</span>
            @elseif($mobile->status == '2')
             <span class="cancel">{{trans('order/order.Cancel')}}</span>
            @endif
            </td>
            <td>{{date('d-m-Y' ,strtotime($mobile->created_at))}}</td>
            <td>{{$mobile->name_admin}}</td>
            <td><a href="{{route('DetailsAllMoborder',$mobile->id)}}"><i class="fa fa-eye"></i></a></td>
          </tr>
          @empty
            <tr>
              <th colspan='8'>لا يوجد بيانات في الجدول</th>
              </tr>
          @endforelse
        </tbody>
      </table>
      </div>
     

@endsection