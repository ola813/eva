@extends('admin.admin')
@section('content')
<div class="table-responsive">
      <div class="card-header">
           <h2 class="text-white m-t-10 m-b-20">{{trans('phone/phone.Details Order')}}</h2>
      </div>              
        <button type="submit" class="btn btn-danger m-b-20"><a href="{{route('PhoneNewOrder')}}" class="text-white"> رجوع </a></button>

      <table class="table table-re ">
         <thead class="table-dark">
         <tr>
            <td scope="col">{{trans('phone/phone.order name')}}</td>
            <td scope="col">{{trans('phone/phone.number')}}</td>
            <td scope="col">{{trans('phone/phone.date')}}</td>
            <td scope="col">{{trans('phone/phone.name_admin')}}</td>
            <td scope="col">{{trans('phone/phone.status')}}</td>
            <td scope="col">{{trans('phone/phone.price')}}</td>
            <td scope="col">{{trans('phone/phone.commission')}}</td>
            <td scope="col">{{trans('phone/phone.price_user')}}</td>
            <td scope="col">{{trans('phone/phone.notation')}}</td>
            <td scope="col">{{trans('phone/phone.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($phones as $phone)
          <tr>
          <td scope="row" data-label="{{trans('phone/phone.order name')}}">{{$phone->user->fname}}</td>
            <td scope="row" data-label="{{trans('phone/phone.number')}}">{{$phone->number}}</td>
            <td scope="row" data-label="{{trans('phone/phone.date')}}">{{date("F j, Y, g:i a" ,strtotime($phone->created_at))}}</td>
            <td scope="row"  data-label="{{trans('phone/phone.name_admin')}}">
              <input type="text" class="w-70" name="name_admin" disabled value="{{$name}}">
            </td>
            <form method="POST" action="{{route('updateorderPhone',$phone->id)}}">
              @csrf
              <td scope="row" data-label="{{trans('phone/phone.status')}}">
                <select class="form-select  p-r-20" aria-label="Default select example" name="status">
                  <option selected>{{trans('electronic/electronic.Open this select menu')}}</option>
                  <option {{$phone->status == '0' ? 'selected':''}} value="0">{{trans('phone/phone.pending')}}</option>
                  <option {{$phone->status == '1' ? 'selected':''}} value="1">{{trans('phone/phone.Completed')}}</option>
                  <option {{$phone->status == '2' ? 'selected':''}} value="2">{{trans('phone/phone.Cancel')}}</option>
                </select>
              </td>
              <td scope="row"  data-label="{{trans('phone/phone.price')}}"><input class="w-100" type="text" name="price"></td>
              <td scope="row"  data-label="{{trans('phone/phone.commission')}}"><input class="w-100" type="text" name="commission"></td>
              <td scope="row"  data-label="{{trans('phone/phone.price_user')}}"><input class="w-100" type="text" disabled value="{{$value}}" name="value"></td>
            <td class="w-150" scope="row" data-label="{{trans('phone/phone.notation')}}">
            <select class="form-select p-r-20" aria-label="Default select example" name="messages">
              <option selected>{{trans('order/order.message')}}</option>
              @foreach ($messagesAll as $message)
                    <option value="{{ $message->id }}">{{ $message->message}}</option>
              @endforeach
            </select>
            </td>
            <td>
              <button type="submit"  class="btn btn-success text-white">تحديث الطلب</button>
            </td>
          </form>
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