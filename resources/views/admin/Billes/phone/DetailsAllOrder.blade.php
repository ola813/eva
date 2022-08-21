@extends('admin.admin')
@section('content')
<div class="table-responsive">
     <div class="card-header">
         <h2 class="text-white m-t-10 m-b-20">{{trans('phone/phone.Details Order')}}</h2>
      </div>
      <table class="table table-re" >
         <thead class="table-dark">
          <tr>
            <td scope="col">{{trans('order/order.fname')}}</td>
            <td scope="col">{{trans('order/order.lname')}}</td>
            <td scope="col">{{trans('order/order.email')}}</td>
            <td scope="col">{{trans('order/order.User_id')}}</td>
            <td scope="col">{{trans('order/order.phone')}}</td>
            <td scope="col">{{trans('phone/phone.type')}}</td>
            <td scope="col">{{trans('phone/phone.number')}}</td>
            <td scope="col">{{trans('phone/phone.price')}}</td>
            <td scope="col">{{trans('phone/phone.commission')}}</td>
            <td scope="col">{{trans('order/order.status')}}</td>
            <td scope="col">{{trans('order/order.date')}}</td>
            <td scope="col">{{trans('order/order.message')}}</td>
            <td scope="col">{{trans('order/order.name_admin')}}</td>
            <td scope="col">{{trans('order/order.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($phones as $phone)
          <tr>
            <td scope="row" data-label="{{trans('order/order.fname')}}">{{$phone->user->fname}}</td>
            <td scope="row" data-label="{{trans('order/order.lname')}}">{{$phone->user->lname}}</td>
            <td scope="row" data-label="{{trans('order/order.email')}}">{{$phone->user->email}}</td>
            <td scope="row" data-label="{{trans('order/order.User_id')}}">{{$phone->user->user_id}}</td>
            <td scope="row" data-label="{{trans('order/order.phone')}}">{{$phone->user->phone}}</td>
            <td scope="row" data-label="{{trans('phone/phone.type')}}">{{$phone->type}}</td>
            <td scope="row" data-label="{{trans('phone/phone.number')}}">{{$phone->number}}</td>
            <td scope="row" data-label="{{trans('phone/phone.price')}}">{{$phone->price}}</td>
            <td scope="row" data-label="{{trans('phone/phone.commission')}}">{{$phone->commission}}</td>
              <td scope="row" data-label="{{trans('order/order.status')}}">
                  @if ($phone->status == '0')
                  <span class="pending">{{trans('order/order.pending')}}</span>
                  @elseif($phone->status == '1')
                    <span class="complete">{{trans('order/order.Completed')}}</span>
                  @elseif($phone->status == '2')
                  <span class="cancel">{{trans('order/order.Cancel')}}</span>
                  @endif
            </td>
              <td scope="row" data-label="{{trans('order/order.date')}}">{{date('F j, Y, g:i a',strtotime($phone->created_at))}}</td>
              <td scope="row" data-label="{{trans('order/order.message')}}">{{$phone->messagesinfo->message}}</td>
              <td scope="row" data-label="{{trans('order/order.name_admin')}}">{{$phone->name_admin}}</td>
              
            <td scope="row">
                <button type="submit" class="btn btn-danger"><a href="{{route('PhoneNewOrder')}}" class="text-white"> رجوع </a></button>
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