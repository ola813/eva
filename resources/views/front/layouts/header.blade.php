	<!-- Header -->
	<header >
		<!-- Header desktop -->
		<div class="container-menu-desktop trans-03">
			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop p-l-45">

						<!-- Icon header -->
					
						<div class="wrap-icon-header flex-w flex-r-m h-full">	
						<div class="flex-c-m h-full p-lr-19">
							<div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
								<i class="zmdi zmdi-menu"></i>
							</div>
							<div class="flex-c-m h-full p-r-5">
									<div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" data-notify="{{\App\Models\Cart::where('user_id',Auth::id())->count()}}">
										<a href="{{url('/cart')}}"><i class="zmdi zmdi-shopping-cart"></i></a>
									</div>
								</div>
						</div>
							
				
						
				
					</div>
					
					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li>
								<a href="{{route('Home')}}" class="text-white fs-26">{{trans('front/navbar/navbar.Home')}}</a>
							</li>
							
							
							<li>
								<div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" data-notify="{{\App\Models\tolalcharge::where('user_id',Auth::id())->sum('total_charge')}}">
									<a href="{{route('Payment-view')}}">{{trans('front/navbar/navbar.account')}}</a>
								</div>
								
							</li>
							<li>
								<div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-notii js-show-cart" data-notify="{{\App\Models\Pointuser::where('user_id',Auth::id())->sum('point')}}">
									<a class="text-white" data-toggle="modal" data-target="#exampleModal">{{trans('front/navbar/navbar.box point')}}</a>
								</div>
								  <!-- Modal -->
<div class=" modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
							</li>
							<li>
								<a href="#footer" class="text-white fs-26">{{trans('front/navbar/navbar.contact us')}}</a>
							</li>
						
						</ul>
					</div>	

						<!-- Logo desktop -->		
						<a href="{{route('Home')}}" class="logo">
							<img src="{{asset('front/logo/logo.png')}}" alt="IMG-LOGO">
						</a>

				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="{{route('Home')}}"><img src="{{asset('front/logo/logo.png')}}" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m h-full m-r-15">
				<div class="flex-c-m h-full p-r-5">
					<div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" data-notify="{{\App\Models\Cart::where('user_id',Auth::id())->count()}}">
						<a href="{{url('/cart')}}"><i class="zmdi zmdi-shopping-cart"></i></a>
					</div>
				</div>
			</div>
		
			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="main-menu-m text-right">
				<li>
					<a href="{{route('Home')}}">{{trans('front/navbar/navbar.Home')}}</a>
				</li>

				<li>
					<a href="{{route('recharge')}}">{{trans('Payment/Payment.charge wallet')}}</a>
				</li>

				<li>
					<a href="{{route('vieworder')}}">{{trans('front/navbar/navbar.orders')}}</a>
				</li>
				<li>
					<a href="{{route('vieworderfatora')}}">{{trans('front/navbar/navbar.orders Bills')}}</a>
				</li>

				<li>
					<a href="{{route('cart')}}">{{trans('front/navbar/navbar.my cart')}}</a>
				</li>

				<li>
					<a href="{{route('Payment-view')}}">{{trans('front/navbar/navbar.Payments')}}</a>
				</li>
				<li>
					<a href="contact.html">{{trans('front/navbar/navbar.Profile')}}</a>
				</li>
               
				<li class="p-b-13 p-l-3x">
					<form method="POST" action="{{ route('logout') }}">
							@csrf

							<x-responsive-nav-link :href="route('logout')"
									onclick="event.preventDefault();
												this.closest('form').submit();" class="text-danger">
								{{trans('front/navbar/navbar.Log Out') }}
							</x-responsive-nav-link>
					</form>
					</li>
			</ul>
		</div>

	</header>

	<!-- Sidebar -->
	<aside class="wrap-sidebar js-sidebar">
		<div class="s-full js-hide-sidebar"></div>

		<div class="sidebar flex-col-l p-t-22 p-b-25">
			<div class="flex-r w-full p-b-30 p-r-27">
				<div class="fs-35 lh-10 cl2 p-l-40 pointer hov-cl1 trans-04 js-hide-sidebar">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>

			<div class="sidebar-content flex-w w-full p-lr-65 js-pscroll">
				<ul class="sidebar-link w-full">
					<li class="p-b-13">
						<a href="{{route('Home')}}" class="stext-102 cl2 hov-cl1 trans-04">
							{{trans('front/navbar/navbar.Home')}}
						</a>
					</li>

					<li class="p-b-13">
						<a href="{{route('recharge')}}" class="stext-102 cl2 hov-cl1 trans-04">
						{{trans('Payment/Payment.charge wallet')}}
						</a>
					</li>

					<li class="p-b-13">
						<a href="{{route('vieworder')}}" class="stext-102 cl2 hov-cl1 trans-04">
						{{trans('front/navbar/navbar.orders')}}
						</a>
					</li>

					<li class="p-b-13">
						<a href="{{route('vieworderfatora')}}" class="stext-102 cl2 hov-cl1 trans-04">
							{{trans('front/navbar/navbar.orders Bills')}}
						</a>
					</li>
					<li class="p-b-13">
						<a href="{{route('cart')}}" class="stext-102 cl2 hov-cl1 trans-04">
						{{trans('front/navbar/navbar.my cart')}}
						</a>
					</li>

					<li class="p-b-13">
						<a href="{{route('Payment-view')}}" class="stext-102 cl2 hov-cl1 trans-04">
						{{trans('front/navbar/navbar.Payments')}}
						</a>
					</li>
					<li class="p-b-13">
						<a href="#" class="stext-102 cl2 hov-cl1 trans-04">
						{{trans('front/navbar/navbar.Profile')}}
						</a>
					</li>

					<li class="p-b-13 p-l-3x">
					<form method="POST" action="{{ route('logout') }}" class="logout">
							@csrf

							<x-responsive-nav-link :href="route('logout')"
									onclick="event.preventDefault();
												this.closest('form').submit();">
								{{trans('front/navbar/navbar.Log Out') }}
							</x-responsive-nav-link>
					</form>
					</li>
				</ul>
				</div>

				
			</div>
		</div>
	</aside>

    	
