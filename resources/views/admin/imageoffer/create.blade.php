@extends('admin.admin')
@section('content')
    <div class="container-fluid">
    
            @if(session('status'))
            <h6 class="alert alert-success">{{session('status')}}</h6>
                @endif
              <form method="POST" action="{{route('addImageOffer')}}" enctype="multipart/form-data">
                  @csrf
                <div class="form-group">
                    <label class="m-t-30">{{trans('layout/sidebar.Image offers')}}</label>
                    <input type="file" class="form-control" name='image' required/>
                </div>
                    <button type="submit" class=" btn btn-danger m-r-t-89">{{trans('layout/sidebar.Add Image offer')}}</button>
                </form>
       
    </div>
@endsection