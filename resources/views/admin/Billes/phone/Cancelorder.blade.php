@extends('admin.admin')
@section('content')
  <div class=" table-responsive">
    <div class="card-header">
      <h2 class="text-white m-t-10 m-b-20">{{trans('phone/phone.Cancel Order')}}</h2>
      </div>

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
          @forelse($phones as $phone)
          <tr>
              <td>{{$phone->user->fname}}</td>
            <td>{{$phone->type}}</td>
            <td>{{$phone->price}}</td>
            <td>
            @if ($phone->status == '0')
             <span class="pending">{{trans('order/order.pending')}}</span>
            @elseif($phone->status == '1')
              <span class="complete">{{trans('order/order.Completed')}}</span>
            @elseif($phone->status == '2')
             <span class="cancel">{{trans('order/order.Cancel')}}</span>
            @endif
            </td>
            <td>{{date("F j, Y, g:i a" ,strtotime($phone->created_at))}}</td>
            <td>{{$phone->name_admin}}</td>
            <td><a href="{{route('DetailsAllPhoorder',$phone->id)}}"><i class="fa fa-eye"></i></a></td>
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