<!DOCTYPE html>
<html lang="en">
    <head>
        @include('front.layouts.styles')
        @section('title','سلة المشتريات')
</head>
<body class="animsition">

@include('front.layouts.header')
<section class="bg0 p-t-120 p-b-40" id="products">
<div class="container">
									
									<a href="{{route('orderElectronic')}}">
                                    Electronic
									</a><br>
									<a href="{{route('orderPhone')}}">
                                    phone
									</a><br>
									<a href="{{route('Electronic')}}">
                                    mobile
									</a><br>
									<a href="{{route('Electronic')}}">
                                    blance transfer
									</a>
							
             
		          
</div>
</section>

@include('front.layouts.footer')
@include('front.layouts.scripts')
