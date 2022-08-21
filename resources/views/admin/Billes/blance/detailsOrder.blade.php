@extends('admin.admin')
@section('content')
  <div class="row table-responsive">
    <div class="col-md-12">
      <div class="card-header">
      <h2 class="text-white m-t-30 m-b-20">{{trans('Blance/Blance.Oreder details balance')}}</h2>
      </div>
      <div class="card-body">
      <table class="table table-re">
         <thead class="table-dark">
          <tr>
            <td scope="col">{{trans('Blance/Blance.name')}}</td>
            <td scope="col">{{trans('Blance/Blance.number')}}</td>
            <td scope="col">{{trans('Blance/Blance.date')}}</td>
            <td scope="col">{{trans('Blance/Blance.name_admin')}}</td>
            <td scope="col">{{trans('Blance/Blance.status')}}</td>
            <td scope="col">{{trans('Blance/Blance.price')}}</td>
            <td scope="col">{{trans('Blance/Blance.account')}}</td>
            <td scope="col">{{trans('Blance/Blance.notation')}}</td>
            <td scope="col">{{trans('Blance/Blance.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($Balances as $Balance)
          <tr>
            <td scope="row" data-label="{{trans('Blance/Blance.name')}}">{{$Balance->user->fname}}</td>
            <td scope="row" data-label="{{trans('Blance/Blance.number')}}">{{$Balance->mobile_number}}</td>
            <td scope="row" data-label="{{trans('Blance/Blance.date')}}">{{date("F j, Y, g:i a",strtotime($Balance->created_at))}}</td>
            <td scope="row" data-label="{{trans('Blance/Blance.name_admin')}}">
              <input class="w-70" type="text" name="name_admin" disabled value="{{$name}}">
            </td>
            <form method="POST" action="{{route('updateorderBalance',$Balance->id)}}">
              @csrf
              <td scope="row" data-label="{{trans('Blance/Blance.status')}}">
                <select class="form-select p-r-20" aria-label="Default select example" name="status">
                  <option selected> {{trans('Blance/Blance.Open this select menu')}}</option>
                  <option {{$Balance->status == '0' ? 'selected':''}} value="0">{{trans('Blance/Blance.pending')}}</option>
                  <option {{$Balance->status == '1' ? 'selected':''}} value="1">{{trans('Blance/Blance.Completed')}}</option>
                  <option {{$Balance->status == '2' ? 'selected':''}} value="2">{{trans('Blance/Blance.Cancel')}}</option>
                </select>
              </td>
              <td scope="row" data-label="{{trans('Blance/Blance.price')}}"><input type="text" class="w-75" disabled name="price" value="{{$Balance->price}}"></td>
              <td scope="row" data-label="{{trans('Blance/Blance.account')}}"><input type="text" class="w-75" disabled name="value" value="{{$value}}"></td>
            <td scope="row" data-label="{{trans('Blance/Blance.notation')}}">
            <select class="form-select w-100 p-r-20 m-r-0" aria-label="Default select example" name="message">
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