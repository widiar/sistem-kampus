@extends('masterTemplate')

@section('title', 'Mahasiswa')

@section('main-content')

<div class="container">
    <main id="main">
        <div class="card shadow w-75 mx-auto my-4">
            <div class="card-body" style="margin-bottom: 80px">
                <form action="{{ route('mahasiswa.nilai.store') }}" method="POST" id="tambahNilai">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="text">Semester<span class="text-danger">*</span></label>
                        <select name="semester" required
                            class="custom-select select2 form-control @error('semester') is-invalid @enderror">
                            @foreach ($semester as $smt)
                            <option {{ old('semester')==$smt->id ? "selected" : "" }} value="{{ $smt->id }}">
                                {{ $smt->text }}
                            </option>
                            @endforeach
                        </select>
                        @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="matakuliah">
                        <div class="matkul">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="text">Mata Kuliah<span class="text-danger">*</span></label>
                                        <select name="matkul[]" required
                                            class="custom-select matkulselect form-control">
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="text">Nilai<span class="text-danger">*</span></label>
                                        <input type="number" required name="nilai[]" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary addButton">Add Matkul</button>

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
    initMatkul();
    let sukses = $(".successMsg").text();
    let info = $(".infoMsg").text();
    if(sukses !== ''){
        toastr.success(sukses, 'Berhasil!')
    }
    if (info !== '') toastr.info(info, 'Mahasiswa');

    $(".addButton").click(function(){
        let mat = `
            <div class="matkul">
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-3">
                            <label for="text">Mata Kuliah<span class="text-danger">*</span></label>
                            <select name="matkul[]" required
                                class="custom-select matkulselect form-control">
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-3">
                            <label for="text">Nilai<span class="text-danger">*</span></label>
                            <input type="number" required name="nilai[]" class="form-control">
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-danger btn-sm mb-3 btn-hapus">Hapus</button><br>
            </div>
        `;
        $(".matakuliah").append(mat);
        initMatkul();
    });
    
    $("body").on("click", ".btn-hapus", function(){
         $(this).parent().remove();
    })

    $("#tambahNilai").submit(function(e){
        var values = $("select[name='matkul[]']").map(function(){return $(this).val();}).get();
        var cek = new Set(values);
        // console.log(values.length)
        // console.log(cek.size)
        if(values.length !== cek.size) {
            e.preventDefault();
            toastr.error("Mata Kuliah Tidak Boleh Sama", 'Mata Kuliah!')
            return false
        }
    })


    function initMatkul(){
        var urlGetMatkul = `{{ route('api.matakuliah') }}`;
        $(".matkulselect").select2({
            theme: "bootstrap",
            minimumInputLength: 2,
            ajax: {
                url: urlGetMatkul,
                dataType: 'json',
                delay: 1000,
                data: function (params) {
                    var query = {
                        search: params.term,
                        user_id: `{{ Auth::user()->id }}`
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            }
        });
    }
</script>
@endsection