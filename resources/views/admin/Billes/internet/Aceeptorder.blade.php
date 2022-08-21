@extends('admin.admin')
@section('content')
<div class="table-responsive" >
  <h2 class="text-white m-t-10 m-b-20">{{trans('phone/phone.internet Aceept Order')}}</h2>
  
  <table class="table table-bordered" id="datatable1">
        <thead class="table-dark">
        <tr>
            <td>{{trans('phone/phone.full name')}}</td>
            <td>{{trans('phone/phone.company')}}</td>
            <td>{{trans('phone/phone.number')}}</td>
            <td>{{trans('phone/phone.price')}}</td>
            <td>{{trans('phone/phone.status')}}</td>
            <td>{{trans('phone/phone.date')}}</td>
            <td>{{trans('phone/phone.name_admin')}}</td>
            <td>{{trans('mobile/mobile.details')}}</td>  
        </tr>
        </thead>
        <tbody>
          @forelse($phones as $phone)
          <tr>
          <td>{{$phone->full_name}}</td>
            <td>{{$phone->company->name}}</td>
            <td>{{$phone->number}}</td>
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
            <td>{{date('d-m-Y' ,strtotime($phone->created_at))}}</td>
            <td>{{$phone->name_admin}}</td>
            <td><a href="{{route('DetailsAllInterorder',$phone->id)}}"><i class="fa fa-eye"></i></a></td>
          </tr>
          @empty
     <tr>
      <th colspan='9'>لا يوجد بيانات في الجدول</th>
      </tr>
    @endforelse
  </tbody>
</table>

@endsection

