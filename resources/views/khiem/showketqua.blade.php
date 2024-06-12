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
                        <h1>Quiz Result</h1>
                        <p>Điểm của bạn: {{ $score }}/{{$tongcauhoi}}</p>
                        <h2>Bài làm:</h2>
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

                        <a href="{{route('monhoc.show')}}">về danh sách môn học</a>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    
    
</body>
</html>
