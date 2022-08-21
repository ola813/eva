@extends('front.home.home')
@section('content')
@section('title','تسديد فاتورة الكهرباء')

        <div class="container dir">
    <a href="{{route('Billes')}}"><button type="submit" class="btn btn-danger mobile-margin-responsive">{{trans('Bills/Bills.Back')}}</button></a>
    <h3 class="title-text text-center">{{trans('Bills/Bills.electronic bills')}}</h3>
   
 
<form method="POST" action="{{route('Add-Bills')}}">
                    @csrf
                    <div class="form-group">
                        <label class="label-title">{{trans('Bills/Bills.counter number')}}</label>
                        <input type="text" class="form-control" required placeholder="{{trans('Bills/Bills.enter counter number')}} ...."   name="counter_number"/>                  
                        @error('counter_number')
                        <small class="form-text text-danger fs-20">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="label-title">{{trans('Bills/Bills.recorde register')}}</label>
                        <input type="text" class="form-control" required placeholder="{{trans('Bills/Bills.enter recorde register')}} ...."  name='recorde_register'/>                  
                        @error('recorde_register')
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
                    <div class="form-group">
                        <label class="label-title">{{trans('Bills/Bills.country')}}</label>
                        <select class="form-control" aria-label="Default select example" name="country">
                                <option     value="دمشق">دمشق</option>
                                <option     value="ريف دمشق">ريف دمشق</option>
                                <option     value="السويداء">السويداء</option>
                                <option     value="حمص">حمص</option>
                                <option     value="حماه">حماه</option>
                                <option     value="اللاذقية">اللاذقية</option>
                                <option     value="دير الزور">دير الزور</option>
                                <option     value="الرقة">الرقة</option>
                                <option     value="الحسكة">الحسكة</option>
                                <option     value="درعا">درعا</option>
                                <option     value="حلب">حلب</option>
                        </select>
                        @error('country')
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
                    <button type="submit" class="btn btn-style">{{trans('Bills/Bills.send order')}}</button>
                </form>            
</div>
</section>
        
@endsection
