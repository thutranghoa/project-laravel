@extends('admin.layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Exercise: {{ $exercise->exercise_name }}</h1>
    <form action="{{ route('admin.quizzes.exercises.update', [$quiz->id, $exercise->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="exercise_name">Exercise Name:</label>
            <input type="text" class="form-control" id="exercise_name" name="exercise_name" value="{{ $exercise->exercise_name }}" required>
        </div>
        <div class="form-group">
            <label for="ma_de">Exercise Code (ma_de):</label>
            <input type="number" class="form-control" id="ma_de" name="ma_de" value="{{ $exercise->ma_de }}" required>
        </div>
        <div class="form-group">
            <label for="time">Time:</label>
            <input type="number" class="form-control" id="time" name="time" value="{{ $exercise->time }}" required>
        </div>
        <div class="form-group">
            <label for="num_questions">Number of Questions:</label>
            <input type="number" class="form-control" id="num_questions" name="num_questions" value="{{ $exercise->num_questions }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Exercise</button>
    </form>
</div>
@endsection
