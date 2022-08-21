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
            <td scope="col">{{trans('order/order.product name')}}</td>
            <td scope="col">{{trans('order/order.product price')}}</td>
            <td scope="col">{{trans('order/order.status')}}</td>
            <td scope="col">{{trans('order/order.price_act')}}</td>
            <td scope="col">{{trans('order/order.commission')}}</td>
            <td scope="col">{{trans('order/order.date')}}</td>
            <td scope="col">{{trans('order/order.message')}}</td>
            <td scope="col">{{trans('order/order.name_admin')}}</td>
            <td scope="col">{{trans('order/order.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($orderouts as $orderout)
          <tr>
           
            <td scope="row" data-label="{{trans('order/order.product name')}}">{{$orderout->message}}</td>
            <td scope="row" data-label="{{trans('order/order.product price')}}">{{$orderout->price}}</td>
            <form method="POST" action="{{route('update-order-out',$orderout->id)}}">
              @csrf
              <td scope="row" data-label="{{trans('order/order.status')}}">
                <select class="form-select w-100 p-r-20" aria-label="Default select example" name="status" required >
                  <option selected>{{trans('order/order.Open this select menu')}}</option>
                  <option {{$orderout->status == '0' ? 'selected':''}} value="0">{{trans('order/order.pending')}}</option>
                  <option {{$orderout->status == '1' ? 'selected':''}} value="1">{{trans('order/order.Completed')}}</option>
                  <option {{$orderout->status == '2' ? 'selected':''}} value="2">{{trans('order/order.Cancel')}}</option>
                </select>
              </td>
              <td><input type="text" name="price_act" class="w-70" required/></td>
              <td><input type="text" name="commission" class="w-70" required disabled/></td>
              <td>{{date('d-m-Y' ,strtotime($orderout->created_at))}}</td>
              <td scope="row" data-label="{{trans('order/order.message')}}">
              <select class="form-select w-100 p-r-20" aria-label="Default select example" name="notic" required >
                      <option selected>{{trans('order/order.message')}}</option>
                      @foreach ($messages as $message)
                            <option value="{{ $message->id }}">{{ $message->message}}</option>
                      @endforeach
              </select>
            </td>
            <td>
            <input type="text" name="name_admin" disabled value="{{$name}}" class="w-70">
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
     
    </div>
  </div>
@endsection