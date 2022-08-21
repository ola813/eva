@extends('admin.admin')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card-header">
        <h2>New Order</h2>
      </div>
      <div class="card-body">
      <table class="table table-re">
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
            <td scope="col">{{trans('order/order.price_act')}}</td>
            <td scope="col">{{trans('order/order.commission')}}</td>
            <td scope="col">{{trans('order/order.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($OrderOuts as $OrderOut)
          <tr>
            <td scope="row" data-label="{{trans('order/order.fname')}}">{{$OrderOut->Userinfo->fname}}</td>
            <td scope="row" data-label="{{trans('order/order.lname')}}">{{$OrderOut->Userinfo->lname}}</td>
            <td scope="row" data-label="{{trans('order/order.email')}}">{{$OrderOut->Userinfo->email}}</td>
            <td scope="row" data-label="{{trans('order/order.User_id')}}">{{$OrderOut->Userinfo->user_id}}</td>
            <td scope="row" data-label="{{trans('order/order.phone')}}">{{$OrderOut->Userinfo->phone}}</td>
            <td scope="row" data-label="{{trans('order/order.product name')}}">{{$OrderOut->message}}</td>
            <td scope="row" data-label="{{trans('order/order.product price')}}">{{$OrderOut->price}}</td>
            <td scope="row" data-label="{{trans('order/order.status')}}">
                      @if ($OrderOut->status == '0')
                      <span class="pending">{{trans('order/order.pending')}}</span>
                      @elseif($OrderOut->status == '1')
                        <span class="complete">{{trans('order/order.Completed')}}</span>
                      @elseif($OrderOut->status == '2')
                      <span class="cancel">{{trans('order/order.Cancel')}}</span>
                      @endif
            </td>
              <td scope="row" data-label="{{trans('order/order.date')}}">{{date('d-m-Y' ,strtotime($OrderOut->created_at))}}</td>
              <td scope="row" data-label="{{trans('order/order.message')}}">{{$OrderOut->messages->message}}</td>
              <td scope="row" data-label="{{trans('order/order.name_admin')}}">{{$OrderOut->name_admin}}</td>
              <td scope="row" data-label="{{trans('order/order.price_act')}}">{{$OrderOut->price_act}}</td>
              <td scope="row" data-label="{{trans('order/order.commission')}}">{{$OrderOut->commission}}</td>
           
            <td scope="row">
                <button type="submit" class="btn btn-danger"><a href="{{route('view-new-order-out')}}" class="text-white"> رجوع </a></button>
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