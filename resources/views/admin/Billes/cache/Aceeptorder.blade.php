@extends('admin.admin')
@section('title','طلبات كاش المقبولة')
@section('content')
<div class="table-responsive">
  <div>
    <h2 class="text-white">{{trans('phone/phone.Accept order cache')}}</h2>
  </div>

      <table class="table table-bordered" id="datatable1">
        <thead class="table-dark">
        <tr>
          <td>{{trans('phone/phone.order name')}}</td>
          <td>{{trans('phone/phone.account')}}</td>
            <td>{{trans('phone/phone.meathod Payment')}}</td>
            <td>{{trans('Bills\Bills.price pay')}}</td>
            <td>{{trans('phone/phone.status')}}</td>
            <td>{{trans('phone/phone.date')}}</td>
            <td>{{trans('phone/phone.name_admin')}}</td>
            <td>{{trans('phone/phone.details')}}</td>

          </tr>
        </thead>
        <tbody>
        @forelse($caches as $cache)
          <tr>
            
          <td>{{$cache->User->fname}}</td>
            <td>{{$cache->account_number}}</td>
            <td>
              @if ($cache->method_payment == 0)
              <span>{{trans('phone/phone.payment money')}}</span>
              @elseif($cache->method_payment == 1)
              <span>{{trans('phone/phone.pay tajer')}}</span>
            @endif
          </td>
            <td>{{$cache->Bill_price}}</td>
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
            <td>{{$cache->name_admin}}</td>
            <td><a href="{{route('DetailsAllcacheorder',$cache->id)}}"><i class="fa fa-eye"></i></a></td>

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

