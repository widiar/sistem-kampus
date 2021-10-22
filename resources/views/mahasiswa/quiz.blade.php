<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container my-3">
        <form action="" method="POST">
            @csrf
            <div class="card shadow">
                <div class="card-header">
                    <h1 class="text-center">Quiz</h1>
                </div>
            </div>
            @foreach ($data as $questions)
            @foreach ($questions as $question)
            <div class="card shadow mb-3">
                <div class="card-body">
                    <div class="question">
                        <textarea class="form-control-plaintext" disabled cols="30">{{ $question->text }}</textarea>
                        @if ($question->image)
                        <img src="{{ asset('storage/questions/image/' . $question->image) }}"
                            class="img-responsive w-50" alt="">
                        @endif
                        @foreach ($question->options as $option)
                        <div class="form-check">
                            <input required class="form-check-input" type="radio" name="answer[{{$question->id}}]"
                                id="answer" value="{{ $option->id }}">
                            <label class="form-check-label" for="answer">
                                {{ $option->text }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
            @endforeach
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
    </div>


    <script>
        $("textarea").each(function () {
            this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
            }).on("input", function () {
            this.style.height = "auto";
            this.style.height = (this.scrollHeight) + "px";
        });
    </script>

</body>

</html>