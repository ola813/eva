@section('title','تسجيل')
@include('front.layouts.styles')
<body class="bg10 animsition height-100vh">	

                    <form class="form-login form-reg" method="POST" action="{{ route('register') }}">
                        @csrf
                        <h3 class="m-b-5 text-danger">{{trans('login/login.Sgin up')}}</h3>
                        
                            <label for="name" class="col-form-label text-md-end fs-10">{{trans('login/login.first name')}}</label>
                        
                                <input id="name" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" autocomplete="name"  required autofocus placeholder="{{trans('login/login.Enter Your first name')}}">
                                @error('fName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <!-- </div> -->
                        </div>
                      
                            <label for="name" class="col-form-label text-md-end">{{trans('login/login.last name')}}</label>
                       
                            <!-- <div class="col-md-6"> -->
                                <input id="name" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}"  autocomplete="name" required autofocus placeholder="{{trans('login/login.Enter Your last name')}}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <!-- </div>
                        </div> -->

                        <!-- <div class="row mb-3"> -->
                            <label for="email" class="col-form-label text-md-end">{{trans('login/login.Email')}}</label>

                            <!-- <div class="col-md-6"> -->
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="{{trans('login/login.Enter Your Email')}}" required> 

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        <!-- </div> -->
                        <!-- <div class="row mb-3"> -->
                            <label for="email" class="col-form-label text-md-end">{{trans('login/login.phone')}}</label>

                            <!-- <div class="col-md-6"> -->
                                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" placeholder="{{trans('login/login.Enter Your phone')}}">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <!-- </div> -->
                        <!-- </div> -->

                        <!-- <div class="row mb-3"> -->
                            <label for="password" class="col-form-label text-md-end fs-13">{{trans('login/login.Password')}}</label>

                            <!-- <div class="col-md-6"> -->
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{trans('login/login.Enter Your Password')}}">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <!-- </div> -->
                        <!-- </div> -->

                        <!-- <div class="row mb-3"> -->
                            <label for="password-confirm" class="col-form-label text-md-end">{{trans('login/login.Confirm Password')}}</label>

                            <!-- <div class="col-md-6"> -->
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"  required placeholder="{{trans('login/login.Enter Your Confirm Password')}}">
                            <!-- </div> -->
                        <!-- </div> -->

                            <div>

                                <!-- <div class="col-md-6 offset-md-4"> -->
                                    <button type="submit" class="txt-center">
                                    {{trans('login/login.Register')}}
                                    </button>
                                    <div class="form-account">
                                        <a href="{{route('login')}}">{{trans('login/login.Sgin in')}}</a>
                                    </div>
                                <!-- </div> -->
                            </div>
                     
                    </form>

                    <body>
    @include('front.layouts.scripts')
