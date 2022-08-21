@extends('admin.admin')
@section('title','تفاصيل الطلب')
@section('content')
<div class=" rtl">
        <h2 class="text-white p-t-20 p-b-20">{{trans('order/order.Details Order')}}</h2>
      </div>
      <a href="{{route('view-new-order')}}" type="submit" class="btn btn-danger m-t-30">{{trans('category/category.Back')}}</a>
<div class="table-responsive ">    
      
      <table class="table table-re m-t-20" >
         <thead class="table-dark ">
                <tr>
                    <td scope="col">{{trans('order/order.product name')}}</td>
                    <td scope="col">{{trans('order/order.product price')}}</td>
                    <td scope="col">{{trans('order/order.status')}}</td>
                    <td scope="col">{{trans('order/order.date')}}</td>
                    <td scope="col">{{trans('order/order.message')}}</td>
                    <td scope="col">{{trans('order/order.name_admin')}}</td>
                    <td scope="col">{{trans('order/order.name player')}}</td>
                    <td scope="col">{{trans('order/order.number')}}</td>
                    <td scope="col">{{trans('order/order.details')}}</td>
              </tr>
        </thead>
        <tbody>
          @forelse($orders as $order)
          <tr>
            
              <td scope="row" data-label="{{trans('order/order.product name')}}">{{$order->product->title}}</td>
            <td scope="row" data-label="{{trans('order/order.product price')}}">{{$order->price}}</td>
            <form method="POST" action="{{route('update-order',$order->id)}}">
              @csrf
              <td scope="row"  data-label="{{trans('order/order.status')}}">
                <select class="form-select  w-70 " aria-label="Default select example" name="status">
                  <option selected>{{trans('order/order.Open this select menu')}}</option>
                  <option {{$order->status == '0' ? 'selected':''}} value="0">{{trans('order/order.pending')}}</option>
                  <option {{$order->status == '1' ? 'selected':''}} value="1">{{trans('order/order.Completed')}}</option>
                  <option {{$order->status == '2' ? 'selected':''}} value="2">{{trans('order/order.Cancel')}}</option>
                </select>
              </td>
              <td scope="row" data-label="{{trans('order/order.date')}}">{{date("F j, Y, g:i a" ,strtotime($order->created_at))}}</td>
              <td scope="row" data-label="{{trans('order/order.message')}}">
              <select class="form-select w-70" aria-label="Default select example" name="message">
              <option selected>{{trans('order/order.message')}}</option>
              @foreach ($messages as $message)
                    <option value="{{ $message->id }}">{{ $message->message}}</option>
              @endforeach
            </select>
            </td>
            <td scope="row" data-label="{{trans('order/order.name_admin')}}">
              <input class="w-70"type="text" name="name_admin" disabled value="{{$name}}">
            </td>
            <td scope="row" data-label="{{trans('order/order.name player')}}">
              <input class="w-150" type="text" name="user_name" disabled value="{{$order->user_name}}">
              </td>

              <td scope="row" data-label="{{trans('order/order.number')}}">
              <input  class="w-150" type="text" name="number" disabled value="{{$order->number}}"> 
              </td>
            <td scope="row" data-label="{{trans('order/order.details')}}">
                <button type="submit" class="btn btn-danger">تحديث الطلب</button>
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