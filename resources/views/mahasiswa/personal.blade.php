@extends('masterTemplate')

@section('title', 'Mahasiswa')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<style>
    .profile-img {
        height: 7cm !important;
        width: 100%;
        object-fit: cover;
        object-position: center;
    }

    .profile-img:hover {
        cursor: pointer;
    }

    .img-frame {
        position: relative;
    }

    #edit-image {
        position: absolute;
        bottom: 0;
        font-size: 18px;
        background: rgb(71, 71, 71);
        opacity: 0.8;
        width: 100%;
        text-align: center;
        height: 30px;
        color: #fff;
        cursor: pointer;
    }
</style>
@endsection

@section('main-content')

<div class="container">
    <main id="main">
        @if(session('success'))
        <p class="successMsg" style="display: none">
            {{session('success')}}
        </p>
        @elseif(session('error'))
        <p class="errorMsg" style="display: none">
            {{session('error')}}
        </p>
        @elseif(session('info'))
        <p class="infoMsg" style="display: none">
            {{session('info')}}
        </p>
        @endif
        <div class="card shadow mx-auto my-4">
            <div class="card-header">
                <h1 class="text-center">Data Mahasiswa</h1>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data" id="form-personal">
                    @csrf
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div class="img-frame">
                                @if (env('APP_HOST') == 'heroku')
                                <img src="{{ isset($user->mahasiswa->image) ? json_decode($user->mahasiswa->image)->url : 'https://ik.imagekit.io/prbydmwbm8c/dummy-profile-pic_10R7S25OM.png' }}"
                                    class="profile-img" alt="">
                                @else
                                <img src="{{ isset($user->mahasiswa->image) ? Storage::url('mahasiswa/image/'. $user->mahasiswa->image) : 'https://ik.imagekit.io/prbydmwbm8c/dummy-profile-pic_10R7S25OM.png' }}"
                                    class="profile-img" alt="" width="100%" height="5cm">
                                @endif
                                <div id="edit-image"><strong>Edit Image</strong></div>
                            </div>
                            <input type="file" name="image" class="input-image" style="display: none" accept="image/*">
                            @error('image')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md col-md col-sm-12">
                            <div class="form-group mb-3">
                                <label for="text">NIM<span class="text-danger">*</span></label>
                                <input type="text" disabled name="nama" class="form-control " value="{{ $user->nim }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="text">Nama Lengkap<span class="text-danger">*</span></label>
                                <input type="text" required name="nama"
                                    class="form-control  @error('nama') is-invalid @enderror"
                                    value="{{ old('nama', @$user->mahasiswa->nama) }}">
                                @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="text">Jenis Kelamin<span class="text-danger">*</span></label>
                                <select name="gender" required
                                    class="custom-select form-control @error('gender') is-invalid @enderror">
                                    <option disabled selected>Jenis Kelamin</option>
                                    <option {{ old('gender', @$user->mahasiswa->gender) == "Laki-laki" ? "selected" : ""
                                        }}
                                        value="Laki-laki">Laki-Laki
                                    </option>
                                    <option {{ old('gender', @$user->mahasiswa->gender) == "Perempuan" ? "selected" : ""
                                        }}
                                        value="Perempuan">Perempuan
                                    </option>
                                </select>
                                @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="text">Tempat, Tanggal Lahir<span class="text-danger">*</span></label>
                                <input type="text" required name="ttl"
                                    class="form-control  @error('ttl') is-invalid @enderror"
                                    value="{{ old('ttl', @$user->mahasiswa->ttl) }}">
                                @error('ttl')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="text">Alamat<span class="text-danger">*</span></label>
                        <input type="text" required name="alamat"
                            class="form-control  @error('alamat') is-invalid @enderror"
                            value="{{ old('alamat', @$user->mahasiswa->alamat) }}">
                        @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="text">No. Telepon<span class="text-danger">*</span></label>
                        <input type="text" required name="notlp"
                            class="form-control  @error('notlp') is-invalid @enderror"
                            value="{{ old('notlp', @$user->mahasiswa->notlp) }}">
                        @error('notlp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="text">Jurusan<span class="text-danger">*</span></label>
                        <select name="jurusan" required
                            class="custom-select jurusan form-control @error('jurusan') is-invalid @enderror">
                            <option disabled selected>Pilih Jurusan</option>
                            @foreach ($jurusan as $j)
                            <option {{ old('jurusan', @$user->mahasiswa->jurusan_id) == $j->id ? "selected" : "" }}
                                value="{{ $j->id }}">{{ $j->nama }}
                            </option>
                            @endforeach
                        </select>
                        @error('jurusan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="text">Konsentrasi<span class="text-danger">*</span></label>
                        <select name="konsentrasi" required
                            class="custom-select form-control @error('konsentrasi') is-invalid @enderror konsentrasi">
                            @if(@$konsentrasi)
                            @foreach (@$konsentrasi as $j)
                            <option {{ old('konsentrasi', @$user->mahasiswa->konsentrasi_id) == $j->id ? "selected" : ""
                                }}
                                value="{{ $j->id }}">{{ $j->nama }}
                            </option>
                            @endforeach
                            @endif
                        </select>
                        @error('konsentrasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="detail-konsentrasi" style="display: none">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <h5 class="my-3">Topik : </h5>
                                    <ul class="topik">

                                    </ul>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <h5 class="my-3">Skill : </h5>
                                    <ul class="skill">

                                    </ul>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <h5 class="my-3">Job : </h5>
                                    <ul class="job">

                                    </ul>
                                </div>
                            </div>
                            <input type="hidden" name="syarat" value="">
                            <div class="syarat-list">
                                <h5 class="my-2">Syarat : </h5>
                                <div class="syarat">
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (@$user->mahasiswa->gender)
                    <a href="{{ route('cv.index') }}">
                        <button type="button" class="btn btn-primary">Buat Profile</button>
                    </a>
                    @endif
                    <hr>
                    <h2>Score Quiz: {{ @$user->mahasiswa->score }}</h2>
                    <hr>
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </form>
            </div>
        </div>
    </main>
</div>

@endsection

@section('script')
<script>
    let sukses = $(".successMsg").text();
    let info = $(".infoMsg").text();
    if(sukses !== ''){
        toastr.success(sukses, 'Berhasil!')
    }
    if (info !== '') toastr.info(info, 'Mahasiswa');

    $("#edit-image").click(function(){
        $(".input-image").click()
    })

    $(".input-image").change(function(e){
        let url = URL.createObjectURL(e.target.files[0])
        $(".profile-img").attr("src", url)
    })

    const initJurusan = (value) => {
        let urlKon = `{{ route('mahasiswa.getKonsentrasi', '#id') }}`;
        //ajax request
        $.ajax({
            url: urlKon.replace('#id', value),
            success: function(res){
                if(res.result == 200){
                    jurusan.find('option').remove();
                    res.data.forEach(element => {
                        jurusan.append(new Option(element.nama, element.id))
                    });
                }
            }
        });
    }

    let jurusan = $(".konsentrasi");
    // initJurusan($('.jurusan').val())

    $('.jurusan').change(function(){
        let value = $(this).val();
        initJurusan(value)
    });

    jurusan.change(function(e){
        $('.detail-konsentrasi').hide(300)
        $('.topik').html('')
        $('.skill').html('')
        $('.job').html('')
        $('.syarat').html('')
        $('input[name="syarat"]').val(0)
        let url = `{{ route('mahasiswa.detail.konsentrasi', '#id') }}`
        let id = $(this).val()
        $.ajax({
            url: url.replace('#id', id),
            success: function(res){
                if(res.code == 200){
                    res.data.topik.forEach(topik => {
                        $('.topik').append(`<li>${topik}</li>`)
                    })
                    res.data.skill.forEach(skill => {
                        $('.skill').append(`<li>${skill}</li>`)
                    })
                    res.data.job.forEach(job => {
                        $('.job').append(`<li>${job}</li>`)
                    })
                    res.data.syarat.forEach(syarat => {
                        let badge
                        if(syarat.status == 1) {
                            badge = { code: 'success', text: 'Terpenuhi' }
                            $('input[name="syarat"]').val(0)
                        } 
                        else {
                            badge = { code: 'danger', text: 'Tidak Terpenuhi' }
                            $('input[name="syarat"]').val(1)
                        } 
                        $('.syarat').append(`<h5>${syarat.nama} <span class="ml-3 badge badge-${badge.code}">${badge.text}</span></h5>`)
                    })
                    if(res.data.umum == 0) $('.detail-konsentrasi').show(300)
                }else{
                    alert(res.message)
                }
            }
        })
    })

    $('#form-personal').submit(function(e){
        let cek = $('input[name="syarat"]').val()
        if (cek == 1){
            e.preventDefault()
            toastr.info('Anda tidak bisa memilih konsentrasi tersebut', 'Konsentrasi');
            return false
        }
    })


</script>
@endsection