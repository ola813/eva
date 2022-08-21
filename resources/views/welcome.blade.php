<!DOCTYPE html>
<html lang="en">
<head>
<title>EvaCard | الرئيسية</title>
@include('front.layouts.styles')
</head>
<body class="animsition">
	
<!-- Header -->
<header class="header-v3">
		<!-- Header desktop -->
		<div class="container-menu-desktop trans-03">
			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop p-l-45">

						<!-- Icon header -->
					
					<div class="wrap-icon-header flex-w flex-r-m h-full">	
					
						
						
						<div class="flex-c-m layer-slick1 animated  p-l-12" data-appear="zoomIn" data-delay="1600">
                                        <a href="{{route('login')}}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                                            {{trans('front/navbar/navbar.sign in')}}
                          				 </a>
                         </div>
					</div>
					
			

						<!-- Logo desktop -->		
						<a href="{{route('welcome')}}" class="logo">
							<img src="{{asset('front/logo/logo.png')}}" alt="IMG-LOGO">
						</a>

				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="{{route('welcome')}}"><img src="{{asset('front/logo/logo.png')}}" alt="IMG-LOGO"></a>
			</div>


	</header>



    	
	


@include('front.layouts.sidebar')

<div class="bg0 p-t-120 p-b-40" id="products">
<div class="container">
		

		
        <!----products----->
		<div class="row isotope-grid">
				@foreach(\App\Models\Category::all() as $category)
					<div class="col-6 col-sm-4 col-md-3 p-b-35 isotope-item women height-card">
						<!-- Block2 -->
						<div class="block2 bg11 height-product">
								<div class="block2-pic hov-img0 label-new" data-label="New">
									
									<a href="{{url('view-category/'.$category->title_en)}}">
										<img src="{{asset('assets/front/images/Category/'.$category->photo)}}" alt="IMG-PRODUCT">
									
									</a>
								</div>
						</div>
					</div>
					@endforeach
				</div>
		</div>
</div>
@include('front.layouts.footer')




	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>




@include('front.layouts.scripts')

</body>
</html>