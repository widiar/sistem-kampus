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
            <form action="" method="get">
                <div class="input-group input-group-sm mb-3 w-50">
                    <input type="text" class="form-control" name="search" value="{{ Request::get('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                    <a class="btn btn-primary btn-sm" href="{{ route('list.profile') }}"
                        style="margin-left: 50px">Clear</a>
                </div>
            </form>

            <div class="row">
                @foreach ($mahasiswa as $mhs)
                <div class="col-lg-6">
                    <div class="testimonial-item">
                        @if (env('APP_HOST') == 'heroku')
                        <img src="{{ isset($mhs->image) ? json_decode($mhs->image)->url : 'https://www.sman8denpasar.sch.id/wp-content/uploads/learn-press-profile/4/172522ec1028ab781d9dfd17eaca4427.jpg' }}"
                            class="testimonial-img" alt="">
                        @else
                        <img src="{{ isset($mhs->image) ? Storage::url('mahasiswa/image/'. $mahasiswa->image) : 'https://www.sman8denpasar.sch.id/wp-content/uploads/learn-press-profile/4/172522ec1028ab781d9dfd17eaca4427.jpg' }}"
                            class="testimonial-img" alt="">
                        @endif
                        <h3>{{ $mhs->nama }}</h3>
                        <h4 style="padding:10px;">{{ $mhs->konsentrasi->nama }}</h4>
                        <a href="{{ route('profile', $mhs->id) }}" style="background-color:#e96b56; border:none;"
                            type="submit" class="btn btn-primary btn-user btn-block">
                            Lihat profile
                        </a>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    <div style="float: right; margin-right: 25px">
        {{ $mahasiswa->withQueryString()->links() }}
    </div>

</main><!-- End #main -->
@endsection