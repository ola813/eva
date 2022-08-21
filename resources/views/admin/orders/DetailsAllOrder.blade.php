@extends('admin.admin')
@section('title','التفاصيل الكاملة للطلب')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card-header">
      <h2 class="text-white m-t-10 m-b-20">{{trans('order/order.Details Order')}}</h2>
      </div>
      <div class="table-responsive">
      <table class="table table-re" >
         <thead class="table-dark">
          <tr>
         
            <td scope="col">{{trans('order/order.fname')}}</td>
            <td scope="col">{{trans('order/order.lname')}}</td>
            <td scope="col">{{trans('order/order.email')}}</td>
            <td scope="col">{{trans('order/order.User_id')}}</td>
            <td scope="col">{{trans('order/order.phone')}}</td>
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
            <td scope="row" data-label="{{trans('order/order.fname')}}">{{$order->userorder->fname}}</td>
            <td scope="row" data-label="{{trans('order/order.lname')}}">{{$order->userorder->lname}}</td>
            <td scope="row" data-label="{{trans('order/order.email')}}">{{$order->userorder->email}}</td>
            <td scope="row" data-label="{{trans('order/order.User_id')}}">{{$order->userorder->user_id}}</td>
            <td scope="row" data-label="{{trans('order/order.phone')}}">{{$order->userorder->phone}}</td>
            <td scope="row" data-label="{{trans('order/order.product name')}}">{{$order->product->title}}</td>
            <td scope="row" data-label="{{trans('order/order.product price')}}">{{$order->price}}</td>
              <!-- <td scope="row" data-label="{{trans('order/order.status')}}">{{$order->status}}</td> -->
              <td scope="row" data-label="{{trans('order/order.status')}}">
              @if ($order->status == '0')
             <span class="pending">{{trans('order/order.pending')}}</span>
            @elseif($order->status == '1')
              <span class="complete">{{trans('order/order.Completed')}}</span>
            @elseif($order->status == '2')
             <span class="cancel">{{trans('order/order.Cancel')}}</span>
            @endif
            </td>
              <td scope="row" data-label="{{trans('order/order.date')}}">{{date("F j, Y, g:i a" ,strtotime($order->created_at))}}</td>
              <td scope="row" data-label="{{trans('order/order.message')}}">{{$order->messages->message}}</td>
              <td scope="row" data-label="{{trans('order/order.name_admin')}}">{{$order->name_admin}}</td>
              @if($order->user_name==null)
              <td scope="row" data-label="{{trans('order/order.name player')}}">{{trans('order/order.name player none')}}</td>
              @else
              <td scope="row" data-label="{{trans('order/order.name player')}}">{{$order->user_name}}</td>
              @endif
              @if($order->number==null)
              <td scope="row" data-label="{{trans('order/order.number')}}">{{trans('order/order.number player none')}}</td>
              @else
              <td scope="row" data-label="{{trans('order/order.number')}}">{{$order->number}}</td>
              @endif
            <td scope="row">
                <button type="submit" class="btn btn-danger"><a href="{{route('view-new-order')}}" class="text-white"> رجوع </a></button>
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
     
    </div>
  </div>
@endsection