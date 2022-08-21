@extends('admin.admin')
@section('title','تفاصيل بيانات المشرف')
@section('content')

<div class="container-fluid">
            @if(Session::has('success'))
                  <div class="alert alert-success" role="alert">
                      {{ Session::get('success') }}
                  </div>
              @endif
                        <div class="form-group">
                            <label class="text-white mt-10">{{trans('users/users.FirstName')}}</label>
                            <input type="text" class="form-control text-white" readonly  value="{{$admins->fname}}" name='fname'/>                  
                        </div>
                        <div class="form-group">
                            <label class="text-white">{{trans('users/users.LastName')}}</label>
                            <input type="text" class="form-control text-white" readonly  value="{{$admins->lname}}" name='lname'/>
                        </div>
                    
                    <div class="form-group">
                        <label class="text-white">{{trans('users/users.user_id')}}</label>
                        <input type="text" class="form-control text-white"  readonly value="{{$admins->user_id}}" name='user_id'/>                  
                    </div>
                    <div class="form-group">
                        <label class="text-white">{{trans('users/users.Email')}}</label>
                        <input type="text" class="form-control text-white" readonly value="{{$admins->email}}" name='email'/>                  
                    </div>
                    <div class="form-group">
                        <label class="text-white">{{trans('users/users.phone')}}</label>
                        <input type="text" class="form-control text-white" readonly value="{{$admins->phone}}" name='phone'/>                  
                    </div>
             
                
                    <button type="submit" class="btn btn-danger "><a href="{{route('admin.view')}}" class="text-white">رجوع</a></button>
</div>              
@endsection