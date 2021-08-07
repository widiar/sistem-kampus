@extends('admin.template.master')

@section('title-content', 'Questions')

@section('content')
<a href="{{ route('admin.matakuliah.create') }}">
    <button class="btn btn-primary mb-3">Tambah Mata Kuliah</button>
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
                    <th class="all">Kode</th>
                    <th>Nama</th>
                    <th>SKS</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="actionz">
                @php
                $no=0;
                @endphp
                @if (!is_null($matakuliah))
                @foreach ($matakuliah as $data)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $data->kode }}</td>
                    <td>{{ Str::limit($data->nama, 50, "...") }}</td>
                    <td>{{ $data->sks }}</td>
                    <td class="row justify-content-center" style="min-width: 120px">
                        <a href="{{ route('admin.matakuliah.edit', $data->id) }}" class="mx-2">
                            <button class="btn btn-primary"><i class="fas fa-edit"></i></button>
                        </a>
                        <form action="{{ route('admin.matakuliah.delete', $data->id) }}" method="POST"
                            class="deleteData">
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
@endsection