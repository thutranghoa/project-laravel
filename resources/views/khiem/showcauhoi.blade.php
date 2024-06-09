<!DOCTYPE html>
<html>
<head>
    <title>Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .question {
            margin-bottom: 20px;
        }
        .answers {
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <h1>Quiz</h1>
    <form action="{{ route('quiz.submit') }}" method="POST">
        @csrf
        @foreach ($questions as $question)
            <div class="question">
                <h3>{{ $question->content }}</h3>
                <div class="answers">
                    @foreach ($question->answers as $answer)
                        <div>
                            <input type="radio" id="answer_{{ $answer->id }}" name="answers[{{ $question->id }}]" value="{{ $answer->id }}">
                            <label for="answer_{{ $answer->id }}">{{ $answer->content }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        <button type="submit">Submit</button>
    </form>
</body>
</html>
