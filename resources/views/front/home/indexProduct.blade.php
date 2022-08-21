@extends('front.home.home')
@section('title','الرئيسية')
@section('content')

<div>
	<div class="m-10-wallet-coins p-r-20 p-t-80">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon-wallet"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M461.2 128H80c-8.84 0-16-7.16-16-16s7.16-16 16-16h384c8.84 0 16-7.16 16-16 0-26.51-21.49-48-48-48H64C28.65 32 0 60.65 0 96v320c0 35.35 28.65 64 64 64h397.2c28.02 0 50.8-21.53 50.8-48V176c0-26.47-22.78-48-50.8-48zM416 336c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z"/></svg>
			<span  class=" fs-14 p-l-226 p-r-10 m-t-10 dis-inline-block color-custom m-b-20">{{$value}}</span>

	
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon-coins"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M336 32c-48.6 0-92.6 9-124.5 23.4-.9.4-51.5 21-51.5 56.6v16.7C76.1 132.2 0 163.4 0 208v192c0 44.2 78.8 80 176 80s176-35.8 176-80v-16.4c89.7-3.7 160-37.9 160-79.6V112c0-37-62.1-80-176-80zm-16 368c0 13.9-50.5 48-144 48S32 413.9 32 400v-50.1c31.8 20.6 84.4 34.1 144 34.1s112.2-13.5 144-34.1V400zm0-96c0 13.9-50.5 48-144 48S32 317.9 32 304v-50.1c31.8 20.6 84.4 34.1 144 34.1s112.2-13.5 144-34.1V304zm-144-48c-81 0-146.7-21.5-146.7-48S95 160 176 160s146.7 21.5 146.7 48S257 256 176 256zm304 48c0 13.1-45 43.6-128 47.3v-64.1c52.8-2.2 99.1-14.6 128-33.3V304zm0-96c0 13.1-45.1 43.4-128 47.2V208c0-5.6-1.7-11-4.1-16.3 54.6-1.7 102.4-14.5 132.1-33.8V208zm-144-48c-7.3 0-14-.5-20.9-.9-36.9-21.7-85-28.2-115.6-30-6.3-5.3-10.1-11-10.1-17.1 0-26.5 65.7-48 146.7-48s146.7 21.5 146.7 48S417 160 336 160z"/></svg>
	<a class=" color-custom-yellow fs-14 m-t-5 p-l-226 p-r-10 dis-inline-block m-b-20 color-custom-yellow" data-toggle="modal" data-target="#exampleModal">{{$pointuser}}</a>

								  <!-- Modal -->
<div class=" modal fade modal-point" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content ">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <div class="modal-body ">
			<span class="text-white fs-17">{{trans('front/navbar/navbar.point text')}}</span>
        </div>
        <div class="modal-footer">
		<form action="javascript:void(0);" method="post" id="ApplyCouponpoint">
                        @csrf
                        <div class="card-footer">
                            <span><strong>{{trans('cart/cart.Coupon point')}} :</strong></span>
                            <input name="code" id="codepoint" type="text" class="input-medium" placeholder="{{trans('cart/cart.Enter Coupon point')}}">
                            <button class="btn btn-danger AddCouppoint">{{trans('cart/cart.Add daily')}}</button>
                    </div>
                    </form>
				</div>
			
    </div>
  </div>
</div>
</div>
<div class="m-t-40">

<h2 class="m-t-40  m-b-30 cl0 p-b-12 text-center offer-title">
	
	<span style="--i:1;">عروض</span> 
	<span style="--i:2;">مميزة </span>
</h2>        
</div>
<!-- ================================================================================== -->
<div class="slider">
@foreach ($Images as $Image)
<div class="slide">
<img  src="{{asset('assets/front/images/ImageOffer/'.$Image->image)}}" alt="slide" />

</div>

@endforeach
<!-- buttons -->
<a class="prev">&#10094;</a>
<a class="next">&#10095;</a>
</div>
<!-- ================================================================================== -->
<!-- <div class="wrapper"> -->
<div class="container">
<div class="wrapper">
 <div class="static-txt">EvaCard</div>
					<div class="dynamic-txts">
						<li><p> منصة الكترونية</p></li>
						<li><p>شحن العاب</p></li>
						<li><p>دفع فواتير</p></li>
						<li><p>شحن رصيد</p></li>
					</div>
		</div>
		
<div class="row isotope-grid m-t-50">
							<div class="col-6  col-lg-3 col-sm-4 col-md-4 p-b-35 isotope-item women height-card">
								<!-- Block2 -->
									<div class="block2 bg11 height-product">
											<div class="block2-pic hov-img0">
												
												<a href="{{route('Billes')}}">
													<img src="{{asset('assets/front/images/sidebar/bannar/1.jpg')}}" alt="IMG-PRODUCT">	
												</a>
											</div>
									</div>
							</div>
					
								@foreach(\App\Models\Category::all() as $category)
								<div class="col-6 col-lg-3  col-sm-4 col-md-4 p-b-35 isotope-item women height-card">
									<!-- Block2 -->
									<div class="block2 bg11 height-product">
											<div class="block2-pic hov-img0 ">
												
												<a href="{{url('view-category/'.$category->title_en)}}">
													<img src="{{asset('assets/front/images/Category/'.$category->photo)}}" alt="IMG-PRODUCT">
												
												</a>
											</div>
									</div>
								</div>
								@endforeach
					
								<div class="col-6 col-lg-3  col-sm-4 col-md-4 p-b-35 isotope-item women height-card">
									<!-- Block2 -->
									<div class="block2 bg11 height-product">
											<div class="block2-pic hov-img0">
												<a href="{{route('orderOut')}}">
													<img src="{{asset('assets/front/images/orderout.png')}}" alt="IMG-PRODUCT">	
												</a>
											</div>
									</div>
								</div>

				</div> 
				</div> 

	


@endsection