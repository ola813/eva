@extends('admin.admin')
@section('title','تعديل بيانات المشرف')
@section('content')
<div class="container-fluid">
<button type="submit" class="btn btn-danger m-t-20 m-b-20"><a href="{{route('admin.view')}}" class="text-white">رجوع</a></button>
            @if(Session::has('success'))
                  <div class="alert alert-success" role="alert">
                      {{ Session::get('success') }}
                  </div>
              @endif
              <form method="POST" action="{{route('update-admin',$Edits->id)}}">
                    @csrf
                    <div class="form-group">
                        <label>{{trans('admin/admin.FirstName')}}</label>
                        <input type="text" class="form-control" placeholder="first_name"  value="{{$Edits->fname}}" name="fname" />                  
                    </div>
                    <div class="form-group">
                        <label>{{trans('admin/admin.LastName')}}</label>
                        <input type="text" class="form-control" placeholder="last_name"  value="{{$Edits->lname}}" name='lname' />                  
                    </div>
                    <div class="form-group">
                        <label>{{trans('admin/admin.Email')}}</label>
                        <input type="text" class="form-control" placeholder="email"  value="{{$Edits->email}}" name='email' />                  
                    </div>
                    <div class="form-group">
                        <label>{{trans('admin/admin.phone')}}</label>
                        <input type="text" class="form-control" placeholder="email"  value="{{$Edits->phone}}" name='phone' />                  
                    </div>
                    <button type="submit" class="btn btn-danger">{{trans('admin/admin.update Data')}}</button>
                </form>
</div>              
@endsection