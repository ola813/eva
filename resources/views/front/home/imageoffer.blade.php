@section('imgeoffer')
<!-- ================================================================================== -->
<div>

<h2 class="m-t-50  m-b-30 cl0 p-b-12 text-center offer-title">
	
	<span style="--i:1;">عروض</span> 
	<span style="--i:2;">جديدة </span>
	<span style="--i:3;">الآن</span>
</h2>        
</div>

<div class="slider">
@foreach ($Images as $Image)
<div class="slide">
<img  src="{{asset('assets/front/images/ImageOffer/'.$Image->image)}}" alt="slide" />

</div>

@endforeach
<!-- buttons -->
<a class="prev">&#10094;</a>
<a class="next">&#10095;</a>
</div>
<!-- ================================================================================== -->
@endsection