@extends('admin.template.master')

@section('title-content', 'Nilai Mahasiswa')

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
        <table id="adminTable" class="table table-bordered dt-responsive" style="width: 100%">
            <thead>
                <tr>
                    <th>NO</th>
                    <th class="all">NIM</th>
                    <th class="all">Nama</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="actionz">
                @php
                $no=0;
                @endphp
                @if (!is_null($mahasiswa))
                @foreach ($mahasiswa as $data)
                @if (!is_null($data->nilai))
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $data->user->nim }}</td>
                    <td>{{ $data->nama }}</td>
                    <td class="text-center" style="min-width: 100px">
                        <a href="{{ route('admin.mahasiswa.verif.nilai', $data->id) }}" class="mx-2">
                            <button class="btn btn-success"><i class="fas fa-eye"></i></button>
                        </a>
                    </td>
                </tr>
                @endif
                @endforeach
                @endif
            </tbody>
        </table>
    </div>

</div>
@endsection