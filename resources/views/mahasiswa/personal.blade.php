@extends('masterTemplate')

@section('title', 'Mahasiswa')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<style>
    .profile-img {
        height: 7cm;
        width: 100%;
        object-fit: cover;
        object-position: center;
    }

    .profile-img:hover {
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
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            @if (env('APP_HOST') == 'heroku')
                            <img src="{{ isset($user->mahasiswa->image) ? json_decode($user->mahasiswa->image)->url : 'https://www.sman8denpasar.sch.id/wp-content/uploads/learn-press-profile/4/172522ec1028ab781d9dfd17eaca4427.jpg' }}"
                                class="img-thumbnail profile-img" alt="">
                            @else
                            <img src="{{ isset($user->mahasiswa->image) ? Storage::url('mahasiswa/image/'. $user->mahasiswa->image) : 'https://www.sman8denpasar.sch.id/wp-content/uploads/learn-press-profile/4/172522ec1028ab781d9dfd17eaca4427.jpg' }}"
                                class="img-thumbnail profile-img" alt="">
                            @endif
                            <input type="file" name="image" class="input-image" style="display: none"
                                accept="image/x-png, image/jpeg">
                            @error('image')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col">
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
                                    <option selected>Jenis Kelamin</option>
                                    <option
                                        {{ old('gender', @$user->mahasiswa->gender) == "Laki-laki" ? "selected" : "" }}
                                        value="Laki-laki">Laki-Laki
                                    </option>
                                    <option
                                        {{ old('gender', @$user->mahasiswa->gender) == "Perempuan" ? "selected" : "" }}
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
                            class="custom-select form-control @error('jurusan') is-invalid @enderror">
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

    $(".profile-img").click(function(){
        $(".input-image").click()
    })

</script>
@endsection