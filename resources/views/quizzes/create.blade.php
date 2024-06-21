@extends('admin.layouts.admin')

@section('content')
<div class="container">
    <h1>Create New Quiz</h1>
    <form action="{{ route('admin.quizzes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="duration">Duration:</label>
            <input type="number" class="form-control" id="duration" name="duration" required>
        </div>
        <div class="form-group">
            <label for="total_questions">Total Questions:</label>
            <input type="number" class="form-control" id="total_questions" name="total_questions" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
