@section('title',' تسجيل الدخول' )
@include('front.layouts.styles')


<body class="bg10 animsition animsition height-100vh">	

        <!-- Session Status -->
        <!-- <x-auth-session-status class="mb-4" :status="session('status')" /> -->

        <!-- Validation Errors -->
        
        <form  class="form-login " method="POST" action="{{ route('login') }}">
            @csrf
            <h3 class="m-b-20">{{trans('login/login.Sgin in')}}</h3>
            <!-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> -->
            @error('email')
            <div class="alert alert-danger text-danger" role="alert">
                {{$message}}
            </div>
            @enderror
   
            <label for="username" :value="__('Email')" >{{trans('login/login.Email')}}</label>
            <input type="text" placeholder="{{trans('login/login.Enter Your Email')}}" id="username" name="email" :value="old('email')" required>
            <label for="password" :value="__('Password')">{{trans('login/login.Password')}}</label>
            <input type="password" placeholder="{{trans('login/login.Enter Your Password')}}" id="password" name="password" require>
            @error('password')
                      <small class='form-text text-danger'>{{$message}}</small>
            @enderror

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        <!-- {{ __('Forgot your password?') }} -->
                    </a>
                @endif
                <button class="txt-center">{{trans('login/login.Log In')}}</button>
                <div class="form-account">
                    <a href="{{route('register')}}">{{trans('login/login.Not Have Account')}}</a>
                </div>
                <input type="hidden" name="device_token" id="device_token" />
            </div>
        </form>
        
    <body>
    @include('front.layouts.scripts')

