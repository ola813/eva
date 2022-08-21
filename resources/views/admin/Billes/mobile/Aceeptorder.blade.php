@extends('admin.admin')
@section('content')
<div class="table-responsive">
<h2 class="text-white p-t-10 m-b-20">{{trans('mobile/mobile.mobile Accept Order')}}</h2>
        <table class="table table-bordered" id="datatable1">
              <thead class="table-dark">
          <tr>
            <td>{{trans('mobile/mobile.name')}}</td>
            <td>{{trans('mobile/mobile.company')}}</td>
            <td>{{trans('mobile/mobile.mobile_number')}}</td>
            <td>{{trans('mobile/mobile.price')}}</td>
            <td>{{trans('mobile/mobile.status')}}</td>
            <td>{{trans('mobile/mobile.date')}}</td>
            <td>{{trans('mobile/mobile.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($mobiles as $mobile)
          <tr>
          <td>{{$mobile->user->fname}}</td>
            <td>{{$mobile->Company}}</td>
            <td>{{$mobile->mobile_number}}</td>
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
            <td><a href="{{route('DetailsAllMoborder',$mobile->id)}}"><i class="fa fa-eye"></i></a></td>
          </tr>
          @empty
     <tr>
      <th colspan='9'>لا يوجد بيانات في الجدول</th>
      </tr>
    @endforelse
  </tbody>
</table>
</div>
@endsection

