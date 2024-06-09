<!DOCTYPE html>
<html>
<head>
    <title>Quiz Result</title>
    <style>
        .correct {
            color: green;
        }
        .incorrect {
            color: red;
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
    <h1>Quiz Result</h1>
    <p>Your score is: {{ $score }}</p>

    <h2>Details:</h2>
    @foreach ($results as $result)
        <div class="question">
            <h3>{{ $result['question']->content }}</h3>
            <div class="answers">
                @foreach ($result['question']->answers as $answer)
                    <div>
                        @if ($answer->id == $result['selected_answer']->id)
                            <strong class="{{ $result['is_correct'] ? 'correct' : 'incorrect' }}">
                                {{ $answer->content }} - 
                                {{ $result['is_correct'] ? 'Đúng' : 'Sai' }}
                            </strong>
                        @else
                            {{ $answer->content }}
                        @endif 
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    <a href="{{ route('quiz.show') }}">Take another quiz</a>
</body>
</html>
