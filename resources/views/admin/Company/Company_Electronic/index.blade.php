@extends('admin.admin')
@section('content')
<a href="{{route('ShowPayELec')}}" class="btn btn-danger m-t-30 m-r-15 m-b-20">رجوع</a>
<div class="container-fluid product-data">
             <form action="{{route('newPayELec')}}" method="post">
                @csrf
                 <div class="form-group">
                     <label>{{trans('layout/sidebar.New_Electronic_name')}}</label>
                     <input type="text" class="form-control name" name='name'/>                  
                    </div>
                    
                    <button type="submit" class="btn6 btn btn-danger">{{trans('layout/sidebar.Save')}}</button>
                </form>
            
</div>              


    @endsection