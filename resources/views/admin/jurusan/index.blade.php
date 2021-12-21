@extends('admin.template.master')

@section('title-content')
<h1 class="h3 mb-0 text-gray-800">Jurusan<span class="badge" style="cursor: pointer" data-toggle="modal"
        data-target="#exampleModal"><i class="fas fa-question-circle"></i></span></h1>
@endsection

@section('content')
<a href="{{ route('admin.jurusan.create') }}">
    <button class="btn btn-primary mb-3">Tambah Jurusan</button>
</a>

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
        <table id="adminTable" class="table table-bordered dt-responsive" style="width: 100%">
            <thead>
                <tr>
                    <th>NO</th>
                    <th class="all">Nama</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="actionz">
                @php
                $no=0;
                @endphp
                @if (!is_null($jurusan))
                @foreach ($jurusan as $data)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ Str::limit($data->nama, 50, "...") }}</td>
                    <td class="row justify-content-center" style="min-width: 120px">
                        <a href="{{ route('admin.jurusan.edit', $data->id) }}" class="mx-2">
                            <button class="btn btn-primary"><i class="fas fa-edit"></i></button>
                        </a>
                        <form action="{{ route('admin.jurusan.delete', $data->id) }}" method="POST" class="deleteData"
                            data-extra="Akan Menghapus Konsentrasi dan Mata Kuliah yg Berhubungan.">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium totam laborum dolor pariatur
                quisquam, a eius consectetur tempore eveniet repellat voluptatibus qui id quidem, natus dolores sequi?
                Nulla, a dolor.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection