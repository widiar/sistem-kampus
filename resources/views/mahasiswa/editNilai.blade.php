@extends('masterTemplate')

@section('title', 'Mahasiswa')

@section('main-content')

<div class="container">
    <main id="main">
        <div class="card shadow w-75 mx-auto my-4">
            <div class="card-body">
                <form action="{{ route('mahasiswa.nilai.update', $nilai[0]->semester) }}" method="POST"
                    id="tambahNilai">
                    @csrf
                    @method('PATCH')
                    <div class="form-group mb-3">
                        <label for="text">Semester<span class="text-danger">*</span></label>
                        <input type="text" disabled value="Semester {{ $nilai[0]->semester }}" class="form-control">
                        @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="matakuliah">
                        @foreach ($nilai as $data)
                        <div class="matkul">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="text">Mata Kuliah<span class="text-danger">*</span></label>
                                        <select name="matkul[{{$data->id}}]" required
                                            class="custom-select matkulselected form-control">
                                            @foreach ($matakuliah as $matkul)
                                            <option {{($data->matakuliah_id == $matkul->id) ? 'selected' : ''}}
                                                value="{{ $matkul->id }}">{{ $matkul->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="text">Nilai<span class="text-danger">*</span></label>
                                        <input type="number" required name="nilai[{{$data->id}}]" class="form-control"
                                            value="{{ $data->nilai }}">
                                    </div>
                                </div>
                            </div>
                            @if (!$loop->first)
                            <button type="button" class="btn btn-danger btn-sm mb-3 btn-hapus">Hapus</button><br>
                            @endif
                        </div>
                        @endforeach
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

    $(document).ready(function(){
        $(".matkulselected").select2({
            theme: "bootstrap",
            minimumInputLength: 2, 
        })
    })

    $("#tambahNilai").submit(function(e){
        var values = $(".custom-select").map(function(){return $(this).val();}).get();
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
                delay: 800,
                data: function (params) {
                    var query = {
                        search: params.term,
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