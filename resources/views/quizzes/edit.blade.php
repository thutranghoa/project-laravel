@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Quiz</h1>

    <form action="{{ route('quizzes.update', $quiz->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $quiz->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description">{{ $quiz->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="duration">Duration:</label>
            <input type="number" class="form-control" id="duration" name="duration" value="{{ $quiz->duration }}" required>
        </div>

        <div class="form-group">
            <label for="total_questions">Total Questions:</label>
            <input type="number" class="form-control" id="total_questions" name="total_questions" value="{{ $quiz->total_questions }}" required>
        </div>

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $quiz->name }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Quiz</button>
        <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
