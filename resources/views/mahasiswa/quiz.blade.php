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
        <div class="card shadow">
            <div class="card-header">
                <h1 class="text-center">Quiz</h1>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    @foreach ($questions as $question)
                    <div class="question">
                        <h5>{{ $question->text }}</h5>
                        @foreach ($question->options as $option)
                        <div class="form-check">
                            <input required class="form-check-input" type="radio" name="answer[{{$question->id}}]"
                                id="answer" value="{{ $option->id }}">
                            <label class="form-check-label" for="answer">
                                {{ $option->text }}
                            </label>
                        </div>
                        @endforeach
                        <hr>
                    </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>