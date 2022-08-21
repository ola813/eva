@extends('admin.admin')
@section('content')
  <div class="row table-responsive">
      <div class="card-header">
      <h2 class="text-white m-t-10 m-b-20">{{trans('electronic/electronic.Cancel Order')}}</h2>
      </div>

      <table class="table" id="datatable1">
         <thead class="table-dark">
         <tr>
          <td>{{trans('electronic/electronic.name')}}</td>
            <td>{{trans('electronic/electronic.counter_number')}}</td>
            <td>{{trans('electronic/electronic.recorde_register')}}</td>
            <td>{{trans('electronic/electronic.price')}}</td>
            <td>{{trans('electronic/electronic.status')}}</td>
            <td>{{trans('electronic/electronic.date')}}</td>
            <td>{{trans('electronic/electronic.country')}}</td>
            <td>{{trans('electronic/electronic.name_admin')}}</td>
            <td>{{trans('order/order.details')}}</td>

          </tr>
          </thead>
        <tbody>
          @forelse($electronics as $electronic)
          <tr>
          <td>{{$electronic->user->fname}}</td>
            <td>{{$electronic->counter_number}}</td>
            <td>{{$electronic->recorde_register}}</td>
            <td>{{$electronic->price}}</td>
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
            <td>{{$electronic->name_admin}}</td>
            <td><a href="{{route('detials-Electronic',$electronic->id)}}"><i class="fa fa-eye"></i></a></td>

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