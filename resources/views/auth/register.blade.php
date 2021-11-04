@extends('auth.template')

@section('title', 'Register')

@section('content')
<div class="card o-hidden border-0 shadow-lg" style="margin-top: 5%">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru!</h1>
                    </div>
                    <form class="user" action="" method="POST">
                        @csrf
                        @if(session('status'))
                        <div class="alert alert-success sukses">
                            {{ session('status') }}
                        </div>
                        @endif
                        @if(session('err'))
                        <div class="alert alert-danger gagal">
                            {{ session('err') }}
                        </div>
                        @endif
                        <div class="form-group">
                            <input type="text" name="nim"
                                class="form-control form-control-user @error('nim') is-invalid @enderror"
                                placeholder="Input NIM" value="{{ old('nim') }}">
                            @error('nim')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="email" name="email"
                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                placeholder="Email Address" value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" name="password"
                                    class="form-control form-control-user @error('password') is-invalid @enderror"
                                    placeholder="Password">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <input type="password" name="password2" class="form-control form-control-user"
                                    placeholder="Repeat Password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Buat Akun
                        </button>
                        <hr>
                    </form>
                    {{-- <div class="text-center">
                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                    </div> --}}
                    <div class="text-center">
                        <a class="small" href="{{ route('login') }}">Sudah Punya Akun? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection