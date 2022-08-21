@extends('admin.admin')
@section('title','حذف رد تلقائي')
@section('content')
    <div class="container-fluid">
    
            @if(session('status'))
            <h6 class="alert alert-success">{{session('status')}}</h6>
                @endif
              <form method="POST" action="{{route('UpdateMessage',$Edits->id)}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                      <label class="m-t-20 m-b-20">{{trans('message/mesage.Edit Message')}}</label>
                      <input type="text" cols="20" rows="10" class="form-control" value="{{$Edits->message}}" name="message" />
                      @error('title')
                      <small class='form-text text-danger'>{{$message}}</small>
                      @enderror
                  </div>
                    <button type="submit" class=" btn btn-danger m-r-t-89">{{trans('message/mesage.Edit Message')}}</button>
                </form>
       
    </div>
@endsection