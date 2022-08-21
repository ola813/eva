@extends('admin.admin')
@section('title','المشرفين')
@section('content')
<div class="table-responsive">
<h2 class="text-white m-t-30 m-b-20 p-r-20">{{trans('users/users.Admins list')}}</h2>

<table class="table table-striped table-bordered" id="datatable1">

    <thead class="table-dark">
      <tr>
      <th scope="col">#</th>
      <th scope="col">{{trans('users/users.FirstName')}}</th>
      <th scope="col">{{trans('users/users.Email')}}</th>
      <th scope="col">{{trans('users/users.phone')}}</th>
      <th scope="col">{{trans('users/users.status')}}</th>
      <th scope="col">{{trans('users/users.last seen')}}</th>
      <th scope="col">{{trans('users/users.operation')}}</th>

    </tr>
  </thead>
  <tbody>
    @forelse($admins as $admin)
    <tr>
      <th scope="row">{{$admin->id}}</th>
      <th>{{$admin->fname}}</th>
      <td>{{$admin->email}}</td>
      <td>{{$admin->phone}}</td>
      <td>
          @if ($admin->isOnline())
              <li class="text-success">
                Online
              </li>
              @else
              <li class="text-danger">
                Offline
              </li>
              @endif
            </td>
            <td>{{Carbon\Carbon::parse($admin->last_seen)->diffForHumans()}}</td>
            <td>
              <a href="{{route('view-admin',$admin->id)}}"><i class="fa fa-eye fs-15 text-success"></i></a>
              <a href="{{route('Edit-admin',$admin->id)}}" ><i class="fa fa-edit fs-15"></i></a>
              <!-- <a href="{{route('delete-admin',$admin->id)}}"><i class="fa fa-trash"></i></a> -->
              <a href="javascript:void(0)" title="Delete Coupon" class="confiradminmDelete "
                  record="user" recordid="{{$admin['id']}}"><i class="fa fa-trash fs-15 text-danger"></i></a>
            </td>
          
          </tr>
          @empty
          <tr>
            <th colspan='5'>لا يوجد بيانات في الجدول</th>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>


@endsection