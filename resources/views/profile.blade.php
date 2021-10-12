<!--
=========================================================
Material Kit - v2.0.7
=========================================================

Product Page: https://www.creative-tim.com/product/material-kit
Copyright 2020 Creative Tim (https://www.creative-tim.com/)

Coded by Creative Tim

=========================================================

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
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
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{ asset('profile/css/material-kit.css?v=2.0.7') }}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('profile/demo/demo.css') }}" rel="stylesheet" />
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
                            <img src="{{ isset($mahasiswa->image) ? json_decode($mahasiswa->image)->url : asset('profile/img/faces/christian.jpg') }}"
                                alt="Circle Image" class="img-raised rounded-circle img-fluid">
                            @else
                            <img src="{{ isset($mahasiswa->image) ? Storage::url('mahasiswa/image/'. $mahasiswa->image) : asset('profile/img/faces/christian.jpg') }}"
                                alt="Circle Image" class="img-raised rounded-circle img-fluid">
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
                    @if (@$mahasiswa->detail->skill)
                    @foreach (explode("|", $mahasiswa->detail->skill) as $item)
                    @if (!$loop->last)
                    <span class="badge badge-pill badge-secondary">{{$item}}</span>
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