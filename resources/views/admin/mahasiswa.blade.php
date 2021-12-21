@extends('admin.template.master')

@section('title-content')
<h1 class="h3 mb-0 text-gray-800">Mahasiswa<span class="badge" style="cursor: pointer" data-toggle="modal"
        data-target="#exampleModal"><i class="fas fa-question-circle"></i></span></h1>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-body">
        <table id="adminTable" class="table table-bordered dt-responsive nowrap" style="width: 100%">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th class="text-center">Aksi</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody class="actionz">
                @php
                $no=0;
                @endphp
                @if (!is_null($mahasiswa))
                @foreach ($mahasiswa as $mhs)
                <tr>
                    <td>{{ ++$no }}</td>
                    <td>{{ $mhs->nim }}</td>
                    <td>{{ $mhs->mahasiswa->nama }}</td>
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
    {{-- <div class="ml-3">
        {{ $mahasiswa->withQueryString()->links() }}
    </div> --}}
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