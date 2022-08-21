@extends('front.home.home')
@section('content')
@section('title','تسديد فاتورة الانترنت')
<div class="container dir">
<a href="{{route('phoneinternet')}}"><button type="submit" class="btn btn-danger mobile-margin-responsive">{{trans('Bills/Bills.Back')}}</button></a>
<h3 class="title-text text-center">{{trans('Bills/Bills.inrernet bills')}}</h3>
<div class="div-mobile">
<form action="{{route('Add-bill-interet')}}" method="POST">
    @csrf
	<div class="passport-box product-data">
		<label for="" class="text-white fs-20">{{trans('phone/phone.company')}}</label> 
					<select id='company_name' name="company"  class="form-select w-100" aria-label="Default select example" required > 
						<option  selected disabled>اختر الشركة المطلوبة</option>
						@foreach(\App\Models\CompanyInternet::all() as $CompanyInternet)
						<option class="company" value="{{$CompanyInternet->id}}">{{$CompanyInternet->name}}</option>
						@endforeach
					</select>
                    @error('Company')
                            <small class="form-text text-danger fs-20">{{$message}}</small>
                    @enderror
					<div class="box">

						<div class="form-group m-t-20">
							<label for="" class="text-white ">{{trans('phone/phone.number')}}</label>
							<input type="text" class="form-control number w-100" placeholder="{{trans('phone/phone.Enter number')}}" name="number" required>
                            @error('number')
                            <small class="form-text text-danger fs-20">{{$message}}</small>
                            @enderror
                        </div>
						<div class="form-group">
							<label for="" class="text-white ">{{trans('phone/phone.price')}}</label>
							<input type="text" class="form-control price w-100" placeholder="{{trans('phone/phone.Enter price')}}" name="price" required>
                            @error('price')
                            <small class="form-text text-danger fs-20">{{$message}}</small>
                            @enderror
                        </div>
						<div class="form-group">
							<label class="text-white ">{{trans('phone/phone.full name')}}</label>
							<input type="text" class="form-control full_name w-100" placeholder="{{trans('phone/phone.Enter full name')}}"   name="full_name" required/>
                            @error('full_name')
                            <small class="form-text text-danger fs-20">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                        <label class="label-title">{{trans('Bills/Bills.mobile number')}}</label>
                        <input type="text" class="form-control"required placeholder="{{trans('Bills/Bills.enter mobile number')}} ...."  name='mobile_number' />                  
                        @error('mobile_number')
                        <small class="form-text text-danger fs-20">{{$message}}</small>
                        @enderror
                    </div>
                        <div class="title">
                            <p class="text-danger m-r-10 m-t-30 fs-20">{{trans('phone/phone.notic')}}</p>
                            <span class="text-danger fs-20 "> * </span> 
                                <span class="text-white"> {{trans('phone/phone.messages1')}}</span><br>
                            <span class="text-danger fs-20">* </span> 
                                <span class="text-white"> {{trans('phone/phone.messages2')}}</span><br>
                            <span class="text-danger fs-20">* </span> 
                                <span class="text-white"> {{trans('phone/phone.messages5')}}</span><br>
                            <span class="text-danger fs-20">* </span> 
				                <span class="text-white m-b-10"> {{trans('phone/phone.messages7')}}</span><br>
                            <span class="text-danger fs-20">* </span> 
                                <span class="text-white"> {{trans('phone/phone.messages4')}}</span>
			            </div>
						<button type="submit" class="btn6 btn btn-danger btn-style">{{trans('phone/phone.send order')}}</button>
                        </form>
                    </div>
                    </div>

				</div>
				
			</div>
	
			<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $('.box').hide(); 
$('.form-select').change(function(){
    if($('.form-select').val()) {
        $('.box').show(); 
        
    } else {
        $('.box').hide(); 
    } 
});
  

$('.btn6').on('click', function(e){

	$('#company_name').on('change',function () {
            var companyInternet_id=$(this).find(':selected').val();    
            var number=$(this).closest('.product-data').find('.number').val();
            var price=$(this).closest('.product-data').find('.price').val();
            var full_name=$(this).closest('.product-data').find('.full_name').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method:"Post",
                url:'Bill-internet',
                data:{
                    'companyInternet_id': companyInternet_id,
                    'number': number,
                    'price': price,
                    'full_name': full_name,
                    
                },
                
                success:function (response){
                    swal(response.status);
                },
                error:function (response){
                    alert(response.error);
                }
			});
            }).change();

        })
        });
        

    </script> -->
@endsection