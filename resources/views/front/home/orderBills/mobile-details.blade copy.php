@extends('front.home.home')
@section('content')
@section('title','تفاصيل فاتورة الموبايل')
<section class="bg0 p-t-120 p-b-40 dir" id="products">
<h2 class=" m-b-22 p-r-6 txt-right font-charge style-charge title-320">{{trans('order/order.Details Order')}}</h2>
      <div class="table-responsive">
      
          <table class="table table-bordered table-re text-center dir">
            <thead class="table-danger text-white  text-center">
              <tr>
                <td scope="col">{{trans('electronic/electronic.name')}}</td>
                <td scope="col">{{trans('electronic/electronic.user_id')}}</td>
                <td scope="col">{{trans('mobile\mobile.company name')}}</td>
                <td scope="col">{{trans('mobile\mobile.mobile_number')}}</td>
                <td scope="col">{{trans('mobile\mobile.price')}}</td>
                <td scope="col">{{trans('mobile\mobile.status')}}</td>
                <td scope="col">{{trans('mobile\mobile.date')}}</td>
                <td scope="col">{{trans('mobile\mobile.notation')}}</td>
                <td scope="col">{{trans('mobile\mobile.details')}}</td>
              </tr>
            </thead>
            <tbody class="">
            @forelse($mobiles as $mobile)
              <tr >
                <td scope="row" data-label="{{trans('electronic/electronic.name')}}">{{$mobile->user->fname}}</td>
                <td scope="row" data-label="{{trans('electronic/electronic.user_id')}}">{{$mobile->user->user_id}}</td>
                <td scope="row" data-label="{{trans('mobile\mobile.company name')}}">{{$mobile->company->name}}</td>
                <td scope="row" data-label="{{trans('mobile\mobile.mobile_number')}}">{{$mobile->mobile_number}}</td>
                <td scope="row" data-label="{{trans('mobile/mobile.price')}}">{{$mobile->price}}</td>
                
                
                <td  scope="row" data-label="{{trans('mobile/mobile.status')}}">
                    @if ($mobile->status == '0')
                    <span class="pending">{{trans('order/order.pending')}}</span>
                    @elseif($mobile->status == '1')
                      <span class="complete">{{trans('order/order.Completed')}}</span>
                    @elseif($mobile->status == '2')
                    <span class="cancel">{{trans('order/order.Cancel')}}</span>
                    @endif 
                </td>
                <td scope="row" data-label="{{trans('mobile/mobile.date')}}">{{date("F j, Y, g:i a" ,strtotime($mobile->created_at))}}</td>
                @if($mobile->message==null)
                <td scope="row" data-label="{{trans('mobile/mobile.notation')}}">{{trans('order/order.message no')}}</td>
                @else
                <td scope="row" data-label="{{trans('mobile/mobile.notation')}}">{{$mobile->messages->message}}</td>
                @endif
                <td scope="row" data-label="{{trans('mobile/mobile.details')}}"><a href="{{route('order-Bill-Mobile')}}" class="text-white btn btn-danger">{{trans('order/order.Back')}}</a></td>
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
