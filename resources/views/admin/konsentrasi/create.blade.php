@extends('admin.template.master')

@section('title-content', 'Tambah Konsentrasi')

@section('content')

<form action="{{ route('admin.konsentrasi.store') }}" method="POST" id="form-konsentrasi">
    @csrf
    <div class="card shadow">
        <div class="card-body">
            <div class="form-group">
                <label for="text">Nama Konsentrasi<span class="text-danger">*</span></label>
                <input type="text" required name="konsentrasi"
                    class="form-control  @error('konsentrasi') is-invalid @enderror"
                    value="{{ old('konsentrasi', @$konsentrasi->nama) }}">
                @error('konsentrasi')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="text">Jurusan<span class="text-danger">*</span></label>
                <select name="jurusan" class="form-control select2">
                    @foreach ($jurusan as $jur)
                    <option value="{{ $jur->id }}">{{ $jur->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="umum" id="umum">
                <label class="form-check-label" for="umum">
                    Umum
                </label>
            </div>
            <div class="prasyarat">
                <div class="skill-list">
                    <div class="skill">
                        <div class="form-group mb-3">
                            <label for="text">Skill<span class="text-danger">*</span></label>
                            <select name="skill[]" multiple="multiple" required
                                class="custom-select select-multi form-control">

                            </select>
                        </div>
                    </div>
                </div>
                {{-- <button type="button" class="btn btn-primary addSkillButton mb-3">Add Skill</button> --}}
                <div class="job-list">
                    <div class="job">
                        <div class="form-group mb-3">
                            <label for="text">Job<span class="text-danger">*</span></label>
                            <select name="job[]" multiple="multiple" required
                                class="custom-select select-multi form-control">

                            </select>
                        </div>
                    </div>
                </div>
                {{-- <button type="button" class="btn btn-primary addJobButton mb-3">Add Job</button> --}}
                <div class="topik-list">
                    <div class="topik">
                        <div class="form-group mb-3">
                            <label for="text">Topik<span class="text-danger">*</span></label>
                            <select name="topik[]" multiple="multiple" required
                                class="custom-select select-multi form-control">

                            </select>
                        </div>
                    </div>
                </div>
                {{-- <button type="button" class="btn btn-primary mb-3 addTopikButton">Add Topik</button> --}}
                <div class="matakuliah">
                    <div class="matkul">
                        <div class="row">
                            <div class="col-lg-6 col-xs-12">
                                <div class="form-group mb-3">
                                    <label for="text">Mata Kuliah<span class="text-danger">*</span></label>
                                    <select name="matkul[]" required class="custom-select matkulselect form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12">
                                <div class="form-group mb-3">
                                    <label for="text">Minimal Nilai<span class="text-danger">*</span></label>
                                    <input type="number" required name="nilai[]" class="form-control"
                                        placeholder="Dalam angka">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary addButton">Add Matkul</button>
            </div>
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
            width: '100%',
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
        tags: true,
        width: '100%'
    })

    initMatkul()

    $('#umum').change(function(){
        if($('#umum').is(':checked')){
            $('.prasyarat').hide(300)
            $('.prasyarat').find('select').removeAttr('required')
            $('.prasyarat').find('input').removeAttr('required')
        }else{
            $('.prasyarat').show(300)
            $('.prasyarat').find('select').attr('required', 'required')
            $('.prasyarat').find('input').attr('required', 'required')
        }
    })

    // $('.addSkillButton').click(function(){
    //     const element = `
    //         <div class="skill">
    //             <div class="form-group mb-3">
    //                 <label for="text">Skill<span class="text-danger">*</span></label>
    //                 <input name="skill[]" required class="form-control">
    //             </div>
    //             <button type="button" class="btn btn-danger btn-sm mb-3 btn-hapus">Hapus</button><br>
    //         </div>
    //     `
    //     $('.skill-list').append(element)
    // })

    // $('.addTopikButton').click(function(){
    //     const element = `
    //         <div class="topik">
    //             <div class="form-group mb-3">
    //                 <label for="text">Topik<span class="text-danger">*</span></label>
    //                 <input name="topik[]" required class="form-control">
    //             </div>
    //             <button type="button" class="btn btn-danger btn-sm mb-3 btn-hapus">Hapus</button><br>
    //         </div>
    //     `
    //     $('.topik-list').append(element)
    // })

    // $('.addJobButton').click(function(){
    //     const element = `
    //         <div class="job">
    //             <div class="form-group mb-3">
    //                 <label for="text">Job<span class="text-danger">*</span></label>
    //                 <input name="job[]" required class="form-control">
    //             </div>
    //             <button type="button" class="btn btn-danger btn-sm mb-3 btn-hapus">Hapus</button><br>
    //         </div>
    //     `
    //     $('.job-list').append(element)
    // })

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