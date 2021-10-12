<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('landing-page/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('landing-page/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('landing-page/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing-page/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing-page/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('landing-page/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing-page/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing-page/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendor/datatables/responsive.bootstrap4.min.css') }}">

    @yield('css')

    <link href="{{ asset('landing-page/vendor/toastr/toastr.min.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Template Main CSS File -->
    <link href="{{ asset('landing-page/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Eterna - v4.1.0
  * Template URL: https://bootstrapmade.com/eterna-free-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body id="body">

    <section id="topbar" class="d-flex align-items-center" style="background: white">
        {{-- <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a
                        href="mailto:contact@example.com">contact@example.com</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
            </div>
        </div> --}}
    </section>
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex justify-content-between align-items-center">

            <div class="logo">
                <h1><a href="{{ route('home') }}">ITB STIKOM BALI</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="landing-page/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    @guest

                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    @endguest
                    @auth
                    <li class="dropdown"><a href="#"><span>Mahasiswa</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ route('mahasiswa.personal') }}">Personal</a></li>
                            <li><a href="{{ route('mahasiswa.nilai') }}">Input Nilai</a></li>
                            {{-- <li><a href="{{ route('mahasiswa.alumni') }}">Permohonan MTA</a>
                    </li> --}}
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
                </li>
                @endauth
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    @yield('main-content')

    <!-- ======= Footer ======= -->
    <footer id="footer" style="bottom: 0">

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>AW</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Created by <a href="http://ariwidiarsana-portofolio.herokuapp.com/">Ari Widiarsana</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>

    <!-- Vendor JS Files -->
    <script src="{{ asset('landing-page/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landing-page/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('landing-page/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('landing-page/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('landing-page/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('landing-page/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('landing-page/vendor/waypoints/noframework.waypoints.js') }}"></script>

    {{-- Data Tables --}}
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('landing-page/vendor/toastr/toastr.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('admin/vendor/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('landing-page/js/main.js') }}"></script>

    <script>
        $("#userTable").dataTable({
            // paging: false,
            // searching: false,
            // columnDefs: [{ orderable: false, targets: 5 }],
        });
        $(".select2").select2({
            theme: "bootstrap",
        });

        $(function() {
            bsCustomFileInput.init();
        }); 

        $(document).ready(function() {
            // Check if body height is higher than window height :)
            if ($("body").height() > $(window).height()) {
                $("#footer").css("position", "unset")
            }else{
                $("#footer").css("position", "fixed")
            }
        });
    </script>


    @yield('script')

</body>

</html>