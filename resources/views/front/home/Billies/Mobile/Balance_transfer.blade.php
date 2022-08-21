@extends('front.home.home')
@section('content')
@section('title','تحويل رصيد')
<div class="container product-data dir">
   
<a href="{{route('pageMobileBlance')}}"><button type="submit" class="btn btn-danger mobile-margin-responsive">{{trans('Bills/Bills.Back')}}</button></a>
<div class="div-mobile">
<h3 class="title-text m-b-20">{{trans('Bills/Bills.blance transfer Bills')}}</h3>
<form method="POST" action="{{route('Add-Blance')}}" >
                    @csrf

                    
                    <div class class="blance-card">
                        <div >
                            <select class="form-select form-select-lg mb-3 m-t-40 w-100 company_id" id="country" required name="company_id">
                                <option selected disabled>اختر شركة الاتصالات</option>
                                @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('company_id')
                            <small class="form-text text-danger fs-20">{{$message}}</small>
                        @enderror
                            <br>
                            <br>
                    
                    
                                              <div  class="label-title">
                                                    
                                                </div>
                                            
                                            <div class="mb-3">
                                                <select class="form-select form-select-lg mb-3  w-100 value" id="balance" required name="value"></select>
                                            </div>
                                            @error('value')
                                            <small class="form-text text-danger fs-20">{{$message}}</small>
                                           @enderror
                                            <!-- <div id="price"></div> -->
                                                <div id="price" class="label-title">
                                                </div>
                                                <div class="box2">

                                                    <div class="form-group w-345 m-b-20 ">
                                                        
                                                        <label for="" class="label-title">{{trans('Bills/Bills.Mobile number')}}</label>
                                                         <input required type="number" class="form-control mobile_number" name="mobile_number" maxlength="10" />
                                                        @error('mobile_number')
                                                         <small class="form-text text-danger fs-20 ">{{$message}}</small>
                                                        @enderror
                                                        </div>
                                                    <button id="btn2" type="submit" class="btn btn btn-style">{{trans('Blance/Blance.charge')}}</button>
                                                </div>
                                                    
                                                        
                                                </div>
                                              
                        
                       
                    </div>              
 </form>            
</div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
$(document).ready(function() { 

    
    $('.box').hide(); 
    $('.box2').hide();

    $('#balance').change(function(){ 
    if($('#balance').val()) {
                         $('.box2').show(); 
                         
                        } else {
                         $('.box2').hide(); 
                     } 
                    });
         
         $('.form-select').change(function(){
                     if($('.form-select').val()) {
                         $('.box').show(); 
                         
                        } else {
                         $('.box').hide(); 
                     } 
                    });
            $('#country').on('change', function () {
                var countryId = this.value;
                // alert(countryId);
              
                $('#balance').html('');
                $.ajax({
                    url: '{{ route('pageBalance') }}?company_id='+countryId,
                    type: 'get',
                    success: function (res) {
                        $('#balance').html('<option value="">اختر فئة الرصيد</option>');
                        $.each(res, function (key, value) {
                            $('#balance').append('<option value="' + value
                                .id + '">' + value.value + '</option>');
                            
                        });
                    }
                });
            });
            
            $('#balance').on('change', function () {
                var valueaccount_id = this.value;
              
              
                $('#price').html('');
                $.ajax({
                    url: '{{ route('getprice') }}?valueaccount_id='+valueaccount_id,
                    type: 'get',
                    success: function (res) {
                        $.each(res, function (key, value) {
                            $('#price').append('<span class="price" value="' + value
                                .valueaccount_id + '" disabled>' + value.price +'</span>'+'ل.س');
                            
                        });
                    }
                });
            });
            });
         
            
               
                         

    
                                     
                                                       
                                    
   



</script>
@endsection