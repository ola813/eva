@extends('admin.admin')
@section('content')
<div class="table-responsive">
      <div class="card-header">
           <h2 class="text-white m-t-10 m-b-20">{{trans('phone/phone.Details Order')}}</h2>
      </div>
      <table class="table table-re " >
         <thead class="table-dark">
          <tr>
         
            <td scope="col">{{trans('order/order.fname')}}</td>
            <td scope="col">{{trans('order/order.lname')}}</td>
            <td scope="col">{{trans('order/order.email')}}</td>
            <td scope="col">{{trans('order/order.User_id')}}</td>
            <td scope="col">{{trans('order/order.phone')}}</td>
            <td scope="col">{{trans('order/order.product name')}}</td>
            <td scope="col">{{trans('order/order.fatora')}}</td>
            <td scope="col">{{trans('order/order.status')}}</td>
            <td scope="col">{{trans('order/order.date')}}</td>
            <td scope="col">{{trans('order/order.message')}}</td>
            <td scope="col">{{trans('order/order.name_admin')}}</td>
            <td scope="col">{{trans('order/order.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($mobiles as $mobile)
          <tr>
            <td scope="row" data-label="{{trans('order/order.fname')}}">{{$mobile->user->fname}}</td>
            <td scope="row" data-label="{{trans('order/order.lname')}}">{{$mobile->user->lname}}</td>
            <td scope="row" data-label="{{trans('order/order.email')}}">{{$mobile->user->email}}</td>
            <td scope="row" data-label="{{trans('order/order.User_id')}}">{{$mobile->user->user_id}}</td>
            <td scope="row" data-label="{{trans('order/order.phone')}}">{{$mobile->user->phone}}</td>
            <td scope="row" data-label="{{trans('order/order.product name')}}">{{$mobile->type}}</td>
            <td scope="row" data-label="{{trans('order/order.fatora')}}">{{$mobile->price}}</td>
            <td scope="row" data-label="{{trans('order/order.commission')}}">{{$mobile->commission}}</td>
              <td scope="row" data-label="{{trans('order/order.status')}}">
              @if ($mobile->status == '0')
             <span class="pending">{{trans('order/order.pending')}}</span>
            @elseif($mobile->status == '1')
              <span class="complete">{{trans('order/order.Completed')}}</span>
            @elseif($mobile->status == '2')
             <span class="cancel">{{trans('order/order.Cancel')}}</span>
            @endif
            </td>
              <td scope="row" data-label="{{trans('order/order.date')}}">{{date('d-m-Y' ,strtotime($mobile->created_at))}}</td>
              <td scope="row" data-label="{{trans('order/order.message')}}">{{$mobile->messages->message}}</td>
              <td scope="row" data-label="{{trans('order/order.name_admin')}}">{{$mobile->name_admin}}</td>
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