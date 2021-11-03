@extends('auth.template')


@section('title', 'Reset Password')

@section('content')
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg" style="margin-top: 15%">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Reset Password!</h1>
                            </div>
                            <form class="user" method="POST" action="">
                                @csrf
                                @if(session('status'))
                                <div class="alert alert-danger">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <div class="form-group">
                                    <input type="password" name="password"
                                        class="form-control form-control-user @error('password') is-invalid @enderror"
                                        placeholder="Enter password..." value="{{ old('password') }}">
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirmPassword"
                                        class="form-control form-control-user @error('confirmPassword') is-invalid @enderror"
                                        placeholder="Enter confirm password...">
                                    @error('confirmPassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Reset Password
                                </button>
                                <hr>
                            </form>
                            {{-- <div class="text-center">
                                <a class="small" href="#">Forgot Password?</a>
                            </div> --}}
                            <div class="text-center">
                                <a class="small" href="{{ route('register') }}">Buat Akun Baru!</a>
                                <br>
                                <a class="small" href="{{ route('login') }}">Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection