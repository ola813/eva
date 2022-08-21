@extends('admin.admin')
@section('content')
    <div class="container-fluid">
        <div class=" mt-3">
            
              <form method="POST" action="{{route('UpdateImage',$Edite->id)}}" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
        
                <div class="form-group">
                <label class="text-white">{{trans('layout/sidebar.Image offers')}}</label>
                    @if($Edite->image)
                    <img src="{{asset('assets/front/images/ImageOffer/' .$Edite->image)}}" alt="image"  width="300" height="300"/>
                    @endif
                    
                    <input type="file" class="form-control" name='image' value="{{$Edite->image}}" />
                </div>
                    <button type="submit" class="btn btn-danger m-r-t-89">{{trans('layout/sidebar.update Image')}}</button>
                </form>
            
        </div>
    </div>
@endsection