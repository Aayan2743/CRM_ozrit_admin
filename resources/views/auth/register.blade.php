@extends('layout.alterlayout')
@section('content')

    <div class="account-content">
        <div class="d-flex flex-wrap w-100 vh-100 overflow-hidden account-bg-02">
            <div class="d-flex align-items-center justify-content-center flex-wrap vh-100 overflow-auto p-4 w-50 bg-backdrop">
                <form action="{{ route('register') }}" method="POST" class="flex-fill">
                    @csrf
                    <div class="mx-auto mw-450">
                        <div class="text-center mb-4">
                            <img src="{{ URL::asset('/build/img/logo.svg')}}" class="img-fluid" alt="Logo">
                        </div>
                        <div class="mb-4">
                            <h4 class="mb-2 fs-20">Register</h4>
                            <p>Create new CRMS account</p>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Name</label>
                            <div class="position-relative">
                                <span class="input-icon-addon">
                                    <i class="ti ti-user"></i>
                                </span>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="text-danger pt-2">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Company Name</label>
                            <div class="position-relative">
                                <span class="input-icon-addon">
                                    <i class="ti ti-user"></i>
                                </span>
                                <input type="text" class="form-control" id="companyname" name="companyname" value="{{ old('companyname') }}">
                            </div>
                            <div class="text-danger pt-2">
                                @error('companyname')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Phone Number</label>
                            <div class="position-relative">
                                <span class="input-icon-addon">
                                    <i class="ti ti-phone"></i>
                                </span>
                                <input type="Number" class="form-control" id="phonenumber" name="phonenumber" value="{{ old('phonenumber') }}">
                            </div>
                            <div class="text-danger pt-2">
                                @error('phonenumber')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="float-end">
                                <input type="checkbox" name="whatsappnumber" id="whatsappnumber"> 
                                <label for="whatsappnumber">Is this Whatsapp Number</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Email Address</label>
                            <div class="position-relative">
                                <span class="input-icon-addon">
                                    <i class="ti ti-mail"></i>
                                </span>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
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
                                <input type="password" class="pass-input form-control" id="password" name="password">
                                <span class="ti toggle-password ti-eye-off"></span>
                            </div>
                            <div class="text-danger pt-2">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="col-form-label">Confirm Password</label>
                            <div class="pass-group">
                                <input type="password" class="pass-inputs form-control" id="password_confirmation" name="password_confirmation">
                                <span class="ti toggle-passwords ti-eye-off"></span>
                            </div>
                            <div class="text-danger pt-2">
                                @error('password_confirmation')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="form-check form-check-md d-flex align-items-center">
                                <input class="form-check-input" type="checkbox" value="" id="checkebox-md" checked="">
                                <label class="form-check-label" for="checkebox-md">
                                    I agree to the <a href="javascript:void(0);" class="text-primary link-hover">Terms & Privacy</a>                                     
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                        </div>
                        <div class="mb-3 d-flex">
                            <h6>Already have an account? <a href="{{url('index')}}" class="text-purple link-hover"> Sign In Instead </a> </h6> 
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