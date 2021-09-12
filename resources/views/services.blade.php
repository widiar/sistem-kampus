@extends('masterTemplate')

@section('title', 'Services')

@section('main-content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Mahasiswa Tingkat Akhir (MTA)</li>
            </ol>
            <h2>Mahasiswa Tingkat Akhir (MTA)</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container">

        <div class="section-title">
            <h2>Mahasiswa Tingkat Akhir (MTA)</h2>

        </div>

        <div class="card shadow mx-auto my-4">
            <div class="card-body">
                <table id="userTable" class="table table-bordered dt-responsive" style="width: 100%">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th class="all">NIM</th>
                            <th class="text-center">Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead> 
            </table> 
            </div>
            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Our Skills Section ======= -->
    <section id="skills" class="skills">
        <div class="container">

            <div class="section-title">
                <h2>Nilai Tertinggi</h2>

            </div>

            <div class="card shadow mx-auto my-4">
            <div class="card-body">
                <table id="adminTable" class="table table-bordered dt-responsive" style="width: 100%">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th class="all">Semester</th>
                            <th class="text-center">Aksi</th>
                            <th>Status</th>
                        </tr>
                    </thead> 
            </table> 
            </div>
            </div>
            

        </div>
    </section><!-- End Our Skills Section -->

</main><!-- End #main -->
@endsection