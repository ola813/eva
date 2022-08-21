@extends('admin.admin')
@section('content')
  <div class="row table-responsive">
    <div class="card-header">
        <h2 class="text-white m-t-10 m-b-20">{{trans('Payment/Payment.New Order Pyment Details')}}</h2>
      </div>
      <table class="table table-re">
         <thead class="table-dark">
          <tr>
            <th scope="col">{{trans('Payment/Payment.id')}}</th>
            <th scope="col">{{trans('Payment/Payment.user name charges')}}</th>
            <th scope="col">{{trans('Payment/Payment.Date')}}</th>
            <th scope="col">{{trans('Payment/Payment.type Payment')}}</th>
            <th scope="col">{{trans('Payment/Payment.photo')}}</th>
            <th scope="col">{{trans('Payment/Payment.status')}}</th>
            <th scope="col">{{trans('Payment/Payment.Amount')}}</th>
            <th scope="col">{{trans('Payment/Payment.message')}}</th>
            <th scope="col">{{trans('Payment/Payment.name_admin')}}</th>
            <th scope="col">{{trans('Payment/Payment.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @forelse($charges as $charge)
          <tr>
            
            
            <td scope="row" data-label="{{trans('Payment/Payment.id')}}">{{$charge->id}}</td>
            <td scope="row" data-label="{{trans('Payment/Payment.user name charges')}}">{{$charge->userCharge->fname}}</td>
            <td scope="row" data-label="{{trans('Payment/Payment.Date')}}">{{date("F j, Y, g:i a" ,strtotime($charge->created_at))}}</td>
            <td scope="row" data-label="{{trans('Payment/Payment.type Payment')}}">{{$charge->type}}</td>
            <td scope="row" data-label="{{trans('Payment/Payment.photo')}}">
                @if($charge->image)
                <img width="100px" height="100px"  alt="image" src="{{asset('assets/front/images/Payment/'.$charge->image)}}"/>
                    @else
                    {{$charge->image}}
                    @endif
                </td>
                <form method="POST" action="{{route('updateCharge',$charge->id)}}">
                    @csrf
                    <td scope="row" data-label="{{trans('Payment/Payment.status')}}">
                        <select class="form-select " aria-label="Default select example" name="status" required>
                            <option selected>Open this select menu</option>
                            <option {{$charge->status == '0' ? 'selected':''}} value="0">{{trans('Payment/Payment.pending')}}</option>
                            <option {{$charge->status == '1' ? 'selected':''}} value="1">{{trans('Payment/Payment.Completed')}}</option>
                            <option {{$charge->status == '2' ? 'selected':''}} value="2">{{trans('Payment/Payment.Cancel')}}</option>
                        </select>
                    </td>
                    <td>{{$charge->account}}</td>
              <td scope="row" data-label="{{trans('Payment/Payment.message')}}">
              <select class="form-select " aria-label="Default select example" name="message" required>
              <option selected>{{trans('order/order.message')}}</option>
              @foreach ($messages as $message)
                    <option value="{{ $message->id }}">{{ $message->message}}</option>
              @endforeach
            </select>
            </td>
            <td  scope="row" data-label="{{trans('Payment/Payment.name_admin')}}">
            <input  class="w-70"type="text" name="name_admin" disabled value="{{$name}}">
              </td>
            <td>
                <button type="submit" class="btn btn-success">تحديث الطلب</button>
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