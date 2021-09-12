@extends('masterTemplate')

@section('title', 'About')

@section('main-content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>About Us</li>
            </ol>
            <h2>About Us</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
        <div class="container">

            <div class="section-title">
                <h2>About Us</h2>
                <p>Sistem Informasi Mahasiswa Online adalah sistem yang dibangun dengan tujuan membantu mahasiswa untuk melihat kemampuannya
                     dan mengambil keputusan berdasarkan kemampuan yang dimiliki mahasiswa tersebut. 
                     Dengan dirancangnya sistem ini diharapkan sistem dapat digunakan dalam pengimplementasian 
                     bagian kemahasiswaan pada Institut Teknologi dan Bisnis (ITB) STIKOM Bali Kampus II Jimbaran sehingga 
                     dapat membantu dan memudahkan mahasiswa dalam melakukan pemilihan konsentrasi, pemilihan judul skripsi, serta memudahkan alumni dalam pencarian lowong pekerjaan.</p><br>
            </div>

            <div class="row">

                <div class="col-lg-6">
                    <div class="testimonial-item">
                        <img src="landing-page/img/testimonials/yuda.jpeg" class="testimonial-img" alt="">
                        <h3>Kadek Yuda Perwira Intaran</h3>
                        <h4>Sistem Informasi</h4>
                        <p>
                            Saya Kadek Yuda Perwira Intaran mahasiswa ITB Stikom Bali Kampus Jimbaran
                            angkatan 18 dengan NIM 180030017
                            
                        </p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="testimonial-item mt-4 mt-lg-0">
                        <img src="landing-page/img/testimonials/yogi.jpg" class="testimonial-img" alt="">
                        <h3>I Kadek Yogi Wiguna</h3>
                        <h4>Sistem Informasi</h4>
                        <p>
                            Saya I Kadek Yogi Wiguna mahasiswa ITB Stikom Bali Kampus Jimbaran
                            angkatan 18 dengan NIM 180030677
                            
                        </p>
                    </div>
                </div>

               

            </div>

        </div>
    </section><!-- End Testimonials Section -->

</main><!-- End #main -->
@endsection