@extends('admin.admin')
@section('content')
  <div class="table-responsive">
    <div class="col-md-12">
      <div class="card-header">
      <h2 class="text-white m-t-10 m-b-20">{{trans('electronic/electronic.Details Order')}}</h2>
      </div>
      <button type="submit" class="btn btn-danger m-b-20"><a href="{{route('ElectronicNewOrder')}}" class="text-white"> رجوع </a></button>

      <table class="table table-re">
         <thead class="table-dark">
          <tr>
            <td scope="col">{{trans('electronic/electronic.name')}}</td>
            <td scope="col">{{trans('electronic/electronic.counter_number')}}</td>
            <td scope="col">{{trans('electronic/electronic.recorde_register')}}</td>
            <td scope="col">{{trans('electronic/electronic.country')}}</td>
            <td scope="col">{{trans('electronic/electronic.date')}}</td>
            <td scope="col">{{trans('electronic/electronic.name_admin')}}</td>
            <td scope="col">{{trans('electronic/electronic.status')}}</td>
            <td scope="col">{{trans('electronic/electronic.price')}}</td>
            <td scope="col">{{trans('electronic/electronic.account')}}</td>
            <td scope="col">{{trans('electronic/electronic.commission')}}</td>
            <td scope="col">{{trans('electronic/electronic.notation')}}</td>
            <td scope="col">{{trans('electronic/electronic.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($electronics as $electronic)
          <tr>
            <td scope="row" data-label="{{trans('electronic/electronic.name')}}">{{$electronic->user->fname}}</td>
            <td scope="row" data-label="{{trans('electronic/electronic.counter_number')}}">{{$electronic->counter_number}}</td>
            <td scope="row" data-label="{{trans('electronic/electronic.recorde_register')}}">{{$electronic->recorde_register}}</td>
            <td scope="row" data-label="{{trans('electronic/electronic.country')}}">{{$electronic->country}}</td>
            <td scope="row" data-label="{{trans('electronic/electronic.date')}}">{{date("F j, Y, g:i a" ,strtotime($electronic->created_at))}}</td>
            <td scope="row" data-label="{{trans('electronic/electronic.name_admin')}}">
              <input class="w-70" type="text" name="name_admin" disabled value="{{$name}}">
            </td>
            <form method="POST" action="{{route('updateElectronic',$electronic->id)}}">
              @csrf
              <td scope="row" data-label="{{trans('electronic/electronic.status')}}">
                <select class="form-select p-r-20" aria-label="Default select example" name="status">
                  <option selected> {{trans('electronic/electronic.Open this select menu')}}</option>
                  <option {{$electronic->status == '0' ? 'selected':''}} value="0">{{trans('electronic/electronic.pending')}}</option>
                  <option {{$electronic->status == '1' ? 'selected':''}} value="1">{{trans('electronic/electronic.Completed')}}</option>
                  <option {{$electronic->status == '2' ? 'selected':''}} value="2">{{trans('electronic/electronic.Cancel')}}</option>
                </select>
              </td>
              <td   scope="row" data-label="{{trans('electronic/electronic.price')}}"><input  class="w-100" type="text" name="price"></td>
              <td scope="row"  data-label="{{trans('electronic/electronic.account')}}"><input class="w-100" type="text" name="value" value={{$value}} disabled></td>
              <td scope="row"  data-label="{{trans('electronic/electronic.commission')}}"><input class="w-100" type="text" name="commission"></td>
            <td scope="row" data-label="{{trans('electronic/electronic.notation')}}">
            <select class="form-select p-r-20" aria-label="Default select example" name="message">
              <option selected>{{trans('order/order.message')}}</option>
              @foreach ($messages as $message)
                    <option value="{{$message->id}}">{{ $message->message}}</option>
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