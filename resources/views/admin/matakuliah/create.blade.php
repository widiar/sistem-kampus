@extends('admin.template.master')

@section('title-content', 'Tambah Mata Kuliah')

@section('content')

<form action="{{ route('admin.matakuliah.store') }}" method="POST">
    @csrf
    <div class="card shadow">
        <div class="card-body">
            <div class="form-group">
                <label for="text">Kode Mata Kuliah<span class="text-danger">*</span></label>
                <input type="text" required name="kode" class="form-control  @error('kode') is-invalid @enderror"
                    value="{{ old('kode') }}">
                @error('kode')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="text">Nama Mata Kuliah<span class="text-danger">*</span></label>
                <input type="text" required name="nama" class="form-control  @error('nama') is-invalid @enderror"
                    value="{{ old('nama') }}">
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="text">SKS<span class="text-danger">*</span></label>
                <input type="number" required name="sks" class="form-control  @error('sks') is-invalid @enderror"
                    value="{{ old('sks') }}">
                @error('sks')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="text">Konsentrasi<span class="text-danger">*</span></label>
                <select name="jurusan" required
                    class="custom-select form-control @error('jurusan') is-invalid @enderror">
                    @foreach ($jurusan as $j)
                    <option {{ old('jurusan') == $j->id ? "selected" : "" }} value="{{ $j->id }}">{{ $j->nama }}
                    </option>
                    @endforeach
                </select>
                @error('jurusan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary float-right">Save</button>
        </div>

    </div>
</form>

@endsection