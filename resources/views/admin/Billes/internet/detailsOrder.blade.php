@extends('admin.admin')
@section('content')

  <div class="table-responsive" >
  <h2 class="text-white m-t-10 m-b-20">{{trans('phone/phone.Details Order')}}</h2>
  
  <table class="table table-bordered" id="datatable1">
        <thead class="table-dark">
         <tr>
         
            <td>{{trans('phone/phone.name')}}</td>
            <td>{{trans('phone/phone.full name')}}</td>
            <td>{{trans('phone/phone.number')}}</td>
            <td>{{trans('phone/phone.mobile_number')}}</td>
            <td>{{trans('phone/phone.date')}}</td>
            <td>{{trans('phone/phone.name_admin')}}</td>
            <td>{{trans('phone/phone.status')}}</td>
            <td>{{trans('phone/phone.price')}}</td>
            <td>{{trans('phone/phone.commission')}}</td>
            <td>{{trans('phone/phone.price_user')}}</td>
            <td>{{trans('phone/phone.notation')}}</td>
            <td>{{trans('phone/phone.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($phones as $phone)
          <tr>
            <td>{{$phone->user->fname}}</td>
            <td>{{$phone->full_name}}</td>
          
            <td>{{$phone->number}}</td>
            <td>{{$phone->mobile_number}}</td>
            <td>{{date('d-m-Y' ,strtotime($phone->created_at))}}</td>
            <td>
              <input class="w-70" type="text" name="name_admin" disabled value="{{$name}}">
            </td>
            <form method="POST" action="{{route('updateorderinternet',$phone->id)}}">
              @csrf
              <td>
                <select class="form-select w-100 p-r-20" aria-label="Default select example" name="status">
                  <option selected>Open this select menu</option>
                  <option {{$phone->status == '0' ? 'selected':''}} value="0">{{trans('phone/phone.pending')}}</option>
                  <option {{$phone->status == '1' ? 'selected':''}} value="1">{{trans('phone/phone.Completed')}}</option>
                  <option {{$phone->status == '2' ? 'selected':''}} value="2">{{trans('phone/phone.Cancel')}}</option>
                </select>
              </td>
              <td><input type="text" value='{{$phone->price}}' name="price" class="w-75" disabled></td>
              <td><input type="text" name="commission" class="w-75" value={{$commission}} disabled></td>
              <td><input type="text"  disabled value="{{$value}}" name="value" class="w-75"></td>
            <td>
            <select class="form-select w-100 p-r-20" aria-label="Default select example" name="messages" >
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
@endsection