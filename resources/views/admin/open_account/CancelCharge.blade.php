@extends('admin.admin')
@section('content')
<div class="table-responsive">
      <div class="card-header">
        <h2 class="text-white m-t-10 m-b-20">{{trans('Payment/Payment.Order Pyment Cancel')}}</h2>
      </div>
      <table class="table" id="datatable1">
         <thead class="table-dark">
          <tr>
            <td>#</td>
          <td>{{trans('Payment/Payment.user name charges')}}</td>
            <td>{{trans('Payment/Payment.Company name')}}</td>
            <td>{{trans('Payment/Payment.amount')}}</td>
            <td>{{trans('Payment/Payment.status')}}</td>
            <td>{{trans('Payment/Payment.date')}}</td>
            <td>{{trans('Payment/Payment.name_admin')}}</td>
            <td>{{trans('Payment/Payment.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($charge as $charge)
          <tr>
              
            <td>{{$charge->id}}</td>
            <td>{{$charge->userCharge->email}}</td>
            <td>{{$charge->type}}</td>
            <td>{{$charge->account}}</td>
            <td>
            @if ($charge->status == '0')
             <span class="pending">{{trans('Payment/Payment.pending')}}</span>
            @elseif($charge->status == '1')
              <span class="complete">{{trans('Payment/Payment.Completed')}}</span>
            @elseif($charge->status == '2')
             <span class="cancel">{{trans('Payment/Payment.Cancel')}}</span>
            @endif
            </td>
            <td>{{date("F j, Y, g:i a" ,strtotime($charge->created_at))}}</td>
            <td>{{$charge->name_admin}}</td>
            <td><a href="{{route('detials-All-openaccount',$charge->id)}}"><i class="fa fa-eye"></i></a></td>
          </tr>
          @empty
            <tr>
              <th colspan='8'>لا يوجد بيانات في الجدول</th>
              </tr>
          @endforelse
        </tbody>
      </table>
      </div>

@endsection