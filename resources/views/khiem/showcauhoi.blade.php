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
                        <h3>Số lượng câu hỏi: {{$socauhoi}}</h3>
                        <form action="{{ route('quiz.submit') }}" method="POST">
                            @csrf
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
</html>
