@extends('front.home.home')
@section('content')
@section('title','طلبات فواتير الانترنت')
<section class="bg0 p-t-120 p-b-40 dir" id="products">
<a href="{{route('vieworderfatora')}}" class="text-white btn btn-danger m-b-30 m-t-30">{{trans('order/order.Back')}}</a>
<h2 class="m-b-22 p-r-6 txt-right font-charge style-charge title-320">{{trans('phone/phone.my order internet')}}</h2>
    <div class="container">
      <div class="table-responsive">
        <table class="table table-bordered text-center dir" id="datatable2">
          <thead class="table-danger text-white f-s-9 text-center">
            <tr>
            <td>{{trans('phone/phone.number')}}</td>
            <td>{{trans('Bills/Bills.mobile number')}}</td>
            <td>{{trans('phone/phone.company_internet')}}</td>
            <td>{{trans('phone/phone.date')}}</td>
            <td>{{trans('phone/phone.status')}}</td>
            <td>{{trans('phone/phone.details')}}</td>
          </tr>
        </thead>
        <tbody class="f-s-9">
          @forelse($internets as $internet)
          <tr>
          
            <td>{{$internet->number}}</td>
            <td>{{$internet->mobile_number}}</td>
            <td>{{$internet->companyinter->name}}</td>
            <td>{{date("F j, Y, g:i a" ,strtotime($internet->created_at))}}</td>

            <td>
            @if ($internet->status == '0')
             <span class="pending">{{trans('phone/phone.pending')}}</span>
            @elseif($internet->status == '1')
              <span class="completed">{{trans('phone/phone.Completed')}}</span>
            @elseif($internet->status == '2')
             <span class="cancel">{{trans('phone/phone.Cancel')}}</span>
            @endif
            </td>
            <td><a href="{{route('Showinternetdetails',$internet->id)}}" class="text-danger"><i class="fa fa-eye"></i></a></td>
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
