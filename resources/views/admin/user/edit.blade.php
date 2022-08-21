@extends('admin.admin')
@section('title','تعديل بيانات المستخدم')
@section('content')
<div class="container-fluid">
    @if(Session::has('status'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('status') }}
    </div>
    @endif
    <form method="POST" action="{{route('Update-User',$Edits->id)}}">
                  <a href="{{route('admin.view-user')}}" class="btn btn-danger m-t-20 m-b-20">رجوع</a>
                    @csrf
                    <div class="form-group">
                        <label>{{trans('users/users.FirstName')}}</label>
                        <input type="text" class="form-control"  value="{{$Edits->fname}}" name='fname'/>                  
                    </div>
                    <div class="form-group">
                        <label>{{trans('users/users.LastName')}}</label>
                        <input type="text" class="form-control"  value="{{$Edits->lname}}" name='lname'/>                  
                    </div>
                    <div class="form-group">
                        <label>{{trans('users/users.Email')}}</label>
                        <input type="text" class="form-control" value="{{$Edits->email}}" name='email'/>                  
                    </div>
                    <div class="form-group">
                        <label>{{trans('users/users.user_id')}}</label>
                        <input type="text" class="form-control" value="{{$Edits->user_id}}" name='user_id'/>                  
                    </div>
                    <div class="form-group">
                        <label>{{trans('users/users.phone')}}</label>
                        <input type="text" class="form-control"  value="{{$Edits->phone}}" name='phone'/>                  
                    </div>
                    <div class="form-group">
                        <label class="text-white">{{trans('users/users.totalcharge')}}</label>
                        <input type="text" class="form-control" value="{{$user_account}}" name='total_charge'/>                  
                    </div>
                    <div class="form-group">
                        <label class="text-white">{{trans('users/users.Pointuser')}}</label>
                        <input type="text" class="form-control" value="{{$Point}}" name='Point'/>                  
                    </div>
                    <button type="submit" class="btn btn-danger">{{trans('admin/admin.update Data')}}</button>
                </form>
</div>              
@endsection