@extends('front.home.start')
@section('title','شحن محفطتي')
@section('content')

<!----products----->

<div class="row justify-row animsition height-100 bg0 p-t-40  dir">
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
        <div class="style-pending ">
            <img src="{{asset('front/logo/logo.png')}}" alt="IMG-LOGO">
        </div>
        <div class="style-title-pendingg">
            <h4 class="text-white fs-30 txt-center">{{trans('Payment/Payment.charge wallet')}}</h4>
        </div>

        <form method="POST" action="{{route('storePaymentpending')}}" class="width-form" enctype="multipart/form-data" required>
                    @csrf
                    <div class="form-group">
                        <label>{{trans('Payment/Payment.amount charge')}}</label>
                        <input type="text" class="form-control width-responsive m-b-30" placeholder="{{trans('Payment/Payment.amount charge')}}"   name='account' required/>                  
                       @error('account')
                        <small class="form-text text-danger fs-20">{{$message}}</small>
                        @enderror
                    </div>
                   
                    <div class="mb-3">
                    <label>{{trans('Payment/Payment.Company name')}}</label>
                            <select class="form-select form-select-lg mb-3 company_id width-responsive" name="type" required>
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
                        <label>{{trans('Payment/Payment.photo')}}</label>
                        <input type="file" class="form-control width-responsive" name="image" required/>                 
                        @error('image')
                                 <small class="form-text text-danger fs-20">{{$message}}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-danger m-r-button">{{trans('Payment/Payment.charge wallet')}}</button>
                </form>
    
</div>	
</div>
</div>


@endsection