@extends('front.home.home')
@section('content')
@section('title','تسديد فاتورة الموبايل')
<section class="bg0  p-b-40 product-data" id="products">
    <div class="container dir">
<a href="{{route('pageMobileBlance')}}"><button type="submit" class="btn btn-danger mobile-margin-responsive">{{trans('Bills/Bills.Back')}}</button></a>
<h3 class="title-text m-b-20">{{trans('Bills/Bills.Mobile bills')}}</h3>
                <div class="div-mobile">

                    <form action="{{route('Add-Bill-Mobile')}}" method="POST">
                        @csrf

                        <div  class="blance-card" >
                       
                            <label for="" class="label-title"> حدد شركة الاتصالات</label>
                             <select class="form-select w-100"  name="Company" id='company_name' required>
                                <option selected disabled value="">اختر الشركة المطلوبة</option>
                                @foreach(\App\Models\Company::all() as $Company)
                                <option class="company" value="{{$Company->id}}">{{$Company->name}}</option>
                                @endforeach
                            </select>
                            @error('Company')
                            <small class="form-text text-danger fs-20"> {{$message}} </small>
                            @enderror
                            
                            <div class="form-group">
                                <label for="" class="label-title">رقم الموبايل</label>
                                <input id ="mobile_number" type="text" class="w-100px form-control mobile_number w-301"  placeholder="{{trans('Bills/Bills.Enter mobile number')}} ...."  name="mobile_number" required />
                                @error('mobile_number')
                                            <small class="form-text text-danger fs-20">{{$message}}</small>
                                        @enderror
                                       
                                    
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label-title">تأكيد رقم الموبايل</label>
                                        <input type="text" class="form-control veryfiy_number w-301"  placeholder="{{trans('Bills/Bills.veryfiy mobile number')}} ...."   name="veryfiy_number"required />
                                        @error('veryfiy_number')
                                        <small class="form-text text-danger fs-20">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="label-title">قيمة الفاتورة</label>
                                        <input type="text" class="form-control w-301 price" name="price"  placeholder="{{trans('Bills/Bills.price bills')}} ...."  id='price' required />                                        
                                        @error('price')
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
                                    </div>
                                    <button id="btn3" type="submit" class="btn btn-style">{{trans('Bills/Bills.send order')}}</button>
                                </form>
                            </div>
                            </div>
                                
                                
                    </div>

                         
</div>
</section>

@endsection
