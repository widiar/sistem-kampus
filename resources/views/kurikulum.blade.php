@extends('masterTemplate')

@section('title', 'About')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
@endsection

@section('main-content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Kurikulum</li>
            </ol>
            <h2>Kurikulum</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Testimonials Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="container">

                <div class="row">
                    <div class="col-lg-6">
                        <img src="https://ik.imagekit.io/prbydmwbm8c/logo-sampul-resmi_HYevhiBIQ.PNG" class="img-fluid"
                            alt="">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content">
                        <h3>Kurikulum yang dipakai adalah kurikulum 2018.</h3>
                        <p class="fst">
                            Jurusan yang tersedia:
                        </p>
                        <ul>
                            @foreach ($jurusan as $jur)
                            <li>
                                <i class="bi bi-check-circle"></i> {{ $jur->nama }}.
                                <h5 style="margin-bottom: 0"><span class="badge badge-success"
                                        style="background-color: #e96b56">Konsentrasi</span></h5>
                                @foreach ($jur->konsentrasi as $item)
                                <ul style="margin-left: 30px">
                                    <li><i class="bi bi-check-square"></i> {{ $item->nama }}.</li>
                                </ul>
                                @endforeach
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

            <section id="clients" class="clients" style="margin-top: 100px">
                <div class="container">

                    <div class="section-title mb-5">
                        <h2>Matakuliah</h2>
                        <p>Matakuliah yang tersedia pada kurikulum 2018 di ITB Stikom Bali Kampus Jimbaran.
                        </p>
                    </div>

                    <div class="content">
                        <table id="tables" class="table table-bordered dt-responsive" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th class="all">Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no=0;
                                @endphp
                                @if (!is_null($matakuliah))
                                @foreach ($matakuliah as $data)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $data->nama }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </section>

        </div>
    </section><!-- End Testimonials Section -->

</main><!-- End #main -->
@endsection

@section('script')
<script>
    $('#tables').dataTable()
</script>
@endsection