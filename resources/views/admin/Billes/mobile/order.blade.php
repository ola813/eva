@extends('admin.admin')
@section('content')
<div class="table-responsive">
<h2 class="text-white p-t-10 m-b-20">{{trans('mobile/mobile.mobile new Order')}}</h2>
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
              <span>pending</span>
            @elseif($mobile->status == '1')
            <span>complete</span>
            @elseif($mobile->status == '2')
             <span>Cancel</span>
             @endif
            </td>
            <td>{{date('d-m-Y' ,strtotime($mobile->created_at))}}</td>
            <td>
              <button type="button" class="btn btn-success text-white"><a href="{{route('ViewOrderMobile',$mobile->id)}}" class="text-white">معالجة الطلب </a></button>
            </td>
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

