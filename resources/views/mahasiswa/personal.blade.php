@extends('masterTemplate')

@section('title', 'Mahasiswa')

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
        <div class="card shadow w-75 mx-auto my-4">
            <div class="card-header">
                <h1 class="text-center">Data Mahasiswa</h1>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
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
                            <option {{ old('gender', @$user->mahasiswa->gender) == "Laki-laki" ? "selected" : "" }}
                                value="Laki-laki">Laki-Laki
                            </option>
                            <option {{ old('gender', @$user->mahasiswa->gender) == "Perempuan" ? "selected" : "" }}
                                value="Perempuan">Perempuan
                            </option>
                        </select>
                        @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                    <hr>
                    <h2>Score Quiz: {{ @$user->mahasiswa->score }}</h2>
                    <hr>
                    <button type="submit" class="btn btn-primary">Save</button>
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
</script>
@endsection