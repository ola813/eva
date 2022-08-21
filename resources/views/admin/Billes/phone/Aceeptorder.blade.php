@extends('admin.admin')
@section('content')
<div class="table-responsive">
  <div>
    <h2 class="text-white">{{trans('phone/phone.Accepted Order')}}</h2>
  </div>

      <table class="table table-bordered" id="datatable1">
        <thead class="table-dark">
        <tr>
          <td>{{trans('phone/phone.order name')}}</td>
            <td>{{trans('phone/phone.number phone')}}</td>
            <td>{{trans('phone/phone.price')}}</td>
            <td>{{trans('phone/phone.status')}}</td>
            <td>{{trans('phone/phone.date')}}</td>
            <td>{{trans('phone/phone.name_admin')}}</td>
            <td>{{trans('phone/phone.details')}}</td>

          </tr>
        </thead>
        <tbody>
          @forelse($phones as $phone)
          <tr>
          <td>{{$phone->user->fname}}</td>
            <td>{{$phone->number}}</td>
            <td>{{$phone->price}}</td>
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
            <td>{{$phone->name_admin}}</td>
            <td><a href="{{route('DetailsAllPhoorder',$phone->id)}}"><i class="fa fa-eye"></i></a></td>

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

