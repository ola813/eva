@extends('admin.admin')
@section('content')
<div class="table-responsive" >
  <h2 class="text-white m-t-10 m-b-20">{{trans('phone/phone.Details Order')}}</h2>
  
  <table class="table table-bordered" id="datatable1">
        <thead class="table-dark">
          <tr>
         
            <td scope="col">{{trans('order/order.fname')}}</td>
            <td scope="col">{{trans('order/order.lname')}}</td>
            <td scope="col">{{trans('order/order.email')}}</td>
            <td scope="col">{{trans('order/order.User_id')}}</td>
            <td scope="col">{{trans('order/order.phone')}}</td>
            <td scope="col">{{trans('order/order.product name')}}</td>
            <td scope="col">{{trans('order/order.fatora')}}</td>
            <td scope="col">{{trans('phone\phone.number')}}</td>
            <td scope="col">{{trans('Bills/Bills.mobile number')}}</td>
            <td scope="col">{{trans('order/order.status')}}</td>
            <td scope="col">{{trans('order/order.date')}}</td>
            <td scope="col">{{trans('order/order.message')}}</td>
            <td scope="col">{{trans('order/order.name_admin')}}</td>
            <td scope="col">{{trans('order/order.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($internets as $internet)
          <tr>
            <td scope="row" data-label="{{trans('order/order.fname')}}">{{$internet->user->fname}}</td>
            <td scope="row" data-label="{{trans('order/order.lname')}}">{{$internet->user->lname}}</td>
            <td scope="row" data-label="{{trans('order/order.email')}}">{{$internet->user->email}}</td>
            <td scope="row" data-label="{{trans('order/order.User_id')}}">{{$internet->user->user_id}}</td>
            <td scope="row" data-label="{{trans('order/order.phone')}}">{{$internet->user->phone}}</td>
            <td scope="row" data-label="{{trans('order/order.product name')}}">{{$internet->type}}</td>
            <td scope="row" data-label="{{trans('order/order.fatora')}}">{{$internet->price}}</td>
            <td scope="row" data-label="{{trans('phone\phone.number')}}">{{$internet->number}}</td>
            <td scope="row" data-label="{{trans('Bills/Bills.mobile number')}}">{{$internet->mobile_number}}</td>
            <td scope="row" data-label="{{trans('order/order.commission')}}">{{$internet->commission}}</td>
              <td scope="row" data-label="{{trans('order/order.status')}}">
              @if ($internet->status == '0')
             <span class="pending">{{trans('order/order.pending')}}</span>
            @elseif($internet->status == '1')
              <span class="complete">{{trans('order/order.Completed')}}</span>
            @elseif($internet->status == '2')
             <span class="cancel">{{trans('order/order.Cancel')}}</span>
            @endif
            </td>
              <td scope="row" data-label="{{trans('order/order.date')}}">{{date("F j, Y, g:i a" ,strtotime($internet->created_at))}}</td>
              <td scope="row" data-label="{{trans('order/order.message')}}">{{$internet->messagesinfo->message}}</td>
              <td scope="row" data-label="{{trans('order/order.name_admin')}}">{{$internet->name_admin}}</td>
            <td scope="row">
                <button type="submit" class="btn btn-danger"><a href="{{route('MobileNewOrder')}}" class="text-white"> رجوع </a></button>
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