@extends('admin.admin')
@section('content')


  <a href="{{route('Addcopanyinter')}}" class="btn btn-danger m-t-30 m-b-20">{{trans('layout/sidebar.Add new company internet')}}</a>
  <div class="table-responsive">
  <table class="table table-bordered" id="datatable1">
      <thead class="table-dark">
          <tr>
            <td>#</td>
            <td>{{trans('layout/sidebar.name')}}</td>
            <td>{{trans('layout/sidebar.details')}}</td>
          </tr>
        </thead>
        <tbody>
          @forelse($companies as $company)
          <tr>
            <td>{{$company->id}}</td>
            <td>{{$company->name}}</td>
            <td>
                <a href="{{route('DeleteCompanyInter',$company->id)}}"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
          @empty
            <tr>
              <th colspan='6'>لا يوجد بيانات في الجدول</th>
              </tr>
          @endforelse
        </tbody>
      </table>
      </div>
@endsection