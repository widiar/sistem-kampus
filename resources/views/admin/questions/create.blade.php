@extends('admin.template.master')

@section('title-content', 'Add Questions')

@section('content')

<form action="{{ route('admin.questions.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card shadow">
        <div class="card-body">
            <div class="form-group">
                <label for="text">Question Text<span class="text-danger">*</span></label>
                <textarea class="form-control  @error('text') is-invalid @enderror" name="text" id="text" cols="30"
                    rows="10" required>{{ old('text') }}</textarea>
                @error('text')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <div class="custom-file">
                    <input type="file" name="image" class="file custom-file-input @error('image') is-invalid @enderror"
                        id="image" value="{{ old('image') }}" accept="image/x-png, image/jpeg">
                    <label class="custom-file-label" for="image">
                        <span class="d-inline-block text-truncate w-75">Browse File</span>
                    </label>
                    @error("image")
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <small id="exampleInputFile" class="form-text text-muted">upload format file .png, .jpg max 5mb.</small>
            </div>

            <div class="form-group">
                <label for="text">Score<span class="text-danger">*</span></label>
                <input type="number" min="0" required name="score"
                    class="form-control  @error('score') is-invalid @enderror" value="{{ old('score') }}">
                @error('score')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="options">
                <div class="opt">
                    <div class="row">
                        <div class="col-6">
                            <label for="option">Option<span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" name="options[]">
                        </div>
                        <div class="col-6">
                            <div class="form-check mt-4">
                                <input required class="form-check-input isTrue" type="radio" value="1" name="tmpTrue">
                                <label class="form-check-label" for="isTrue">
                                    Benar
                                </label>
                                <input type="hidden" name="isTrue[]" value="0" class="ftrue">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary my-3 addOptionButton">Add Options</button>

            <br>
            <hr>
            <button type="submit" class="btn btn-primary float-right">Save</button>
        </div>

    </div>
</form>

@endsection

@section('script')
<script>
    $(".addOptionButton").click(function(){
        let opt = `
                <div class="opt">
                    <div class="row">
                        <div class="col-6">
                            <label for="option">Option<span class="text-danger">*</span></label>
                            <input type="text" required class="form-control" name="options[]">
                        </div>
                        <div class="col-6">
                            <div class="form-check mt-4">
                                <input class="form-check-input isTrue" type="radio" value="1" name="tmpTrue">
                                <label class="form-check-label" for="isTrue">
                                    Benar
                                </label>
                                <input type="hidden" name="isTrue[]" value="0" class="ftrue">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm my-2 btn-hapus">Hapus</button><br>
                </div>`;

        $(".options").append(opt)
    });

    $("body").on("click", ".btn-hapus", function(){
         $(this).parent().remove();
    })

    $("body").on("click", ".isTrue", function(){
        $(".isTrue").removeAttr("checked")
        $(this).attr("checked", true);
        $(".isTrue").parent().find(".ftrue").val("0");
        var p = $(this).parent();
        p.find(".ftrue").val("1");
    })
</script>
@endsection