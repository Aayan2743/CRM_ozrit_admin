@extends('layout.alterlayout')
@section('content')
    <div class="account-content">
        <div class="d-flex flex-wrap w-100 vh-100 overflow-hidden account-bg-04">
            <div class="d-flex align-items-center justify-content-center flex-wrap vh-100 overflow-auto p-4 w-50 bg-backdrop">
                <form method="POST" action="{{ route('password.update') }}" class="flex-fill">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="mx-auto mw-450">
                        <div class="text-center mb-4">
                            <img src="{{ URL::asset('/build/img/logo.svg')}}" class="img-fluid" alt="Logo">
                        </div>
                        <div class="mb-4">
                            <h4 class="mb-2 fs-20">Reset Password?</h4>
                            <p>Enter New Password & Confirm Password to get inside</p>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Email Address</label>
                            <div class="pass-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" readonly>
                                <span class="ti toggle-password ti-email"></span>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Password</label>
                            <div class="pass-group">
                                <input type="password" name="password" class="pass-input form-control @error('password') is-invalid @enderror">
                                <span class="ti toggle-password ti-eye-off"></span> 
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Confirm Password</label>
                            <div class="pass-group">
                                <input type="password" name="password_confirmation" class="pass-inputs form-control @error('password_confirmation') is-invalid @enderror">
                                <span class="ti toggle-passwords ti-eye-off"></span>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                        </div>
                        <div class="mb-3 text-center">
                            <h6>Return to <a href="{{url('index')}}" class="text-purple link-hover"> Login</a></h6>
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
