@extends('front.home.home')
@section('content')
@section('title','تحويلات ودفع كاش')
    <div class="container-fluid dir">
    <a href="{{route('Billes')}}"><button type="submit" class="btn btn-danger mobile-margin-responsive">{{trans('Bills/Bills.Back')}}</button></a>
    <div class="div-mobile">
        <h3 class="title-text m-b-20">{{trans('Bills/Bills.charge company')}}</h3>
    <form method="POST" action="{{route('Add-Bills-cache-order')}}">
                    @csrf
                    <div class="form-group">
                        <label class="label-title">{{trans('Bills/Bills.type Payment')}}</label>
                        <select class="form-control" aria-label="Default select example" name="method_payment" required>
                                <option  value="0">تحويل مبلغ مالي </option>
                                <option  value="1">دفع لتاجر</option>
                        </select>
                        @error('method_payment')
                        <small class="form-text text-danger fs-20">{{$message}}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="label-title">{{trans('Bills/Bills.account number')}}</label>
                        <input type="text" class="form-control" required placeholder="{{trans('Bills/Bills.enter account number')}} ...."   name="account_number"/>                  
                        @error('account_number')
                        <small class="form-text text-danger fs-20">{{$message}}</small>
                        @enderror
                    </div>
             
                    <div class="form-group">
                        <label class="label-title">{{trans('Bills/Bills.Bill-price')}}</label>
                        <input type="text" class="form-control"required placeholder="{{trans('Bills/Bills.enter Bill-price')}} ...."  name='Bill_price' />                  
                        @error('Bill_price')
                        <small class="form-text text-danger fs-20">{{$message}}</small>
                        @enderror
                    </div>
             
                    <div class="title">
                        <p class="text-danger m-r-10 m-t-30 fs-20">{{trans('phone/phone.notic')}}</p>
                        <span class="text-danger fs-20 "> * </span> 
                            <span class="text-white"> {{trans('phone/phone.messages1')}}</span><br>
                        <span class="text-danger fs-20">* </span> 
                            <span class="text-white"> {{trans('phone/phone.messages6')}}</span><br>
                    
                    <button type="submit" class="btn btn-style">{{trans('Bills/Bills.send order')}}</button>
                </form>            
</div>
</div>

@endsection