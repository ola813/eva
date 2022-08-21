@extends('admin.admin')
@section('content')
  <div class="table-responsive">
      <div class="card-header">
        <h2 class="text-white m-t-10 m-b-20">{{trans('Payment/Payment.New Order Pyment')}}</h2>
      </div>
      <table class="table table-re" >
         <thead class="table-dark">
          <tr>
          
          <td>{{trans('Payment/Payment.fname')}}</td>
          <td>{{trans('Payment/Payment.lname')}}</td>
          <td>{{trans('Payment/Payment.email')}}</td>
          <td>{{trans('Payment/Payment.User_id')}}</td>
          <td>{{trans('Payment/Payment.phone')}}</td>
            <td scope="col">{{trans('Payment/Payment.type')}}</td>
            <td scope="col">{{trans('Payment/Payment.price')}}</td>
            <td scope="col">{{trans('Payment/Payment.status')}}</td>
            <td>{{trans('Payment/Payment.Date')}}</td>
            <td scope="col">{{trans('Payment/Payment.message')}}</td>
            <td>{{trans('Payment/Payment.name_admin')}}</td>
            <td scope="col">{{trans('Payment/Payment.operation')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($charges as $charge)
          <tr>
            <td scope="row" data-label="{{trans('Payment/Payment.fname')}}">{{$charge->userCharge->fname}}</td>
            <td scope="row" data-label="{{trans('Payment/Payment.lname')}}">{{$charge->userCharge->lname}}</td>
            <td scope="row" data-label="{{trans('Payment/Payment.email')}}">{{$charge->userCharge->email}}</td>
            <td scope="row" data-label="{{trans('Payment/Payment.User_id')}}">{{$charge->userCharge->user_id}}</td>
            <td scope="row" data-label="{{trans('Payment/Payment.phone')}}">{{$charge->userCharge->phone}}</td>
            <td scope="row" data-label="{{trans('Payment/Payment.type')}}">{{$charge->type}}</td>
            <td scope="row" data-label="{{trans('Payment/Payment.price')}}">{{$charge->account}}</td>
              <td scope="row" data-label="{{trans('Payment/Payment.status')}}">
              @if ($charge->status == '0')
             <span class="pending">{{trans('Payment/Payment.pending')}}</span>
            @elseif($charge->status == '1')
              <span class="complete">{{trans('Payment/Payment.Completed')}}</span>
            @elseif($charge->status == '2')
             <span class="cancel">{{trans('Payment/Payment.Cancel')}}</span>
            @endif
            </td>
              <td scope="row" data-label="{{trans('Payment/Payment.Date')}}">{{date("F j, Y, g:i a"  ,strtotime($charge->created_at))}}</td>
              <td scope="row" data-label="{{trans('Payment/Payment.message')}}">{{$charge->messages->message}}</td>
              <td scope="row" data-label="{{trans('Payment/Payment.name_admin')}}">{{$charge->name_admin}}</td>>
            <td scope="row">
                <button type="submit" class="btn btn-danger"><a href="{{route('Payments')}}" class="text-white"> رجوع </a></button>
            </td>
          </form>
          </tr>
           @empty
            <tr>
              <th colspan='12'>لا يوجد بيانات في الجدول</th>
              </tr>
          @endforelse
        </tbody>
      </table>
      </div>

@endsection