
@extends('front.home.home')
@section('title','سلة المشتريات')
@section('content')
<body class="animsition">
  <div class="table-responsive">

    <table class="table">
      <thead class="table-dark">
        <tr>
          
      <th scope="col">{{trans('users/users.title')}}</th>
      <th scope="col">{{trans('users/users.price')}}</th>
      <th scope="col">{{trans('users/users.quantity')}}</th>
      <th scope="col">{{trans('users/users.pricetotal')}}</th>
      <th scope="col">{{trans('users/users.operation')}}</th>

    </tr>
  </thead>
  <tbody>
    @forelse($order as $item)
    <tr>
      <th scope="row">{{$item->title}}</th>
      <td>
        {{\Cart::session(auth()->id())->get($item->id)->getPriceSum()}}
      </td>
      <td>{{$item->quantity}}</td>
      <td>
        Total Price:{{Cart::session(auth()->id())->getTotal()}}
      </td>
    </tr>
    @empty
     <tr>
      <th colspan='4'>لا يوجد طلبات</th>
      </tr>
    @endforelse
  </tbody>
</table>
</div>
@endSection


    
   


