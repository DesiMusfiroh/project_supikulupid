@extends('layouts.app')

@section('content')
<form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
@csrf
    <span class="login100-form-title">
        Member Register
    </span>

    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
        <input class="input100 @error('username') is-invalid @enderror" type="text" name="username" placeholder="Username" name="username" value="{{ old('username') }}" required autocomplete="username" >
								@error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
		<span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-user" aria-hidden="true"></i>
        </span>
    </div>
    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
        <input class="input100 @error('email') is-invalid @enderror" type="text" name="email" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" >
								@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
		<span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-envelope" aria-hidden="true"></i>
        </span>
    </div>

    <div class="wrap-input100 validate-input" data-validate = "Password is required">
        <input class="input100 @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password" placeholder="Password">
        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
		<span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-lock" aria-hidden="true"></i>
        </span>
    </div>
    
    <div class="wrap-input100 validate-input" data-validate = "Password is required">
        <input class="input100 @error('password') is-invalid @enderror" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
		<span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-lock" aria-hidden="true"></i>
        </span>
    </div>
    
    <div class="container-login100-form-btn">
        <button class="login100-form-btn" type="submit">
            Daftar
        </button>
    </div>

    <div class="text-center p-t-12">
        
        <a class="txt2" href="{{ route('login') }}">
        <i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
            Back to Login
        </a>
    </div>
</form>
@endsection
