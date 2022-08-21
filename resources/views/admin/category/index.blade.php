@extends('admin.admin')
@section('title','الالعاب')
@section('content')
<div class="table-responsive">
<h2 class="text-white m-t-30 m-b-20 p-r-20">{{trans('category/category.category product')}}</h2>
<a href="{{route('create-Category')}}" class="btn btn-danger m-r-20 m-b-20">{{trans('category/category.Add Category')}}</a>
<a href="{{route('create-item')}}" class="btn btn-danger m-r-20 m-b-20">{{trans('category/category.Add product')}}</a>


  <table class="table table-bordered table-striped" id="datatable1">
    <thead class="table-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">{{trans('category/category.title_en')}}</th>
      <th scope="col">{{trans('category/category.Category_ar')}}</th>
      <th scope="col">{{trans('category/category.Category_en')}}</th>
      <th scope="col">{{trans('category/category.Photo')}}</th>
      <th scope="col">{{trans('category/category.operation')}}</th>

    </tr>
  </thead>
  <tbody>
    @forelse($Categories as $Category)
  <tr>
      <th scope="row">{{$Category->id}}</th>
      <td>{{$Category->title_en}}</td>
      <td>{{$Category->category_ar}}</td>
      <td>{{$Category->category_en}}</td>
      <td>
        @if($Category->photo)
        <img width="100px" height="100px"  alt="image" src="{{asset('assets/front/images/Category/'.$Category->photo)}}"/>
        @else
        {{$Category->photo}}
        @endif
      </td>
      <td>
        <a href="{{route('Categories.product',$Category->id)}}" class="btn btn-success f-z-20 m-b-10"><i class="fa fa-bars"></i></a>    
        <a href="javascript:void(0)" title="Delete Category" class="confirCategorymDelete btn btn-danger f-z-20 m-b-10"
        record="Category" recordid="{{$Category['id']}}"><i class="fa fa-trash "></i></a>
        <a href="{{route('edit-Category',$Category->id)}}" class="btn btn-primary f-z-20 m-b-10"><i class="fa fa-edit"></i></a>
      </td>
    </tr>
    @empty
    <tr>
      <th colspan='7' class="text-center">لا يوجد بيانات في الجدول</th>
    </tr>
    @endforelse
  </tbody>
</table>
</div>
@endsection