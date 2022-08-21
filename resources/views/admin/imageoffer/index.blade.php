@extends('admin.admin')
@section('content')
<div class="margin-t-b">
<a href="{{route('CreateNewImage')}}" class="btn btn-success">{{trans('layout/sidebar.Add Image offer')}}</a>
</div>
<div class="table-responsive">

  <table class="table table-bordered table-striped" id="datatable1">
    <thead class="table-dark">
      <tr>
        <th scope="col">#</th>
      <th scope="col">{{trans('category/category.Photo')}}</th>
      <th scope="col">{{trans('category/category.operation')}}</th>

    </tr>
  </thead>
  <tbody>
    @forelse($Images as $Image)
  <tr>
    <td>{{$Image->id}}</td>
      <td>
        @if($Image->image)
        <img width="100px" height="100px"  alt="image" src="{{asset('assets/front/images/ImageOffer/'.$Image->image)}}"/>
        @else
        {{$Image->image}}
        @endif
      </td>
      <td>
       
        <a href="{{route('EditeImage',$Image->id)}}" class="btn btn-primary f-z-20 m-b-10"><i class="fa fa-edit"></i></a>
        <a href="{{route('DeleteImage',$Image->id)}}" class="btn btn-danger f-z-20 m-b-10"><i class="fa fa-trash"></i></a>
   
      </td>
    </tr>
    @empty
    <tr>
      <th colspan='3' class="text-center">لا يوجد بيانات في الجدول</th>
    </tr>
    @endforelse
  </tbody>
</table>
</div>
@endsection