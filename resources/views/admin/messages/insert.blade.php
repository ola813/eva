@extends('admin.admin')
@section('title','إضافة رد تلقائي')
@section('content')
    <div class="container-fluid">
    
            @if(session('status'))
            <h6 class="alert alert-success">{{session('status')}}</h6>
                @endif
              <form method="POST" action="{{route('addMessage')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                      <label class="m-t-30 m-b-20">{{trans('message/mesage.Enter message')}}</label>
                      <textarea type="text" cols="20" rows="10" class="form-control" placeholder="{{trans('message/mesage.Add Enter Message')}}" name='message'></textarea>
                      @error('title')
                      <small class='form-text text-danger'>{{$message}}</small>
                      @enderror
                  </div>
                    <button type="submit" class=" btn btn-danger  m-r-t-89">{{trans('message/mesage.Add Message')}}</button>
                </form>
       
    </div>
@endsection