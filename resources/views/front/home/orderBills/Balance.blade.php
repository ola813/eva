@extends('front.home.home')
@section('content')
<section class="bg0 p-t-120 p-b-40 dir" id="products">
<a href="{{route('vieworderfatora')}}" class="text-white btn btn-danger m-b-30 m-t-30">{{trans('order/order.Back')}}</a>

<h2 class="m-b-22 p-r-6 txt-right font-charge style-charge title-320">{{trans('Blance/Blance.my order Balance')}}</h2>
    <div class="container">
      <div class="table-responsive">
        <table class="table table-bordered text-center dir" id="datatable2">
          <thead class="table-danger text-white f-s-9 text-center">
            <tr>
              <td>#</td>
              <td>{{trans('Blance\Blance.number')}}</td>
              <td>{{trans('Blance\Blance.price')}}</td>
              <td>{{trans('Blance\Blance.status')}}</td>
              <td>{{trans('Blance\Blance.date')}}</td>
              <td>{{trans('Blance\Blance.notation')}}</td>
          </tr>
        </thead>
        <tbody class="f-s-9">
          @forelse($balances as $balance)
          <tr>
          
            <td>{{$balance->id}}</td>
            <td>{{$balance->mobile_number}}</td>
            <td>{{$balance->price}}</td>
            <td>
              @if ($balance->status == '0')
              <span class="pending">{{trans('Blance\Blance.pending')}}</span>
              @elseif($balance->status == '1')
              <span class="completed">{{trans('Blance\Blance.Completed')}}</span>
              @elseif($balance->status == '2')
              <span class="cancel">{{trans('Blance\Blance.Cancel')}}</span>
              @endif
              <td>{{date("F j, Y, g:i a" ,strtotime($balance->created_at))}}</td>
              @if($balance->messages==null)
                <td >{{trans('order/order.message no')}}</td>
                @else
                <td >{{$balance->messages->message}}</td>
                @endif
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
  </div>
</div>
@endsection
