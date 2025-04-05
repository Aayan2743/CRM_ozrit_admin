@extends('layout.alterlayout')
@section('content')
    <div class="account-content">
        <div class="d-flex flex-wrap w-100 vh-100 overflow-hidden account-bg-01">
            <div class="d-flex align-items-center justify-content-center flex-wrap vh-100 overflow-auto p-4 w-50 bg-backdrop">
                <form action="{{ url('login') }}" method="POST" class="flex-fill"> 
                @csrf
                    <div class="mx-auto mw-450">
                        <div class="text-center mb-4">
                            <img src="{{ URL::asset('/build/img/logo.svg')}}" class="img-fluid" alt="Logo">
                        </div>
                        <div class="mb-4">
                            <h4 class="mb-2 fs-20">Sign In</h4>
                            <p>Access the CRMS panel using your email and passcode.</p>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Email Address</label>
                            <div class="position-relative">
                                <span class="input-icon-addon">
                                    <i class="ti ti-mail"></i>
                                </span>
                                <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
                            </div>
                            <div class="text-danger pt-2">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Password</label>
                            <div class="pass-group">
                                <input type="password" class="pass-input form-control" name="password" id="password" value="">
                                <span class="ti toggle-password ti-eye-off"></span>
                            </div>
                            <div class="text-danger pt-2">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="form-check form-check-md d-flex align-items-center">
                                <input class="form-check-input" type="checkbox" name="remember" value="" id="checkebox-md" checked="">
                                <label class="form-check-label" for="checkebox-md">
                                    Remember Me
                                </label>
                            </div>
                            <div class="text-end">
                                <a href="{{ route('password.request') }}" class="text-primary fw-medium link-hover">Forgot Password?</a>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Sign In</button>
                        </div>
                        <div class="mb-3">
                            <h6>New on our platform?<a href="{{url('register')}}" class="text-purple link-hover"> Create an account</a></h6>
                            <h6>|<a href="{{ route('index') }}" class="text-info link-hover">Login With OTP</a></h6>
                        </div>
                        <div class="text-center">
                            <p class="fw-medium text-gray">Copyright &copy; 2024 - CRMS</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection