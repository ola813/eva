@extends('admin.admin')
@section('title','قائمة المستخدمين')
@section('content')
<div class="table-responsive">
<h2 class="text-white m-t-30 m-b-40 p-r-20 text-aling-center">{{trans('users/users.user list')}}</h2>

  <div class="col-12">
  @if(Session::has('success'))
  <div class="alert alert-success" role="alert">
    {{Session::get('success')}}
  </div>
  @endif
  </div>
  <div class="row">
        <div class="col-12">
          <a href="{{route('export')}}" class="btn btn-success mt-10 m-b-40 f-z-10 "> {{trans('users/users.Export Data')}}</a>
        </div>
    
    <!-- ----this is file imort excel ----->
          <div class="col-12 m-b-20">
      
                <form class="form-inline row g-3" method="post" action="{{route('import_user')}}"  enctype="multipart/form-data">
                  @csrf
                  <div class=" col-s-4 col-lg-2">
                    <button type="submit" class="btn btn-danger  f-z-10">{{trans('users/users.Upload Excel File')}}</button>
                  </div>
                  <div class="form-group col-s-4 col-lg-3">
                    <label for="staticEmail2" class="sr-only">Excel</label>
                    <input type="file" readonly class="form-control-plaintext" id="staticEmail2" name="excel_file">
                  </div>
                  @error('excel_file')
                  <small class="text-danger">{{$message}}</small>
                  @enderror
                </form>
                    @if(Session::has('import_error'))
                    @foreach(Session::get('import_error') as $failure)
                    <div class="alert alert-danger" role="alert">
                      {{$failure->errors()[0]}}at line no-{{$failure->row()}}
                    </div>
                    @endforeach
                    @endif
          </div>
      </div>
        <!-- ----this is file imort excel ----->
  <table class="table table-striped table-bordered" id="datatable1">
    <thead class="table-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">{{trans('users/users.FirstName')}}</th>
        <th scope="col">{{trans('users/users.user_id')}}</th>
        <th scope="col">{{trans('users/users.phone')}}</th>
        <th scope="col">{{trans('users/users.status')}}</th>
        <th scope="col">{{trans('users/users.last seen')}}</th>
        <th scope="col">{{trans('users/users.date join')}}</th>
        <th scope="col">{{trans('users/users.operation')}}</th>

      </tr>
    </thead>
    <tbody>
      @forelse($Users as $User)
  <tr>
    <th scope="row">{{$User->id}}</th>
    <td>{{$User->fname}}</td>
    <td>{{$User->user_id}}</td>
    <td>{{$User->phone}}</td>
    <td>
      @if ($User->isOnline())
      <li class="text-success">
            Online
          </li>
          @else
          <li class="text-danger">
            Offline
          </li>
          @endif
        </td>
        <td>{{Carbon\Carbon::parse($User->last_seen)->diffForHumans()}}</td>
        <td>{{date("F j, Y, g:i a" ,strtotime($User->created_at))}}</td>
       
      <td>
          <a href="{{route('view-user',$User->id)}}" class="btn btn-success m-b-10"><i class="fa fa-eye"></i></a>
          <a href="{{route('Edit-User',$User->id)}}" class="btn btn-primary m-b-10"><i class="fa fa-edit"></i></a>
       
          <a href="javascript:void(0)" title="Delete user" class="confirusermDelete btn btn-danger m-b-10"
          record="user" recordid="{{$User['id']}}" ><i class="fa fa-trash "></i></a>
        </td>
      </tr>
      @empty
     <tr>
      <th colspan='8' class='text-center'>لا يوجد بيانات في الجدول</th>
      </tr>
    @endforelse
  </tbody>
</table>
</div>
<script src="{{asset('assets/js/js_export.js')}}"></script>
@endsection