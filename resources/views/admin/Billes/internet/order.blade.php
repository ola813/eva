@extends('admin.admin')
@section('content')

           <h2 class="text-white p-t-10 m-b-20">{{trans('phone/phone.internet Order')}}</h2>
      
<div class="table-responsive" >
  <table class="table table-bordered" id="datatable1">
        <thead class="table-dark">
          <tr>
            <td>#</td>
            <td>{{trans('phone/phone.name')}}</td>
            <td>{{trans('phone/phone.number')}}</td>
            <td>{{trans('Bills/Bills.mobile number')}}</td>
            <td>{{trans('phone/phone.full name')}}</td>
            <td>{{trans('phone/phone.company_internet')}}</td>
            <td>{{trans('phone/phone.status')}}</td>
            <td>{{trans('phone/phone.date')}}</td>
            <td>{{trans('phone/phone.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($internets as $internet)
          <tr>
          
            <td>{{$internet->id}}</td>
            <td>{{$internet->user->fname}}</td>
            <td>{{$internet->full_name}}</td>
            <td>{{$internet->company->name}}</td>
            <td>{{$internet->number}}</td>
            <td>{{$internet->mobile_number}}</td>
           
            <td>
            @if ($internet->status == '0')
             <span class="pending">{{trans('order/order.pending')}}</span>
            @elseif($internet->status == '1')
              <span class="complete">{{trans('order/order.Completed')}}</span>
            @elseif($internet->status == '2')
             <span class="cancel">{{trans('order/order.Cancel')}}</span>
            @endif
            </td>
            <td>{{date('d-m-Y' ,strtotime($internet->created_at))}}</td>
            <td>
                <button type="button" class="btn btn-success text-white"><a href="{{route('ViewOrderinternet',$internet->id)}}" class="text-white">معالجة الطلب </a></button>
            </td>
          </tr>
          @empty
         <tr>
            <th colspan='11'>لا يوجد بيانات في الجدول</th>
         </tr>
          @endforelse
        </tbody>
      </table>
@endsection

          
            


