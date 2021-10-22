<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Profile
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="{{ asset('landing-page/img/favicon.png') }}" rel="icon">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{ asset('profile/css/material-kit.css') }}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('profile/demo/demo.css') }}" rel="stylesheet" />
    <style>
        .profile-img {
            height: 4cm;
            width: 100%;
            object-fit: cover;
            object-position: center;
        }

        .skills .content h3 {
            font-weight: 700;
            font-size: 26px;
            color: #545454;
            font-family: "Poppins", sans-serif;
            margin-bottom: 20px;
        }

        .skills .content ul {
            list-style: none;
            padding: 0;
        }

        .skills .content ul li {
            padding-bottom: 10px;
        }

        .skills .content ul i {
            font-size: 20px;
            padding-right: 4px;
            color: #e96b56;
        }

        .skills .content p:last-child {
            margin-bottom: 0;
        }

        .skills .progress {
            height: 62px;
            display: block;
            background: none;
            border-radius: 0;
        }

        .skills .progress .skill {
            padding: 0;
            margin: 0 0 6px 0;
            text-transform: uppercase;
            display: block;
            font-weight: 600;
            font-family: "Poppins", sans-serif;
            color: #545454;
            text-align: left;
        }

        .skills .progress .skill .val {
            float: right;
            font-style: normal;
        }

        .skills .progress-bar-wrap {
            background: #e0e0e0;
        }

        .skills .progress-bar {
            width: 1px;
            height: 10px;
            transition: .9s;
            background-color: #e96b56;
        }
    </style>
</head>

<body class="profile-page sidebar-collapse">

    <div class="page-header header-filter" data-parallax="true" style="background-image: url('/profile/img/bg.jpg');">
    </div>
    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="row">

                    <div class="profile">
                        <div class="avatar">
                            @if (env('APP_HOST') == 'heroku')
                            <img src="{{ isset($mahasiswa->image) ? json_decode($mahasiswa->image)->url : 'https://ik.imagekit.io/prbydmwbm8c/dummy-profile-pic_10R7S25OM.png' }}"
                                alt="Circle Image" class="img-raised rounded-circle img-fluid profile-img">
                            @else
                            <img src="{{ isset($mahasiswa->image) ? Storage::url('mahasiswa/image/'. $mahasiswa->image) : 'https://ik.imagekit.io/prbydmwbm8c/dummy-profile-pic_10R7S25OM.png' }}"
                                alt="Circle Image" class="img-raised rounded-circle img-fluid profile-img">
                            @endif
                        </div>
                        <div class="name">
                            <h3 class="title" style="margin-bottom: 0px">{{ $mahasiswa->nama }}</h3>
                            <h4 style="margin: 0px">{{ $mahasiswa->konsentrasi->nama }}</h4>
                            <h4 style="margin: 0px">{{ $mahasiswa->alamat }}</h4>
                        </div>
                        <p style="margin-top: 10px">
                            {{ $mahasiswa->detail->deskripsi }}
                        </p>
                    </div>
                </div>

                <br>
            </div>
        </div>
    </div>


    <br>
    <br>


    <div class="main main-raised">
        <div class="section section-basic">
            <div class="container">

                <div class="title">

                    <h3><b>SKILL</b> </h3>
                    <hr style=" display: block; width: 50px; height: 3px;
                     background: #e96b56; bottom: 0; left: calc(50% - 25px)">
                </div>

                <div style="max-width: 100%; text-align: center;">
                    <div class="skills">
                        @if (@$mahasiswa->detail->skill)
                        @foreach (json_decode($mahasiswa->detail->skill) as $item)

                        <div class="progress">
                            <span class="skill">{{ $item->nama }} <i class="val">{{ $item->level }}</i></span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                    aria-valuemax="100" style="width: {{ $item->level }}%;"></div>
                            </div>
                        </div>

                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
    <br>

    <div class="main main-raised">
        <div class="section section-basic">
            <div class="container">

                <div class="title">
                    <H3><b>PENGALAMAN</b></H3>
                    <hr style=" display: block; width: 50px; height: 3px;
                     background: #e96b56; bottom: 0; left: calc(50% - 25px)">
                    @if (@$mahasiswa->detail->pengalaman)
                    @foreach (json_decode($mahasiswa->detail->pengalaman) as $item)
                    <h4 style="padding-left: 15px"><b>{{ $item->nama }}</b></h4>
                    <h4 style="padding-left: 15px" style='margin: 0px'>{{ $item->tahun }}</h4>
                    @if (!$loop->last)
                    <hr style="padding-left: 15px">
                    @endif
                    @endforeach
                    @endif
                </div>

            </div>
        </div>
    </div>

    <br>
    <br>
    <br>

    <div class="main main-raised">
        <div class="section section-basic">
            <div class="container">

                <div class="title">
                    <H3><b>PENDIDIKAN</b></H3>
                    <hr style=" display: block; width: 50px; height: 3px;
                     background: #e96b56; bottom: 0; left: calc(50% - 25px)">
                    @if (@$mahasiswa->detail->pendidikan)
                    @foreach (json_decode($mahasiswa->detail->pendidikan) as $item)
                    <h4 style="padding-left: 15px"><b>{{ $item->nama }}</b></h4>
                    <h4 style="padding-left: 15px" style='margin: 0px'>{{ $item->tahun }}</h4>
                    @if (!$loop->last)
                    <hr style="padding-left: 15px">
                    @endif
                    @endforeach
                    @endif
                </div>
            </div>

        </div>
        <a href="{{ route('nilai.mhs', $mahasiswa->user->nim) }}" class="btn btn-primary ml-3">Lihat Nilai</a>
    </div>

    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('profile/js/core/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('profile/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('profile/js/core/bootstrap-material-design.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('profile/js/plugins/moment.min.js') }}"></script>
    <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="{{ asset('profile/js/plugins/bootstrap-datetimepicker.js') }}" type="text/javascript"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ asset('profile/js/plugins/nouislider.min.js') }}" type="text/javascript"></script>
    <!--  Google Maps Plugin    -->
    <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('profile/js/material-kit.js?v=2.0.7') }}" type="text/javascript"></script>
</body>

</html>