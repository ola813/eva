@extends('admin.admin')
@section('title','طلبات كاش المعلقة')
@section('content')
<div class="table-responsive" >
<div class="card-header">
           <h2 class="text-white m-t-10 m-b-20">{{trans('phone/phone.Order cache pending')}}</h2>
      </div>
  <table class="table table-bordered" id="datatable1">
        <thead class="table-dark">
          <tr>
            <td>#</td>
            <td scope="col">{{trans('phone/phone.order name')}}</td>
            <td>{{trans('phone/phone.account')}}</td>
            <td>{{trans('phone/phone.meathod Payment')}}</td>
            <td>{{trans('phone/phone.status')}}</td>
            <td>{{trans('phone/phone.date')}}</td>
            <td>{{trans('phone/phone.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($caches as $cache)
          <tr>
            <td>{{$cache->id}}</td>
          <td>{{$cache->User->fname}}</td>
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
                <span class="pending">{{trans('electronic/electronic.pending')}}</span>
                @elseif($cache->status == '1')
                  <span class="complete">{{trans('electronic/electronic.Completed')}}</span>
                @elseif($cache->status == '2')
                <span class="cancel">{{trans('electronic/electronic.Cancel')}}</span>
                @endif
            </td>
          <td>{{date("F j, Y, g:i a" ,strtotime($cache->created_at))}}</td>
          <td>
            <button type="button" class="btn btn-success text-white f-z-15"><a href="{{route('ViewOrdercache',$cache->id)}}" class="text-white">معالجة الطلب </a></button>
          </td>
        </tr>
        @empty
        <tr>
          <th colspan='11'>لا يوجد بيانات في الجدول</th>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
    
          
            


