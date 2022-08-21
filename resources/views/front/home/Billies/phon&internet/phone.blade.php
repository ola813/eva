@extends('front.home.home')
@section('content')
@section('title','تسديد فاتورة الهاتف')
<div class="container dir">
	<a href="{{route('phoneinternet')}}"><button type="submit" class="btn btn-danger mobile-margin-responsive">{{trans('Bills/Bills.Back')}}</button></a>
	<h3 class="title-text text-center">{{trans('Bills/Bills.phones bills')}}</h3>

    <form action="{{route('Add-Bills-phone-order')}}" method="POST">
		@csrf
			<div class="form-group">
			<label class="label-title">{{trans('phone/phone.number phone')}}</label>
			<input type="text" class="form-control"  required placeholder="{{trans('phone/phone.number')}}"   name="number"/>
			@error('number')
                <small class="form-text text-danger fs-20">{{$message}}</small>
            @enderror
			</div>
			<div class="form-group">
			<label class="label-title">{{trans('phone/phone.mobile notication')}}</label>
			<input type="text" class="form-control"  required placeholder="{{trans('phone/phone.mobile notication')}}"   name="mobile_number"/>
			@error('mobile_number')
                <small class="form-text text-danger fs-20">{{$message}}</small>
            @enderror
			</div>
			<div class="title">
			<p class="text-danger m-r-10 m-t-30 fs-20">{{trans('phone/phone.notic')}}</p>
			<span class="text-danger fs-20 "> * </span> 
				<span class="text-white"> {{trans('phone/phone.messages1')}}</span><br>
			<span class="text-danger fs-20">* </span> 
				<span class="text-white"> {{trans('phone/phone.messages4')}}</span><br>
			<span class="text-danger fs-20">* </span> 
				<span class="text-white m-b-10"> {{trans('phone/phone.messages7')}}</span><br>
			<span class="text-danger fs-20">* </span> 
				<span class="text-white"> {{trans('phone/phone.messages8')}}</span><br>
			</div>
			<button type="submit" class="btn btn-style">{{trans('phone/phone.send order')}}</button>
			</form>
               
</div>


@endsection