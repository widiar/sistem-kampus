@extends('admin.template.master')

@section('title-content', 'Tambah Jurusan')

@section('content')

<form action="{{ route('admin.konsentrasi.update', $konsentrasi->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="card shadow">
        <div class="card-body">
            <div class="form-group">
                <label for="text">Nama Konsentrasi<span class="text-danger">*</span></label>
                <input type="text" required name="konsentrasi"
                    class="form-control  @error('konsentrasi') is-invalid @enderror"
                    value="{{ old('konsentrasi', $konsentrasi->nama) }}">
                @error('konsentrasi')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="text">Jurusan<span class="text-danger">*</span></label>
                <select name="jurusan" class="form-control select2">
                    @foreach ($jurusan as $jur)
                    <option {{ ($jur->id == $konsentrasi->jurusan_id) ? 'selected':'' }} value="{{ $jur->id }}">
                        {{ $jur->nama }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary float-right">Save</button>
        </div>

    </div>
</form>

@endsection