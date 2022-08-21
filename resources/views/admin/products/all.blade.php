@extends('admin.admin')
@section('title','الفئات التابعة للعبة ')
@section('content')
<div class="table-responsive">
<button class="btn btn-danger mt-10 mb-10 "><a href="{{route('Categories')}}" class="text-white">رجوع</a></button>
<table class="table" id="datatable1">
  <thead class="table-dark">
  <tr>
      <th scope="col">#</th>
      <th scope="col">{{trans('product/product.title')}}</th>
      <th scope="col">{{trans('product/product.orginal_price')}}</th>
      <th scope="col">{{trans('product/product.selling_price')}}</th>
      <th scope="col">{{trans('product/product.price_act')}}</th>
      <th scope="col">{{trans('product/product.commission')}}</th>
      <th scope="col">{{trans('product/product.point number')}}</th>
      <th scope="col">{{trans('product/product.price point')}}</th>
      <th scope="col">{{trans('product/product.quantity')}}</th>
      <th scope="col">{{trans('product/product.photo')}}</th>
      <th scope="col">{{trans('product/product.operation')}}</th>

    </tr>
  </thead>
  <tbody>
  @if(isset ($products)&& $products->count() > 0)
    @forelse($products as $product)
  <tr>
      <th scope="row">{{$product->id}}</th>
      <td>{{$product->category->title_en}}</td>
      <td>{{$product->orginal_price}}</td>
      <td>{{$product->selling_price}}</td>
      <td>{{$product->price_act}}</td>
      <td>{{$product->commission}}</td>
      <td>{{$product->point}}</td>
      <td>{{$product->price_point}}</td>
      <td>{{$product->quantity}}</td>
      <td>
        @if($product->photo)
        <img width="100px" height="100px"  alt="image" src="{{asset('assets/front/images/products/'.$product->photo)}}"/>
        @else
        {{$product->photo}}
        @endif
      </td>
      <td>
      <a href="{{route('Edit-product',$product->id)}}" class="btn btn-success m-b-10"><i class="fa fa-edit"></i></a><br>
      <a href="{{route('delete-product',$product->id)}}" class="btn btn-danger m-b-10"><i class="fa fa-trash"></i></a>
      </td>
    </tr>
  @empty
     <tr>
      <th colspan='4'>لا يوجد بيانات في الجدول</th>
      </tr>
    @endforelse
    @endif
  </tbody>
</table>
</div>
@endsection