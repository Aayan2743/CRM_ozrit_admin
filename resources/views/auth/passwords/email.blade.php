@extends('layout.alterlayout')
@section('content')
    <div class="account-content">
        <div class="d-flex flex-wrap w-100 vh-100 overflow-hidden account-bg-03">
            <div class="d-flex align-items-center justify-content-center flex-wrap vh-100 overflow-auto p-4 w-50 bg-backdrop">
                <form action="{{ route('password.email') }}" method="POST" class="flex-fill">
                    @csrf
                    <div class="mx-auto mw-450">
                        <div class="text-center mb-4">
                        <img src="{{ URL::asset('/build/img/logo.svg')}}" class="img-fluid" alt="Logo">
                        </div>
                        <div class="mb-4">
                            <h4 class="mb-2 fs-20">Forgot Password?</h4>
                            <p>If you forgot your password, well, then we’ll email you instructions to reset your password.</p>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Email Address</label>
                            <div class="position-relative">
                                <span class="input-icon-addon">
                                    <i class="ti ti-mail"></i>
                                </span>
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
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
