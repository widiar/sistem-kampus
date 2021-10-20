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
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            @if (env('APP_HOST') == 'heroku')
                            <img src="{{ isset($mahasiswa->image) ? json_decode($mahasiswa->image)->url : 'https://ik.imagekit.io/prbydmwbm8c/dummy-profile-pic_10R7S25OM.png' }}"
                                class="img-thumbnail profile-img" alt="">
                            <input type="hidden" name="profile_img"
                                value="{{ isset($mahasiswa->image) ? json_decode($mahasiswa->image)->url : 'https://ik.imagekit.io/prbydmwbm8c/dummy-profile-pic_10R7S25OM.png' }}">
                            @else
                            <img src="{{ isset($mahasiswa->image) ? Storage::url('mahasiswa/image/'. $mahasiswa->image) : 'https://ik.imagekit.io/prbydmwbm8c/dummy-profile-pic_10R7S25OM.png' }}"
                                class="img-thumbnail profile-img" alt="">
                            <input type="hidden" name="profile_img"
                                value="{{ isset($mahasiswa->image) ? env('APP_URL') . Storage::url('mahasiswa/image/'. $mahasiswa->image) : 'https://ik.imagekit.io/prbydmwbm8c/dummy-profile-pic_10R7S25OM.png' }}">
                            @endif
                        </div>
                        <div class="col">
                            <div class="form-group row mb-3">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" readonly
                                        value="{{ $mahasiswa->nama }}">
                                    <input type="hidden" name="nama" value="{{ $mahasiswa->nama }}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" readonly
                                        value="{{ $mahasiswa->gender }}">
                                    <input type="hidden" name="gender" value="{{ $mahasiswa->gender }}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Tempat Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" readonly
                                        value="{{ $mahasiswa->ttl }}">
                                    <input type="hidden" name="ttl" value="{{ $mahasiswa->ttl }}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" readonly
                                        value="{{ $mahasiswa->alamat }}">
                                    <input type="hidden" name="alamat" value="{{ $mahasiswa->alamat }}">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="" class="col-sm-3 col-form-label">No Telepon</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" readonly
                                        value="{{ $mahasiswa->notlp }}">
                                    <input type="hidden" name="notlp" value="{{ $mahasiswa->notlp }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">Deskriprsi</label>
                        <textarea required name="deskripsi" class="form-control" cols="30"
                            rows="10">{{ @$mahasiswa->detail->deskripsi }}</textarea>
                    </div>
                    <hr>
                    <div class="skills">
                        <h4>Skill :</h4>
                        @if (@$mahasiswa->detail->skill)
                        @foreach (json_decode($mahasiswa->detail->skill) as $item)
                        <div class="skill">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" required name="skill[]" value="{{ $item->nama }}"
                                            class="form-control" placeholder="Skill">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="number" required min="0" max="100" name="skl[]"
                                            value="{{ $item->level }}" class="form-control"
                                            placeholder="Progress bar (%)">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm my-3 btn-hapus">Hapus</button><br>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn btn-primary btn-sm btn-add-skill">Tambah</button>
                    <hr>

                    <div class="experiences">
                        <h4>Pengalaman :</h4>
                        @if (@$mahasiswa->detail->pengalaman)
                        @foreach (json_decode($mahasiswa->detail->pengalaman) as $item)
                        <div class="experience">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" required name="exp[]" value="{{ $item->nama }}"
                                            class="form-control" placeholder="Nama Pengalaman">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" required name="year[]" value="{{ $item->tahun }}"
                                            class="form-control" placeholder="cth: 06/2000-07/2021">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm my-3 btn-hapus">Hapus</button><br>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn btn-primary btn-sm btn-add-exp">Tambah</button>
                    <hr>

                    <div class="schools">
                        <h4>Pendidikan :</h4>
                        @if (@$mahasiswa->detail->pendidikan)
                        @foreach (json_decode($mahasiswa->detail->pendidikan) as $item)
                        <div class="school">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" required name="sch[]" value="{{ $item->nama }}"
                                            class="form-control" placeholder="Pendidikan">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" required name="tahun[]" value="{{ $item->tahun }}"
                                            class="form-control" placeholder="Tahun">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm my-3 btn-hapus">Hapus</button><br>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn btn-primary btn-sm btn-add-sch">Tambah</button>

                    <hr>
                    <button type="submit" class="my-3 btn btn-success btn-block">Buat Profile</button>
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

    $(document).ready(function(){
        let skill = `<div class="skill">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" required name="skill[]" class="form-control" placeholder="Skill">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="number" required name="skl[]" min="0" max="100" class="form-control" placeholder="Progress bar (%)">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm my-3 btn-hapus">Hapus</button><br>
                    </div>`;

        let exp = `<div class="experience">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" required name="exp[]" class="form-control" placeholder="Nama Pengalaman">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" required name="year[]" class="form-control" placeholder="cth: 06/2000-07/2021">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm my-3 btn-hapus">Hapus</button><br>
                    </div>`;

        let sch = `<div class="school">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" required name="sch[]" class="form-control" placeholder="Pendidikan">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" required name="tahun[]" class="form-control" placeholder="Tahun">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm my-3 btn-hapus">Hapus</button><br>
                    </div>`;

        $(".btn-add-skill").click(function(){
            $(".skills").append(skill);
        });
        $(".btn-add-exp").click(function(){
            $(".experiences").append(exp);
        })
        $(".btn-add-sch").click(function(){
            $(".schools").append(sch);
        })

        $("body").on("click", ".btn-hapus", function(){
            $(this).parent().remove();
        });
    });
</script>
@endsection