@extends('admin.admin')
@section('content')
<div class="table-responsive">
  <h2 class="text-white m-t-30 m-b-20">{{trans('Blance/Blance.Oreder Accept')}}</h2>
  
  <table class="table table-bordered" id="datatable1">
        <thead class="table-dark">
          <tr>
          <td>{{trans('Blance/Blance.name')}}</td>
            <!-- <td>{{trans('Blance/Blance.email')}}</td> -->
            <td>{{trans('Blance/Blance.number')}}</td>
            <td>{{trans('Blance/Blance.price')}}</td>
            <td>{{trans('Blance/Blance.value')}}</td>
            <td>{{trans('Blance/Blance.status')}}</td>
            <td>{{trans('Blance/Blance.date')}}</td>
            <td>{{trans('Blance/Blance.notation')}}</td>
            <td>{{trans('Blance/Blance.name_admin')}}</td>
            <td>{{trans('Blance/Blance.details')}}</td>

          </tr>
        </thead>
        <tbody>
          @forelse($Balances as $Balance)
          <tr>
          <td>{{$Balance->user->fname}}</td>
            <!-- <td>{{$Balance->user->email}}</td> -->
            <td>{{$Balance->user->phone}}</td>
            <td>{{$Balance->price}}</td>
            <td>{{$Balance->valueaccount->value}}</td>
            <td>
            @if ($Balance->status == '0')
             <span class="pending">{{trans('Blance/Blance.pending')}}</span>
            @elseif($Balance->status == '1')
              <span class="complete">{{trans('Blance/Blance.Completed')}}</span>
            @elseif($Balance->status == '2')
             <span class="cancel">{{trans('Blance/Blance.Cancel')}}</span>
            @endif
            </td>
            <td>{{date("F j, Y, g:i a",strtotime($Balance->created_at))}}</td>
            <td>{{$Balance->messages->message}}</td>
            <td>{{$Balance->name_admin}}</td>
            <td><a href="{{route('DetailsAllBalance',$Balance->id)}}"><i class="fa fa-eye"></i></a></td>
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

