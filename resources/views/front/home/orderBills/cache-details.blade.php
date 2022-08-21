@extends('front.home.home')
@section('content')
@section('title','تفاصيل فاتورة الهاتف')
<section class="bg0 p-t-120 p-b-40 dir" id="products">
<h2 class=" m-b-22 p-r-6 txt-right font-charge style-charge title-320">{{trans('order/order.Details Order')}}</h2>
      <div class="table-responsive">
      
          <table class="table table-bordered table-re text-center dir">
            <thead class="table-danger text-white  text-center">
              <tr>
                <td scope="col">{{trans('electronic/electronic.name')}}</td>
                <td scope="col">{{trans('electronic/electronic.user_id')}}</td>
                <td scope="col">{{trans('phone\phone.account number')}}</td>
                <td scope="col">{{trans('phone\phone.meathod Payment')}}</td>
                <td scope="col">{{trans('phone\phone.Bill-price')}}</td>
                <td scope="col">{{trans('mobile\mobile.mobile_number')}}</td>
                <td scope="col">{{trans('mobile\mobile.status')}}</td>
                <td scope="col">{{trans('mobile\mobile.date')}}</td>
                <td scope="col">{{trans('mobile\mobile.notation')}}</td>
                <td scope="col">{{trans('mobile\mobile.details')}}</td>
              </tr>
            </thead>
            <tbody class="">
            @forelse($caches as $cache)
              <tr >
                <td scope="row" data-label="{{trans('electronic/electronic.name')}}">{{$cache->User->fname}}</td>
                <td scope="row" data-label="{{trans('electronic/electronic.user_id')}}">{{$cache->User->user_id}}</td>
                <td scope="row" data-label="{{trans('phone/phone.account number')}}">{{$cache->account_number}}</td>
                <td scope="row" data-label="{{trans('phone\phone.meathod Payment')}}">{{$cache->method_payment}}</td>
                @if($cache->Bill_price==null)
                <td scope="row" data-label="{{trans('phone\phone.Bill-price')}}">{{trans('electronic/electronic.price no')}}</td>
                @else
                <td scope="row" data-label="{{trans('phone\phone.Bill-price')}}">{{$cache->Bill_price}}</td>
                @endif
                
                <td  scope="row" data-label="{{trans('mobile/mobile.status')}}">
                    @if ($cache->status == '0')
                    <span class="pending">{{trans('order/order.pending')}}</span>
                    @elseif($cache->status == '1')
                      <span class="complete">{{trans('order/order.Completed')}}</span>
                    @elseif($cache->status == '2')
                    <span class="cancel">{{trans('order/order.Cancel')}}</span>
                    @endif 
                </td>
                <td scope="row" data-label="{{trans('mobile/mobile.date')}}">{{date("F j, Y, g:i a" ,strtotime($phone->created_at))}}</td>
                @if($cache->messages==null)
                <td scope="row" data-label="{{trans('mobile/mobile.notation')}}">{{trans('order/order.message no')}}</td>
                @else
                <td scope="row" data-label="{{trans('mobile/mobile.notation')}}">{{$cache->messagesinfo->message}}</td>
                @endif
                <td scope="row" data-label="{{trans('mobile/mobile.details')}}"><a href="{{route('orderCache')}}" class="text-white btn btn-danger">{{trans('order/order.Back')}}</a></td>
              </tr>
              @empty
              <tr>
                <th colspan='10' class="text-center">لا يوجد بيانات في الجدول</th>
              </tr>
              @endforelse
            </tbody>
          </table>
      </div>
</section>   

@endsection
