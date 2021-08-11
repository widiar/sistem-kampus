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
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            <img src="https://www.sman8denpasar.sch.id/wp-content/uploads/learn-press-profile/4/172522ec1028ab781d9dfd17eaca4427.jpg"
                                class="img-thumbnail" alt="">
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                        value="email@example.com">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword">
                                </div>
                            </div>
                        </div>
                    </div>
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