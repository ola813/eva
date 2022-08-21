@extends('front.home.home')
@section('title','الفئات')
@section('content')
	<div class="container">

		<h2 class="style-title-cate m-t-52"> <span class="text-danger"> * </span> {{$category->title_en}} <span class="text-danger"> * </span></h2>
		<div class="row">
			@foreach($products as $product)
			<div class="col-lg-6 col-md-6 col-sm-12 m-t-20">
				<div class="blog-slider">
					<div class="blog-slider__wrp swiper-wrapper">
						<div class="blog-slider__item swiper-slide">
							<div class="blog-slider__img">
								<img src="{{asset('assets/front/images/products/'.$product->photo)}}" alt="">
							</div>
							<div class="blog-slider__content">
								<span class="blog-slider__code text-danger">{{$product->title}}</span>
								<div class="flex m-t-10">
									@if($product->quantity >=1 && $product->price_point ==0 && $product->orginal_price !=0)
									<span class="text-center text-danger price_input float-end fs-23 style-new-price fs-16"> <small class="style-s-p fs-16"> ل.س </small> <a href="{{url('view-category/'.$category->title_en.'/'.$product->title)}}" class="text-danger fs-16">{{$product->selling_price}}</a></span>
									<span class="text-center text-danger price_input float-start style-old-price fs-16"><s><small class="style-s-p fs-16"> ل.س </small class="fs-16">{{$product->orginal_price}}</s></span>
									@elseif($product->quantity >=1 && $product->price_point !=0 && $product->orginal_price ==0 && $product->selling_price ==0)
									<span class="text-center text-danger price_input float-end fs-23 style-new-price fs-16"> <small class="style-s-p fs-16">{{trans('product/product.points')}}</small> <a href="{{url('view-category/'.$category->title_en.'/'.$product->title)}}" class="text-danger fs-16">{{$product->price_point}}</a></span>
									@elseif($product->quantity >=1 && $product->price_point !=0  && $product->selling_price !=0)
									<span class="text-center text-danger price_input float-end fs-23 style-new-price fs-16"> <small class="style-s-p fs-16">ل.س</small> <a href="{{url('view-category/'.$category->title_en.'/'.$product->title)}}"  class="text-danger fs-16">{{$product->selling_price}}</a> + </span>
									<span class="text-center text-danger price_input float-end fs-23 style-new-price fs-16"> <small class="style-s-p fs-16">{{trans('product/product.points')}}</small> <a href="{{url('view-category/'.$category->title_en.'/'.$product->title)}}" class="text-danger fs-16">{{$product->price_point}}</a></span>
									@elseif($product->quantity ==0)
									<span class="text-center text-danger price_input float-end fs-23 style-new-price fs-16"><a href="{{url('view-category/'.$category->title_en.'/'.$product->title)}}" class="text-danger">{{trans('product/product.product no avilable')}}</a></span>
									@endif
								</div>
								<div class="show-produ">
									<a href="{{url('view-category/'.$category->title_en.'/'.$product->title)}}" class="blog-slider__button">{{trans('product/product.READ MORE')}}</a>
								</div>
							</div>
						</div>  
					</div>
				</div>
			</div>	
			@endforeach
		</div>
	</div>
@endsection