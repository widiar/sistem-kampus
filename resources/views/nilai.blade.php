@extends('masterTemplate')

@section('title', 'Mahasiswa')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
@endsection

@section('main-content')

<div class="card shadow mx-auto w-75">
    <div class="card-body">
        <ul class="nav nav-tabs my-3">
            @foreach ($nilai as $n)
            <li class="nav-item">
                <a class="nav-link tab-link @if($loop->first) active @endif" data-id="{{ $n->semester }}"
                    data-toggle="tab" href="#">Semester
                    {{$n->semester}}</a>
            </li>
            @endforeach
        </ul>
        <table id="nilaiTable" class="table table-bordered nowrap dt-responsive mx-auto" style="width: 80%">
            <thead>
                <tr>
                    <th>Mata Kuliah</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

</div>

@endsection

@section('script')
<script>
    const idMhs = `{{ $mhs->id }}`;

    $(document).ready(function(){
        let smt = $(".tab-link").first().data('id');
        $("#valSmt").val(smt);
        initTableNilai(smt, idMhs)
    })

    $(".tab-link").click(function(){
        $(".tab-link").removeClass('active');
        $(this).addClass('active');
        let smt = $(this).data('id');
        $("#valSmt").val(smt);
        initTableNilai(smt, idMhs)
    });


    function initTableNilai(smt, idMhs){
        urlTable = `{{ route('api.nilai') }}`;
        $("#nilaiTable").dataTable({
            paging: false,
            searching: false,
            destroy: true,
            info: false,
            ajax: {
                url: urlTable,
                type: 'GET',
                data: {
                    id: idMhs,
                    semester: smt
                },
                dataSrc: function(res){
                    console.log(res)
                    return res
                }
            },
            columns: [
                {data: "matkul"},
                {data: "nilai"},
            ]
        });
    }
</script>
@endsection