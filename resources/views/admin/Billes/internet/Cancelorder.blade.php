@extends('admin.admin')
@section('content')
<div class="table-responsive" >
  <h2 class="text-white m-t-10 m-b-20">{{trans('phone/phone.internet cancel Order')}}</h2>
  
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
          @forelse($internets as $internet)
          <tr>
          <td>{{$internet->full_name}}</td>
            <td>{{$internet->company->name}}</td>
            <td>{{$internet->number}}</td>
            <td>{{$internet->price}}</td>
            <td>
            @if ($internet->status == '0')
             <span class="pending">{{trans('order/order.pending')}}</span>
            @elseif($internet->status == '1')
              <span class="complete">{{trans('order/order.Completed')}}</span>
            @elseif($internet->status == '2')
             <span class="cancel">{{trans('order/order.Cancel')}}</span>
            @endif
            </td>
            <td>{{date('d-m-Y' ,strtotime($internet->created_at))}}</td>
            <td>{{$internet->name_admin}}</td>
            <td><a href="{{route('DetailsAllInterorder',$internet->id)}}"><i class="fa fa-eye"></i></a></td>
          </tr>
          @empty
     <tr>
      <th colspan='9'>لا يوجد بيانات في الجدول</th>
      </tr>
    @endforelse
  </tbody>
      </table>
      </div>
     
    </div>
  </div>
@endsection