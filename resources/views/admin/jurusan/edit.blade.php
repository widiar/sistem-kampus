@extends('admin.template.master')

@section('title-content', 'Tambah Jurusan')

@section('content')

<form action="{{ route('admin.jurusan.update', $jurusan->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="card shadow">
        <div class="card-body">
            <div class="form-group">
                <label for="text">Nama Jurusan<span class="text-danger">*</span></label>
                <input type="text" required name="jurusan" class="form-control  @error('jurusan') is-invalid @enderror"
                    value="{{ old('jurusan', $jurusan->nama) }}">
                @error('jurusan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary float-right">Save</button>
        </div>

    </div>
</form>

@endsection