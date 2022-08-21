@extends('front.home.start')
@section('title','قيد الانتظار')
@section('content')
<!----products----->
<div class="row justify-row-center animsition bg0 p-t-40 pendingg height-100 dir">
  <div class="container-fluid">
    <div class="charg-center">

        <div class="style-pending">
            <img src="{{asset('front/logo/logo.png')}}" alt="IMG-LOGO">
        </div>
        <h2 class="stext-302 cl0 p-b-12 text-center footer-title">
            
            <span style="--i:1;">{{trans('layout/sidebar.pinding-1')}}</span>
            <span style="--i:2;">{{trans('layout/sidebar.pinding-2')}}</span>
          <span style="--i:3;">{{trans('layout/sidebar.pinding-3')}}</span>
      </h2>
   <div class="row m-t-30 justify-row-center">
    <button type="button" class="btn btn-danger m-l-20" data-toggle="modal" data-target="#exampleModal">
       <a href="{{route('gottohome')}}">{{trans('layout/sidebar.go-account')}}</a>
    </button>
    <button type="button" class="btn btn-danger m-l-20" data-toggle="modal" data-target="#exampleModal">
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
</div>
@endsection
