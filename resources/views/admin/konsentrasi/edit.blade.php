@extends('admin.template.master')

@section('title-content', 'Edit Konsentrasi')

@section('content')

<form action="{{ route('admin.konsentrasi.update', $konsentrasi->id) }}" method="POST" id="form-konsentrasi">
    @csrf
    @method('PATCH')
    <div class="card shadow">
        <div class="card-body">
            <div class="form-group">
                <label for="text">Nama Konsentrasi<span class="text-danger">*</span></label>
                <input type="text" required name="konsentrasi"
                    class="form-control  @error('konsentrasi') is-invalid @enderror"
                    value="{{ old('konsentrasi', $konsentrasi->nama) }}">
                @error('konsentrasi')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="text">Jurusan<span class="text-danger">*</span></label>
                <select name="jurusan" class="form-control select2">
                    @foreach ($jurusan as $jur)
                    <option {{ ($jur->id == $konsentrasi->jurusan_id) ? 'selected':'' }} value="{{ $jur->id }}">
                        {{ $jur->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="skill-list">
                <div class="skill">
                    <div class="form-group mb-3">
                        <label for="text">Skill<span class="text-danger">*</span></label>
                        <select name="skill[]" multiple="multiple" required
                            class="custom-select select-multi form-control">
                            @if($konsentrasi->skill)
                            @foreach(json_decode($konsentrasi->skill) as $skill)
                            <option selected value="{{ $skill }}">{{ $skill }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="job-list">
                <div class="job">
                    <div class="form-group mb-3">
                        <label for="text">Job<span class="text-danger">*</span></label>
                        <select name="job[]" multiple="multiple" required
                            class="custom-select select-multi form-control">
                            @if($konsentrasi->job)
                            @foreach(json_decode($konsentrasi->job) as $job)
                            <option selected value="{{ $job }}">{{ $job }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="topik-list">
                <div class="topik">
                    <div class="form-group mb-3">
                        <label for="text">Topik<span class="text-danger">*</span></label>
                        <select name="topik[]" multiple="multiple" required
                            class="custom-select select-multi form-control">
                            @if($konsentrasi->topik)
                            @foreach(json_decode($konsentrasi->topik) as $topik)
                            <option selected value="{{ $topik }}">{{ $topik }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="matakuliah">
                @if($konsentrasi->syarat)
                @foreach(json_decode($konsentrasi->syarat) as $syarat)
                <div class="matkul">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="text">Mata Kuliah<span class="text-danger">*</span></label>
                                <select name="matkul[]" required class="custom-select matkulselected form-control">
                                    @foreach ($matakuliah as $matkul)
                                    <option {{($syarat->id == $matkul->id) ? 'selected' : ''}}
                                        value="{{ $matkul->id }}">{{ $matkul->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="text">Minimal Nilai<span class="text-danger">*</span></label>
                                <input type="number" required name="nilai[]" class="form-control"
                                    placeholder="Dalam angka" value="{{ $syarat->nilai }}">
                            </div>
                        </div>
                    </div>
                    @if (!$loop->first)
                    <button type="button" class="btn btn-danger btn-sm mb-3 btn-hapus">Hapus</button><br>
                    @endif
                </div>
                @endforeach
                @else
                <div class="matkul">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="text">Mata Kuliah<span class="text-danger">*</span></label>
                                <select name="matkul[]" required class="custom-select matkulselect form-control">
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="text">Minimal Nilai<span class="text-danger">*</span></label>
                                <input type="number" required name="nilai[]" class="form-control"
                                    placeholder="Dalam angka">
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <button type="button" class="btn btn-primary addButton">Add Matkul</button>
            <button type="submit" class="btn btn-primary float-right">Save</button>
        </div>

    </div>
</form>

@endsection

@section('script')
<script>
    const initMatkul = () => {
        let urlGetMatkul = `{{ route('api.matakuliah') }}`;
        $(".matkulselect").select2({
            theme: "bootstrap",
            minimumInputLength: 2,
            ajax: {
                url: urlGetMatkul,
                dataType: 'json',
                delay: 800,
                data: function (params) {
                    let query = {
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

    $('.select-multi').select2({
        tags: true
    })

    $('.matkulselected').select2({
        theme: "bootstrap",
        minimumInputLength: 2,
    })

    initMatkul()

    $(".addButton").click(function(){
        const mat = `
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
                            <input type="number" required name="nilai[]" class="form-control" placeholder="Dalam angka">
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-danger btn-sm mb-3 btn-hapus">Hapus</button><br>
            </div>
        `;
        $(".matakuliah").append(mat);
        initMatkul();
    });

    $('body').on('click', '.btn-hapus', function(){
        $(this).parent().remove()
    })

    $("#form-konsentrasi").submit(function(e){
        var values = $("select[name='matkul[]']").map(function(){return $(this).val();}).get();
        var cek = new Set(values);
        if(values.length !== cek.size) {
            e.preventDefault();
            toastr.error("Mata Kuliah Tidak Boleh Sama", 'Mata Kuliah!')
            return false
        }
    })
</script>
@endsection