@extends('admin.template.master')

@section('title-content', 'Mahasiswa')

@section('content')
<div class="card shadow">
    <div class="card-body">
        <table id="mahasiswaTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIM</th>
                    <th>Email</th>
                    <th class="text-center">Aksi</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no=0;
                @endphp
                @if (!is_null($mahasiswa))
                @foreach ($mahasiswa as $mhs)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $mhs->nim }}</td>
                    <td>{{ $mhs->email }}</td>
                    <td class="text-center">
                        @if ($mhs->status == 0)
                        <form action="{{ route('admin.verif-mahasiswa', ['user' => $mhs, 'status' => 1]) }}"
                            method="POST" class="verif">
                            @method('PATCH')
                            @csrf
                            <button class="btn btn-sm btn-success" type="submit"><i class="fas fa-check"></i></button>
                        </form>
                        @else
                        <form action="{{ route('admin.verif-mahasiswa', ['user' => $mhs, 'status' => 0]) }}"
                            method="POST" class="notverif">
                            @method('PATCH')
                            @csrf
                            <button class="btn btn-sm btn-danger" type="submit"><i
                                    class="fas fa-times-circle"></i></button>
                        </form>
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($mhs->status == 0)
                        <span class="badge badge-danger">Not Verified</span>
                        @else
                        <span class="badge badge-success">Verified</span>
                        @endif
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="ml-3">
        {{  $mahasiswa->withQueryString()->links() }}
    </div>
</div>
@endsection