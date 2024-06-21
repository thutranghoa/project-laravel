@extends('admin.layouts.admin')

@section('content')
<div class="container">
    <h1>Create Exercise for {{ $quiz->title }}</h1>
    <form action="{{ route('admin.quizzes.exercises.store', $quiz->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exercise_name">Exercise Name:</label>
            <input type="text" class="form-control" id="exercise_name" name="exercise_name" required>
        </div>
        <div class="form-group">
            <label for="ma_de">Exercise Code (ma_de):</label>
            <input type="number" class="form-control" id="ma_de" name="ma_de" required>
        </div>
        <div class="form-group">
            <label for="time">Time:</label>
            <input type="number" class="form-control" id="time" name="time" required>
        </div>
        <div class="form-group">
            <label for="num_questions">Number of Questions:</label>
            <input type="number" class="form-control" id="num_questions" name="num_questions" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Exercise</button>
    </form>
</div>
@endsection
