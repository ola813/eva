@extends('admin.admin')
@section('content')
<div class="table-responsive" >
<div class="card-header">
           <h2 class="text-white m-t-10 m-b-20">{{trans('phone/phone.Details Order')}}</h2>
      </div>
  <table class="table table-bordered" id="datatable1">
        <thead class="table-dark">
          <tr>
            <td>#</td>
            <td scope="col">{{trans('phone/phone.order name')}}</td>
            <td>{{trans('phone/phone.number phone')}}</td>
            <td>{{trans('phone/phone.number')}}</td>
            <td>{{trans('phone/phone.status')}}</td>
            <td>{{trans('phone/phone.date')}}</td>
            <td>{{trans('phone/phone.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($phones as $phone)
          <tr>
            <td>{{$phone->id}}</td>
          <td>{{$phone->user->fname}}</td>
            <td>{{$phone->number}}</td>
            <td>{{$phone->number}}</td>
            <td>
                @if ($phone->status == '0')
                <span class="pending">{{trans('electronic/electronic.pending')}}</span>
                @elseif($phone->status == '1')
                  <span class="complete">{{trans('electronic/electronic.Completed')}}</span>
                @elseif($phone->status == '2')
                <span class="cancel">{{trans('electronic/electronic.Cancel')}}</span>
                @endif
            </td>
          <td>{{date("F j, Y, g:i a" ,strtotime($phone->created_at))}}</td>
          <td>
            <button type="button" class="btn btn-success text-white f-z-15"><a href="{{route('ViewOrder',$phone->id)}}" class="text-white">معالجة الطلب </a></button>
          </td>
        </tr>
        @empty
        <tr>
          <th colspan='11'>لا يوجد بيانات في الجدول</th>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
    @endsection
    
          
            


