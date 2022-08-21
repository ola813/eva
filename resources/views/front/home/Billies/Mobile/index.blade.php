@extends('front.home.home')
@section('content')
@section('title','تسديد فواتير')
<div class="dir">

    <a href="{{route('Billes')}}"><button type="submit" class="btn btn-danger margin-responsive">{{trans('Bills/Bills.Back')}}</button></a>
<div class="display-table margin-30-auto">
    <a class="text-white" href="{{route('Bill-Mobile')}}">
    <button class="btn btn-border-bottom  text-white fs-30 m-b-20">
        {{trans('Bills/Bills.Mobile bills')}}
    </button>
    </a><br>
    <a class="text-white " href="{{route('drowpdown')}}">
    <button class="btn btn-border-bottom text-white fs-30 m-b-20">
        {{trans('Bills/Bills.blance transfer Bills')}}
    </button>
    </a>
</div>
</div>

             
		          
@endsection

