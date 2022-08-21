@extends('front.home.home')
@section('content')
<div class="table-responsive dir">
<table class="table" id="datatable1">

    <thead class="table-dark">
      <tr>
      <th scope="col">#</th>
      <th scope="col">{{trans('orderout/orderout.messages')}}</th>
      <th scope="col">{{trans('orderout/orderout.price')}}</th>
      <th scope="col">{{trans('orderout/orderout.status')}}</th>
      <th scope="col">{{trans('orderout/orderout.date')}}</th>
      <th scope="col">{{trans('orderout/orderout.notic')}}</th>
    </tr>
  </thead>
  <tbody>
    @forelse($orderouts as $orderout)
    <tr>
      <th scope="row">{{$orderout->id}}</th>
      <td>{{$orderout->message}}</td>
      <td>{{$orderout->price}}</td>
      <td>
                @if ($orderout->status == '0')
                <span>pending</span>
                @elseif($orderout->status == '1')
                  <span>complete</span>
                @elseif($orderout->status == '2')
                <span>Cancel</span>
                @endif
                </td>
                <td>{{date('d-m-Y' ,strtotime($orderout->created_at))}}</td>
                @if($orderout->notic==null)
                <td>{{$orderout->notic}}</td>
                @else
                <td>{{$orderout->messages->message}}</td>
                @endif
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