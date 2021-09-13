@extends('masterTemplate')

@section('title', 'Mahasiswa')

@section('main-content')

<div class="container my-4">
    <main id="main">
        @if(session('success'))
        <p class="successMsg" style="display: none">
            {{session('success')}}
        </p>
        @elseif(session('error'))
        <p class="errorMsg" style="display: none">
            {{session('error')}}
        </p>
        @elseif(session('info'))
        <p class="infoMsg" style="display: none">
            {{session('info')}}
        </p>
        @endif
        <a href="{{ route('mahasiswa.nilai.add') }}"><button class="btn btn-primary">Input Nilai</button></a>
        <div class="card shadow mx-auto my-4">
            <div class="card-body">
                <table id="userTable" class="table table-bordered dt-responsive" style="width: 100%">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th class="all">Semester</th>
                            <th class="text-center">Aksi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="actionz">
                        @php
                        $no=0;
                        $is_rejected = false;
                        @endphp
                        @if (!is_null($nilai))
                        @foreach ($nilai as $data)
                        @php if($data->is_approve == 2)
                        $is_rejected = true;
                        @endphp
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>Semester {{ $data->semester }}</td>
                            @if ($data->is_approve == 2)
                            <td class="text-center" style="min-width: 120px">
                                <a href="{{ route('mahasiswa.nilai.edit', $data->semester) }}" class="mx-2">
                                    <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                </a>
                                <a href="{{ route('mahasiswa.nilai.delete', $data->semester) }}">
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </a>
                            </td>
                            @else
                            <td class="text-center" style="min-width: 120px">
                                <a href="{{ route('mahasiswa.nilai.show', $data->semester) }}" class="mx-2">
                                    <button class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
                                </a>
                            </td>
                            @endif
                            <td class="text-center">
                                @if ($data->is_approve == 0)
                                <button class="btn btn-warning btn-sm" style="cursor: default;">Processed</button>
                                @elseif($data->is_approve == 1)
                                <button class="btn btn-success btn-sm" style="cursor: default;">Verified</button>
                                @else
                                <button class="btn btn-danger btn-sm" style="cursor: default;">Rejected</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                @if ($is_rejected)
                <p style="display: none" class="rejected">Nilai ada yang ditolak. Silahkan ajukan kembali.</p>
                @endif
            </div>
        </div>
    </main>
</div>

@endsection

@section('script')
<script>
    let sukses = $(".successMsg").text();
    let info = $(".infoMsg").text();
    let rejected = $(".rejected").text()
    if(sukses !== ''){
        toastr.success(sukses, 'Berhasil!')
    }
    if (info !== '') toastr.info(info, 'Mahasiswa');
    if(rejected !== '') toastr.warning(rejected, 'Nilai!')

</script>
@endsection