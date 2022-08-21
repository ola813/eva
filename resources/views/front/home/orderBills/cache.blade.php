@extends('front.home.home')
@section('content')
@section('title',' طلبات فواتير الهاتف')
<section class="bg0 p-t-120 p-b-40 dir" id="products">
<a href="{{route('vieworderfatora')}}" class="text-white btn btn-danger m-b-30 m-t-30">{{trans('order/order.Back')}}</a>

<h2 class="m-b-22 p-r-6 txt-right font-charge style-charge title-320">{{trans('phone/phone.my order cache')}}</h2>
    <div class="container">

      <div class="table-responsive">
        <table class="table table-bordered text-center dir" id="datatable2">
                          <thead class="table-danger text-white f-s-9 text-center">
                            <tr>
                              <td>{{trans('phone/phone.account')}}</td>
                              <td>{{trans('phone/phone.meathod Payment')}}</td>
                              <td>{{trans('phone/phone.status')}}</td>
                              <td>{{trans('phone/phone.date')}}</td>
                              <td>{{trans('phone/phone.details')}}</td>
                        </tr>
                      </thead>
                      <tbody class="f-s-9">
                        @forelse($caches as $cache)
                        <tr>
                        
                          <td>{{$cache->account_number}}</td>
                          <td>
                            @if ($cache->method_payment == '0')
                            <span>{{trans('phone/phone.payment money')}}</span>
                            @elseif($cache->method_payment == '1')
                            <span>{{trans('phone/phone.pay tajer')}}</span>
                          @endif
                        </td>
                          <td>
                            @if ($cache->status == '0')
                            <span class="pending">{{trans('phone/phone.pending')}}</span>
                            @elseif($cache->status == '1')
                            <span class="completed">{{trans('phone/phone.Completed')}}</span>
                          @elseif($cache->status == '2')
                          <span class="cancel">{{trans('phone/phone.Cancel')}}</span>
                          @endif
                        </td>
                        <td scope="row">{{date("F j, Y, g:i a" ,strtotime($cache->created_at))}}</td>
                        <td><a href="{{route('ShowCacheorder',$cache->id)}}" class="text-danger"><i class="fa fa-eye"></i></a></td>
                      </tr>
                      @empty
                      <tr>
                        <th colspan='5' class="text-center">لا يوجد بيانات في الجدول</th>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
</section>
@endsection
