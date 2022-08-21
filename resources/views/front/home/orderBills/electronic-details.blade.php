@extends('front.home.home')
@section('content')
@section('title','تفاصيل فاتورة الكهرباء')
<section class="bg0 p-t-120 p-b-40 dir" id="products">
  <div class="container">

    <h2 class=" m-b-22 p-r-6 txt-right font-charge style-charge title-320">{{trans('order/order.Details Order')}}</h2>
    <div class="table-responsive">
      
      <table class="table table-bordered table-re text-center dir">
            <thead class="table-danger text-white  text-center">
              <tr>
                <td scope="col">{{trans('electronic/electronic.name')}}</td>
                <td scope="col">{{trans('electronic/electronic.user_id')}}</td>
                <td>{{trans('electronic/electronic.counter_number')}}</td>
                <td>{{trans('electronic/electronic.recorde_register')}}</td>
                <td>{{trans('electronic/electronic.mobile number')}}</td>
                <td>{{trans('electronic/electronic.country')}}</td>
                <td>{{trans('electronic/electronic.price')}}</td>
                <td>{{trans('electronic/electronic.status')}}</td>
                <td>{{trans('electronic/electronic.date')}}</td>
                <td>{{trans('electronic/electronic.notation')}}</td>
                <td>{{trans('electronic/electronic.details')}}</td>
              </tr>
            </thead>
            <tbody class="">
            @forelse($electronics as $electronic)
              <tr >
                <td scope="row" data-label="{{trans('electronic/electronic.name')}}">{{$electronic->user->fname}}</td>
                <td scope="row" data-label="{{trans('electronic/electronic.user_id')}}">{{$electronic->user->user_id}}</td>
                <td scope="row" data-label="{{trans('electronic/electronic.counter_number')}}">{{$electronic->counter_number}}</td>
                <td scope="row" data-label="{{trans('electronic/electronic.recorde_register')}}">{{$electronic->recorde_register}}</td>
                <td scope="row" data-label="{{trans('electronic/electronic.mobile number')}}">{{$electronic->mobile_number}}</td>
                <td scope="row" data-label="{{trans('electronic/electronic.country')}}">{{$electronic->country}}</td>
                @if($electronic->price==null)
                <td scope="row" data-label="{{trans('electronic/electronic.price')}}">{{trans('electronic/electronic.price no')}}</td>
                @else
                <td scope="row" data-label="{{trans('electronic/electronic.price')}}">{{$electronic->price}}</td>
                @endif
                
                <td  scope="row" data-label="{{trans('electronic/electronic.status')}}">
                  @if ($electronic->status == '0')
                    <span class="pending text-center">{{trans('order/order.pending')}}</span>
                    @elseif($electronic->status == '1')
                      <span class="complete text-center">{{trans('order/order.Completed')}}</span>
                    @elseif($electronic->status == '2')
                    <span class="cancel text-center">{{trans('order/order.Cancel')}}</span>
                    @endif 
                </td>
                <td scope="row" data-label="{{trans('order/order.date')}}">{{date("F j, Y, g:i a" ,strtotime($electronic->created_at))}}</td>
                @if($electronic->message==null)
                <td scope="row" data-label="{{trans('order/order.message')}}">{{trans('order/order.message no')}}</td>
                @else
                <td scope="row" data-label="{{trans('order/order.message')}}">{{$electronic->messages->message}}</td>
                @endif
                <td scope="row" data-label="{{trans('order/order.details')}}"><a href="{{route('orderElectronic')}}" class="text-white btn btn-danger">{{trans('order/order.Back')}}</a></td>
              </tr>
              @empty
              <tr>
                <th colspan='11' class="text-center">لا يوجد بيانات في الجدول</th>
              </tr>
              @endforelse
            </tbody>
          </table>
      </div>
    </div>
</section>   

@endsection
