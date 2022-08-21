@extends('front.home.home')
@section('content')
<!----products----->
<section class="bg0 p-t-60  dir" id="products">
<div class="row justify-row animsition">
<div class="container">
<div class="div-mobile">
    <h3 class="title-text m-b-20 text-center">{{trans('Payment/Payment.charge wallet')}}</h3>
    <div>
        <h4 class="text-danger m-t-10 m-b-10 ">{{trans('Payment/Payment.payment title')}}</h4>
        <p class="text-white m-t-10 m-b-10 ">{{trans('Payment/Payment.payment title2')}}</p>
        <p class="text-white m-t-10 m-b-10 ">{{trans('Payment/Payment.payment1')}}</p>
        <p class="text-white m-t-10 m-b-10 ">{{trans('Payment/Payment.payment2')}}</p>
        <p class="text-white m-t-10 m-b-10 ">{{trans('Payment/Payment.payment3')}}</p>
        <p class="text-white m-t-10 m-b-10 ">{{trans('Payment/Payment.payment4')}}</p>
        <p class="text-white m-t-10 m-b-10 ">{{trans('Payment/Payment.payment5')}}</p>
        <p class="text-white m-t-10 m-b-10 ">{{trans('Payment/Payment.payment6')}}</p>
        <p class="text-white m-t-10 m-b-10 ">{{trans('Payment/Payment.payment7')}}</p>
        <p class="text-white m-t-10 m-b-10 ">{{trans('Payment/Payment.payment8')}}</p><br>

    </div>
          <form method="POST" action="{{route('Payment-store')}}"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="text-white">{{trans('Payment/Payment.amount charge')}}</label>
                        <input type="text" class="form-control width-responsive m-b-30 w-100" placeholder="{{trans('Payment/Payment.amount charge')}}"   name='account'/>                  
                       @error('account')
                        <small class="form-text text-danger fs-20">{{$message}}</small>
                        @enderror
                    </div>
                   
                    <div class="mb-3">
                    <label class="text-white">{{trans('Payment/Payment.Company name')}}</label>
                            <select class="form-select form-select-lg mb-3 company_id w-100" name="type">
                                <option selected disabled>اختر شركة الدفع</option>
                                @foreach ($CompanyPays as $CompanyPay)
                                <option value="{{ $CompanyPay->name }}">{{ $CompanyPay->name }}</option>
                                @endforeach
                            </select>
                            @error('type')
                                 <small class="form-text text-danger fs-20">{{$message}}</small>
                             @enderror
                        </div>
                    <div class="form-group">
                        <label class="text-white">{{trans('Payment/Payment.photo')}}</label>
                        <input type="file" class="form-control width-responsive w-100 m-b-30" name="image"/>                 
                        @error('image')
                                 <small class="form-text text-danger fs-20">{{$message}}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-danger btn-style m-t-30">{{trans('Payment/Payment.send order')}}</button>
                </form>
</div>	
</div>	
</div>
@endsection