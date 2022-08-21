@extends('front.home.home')
@section('content')
<div class="div-mobile">
<div class="">
    <a class="title-text" href="{{route('order-Bill-Mobile')}}">
        <span class="fs-20 font-custom-16 m-b-20 m-l-30">
            {{trans('front/navbar/navbar.order Mobile bills')}}
            <i class="fa fa-arrow-left m-l-15 m-b-20" aria-hidden="true"></i>
    </span>
</a>
</div>								
<div class="">
    <a class="title-text m-l-50" href="{{route('orderElectronic')}}">
    <span class="fs-20 m-b-20 font-custom-16 m-l-30">
            {{trans('front/navbar/navbar.order Electronic Bills')}}
            <i class="fa fa-arrow-left m-l-15 m-b-20" aria-hidden="true"></i>
        </span>
    </a>
</div>
<div class="">
    <a class="title-text m-l-50" href="{{route('orderinternet')}}">
    <span class="fs-20 m-b-20 font-custom-16 m-l-30">
            {{trans('front/navbar/navbar.order internet  Bills')}}
            <i class="fa fa-arrow-left m-l-15 m-b-20" aria-hidden="true"></i>
    </span>
    </a>
</div>
<div class="">
    <a class="title-text m-l-50" href="{{route('orderBalance')}}">
    <span class="fs-20 m-b-20 font-custom-16 m-l-30">
        {{trans('front/navbar/navbar.order blance transfer Bills')}}
        <i class="fa fa-arrow-left m-l-20 m-b-20" aria-hidden="true"></i>
    </span>
    </a>
</div>
<div class="">
    <a class="title-text m-l-50" href="{{route('orderPhone')}}">
      <span class="fs-20 m-b-20 font-custom-16 m-l-30">
        {{trans('front/navbar/navbar.order phone Bills')}}
        <i class="fa fa-arrow-left m-l-27 " aria-hidden="true"></i>
    </span>
    </a>
</div>
<a href="{{route('Home')}}"><button type="submit" class="btn btn-danger m-t-30 m-l-150">{{trans('Bills/Bills.Back')}}</button></a>
</div>


@endsection

