@extends('admin.template.master')

@section('title-content', 'Verifikasi Nilai')

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> BERHASIL!</h5>
    {{session('success')}}
</div>
@elseif(session('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> GAGAL!</h5>
    {{session('error')}}
</div>
@endif
<div class="card shadow">
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
        <hr>
        <h3>Status: <span class="sts badge badge-info"></span></h3>
        <hr>
        <form action="{{ route('admin.mahasiswa.nilai.update') }}" method="POST" id="formUpdate">
            @csrf
            @method('PATCH')
            <input type="hidden" name="semester" value="" id="valSmt">
            <button type="button" class="btn btn-success mt-3 btn-approve" id="approve">Approve</button>
            <button type="button" class="btn btn-danger mt-3 btn-reject" id="reject">Reject</button>
        </form>
    </div>

</div>

@endsection

@section('script')
<script>
    const idMhs = `{{ $mhs->id }}`;
    const urlUpdate = `{{ route('admin.mahasiswa.nilai.update') }}`;

    $(document).ready(function(){
        let smt = $(".tab-link").first().data('id');
        $("#valSmt").val(smt);
        initTableNilai(smt, idMhs)
    })

    $(".btn-approve, .btn-reject").click(function(){
        var name = $(this).attr('id');
        if(name == 'approve'){
            var text = 'Anda akan memverifikasi nilai mahasiswa ini.';
            var berhasil = 'Berhasil memverfikasi nilai mahasiswa';
            status = 1;
        }else{
            var text = 'Anda akan menolak nilai mahasiswa ini.';
            var berhasil = 'Berhasil menolak nilai mahasiswa';
            status = 2;
        }
        Swal.fire({
            title: "Anda Yakin?",
            text: text,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yap!",
        }).then((result) => {
            if (result.isConfirmed){
                $.ajax({
                    type: "PATCH",
                    url: urlUpdate,
                    data: {
                        semester: $("#valSmt").val(),
                        status: status,
                        id: idMhs
                    },
                    success: function (msg) {
                        if (msg == "Sukses") {
                            Swal.fire(
                                "Berhasil!",
                                berhasil,
                                "success"
                            ).then((result) => {
                                if (result.value) {
                                    window.location.href = $(location).attr(
                                        "href"
                                    );
                                }
                            });
                        } else {
                            Swal.fire(
                                "Gagal",
                                msg,
                                "error"
                            );
                        }
                    },
                });
            }
        });
    });
    $(".btn-reject").click(function(){
        // $("#upStatus")val(2)
    });

    $(".tab-link").click(function(){
        $(".tab-link").removeClass('active');
        $(this).addClass('active');
        let smt = $(this).data('id');
        $("#valSmt").val(smt);
        initTableNilai(smt, idMhs)
    });


    function initTableNilai(smt, idMhs){
        urlTable = `{{ route('admin.mahasiswa.getNilai') }}`;
        $("#nilaiTable").dataTable({
            paging: false,
            searching: false,
            destroy: true,
            info: false,
            ajax: {
                url: urlTable,
                type: 'POST',
                data: {
                    id: idMhs,
                    semester: smt
                },
                dataSrc: function(res){
                    var lastClass = $('.sts').attr('class').split(' ').pop();
                    $('.sts').removeClass(lastClass);
                    $(".sts").addClass(res.class);
                    $(".sts").text(res.status);
                    if (res.status != 'Pending') {
                        $(".btn-approve").attr('disabled', 'disabled');
                        $(".btn-reject").attr('disabled', 'disabled');
                    }
                    else {
                        $(".btn-reject").removeAttr('disabled');
                        $(".btn-approve").removeAttr('disabled');
                    }
                    return res.data
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