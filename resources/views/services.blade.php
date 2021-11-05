@extends('masterTemplate')

@section('title', 'List Profile')

@section('main-content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>List Profile Mahasiswa</li>
            </ol>
            <h2>List Profile Mahasiswa</h2>

        </div>
    </section><!-- End Breadcrumbs -->


    <!-- ======= Services Section ======= -->
    <section id="testimonials" class="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <form action="" method="get">
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" class="form-control" name="search" value="{{ Request::get('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                            <a class="btn btn-primary btn-sm" href="{{ route('list.profile') }}"
                                style="margin-left: 10px">Clear</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                @foreach ($mahasiswa as $mhs)
                @if (@$mhs->detail->deskripsi)
                <div class="col-lg-6">
                    <div class="testimonial-item">
                        @if (env('APP_HOST') == 'heroku')
                        <img src="{{ isset($mhs->image) ? json_decode($mhs->image)->url : 'https://ik.imagekit.io/prbydmwbm8c/dummy-profile-pic_10R7S25OM.png' }}"
                            class="testimonial-img profile-img" alt="">
                        @else
                        <img src="{{ isset($mhs->image) ? Storage::url('mahasiswa/image/'. $mhs->image) : 'https://ik.imagekit.io/prbydmwbm8c/dummy-profile-pic_10R7S25OM.png' }}"
                            class="testimonial-img profile-img" alt="">
                        @endif
                        <h3>{{ $mhs->nama }}</h3>
                        <h4 style="padding:10px;">{{ $mhs->konsentrasi->nama }}</h4>
                        <a href="{{ route('profile', $mhs->user->nim) }}" style="background-color:#e96b56; border:none;"
                            type="submit" class="btn btn-primary btn-user btn-block">
                            Lihat profile
                        </a>
                    </div>
                </div>
                @endif
                @endforeach

            </div>
        </div>
    </section>
    <div style="float: right; margin-right: 25px">
        {{ $mahasiswa->withQueryString()->links() }}
    </div>

</main><!-- End #main -->
@endsection