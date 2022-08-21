@extends('admin.admin')
@section('title','تفاصيل بيانات المستخدم')
@section('content')

<div class="container-fluid">
            @if(Session::has('success'))
                  <div class="alert alert-success" role="alert">
                      {{ Session::get('success') }}
                  </div>
              @endif
                        <div class="form-group">
                            <label class="text-white mt-10">{{trans('users/users.FirstName')}}</label>
                            <input type="text" class="form-control" readonly  value="{{$Users->fname}}"/>                  
                        </div>
                        <div class="form-group">
                            <label class="text-white">{{trans('users/users.LastName')}}</label>
                            <input type="text" class="form-control" readonly  value="{{$Users->lname}}" name='lname'/>
                        </div>
                    
                    <div class="form-group">
                        <label class="text-white">{{trans('users/users.user_id')}}</label>
                        <input type="text" class="form-control"  readonly value="{{$Users->user_id}}" name='user_id'/>                  
                    </div>
                    <div class="form-group">
                        <label class="text-white">{{trans('users/users.Email')}}</label>
                        <input type="text" class="form-control" readonly value="{{$Users->email}}" name='email'/>                  
                    </div>
                    <div class="form-group">
                        <label class="text-white">{{trans('users/users.phone')}}</label>
                        <input type="text" class="form-control" readonly value="{{$Users->phone}}" name='phone'/>                  
                    </div>
                    <div class="form-group">
                        <label class="text-white">{{trans('users/users.totalcharge')}}</label>
                        <input type="text" class="form-control" readonly value="{{$user_account}}" name='total_charge'/>                  
                    </div>
                    <div class="form-group">
                        <label class="text-white">{{trans('users/users.Pointuser')}}</label>
                        <input type="text" class="form-control" readonly value="{{$Point}}" name='Point'/>                  
                    </div>
                    <button type="submit" class="btn btn-danger "><a href="{{route('admin.view-user')}}" class="text-white">رجوع</a></button>
</div>              
@endsection