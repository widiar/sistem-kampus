@extends('masterTemplate')

@section('main-content')
<!-- ======= Hero Section ======= -->
<section id="hero">
    <div class="hero-container">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

            <div class="carousel-inner" role="listbox">

                <!-- Slide 1 -->
                <div class="carousel-item active" style="background: url(landing-page/img/slide/slide-1.jpg)">
                    <div class="carousel-container">
                        <div class="carousel-content">
                            <h2 class="animate__animated animate__fadeInDown">ITB STIKOM BALI</h2>
                            <p class="animate__animated animate__fadeInUp">Institut Teknologi dan Bisnis (ITB) STIKOM
                                Bali merupakan
                                salah satu perguruan tinggi swasta yang bertempat di Bali dan bergerak pada
                                bidang pengajaran Teknologi dan Bisnis dengan berbagai penghargaan dan prestasi
                                yang dimiliki baik tingkat nasional maupun tingkat internasional.
                                Institut Teknologi dan Bisnis (ITB) STIKOM Bali merupakan salah satu kampus IT di
                                Bali yang berhasil menghasilkan lulusan lulusan dengan kualitas terbaik dan berguna
                                untuk masyarakat. </p>

                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item" style="background: url(landing-page/img/slide/slide-2.jpg)">
                    <div class="carousel-container">
                        <div class="carousel-content">
                            <h2 class="animate__animated fanimate__adeInDown">Sistem Informasi<span> Mahasiswa
                                    Online</span></h2>
                            <p class="animate__animated animate__fadeInUp">Selamat datang di Sistem Informasi Mahasiswa
                                Online ITB Stikom Bali.
                                Sistem Informasi Mahasiswa Online ITB Stikom Bali adalah sistem informasi yang dibangun
                                dengan tujuan membantu Mahasiswa ITB Stikom Bali</p>

                        </div>
                    </div>
                </div>

            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        </div>
    </div>
</section><!-- End Hero -->

<section id="featured" class="featured">
    <div class="container testimonials">
        <div class="section-title">
            <h2>Profile</h2>
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

                <a style="text-align: right; color:#2e59d9;"
                    href="{{ route('list.profile') }}">Selengkapnya>></a><br><br>
            </div>

        </div>
    </div>

    <div class="container testimonials">
        <div class="section-title">
            <h2>Top 5 Nilai A Terbanyak</h2>
            <div class="row">

                @foreach ($nilai as $mhs)
                @if ($mhs->gender && $mhs->nilai_a > 0)
                <div class="col-lg-6">
                    <div class="testimonial-item">
                        @if (env('APP_HOST') == 'heroku')
                        <img src="{{ isset($mhs->image) ? json_decode($mhs->image)->url : 'https://ik.imagekit.io/prbydmwbm8c/dummy-profile-pic_10R7S25OM.png' }}"
                            class="testimonial-img profile-img" alt="">
                        @else
                        <img src="{{ isset($mhs->image) ? Storage::url('mahasiswa/image/'. $mahasiswa->image) : 'https://ik.imagekit.io/prbydmwbm8c/dummy-profile-pic_10R7S25OM.png' }}"
                            class="testimonial-img profile-img" alt="">
                        @endif
                        <h3>{{ $mhs->nama }}</h3>
                        <a href="{{ route('profile', $mhs->nim) }}" style="background-color:#e96b56; border:none;"
                            type="submit" class="btn btn-primary btn-user btn-block">
                            Lihat profile
                        </a>
                    </div>
                </div>
                @endif
                @endforeach

            </div>

        </div>
    </div>
</section>


</div>
<main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="section-title">
                <h2>About Us</h2>
                <p>Sistem Informasi Mahasiswa Online adalah sistem yang dibangun dengan tujuan membantu mahasiswa untuk
                    melihat kemampuannya
                    dan mengambil keputusan berdasarkan kemampuan yang dimiliki mahasiswa tersebut.
                    Dengan dirancangnya sistem ini diharapkan sistem dapat digunakan dalam pengimplementasian
                    bagian kemahasiswaan pada Institut Teknologi dan Bisnis (ITB) STIKOM Bali Kampus II Jimbaran
                    sehingga
                    dapat membantu dan memudahkan mahasiswa dalam melakukan pemilihan konsentrasi, pemilihan judul
                    skripsi, serta memudahkan alumni dalam pencarian lowong pekerjaan.</p>
            </div>

        </div>
    </section><!-- End About Section -->






</main><!-- End #main -->
@endsection

@section('title', 'Home')