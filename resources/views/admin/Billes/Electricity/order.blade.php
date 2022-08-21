@extends('admin.admin')
@section('content')
<div class="table-responsive">

<h2 class="text-white m-t-10 m-b-20">{{trans('electronic/electronic.New Order')}}</h2>
  <table class="table table-bordered" id="datatable1">
    <thead class="table-dark">
      <tr>
            <td>{{trans('electronic/electronic.name')}}</td>
            <td>{{trans('electronic/electronic.counter_number')}}</td>
            <td>{{trans('electronic/electronic.recorde_register')}}</td>
            <td>{{trans('electronic/electronic.status')}}</td>
            <td>{{trans('electronic/electronic.date')}}</td>
            <td>{{trans('electronic/electronic.country')}}</td>
            <td>{{trans('electronic/electronic.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($electronics as $electronic)
          <tr>
          <td>{{$electronic->user->fname}}</td>
            <td>{{$electronic->counter_number}}</td>
            <td>{{$electronic->recorde_register}}</td>
            <td>
              @if ($electronic->status == '0')
             <span class="pending">{{trans('electronic/electronic.pending')}}</span>
             @elseif($electronic->status == '1')
             <span class="complete">{{trans('electronic/electronic.Completed')}}</span>
             @elseif($electronic->status == '2')
             <span class="cancel">{{trans('electronic/electronic.Cancel')}}</span>
             @endif
            </td>
            <td>{{date("F j, Y, g:i a" ,strtotime($electronic->created_at))}}</td>
            <td>{{$electronic->country}}</td>
            <td>
                <button type="button" class="btn btn-success text-white f-z-15"><a href="{{route('order-Electornic',$electronic->id)}}" class="text-white">معالجة الطلب </a></button>
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

