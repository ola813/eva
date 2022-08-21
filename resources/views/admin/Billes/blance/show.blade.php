@extends('admin.admin')
@section('content')

  <h2 class="text-white m-b-20">{{trans('Blance/Blance.list Blalance')}}</h2>
  <div class="table-responsive">
  <table class="table table-bordered" id="datatable1">
      <thead class="table-dark">
          <tr>
          <td>#</td>
            <td>{{trans('Blance/Blance.value')}}</td>
            <td>{{trans('Blance/Blance.orginal_price')}}</td>
            <td>{{trans('Blance/Blance.selling_price')}}</td>
            <td>{{trans('Blance/Blance.commission')}}</td>
            <td>{{trans('Blance/Blance.company')}}</td>
            <td>{{trans('Blance/Blance.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($Blances as $Blance)
          <tr>
          <td>{{$Blance->id}}</td>
          <td>{{$Blance->value}}</td>
            <td>{{$Blance->balanceprice->orginal_price}}</td>
            <td>{{$Blance->balanceprice->price}}</td>
            <td>{{$Blance->balanceprice->commission}}</td>
            <td>{{$Blance->company->name}}</td>
            <td>
            <a href="{{route('DeleteBalance',$Blance->id)}}"><i class="fa fa-trash"></i></a>
            </td>
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

