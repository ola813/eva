@extends('admin.admin')
@section('content')
<div class="table-responsive">
<h2 class="text-white p-t-10 m-b-20">{{trans('mobile/mobile.mobile new Order')}}</h2>
<button type="submit" class="btn btn-danger m-b-20"><a href="{{route('MobileNewOrder')}}" class="text-white"> رجوع </a></button>

        <table class="table table-bordered table-re" >
              <thead class="table-dark">
          <tr>
            <td scope="col">{{trans('mobile/mobile.name')}}</td>
            <td scope="col">{{trans('mobile/mobile.company')}}</td>
            <td scope="col">{{trans('mobile/mobile.mobile_number')}}</td>
            <td scope="col">{{trans('mobile/mobile.date')}}</td>
            <td scope="col">{{trans('mobile/mobile.status')}}</td>
            <td scope="col">{{trans('mobile/mobile.price')}}</td>
            <td scope="col">{{trans('mobile/mobile.account')}}</td>
            <td scope="col">{{trans('mobile/mobile.name_admin')}}</td>
            <td scope="col">{{trans('mobile/mobile.notation')}}</td>
            <td scope="col">{{trans('mobile/mobile.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($mobiles as $mobile)
          <tr>
          <td scope="row" data-label="{{trans('mobile/mobile.name')}}">{{$mobile->user->fname}}</td>
            <td scope="row" data-label="{{trans('mobile/mobile.company')}}">{{$mobile->Company}}</td>
            <td scope="row" data-label="{{trans('mobile/mobile.mobile_number')}}">{{$mobile->mobile_number}}</td>
            <td scope="row" data-label="{{trans('mobile/mobile.date')}}">{{date('d-m-Y' ,strtotime($mobile->created_at))}}</td>
            
              <form method="POST" action="{{route('updateorderMobile',$mobile->id)}}">
                @csrf
                <td scope="row" data-label="{{trans('mobile/mobile.status')}}">
                  <select class="form-select" aria-label="Default select example" name="status">
                    <option selected>Open this select menu</option>
                    <option {{$mobile->status == '0' ? 'selected':''}} value="0">{{trans('order/order.pending')}}</option>
                    <option {{$mobile->status == '1' ? 'selected':''}} value="1">{{trans('order/order.Completed')}}</option>
                    <option {{$mobile->status == '2' ? 'selected':''}} value="2">{{trans('order/order.Cancel')}}</option>
                  </select>
                </td>
                
                <td scope="row" data-label="{{trans('mobile/mobile.price')}}"><input type="text" value="{{$mobile->price}}" disabled name="price"></td>
                <td scope="row" data-label="{{trans('mobile/mobile.commission')}}"><input type="text"value="{{$mobile->commission}}" name="commission"></td>
                <td scope="row" data-label="{{trans('mobile/mobile.account')}}"><input type="text" name="value"  disabled value={{$value}}></td>
                <td scope="row" data-label="{{trans('mobile/mobile.name_admin')}}"><input type="text" name="name_admin" disabled value="{{$name}}"></td>
            <td scope="row" data-label="{{trans('mobile/mobile.notation')}}">
            <select class="form-select" aria-label="Default select example" name="message">
              <option selected>{{trans('order/order.message')}}</option>
              @foreach ($messages as $message)
                    <option value="{{ $message->id }}">{{ $message->message}}</option>
              @endforeach
            </select>
            </td>
            <td>
              <button type="submit" class="btn btn-success text-white">تحديث الطلب</button>
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
     
    </div>
  </div>
@endsection