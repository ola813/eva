@extends('front.home.start')
@section('title','إنشاء حساب جديد')
@section('content')

<div class="row justify-row animsition bg0 p-t-40  dir">
  <div class="container">
            <div class="style-pending">
                <img src="{{asset('front/logo/logo.png')}}" alt="IMG-LOGO">
            </div>
            <div class="style-title-pendingg">
                    <p class="text-white text-size txt-center ">
                        {{trans('layout/sidebar.paragrahe-1')}}
                    </p >
            </div>
            <div class="size-title">

                <p class="text-white text-center text-size">
                    {{trans('layout/sidebar.paragrahe-2')}}
                </p>
            </div>

                <!-- ///=======================================time line==================== -->
<section class="ps-timeline-sec">
        <div class="container">
            <ol class="ps-timeline">
                    <li>
                            <div class="img-handler-top">
                                <!-- <img src="http://www.physology.co.uk/wp-content/uploads/2016/02/ps-elem_03.png" alt=""/> -->
                                <img src="{{asset('assets/front/images/quest.png')}}" alt=""/>
                            </div>
                            <div class="ps-bot">
                                <p class="text-white">{{trans('layout/sidebar.plan1')}}</p>
                            </div>
                            <span class="ps-sp-top">01</span>
                    </li>
                <li>
                    <div class="img-handler-bot">
                        <!-- <img src="http://www.physology.co.uk/wp-content/uploads/2016/02/ps-elem_13.png" alt=""/> -->
                        <img src="{{asset('assets/front/images/wallet.png')}}" alt=""/>
                    </div>
                    <div class="ps-top">
                    <p class="text-white">{{trans('layout/sidebar.plan2')}}</p>
                    </div>
                    <span class="ps-sp-bot">02</span>
                </li>
                <li>
                    <div class="img-handler-top">
                        <!-- <img src="http://www.physology.co.uk/wp-content/uploads/2016/02/ps-elem_05.png" alt=""/> -->
                        <img src="{{asset('assets/front/images/waiting-icon-18.png')}}" alt=""/>
                    </div>
                    <div class="ps-bot">
                    <p class="text-white">{{trans('layout/sidebar.plan3')}}</p>
                    </div>
                    <span class="ps-sp-top">03</span>
                </li>
                <li>
                    <div class="img-handler-bot">
                        <img src="http://www.physology.co.uk/wp-content/uploads/2016/02/ps-elem_10.png" alt=""/>
                    </div>
                    <div class="ps-top">
                    <p class="text-white">{{trans('layout/sidebar.plan4')}}</p>
                    </div>
                    <span class="ps-sp-bot">04</span>
                </li>
            </ol>
        </div>
    </section>
            <div class="style-title-pending">
                
                    <button type="button" class="btn btn-danger p-b-13 p-l-3x txt-center m-l-20 style-button-320">
                         <a href="{{route('chargewallet')}}">{{trans('layout/sidebar.change-account')}}</a>
                    </button>
                
                <button class="p-b-13 p-l-3x btn btn-danger ">
                                <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-responsive-nav-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{trans('front/navbar/navbar.Log Out') }}
                                        </x-responsive-nav-link>
                    </form>
                </button>
        </div>
</div>	
</div>
@endsection
