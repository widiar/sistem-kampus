@extends('admin.template.master')

@section('title-content', 'Add Questions Category')

@section('content')

<form action="" method="POST">
    @csrf
    <div class="card shadow">
        <div class="card-body">
            <div class="form-group">
                <label for="text">Nama Category<span class="text-danger">*</span></label>
                <input type="text" required name="name" class="form-control  @error('name') is-invalid @enderror"
                    value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary float-right">Save</button>
        </div>

    </div>
</form>

@endsection