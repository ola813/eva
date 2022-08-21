@extends('front.home.home')
@section('content')
@section('title',' طلبات فواتير الكهرباء')
<section class="bg0 p-t-120 p-b-40 dir" id="products">
<a href="{{route('vieworderfatora')}}" class="text-white btn btn-danger mobile-margin-responsive m-r-10">{{trans('order/order.Back')}}</a>

<h2 class="title-text m-b-20">{{trans('electronic/electronic.my order electronic')}}</h2>
    <div class="container">
      <div class="table-responsive">
        <table class="table table-bordered text-center dir" id="datatable2">
          <thead class="table-danger text-white f-s-9 text-center">
            <tr>
            <td>{{trans('electronic/electronic.counter_number')}}</td>
            <td>{{trans('electronic/electronic.recorde_register')}}</td>
            <td>{{trans('electronic/electronic.status')}}</td>
            <td>{{trans('electronic/electronic.date')}}</td>
            <td>{{trans('electronic/electronic.details')}}</td>
          </tr>
        </thead>
        <tbody class="f-s-9">
          @forelse($electronics as $electronic)
          <tr>
          
            <td>{{$electronic->counter_number}}</td>
            <td>{{$electronic->recorde_register}}</td>
            <td >
            @if ($electronic->status == '0')
             <span class="pending">{{trans('order/order.pending')}}</span>
            @elseif($electronic->status == '1')
              <span class="complete">{{trans('order/order.complete')}}</span>
            @elseif($electronic->status == '2')
             <span class="cancel">{{trans('order/order.Cancel')}}</span>
            @endif 
            </td>
            <td scope="row">{{date("F j, Y, g:i a" ,strtotime($electronic->created_at))}}</td>
            <td><a href="{{route('ShowElectronicdetails',$electronic->id)}}" class="text-danger"><i class="fa fa-eye"></i></a></td>
            </tr>
            @empty
            <tr>
              <th colspan='7' class="text-center">لا يوجد بيانات في الجدول</th>
            </tr>
            @endforelse
        </tbody>
      </table>
      </div>
    </div>
</section>
@endsection
