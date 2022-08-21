@extends('admin.admin')
@section('content')
<div class="table-responsive">

  <h2 class="text-white m-t-30 m-b-20">{{trans('Blance/Blance.New Oreder Blalance')}}</h2>
  <table class="table table-bordered" id="datatable1">
    <thead class="table-dark">
      <tr>
            <td>{{trans('electronic/electronic.name')}}</td>
            <td>{{trans('electronic/electronic.company')}}</td>
            <td>{{trans('electronic/electronic.mobile number')}}</td>
            <td>{{trans('electronic/electronic.value')}}</td>
            <td>{{trans('electronic/electronic.price_act')}}</td>
            <td>{{trans('electronic/electronic.status')}}</td>
            <td>{{trans('electronic/electronic.date')}}</td>
            <td>{{trans('electronic/electronic.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($balances as $balance)
          <tr>
            <td>{{$balance->user->fname}}</td>
            <td>{{$balance->company->name}}</td>
            <td>{{$balance->mobile_number}}</td>
            <td>{{$balance->valueaccount->value}}</td>
            <td>{{$balance->price}}</td>
            <td>
              @if ($balance->status == '0')
             <span class="pending">{{trans('electronic/electronic.pending')}}</span>
             @elseif($balance->status == '1')
             <span class="complete">{{trans('electronic/electronic.Completed')}}</span>
             @elseif($balance->status == '2')
             <span class="cancel">{{trans('electronic/electronic.Cancel')}}</span>
             @endif
            </td>
            <td>{{date("F j, Y, g:i a" ,strtotime($balance->created_at))}}</td>
            <td>
                <button type="button" class="btn btn-success text-white"><a href="{{route('ViewOrderBalance',$balance->id)}}" class="text-white">معالجة الطلب </a></button>
            </td>
          </tr>
          @empty
     <tr>
      <th colspan='7'>لا يوجد بيانات في الجدول</th>
    </tr>
    @endforelse
  </tbody>
</table>
</div>

@endsection

