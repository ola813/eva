@extends('admin.admin')
@section('content')
  <div class=" table-responsive">
      <div class="card-header">
      <h2 class="text-white m-t-10 m-b-20">{{trans('electronic/electronic.Details Order')}}</h2>
      </div>

      <table class="table table-re">
         <thead class="table-dark">
          <tr>
          
          <td>{{trans('order/order.fname')}}</td>
          <td>{{trans('order/order.lname')}}</td>
          <td>{{trans('order/order.email')}}</td>
          <td>{{trans('order/order.User_id')}}</td>
          <td>{{trans('order/order.phone')}}</td>
            <td scope="col">{{trans('electronic/electronic.type')}}</td>
            <td scope="col">{{trans('electronic/electronic.price')}}</td>
            <td scope="col">{{trans('electronic/electronic.commission')}}</td>
            <td scope="col">{{trans('order/order.status')}}</td>
            <td>{{trans('order/order.date')}}</td>
            <td scope="col">{{trans('order/order.message')}}</td>
            <td>{{trans('order/order.name_admin')}}</td>
            <td scope="col">{{trans('order/order.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($electronics as $electronic)
          <tr>
            <td scope="row" data-label="{{trans('order/order.fname')}}">{{$electronic->user->fname}}</td>
            <td scope="row" data-label="{{trans('order/order.lname')}}">{{$electronic->user->lname}}</td>
            <td scope="row" data-label="{{trans('order/order.email')}}">{{$electronic->user->email}}</td>
            <td scope="row" data-label="{{trans('order/order.User_id')}}">{{$electronic->user->user_id}}</td>
            <td scope="row" data-label="{{trans('order/order.phone')}}">{{$electronic->user->phone}}</td>
            <td scope="row" data-label="{{trans('electronic/electronic.type')}}">{{$electronic->type}}</td>
            <td scope="row" data-label="{{trans('order/order.price')}}">{{$electronic->price}}</td>
            <td scope="row" data-label="{{trans('order/order.commission')}}">{{$electronic->commission}}</td>
              <td scope="row" data-label="{{trans('order/order.status')}}">
              @if ($electronic->status == '0')
             <span class="pending">{{trans('order/order.pending')}}</span>
            @elseif($electronic->status == '1')
              <span class="complete">{{trans('order/order.Completed')}}</span>
            @elseif($electronic->status == '2')
             <span class="cancel">{{trans('order/order.Cancel')}}</span>
            @endif
            </td>
              <td scope="row" data-label="{{trans('order/order.date')}}">{{date("F j, Y, g:i a" ,strtotime($electronic->created_at))}}</td>
              <td scope="row" data-label="{{trans('order/order.message')}}">{{$electronic->messages->message}}</td>
              <td scope="row" data-label="{{trans('order/order.name_admin')}}">{{$electronic->name_admin}}</td>
            
            <td scope="row">
                <button type="submit" class="btn btn-danger"><a href="{{route('ElectronicNewOrder')}}" class="text-white"> رجوع </a></button>
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