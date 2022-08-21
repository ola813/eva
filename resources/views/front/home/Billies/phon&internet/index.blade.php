@extends('front.home.home')
@section('content')
@section('title','تسديد فواتير')
<div class="dir">

    <a href="{{route('Billes')}}"><button type="submit" class="btn btn-danger margin-responsive">{{trans('Bills/Bills.Back')}}</button></a>
<div class="display-table margin-30-auto">
    <a class="text-white" href="{{route('pageBillphone')}}">
    <button class="btn btn-border-bottom  text-white fs-30 m-b-20">
        {{trans('phone/phone.bill Phone')}}
    </button>
    </a><br>
    <a class="text-white " href="{{route('pageInternet')}}">
    <button class="btn btn-border-bottom text-white fs-30 m-b-20">
        {{trans('phone/phone.bill internet')}}
    </button>
    </a>
</div>
</div>	          
@endsection

