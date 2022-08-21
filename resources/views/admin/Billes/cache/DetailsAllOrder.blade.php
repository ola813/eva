@extends('admin.admin')
@section('content')
<div class="table-responsive">
     <div class="card-header">
         <h2 class="text-white m-t-10 m-b-20">{{trans('phone/phone.Details Order chache')}}</h2>
      </div>
      <table class="table table-re" >
         <thead class="table-dark">
          <tr>
            <td scope="col">{{trans('order/order.fname')}}</td>
            <td scope="col">{{trans('order/order.lname')}}</td>
            <td scope="col">{{trans('order/order.email')}}</td>
            <td scope="col">{{trans('order/order.User_id')}}</td>
            <td scope="col">{{trans('order/order.phone')}}</td>
            <td scope="col">{{trans('phone/phone.type')}}</td>
            <td>{{trans('phone/phone.account')}}</td>
            <td>{{trans('phone/phone.meathod Payment')}}</td>
            <td scope="col">{{trans('Bills/Bills.price pay')}}</td>
            <td scope="col">{{trans('phone/phone.commission')}}</td>
            <td scope="col">{{trans('order/order.status')}}</td>
            <td scope="col">{{trans('order/order.date')}}</td>
            <td scope="col">{{trans('order/order.message')}}</td>
            <td scope="col">{{trans('order/order.name_admin')}}</td>
            <td scope="col">{{trans('order/order.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($caches as $cache)
          <tr>
            <td scope="row" data-label="{{trans('order/order.fname')}}">{{$cache->User->fname}}</td>
            <td scope="row" data-label="{{trans('order/order.lname')}}">{{$cache->User->lname}}</td>
            <td scope="row" data-label="{{trans('order/order.email')}}">{{$cache->User->email}}</td>
            <td scope="row" data-label="{{trans('order/order.User_id')}}">{{$cache->User->user_id}}</td>
            <td scope="row" data-label="{{trans('order/order.phone')}}">{{$cache->User->phone}}</td>
            <td scope="row" data-label="{{trans('phone/phone.type')}}">{{$cache->type}}</td>
            <td scope="row" data-label="{{trans('phone/phone.account')}}">{{$cache->account_number}}</td>
            <td scope="row" data-label="{{trans('phone/phone.meathod Payment')}}">
              @if ($cache->method_payment == '0')
              <span>{{trans('phone/phone.payment money')}}</span>
              @elseif($cache->method_payment == '1')
              <span>{{trans('phone/phone.pay tajer')}}</span>
            @endif
          </td>
            <td scope="row" data-label="{{trans('Bills/Bills.price pay')}}">{{$cache->Bill_price}}</td>
            <td scope="row" data-label="{{trans('phone/phone.commission')}}">{{$cache->commission}}</td>
              <td scope="row" data-label="{{trans('order/order.status')}}">
                  @if ($cache->status == '0')
                  <span class="pending">{{trans('order/order.pending')}}</span>
                  @elseif($cache->status == '1')
                    <span class="complete">{{trans('order/order.Completed')}}</span>
                  @elseif($cache->status == '2')
                  <span class="cancel">{{trans('order/order.Cancel')}}</span>
                  @endif
            </td>
              <td scope="row" data-label="{{trans('order/order.date')}}">{{date('F j, Y, g:i a',strtotime($cache->created_at))}}</td>
              <td scope="row" data-label="{{trans('order/order.message')}}">{{$cache->messagesinfo->message}}</td>
              <td scope="row" data-label="{{trans('order/order.name_admin')}}">{{$cache->name_admin}}</td>
              
            <td scope="row">
                <button type="submit" class="btn btn-danger"><a href="{{route('CacheNewOrder')}}" class="text-white"> رجوع </a></button>
            </td>
          </form>
          </tr>
           @empty
            <tr>
              <th colspan='4'>لا يوجد بيانات في الجدول</th>
              </tr>
          @endforelse
        </tbody>
      </table>
      </div>
   

@endsection