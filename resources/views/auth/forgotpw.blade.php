@extends('auth.template')


@section('title', 'Reset Password')

@section('content')
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Fogot Password!</h1>
                            </div>
                            <form class="user" method="POST" action="">
                                @csrf
                                @if(session('status'))
                                <div class="alert alert-danger">
                                    {{ session('status') }}
                                </div>
                                @endif
                                @if(session('statussukses'))
                                <div class="alert alert-success">
                                    {{ session('statussukses') }}
                                </div>
                                @endif
                                @if(session('warning'))
                                <div class="alert alert-warning warning">
                                    {{ session('warning') }}
                                </div>
                                @endif
                                <div class="form-group">
                                    <input type="email" name="email"
                                        class="form-control form-control-user @error('email') is-invalid @enderror"
                                        placeholder="Enter Email..." value="{{ old('email') }}">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Send Email
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