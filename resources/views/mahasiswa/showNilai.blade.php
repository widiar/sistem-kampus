@extends('masterTemplate')

@section('title', 'Nilai Mahasiswa')

@section('main-content')

<div class="container  my-4">
    <main id="main">
        <div class="card shadow mx-auto my-4">
            <div class="card-header">
                <h2 class="text-center">Nilai Semester {{ $nilai[0]->semester }}</h2>
            </div>
            <div class="card-body" style="margin-bottom: 80px">
                <table id="nilaiTable" class="table table-bordered dt-responsive" style="width: 100%">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th class="all">Mata Kuliah</th>
                            <th class="text-center">Nilai</th>
                        </tr>
                    </thead>
                    <tbody class="actionz">
                        @php
                        $no=0;
                        @endphp
                        @if (!is_null($nilai))
                        @foreach ($nilai as $data)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $data->matakuliah->nama }}</td>
                            <td class="text-center">{{ $data->nilai }}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="{{ route('mahasiswa.nilai') }}">
                    <button class="btn btn-primary">Kembali</button>
                </a>
            </div>
        </div>
    </main>
</div>

@endsection
@section('script')
<script>
    $(".nilaiTable").dataTable({
        paging: false,
        info: false,
        search: false
    })
</script>
@endsection