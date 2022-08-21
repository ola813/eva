@extends('front.home.home')
@section('content')
@section('title','تسديد فواتير ')
<div class="container dir">
<a href="{{route('Home')}}"><button type="submit" class="btn btn-danger m-t-30  txt-right m-b-40">{{trans('Bills/Bills.Back')}}</button></a>

<div class="row isotope-grid">
					<div class="col-6 col-sm-4 col-md-3 p-b-35 isotope-item women height-card">
						<!-- Block2 -->
						<div class="block2 bg11 height-product">
								<div class="block2-pic hov-img0">
									
									<a href="{{route('Electronic')}}">
										<img src="{{asset('assets/front/images/electronic.jpeg')}}" alt="IMG-PRODUCT">	
									</a>
								</div>
						</div>
					</div>
					<div class="col-6 col-sm-4 col-md-3 p-b-35 isotope-item women height-card">
						<!-- Block2 -->
						<div class="block2 bg11 height-product">
								<div class="block2-pic hov-img0">
									
									<a href="{{route('pageMobileBlance')}}">
										<img src="{{asset('assets/front/images/mobile.jpeg')}}" alt="IMG-PRODUCT">	
									</a>
								</div>
						</div>
					</div>
					<div class="col-6 col-sm-4 col-md-3 p-b-35 isotope-item women height-card">
						<!-- Block2 -->
						<div class="block2 bg11 height-product">
								<div class="block2-pic hov-img0">
									
									<a href="{{route('phoneinternet')}}">
										<img src="{{asset('assets/front/images/phone.jpeg')}}" alt="IMG-PRODUCT">	
									</a>
								</div>
						</div>
					</div>
					<div class="col-6 col-sm-4 col-md-3 p-b-35 isotope-item women height-card">
						<!-- Block2 -->
						<div class="block2 bg11 height-product">
								<div class="block2-pic hov-img0">
									<a href="{{route('cache')}}">
										<img src="{{asset('assets/front/images/walletcash.png')}}" alt="IMG-PRODUCT">	
									</a>
								</div>
						</div>
					</div>
</div>
</div>
</section>
@endsection
