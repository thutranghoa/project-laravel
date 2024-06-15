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
        .phan_tren{
            display: flex;
            justify-content: space-around;
        }
    </style>
    
</head>
<body>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <h1>Quiz</h1>
                        <div class="phan_tren">
                            
                            <div></div>
                            <div>
                                <div>
                                    <strong>Thời gian còn lại: </strong>
                                    <span id="m">00</span>:
                                    <span id="s">00</span>
                                    <span>s</span>
                                </div>
                            
                            </div>
                            
                        </div>
                        <h3>Số lượng câu hỏi: {{$socauhoi}}</h3>
                        <form id="quiz-form" action="{{ route('quiz.submit', ['id_exercise'=> $id_exercise]) }}" method="POST">
                            @csrf
                            <input type="hidden" id="elapsedTime" name="elapsedTime" value="">
                            @foreach ($questions as $question)
                                <div class="question">
                                    <h3>{{ $question->content }}</h3>
                                    <div class="answers">
                                        @foreach ($question->answers as $answer)
                                            <div>
                                                <input type="radio" id="answer_{{ $answer->id }}" name="answers[{{ $question->id }}]" value="{{ $answer->id }}" required>
                                                <label for="answer_{{ $answer->id }}">{{ $answer->content }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit">Submit</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    
</body>
<script language="javascript">
    var m = {{$time}}; 
    var s = 0;  
    var timeout = null;
    var elapsedSeconds = 0; // Biến để lưu thời gian làm bài

    function start() {
        if (s === -1) {
            m -= 1;
            s = 59;
        }

        if (m === -1) {
            clearTimeout(timeout);
            alert('Hết giờ');
            document.getElementById('quiz-form').submit();
            return false;
        }

        document.getElementById('elapsedTime').value = elapsedSeconds;
        document.getElementById('m').innerText = m.toString();
        document.getElementById('s').innerText = s.toString();

        timeout = setTimeout(function() {
            s--;
            elapsedSeconds++; 
            start();
        }, 1000);
    }

    function stop() {
        clearTimeout(timeout);
    }

    window.onload = function() {
        start();
    }
</script>

</html>
