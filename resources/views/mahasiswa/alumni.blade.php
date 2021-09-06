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
                <h1 class="text-center">Upload CV</h1>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">CV</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="cv"
                                    class="file custom-file-input @error('cv') is-invalid @enderror" id="cv"
                                    value="{{ old('cv') }}" accept="application/pdf">
                                <label class="custom-file-label" for="image">
                                    <span class="d-inline-block text-truncate w-75">Browse File</span>
                                </label>
                                @error("cv")
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input-group-append ml-3">
                                <a href="{{ route('cv.index') }}">
                                    <button type="button" class="btn btn-info">Buat CV</button>
                                </a>
                            </div>
                        </div>
                        @isset($user->mahasiswa->cv)
                        <a href="{{ Storage::url('mahasiswa/cv/' . $user->mahasiswa->cv) }}" target="_blank">
                            <small class="text-info">Lihat CV</small>
                        </a>
                        @endisset
                        <small id="exampleInputFile" class="form-text text-muted">upload format file .pdf
                            max 5mb.</small>
                    </div>
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