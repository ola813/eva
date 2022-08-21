@extends('front.home.home')
@section('content')
@section('title',' طلبات فواتير الموبايل')
<section class="bg0 p-t-120 p-b-40 dir" id="products">
<a href="{{route('vieworderfatora')}}" class="text-white btn btn-danger m-b-30 m-t-30">{{trans('order/order.Back')}}</a>

    <h2 class="m-b-22 p-r-6 txt-right font-charge style-charge title-320">{{trans('mobile/mobile.mobile Order')}}</h2>
    <div class="container">
      <div class="table-responsive">
        <table class="table table-bordered txt-center" id="datatable2">
                          <thead class="table-danger text-white f-s-9 text-center">
                            <tr>
            
            
            <td>#</td>
            <td>{{trans('mobile\mobile.company')}}</td>
            <td>{{trans('mobile\mobile.mobile_number')}}</td>
            <td>{{trans('mobile\mobile.price')}}</td>
            <td>{{trans('mobile\mobile.status')}}</td>
            <td>{{trans('mobile\mobile.date')}}</td>
            <td>{{trans('mobile\mobile.details')}}</td>
          </tr>
        </thead>
        <tbody class="f-s-9">
          @forelse($mobiles as $mobile)
          <tr>
          
            <td>{{$mobile->id}}</td>
            <td>{{$mobile->company->name}}</td>
            <td>{{$mobile->mobile_number}}</td>
            <td>{{$mobile->price}}</td>
            <td >
            @if ($mobile->status == '0')
             <span class="pending">{{trans('order/order.pending')}}</span>
            @elseif($mobile->status == '1')
              <span class="complete">{{trans('order/order.complete')}}</span>
            @elseif($mobile->status == '2')
             <span class="cancel">{{trans('order/order.Cancel')}}</span>
            @endif 
            </td>
            <td scope="row">{{date("F j, Y, g:i a" ,strtotime($mobile->created_at))}}</td>
            <td><a href="{{route('Showmobiledetails',$mobile->id)}}" class="text-danger"><i class="fa fa-eye"></i></a></td>
            </tr>
            @empty
            <tr>
              <th colspan='7' class="text-center">لا يوجد بيانات في الجدول</th>
            </tr>
            @endforelse
        </tbody>
      </table>
      </div>
    </div>
</section>
@endsection
