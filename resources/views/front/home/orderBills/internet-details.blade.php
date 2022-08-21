@extends('front.home.home')
@section('content')
@section('title','تفاصيل فاتورة الموبايل')
<section class="bg0 p-t-120 p-b-40 dir" id="products">
<h2 class=" m-b-22 p-r-6 txt-right font-charge style-charge title-320">{{trans('phone/phone.Details Order internet')}}</h2>
      <div class="table-responsive">
      
          <table class="table table-bordered table-re text-center dir">
            <thead class="table-danger text-white  text-center">
              <tr>
                <td scope="col">{{trans('electronic/electronic.name')}}</td>
                <td scope="col">{{trans('electronic/electronic.user_id')}}</td>
                <td scope="col">{{trans('phone\phone.company_internet')}}</td>
                <td scope="col">{{trans('phone\phone.full name')}}</td>
                <td scope="col">{{trans('phone\phone.number')}}</td>
                <td scope="col">{{trans('Bills/Bills.mobile number')}}</td>
                <td scope="col">{{trans('mobile\mobile.price')}}</td>
                <td scope="col">{{trans('mobile\mobile.status')}}</td>
                <td scope="col">{{trans('mobile\mobile.date')}}</td>
                <td scope="col">{{trans('mobile\mobile.notation')}}</td>
                <td scope="col">{{trans('mobile\mobile.details')}}</td>
              </tr>
            </thead>
            <tbody class="">
            @forelse($internets as $internet)
              <tr >
                <td scope="row" data-label="{{trans('electronic/electronic.name')}}">{{$internet->user->fname}}</td>
                <td scope="row" data-label="{{trans('electronic/electronic.user_id')}}">{{$internet->user->user_id}}</td>
                <td scope="row" data-label="{{trans('phone\phone.company_internet')}}">{{$internet->companyinter->name}}</td>
                <td scope="row" data-label="{{trans('phone\phone.full name')}}">{{$internet->full_name}}</td>
                <td scope="row" data-label="{{trans('phone\phone.number')}}">{{$internet->number}}</td>
                <td scope="row" data-label="{{trans('Bills/Bills.mobile number')}}">{{$internet->mobile_number}}}</td>
                <td scope="row" data-label="{{trans('mobile/mobile.price')}}">{{$internet->price}}</td>
                
                
                <td  scope="row" data-label="{{trans('mobile/mobile.status')}}">
                    @if ($internet->status == '0')
                    <span class="pending text-center">{{trans('order/order.pending')}}</span>
                    @elseif($internet->status == '1')
                      <span class="complete text-center">{{trans('order/order.Completed')}}</span>
                    @elseif($internet->status == '2')
                    <span class="cancel text-center">{{trans('order/order.Cancel')}}</span>
                    @endif 
                </td>
                <td scope="row" data-label="{{trans('mobile/mobile.date')}}">{{date("F j, Y, g:i a" ,strtotime($internet->created_at))}}</td>
                @if($internet->message==null)
                <td scope="row" data-label="{{trans('mobile/mobile.notation')}}">{{trans('order/order.message no')}}</td>
                @else
                <td scope="row" data-label="{{trans('mobile/mobile.notation')}}">{{$internet->messages->message}}</td>
                @endif
                <td scope="row" data-label="{{trans('mobile/mobile.details')}}"><a href="{{route('orderinternet')}}" class="text-white btn btn-danger">{{trans('order/order.Back')}}</a></td>
              </tr>
              @empty
              <tr>
                <th colspan='11' class="text-center">لا يوجد بيانات في الجدول</th>
              </tr>
              @endforelse
            </tbody>
          </table>
      </div>
</section>   

@endsection
