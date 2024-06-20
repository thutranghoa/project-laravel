@extends('admin.layouts.admin')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">


<h2 class='mb-4'>Student Results</h2>

<div class="container">
  <div class="row">
    <div class="ml-auto">
      <form id="searchForm" method="GET" action="{{ route('admin.searchStudents') }}">
        <div class="form-row">
          <div class="form-group col-md-8">
            <input type="text" class="form-control" id="searchInput" placeholder="Search by ID or Name" style="border: 1px solid #000;">
          </div>
          <div class="form-group col-md-2">
            <button type="submit" class="btn btn-primary">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<table class="table table-striped" id="resultsTable">
  <thead>
    <tr>
      <th scope="col">
        <a href="{{ route('admin.studentResults', ['sortField' => 'id', 'sortOrder' => $sortField == 'id' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
          ID
          @if ($sortField == 'id')
            @if ($sortOrder == 'asc') ▲ @else ▼ @endif
          @endif
        </a>
      </th>
      <th scope="col">
        <a href="{{ route('admin.studentResults', ['sortField' => 'user_id', 'sortOrder' => $sortField == 'user_id' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
          Student ID
          @if ($sortField == 'user_id')
            @if ($sortOrder == 'asc') ▲ @else ▼ @endif
          @endif
        </a>
      </th>
      <th scope="col">
        <a href="{{ route('admin.studentResults', ['sortField' => 'user.name', 'sortOrder' => $sortField == 'user.name' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
          Student Name
          @if ($sortField == 'user.name')
            @if ($sortOrder == 'asc') ▲ @else ▼ @endif
          @endif
        </a>
      </th>
      <th scope="col">
        <a href="{{ route('admin.studentResults', ['sortField' => 'exam_id', 'sortOrder' => $sortField == 'exam_id' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
          Exam ID
          @if ($sortField == 'exam_id')
            @if ($sortOrder == 'asc') ▲ @else ▼ @endif
          @endif
        </a>
      </th>
      <th scope="col">
        <a href="{{ route('admin.studentResults', ['sortField' => 'exercise.exercise_name', 'sortOrder' => $sortField == 'exercise.exercise_name' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
          Exam Title
          @if ($sortField == 'exercise.exercise_name')
            @if ($sortOrder == 'asc') ▲ @else ▼ @endif
          @endif
        </a>
      </th>
      <th scope="col">
        <a href="{{ route('admin.studentResults', ['sortField' => 'score', 'sortOrder' => $sortField == 'score' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
          Score
          @if ($sortField == 'score')
            @if ($sortOrder == 'asc') ▲ @else ▼ @endif
          @endif
        </a>
      </th>
      <th scope="col">
        <a href="{{ route('admin.studentResults', ['sortField' => 'exam_duration', 'sortOrder' => $sortField == 'exam_duration' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
          Duration
          @if ($sortField == 'exam_duration')
            @if ($sortOrder == 'asc') ▲ @else ▼ @endif
          @endif
        </a>
      </th>
      <th scope="col">
        <a href="{{ route('admin.studentResults', ['sortField' => 'updated_at', 'sortOrder' => $sortField == 'updated_at' && $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
          Finish At
          @if ($sortField == 'updated_at')
            @if ($sortOrder == 'asc') ▲ @else ▼ @endif
          @endif
        </a>
      </th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  @include('admin.studentResultpartial')

  <tbody>
    @if (count($results) > 0)
        @foreach($results as $result)
        <tr>
          <th scope="row">{{ $result->id }}</th>
          <td>{{ $result->user_id }}</td>
          <td>{{ $result->user ? $result->user->name : 'N/A' }}</td>
          <td>{{ $result->exam_id }}</td>
          <td>{{ $result->exercise ? $result->exercise->exercise_name : 'N/A' }}</td>
          <td>{{ $result->score }}</td>
          <td>{{ $result->exam_duration }}</td>
          <td>{{ $result->updated_at }}</td>
          <td>
            <button type="button" class="btn btn-danger delete-button" data-id="{{ $result->id }}" data-toggle="modal" data-target="#deleteStudentModal">
                Delete
            </button>
          </td>
        </tr>
        @endforeach
    @else
    <tr>
      <td colspan="9">No results found.</td>
    </tr>
    @endif
  </tbody>
</table>


<!-- Delete Student results Modal -->

<div class="modal fade" id="deleteResultModal" tabindex="-1" aria-labelledby="deleteStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteStudentModalLabel">Delete </h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id='deleteResult' method="post" action="{{ route('admin.deleteResult') }}">
        @csrf
        <div class="modal-body">
            <p>Bạn có muốn xoá kết quả này không ?</p>
            <input type="hidden" name="id" id="delete-result-id">

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger ">Delete </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {

      $.ajaxSetup({
        headers: {
            // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-Requested-With': 'XMLHttpRequest'
        }
      });


        $('.delete-button').on('click', function() {
            var studentId = $(this).data('id');
            $('#delete-result-id').val(studentId);
            $('#deleteResultModal').modal('show');

            console.log(studentId);
        });

        $('#deleteResult').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            console.log("Form Data being sent for deletion:", formData); // Debugging step
            $.ajax({
                url: "{{ route('admin.deleteResult') }}",
                type: "POST",
                data: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(data) {
                    if (data.success) {
                        $('#deleteResultModal').modal('hide');
                        alert('Result deleted successfully');
                        location.reload();
                    } else {
                        alert(data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus, errorThrown);
                }
            });
        });

        $('#searchForm').on('submit', function(e) {
          e.preventDefault();
          var searchQuery = $('#searchInput').val();
          $.ajax({
              url: "{{ route('admin.searchStudents') }}",
              type: 'GET',
              data: { search: searchQuery },
              headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
              success: function(data) {
                  var tableBody = $('#resultsTable tbody');
                  tableBody.empty();

                  if (data.length > 0) {
                      $.each(data, function(index, student) {
                          tableBody.append('<tr><th scope="row">' + student.id + '</th><td>' + student.name + '</td><td>' + student.email + '</td><td><button type="button" class="btn btn-info edit-button" data-id="' + student.id + '" data-name="' + student.name + '" data-email="' + student.email + '" data-toggle="modal" data-target="#editStudentModal">Edit</button><button type="button" class="btn btn-danger delete-button" data-id="' + student.id + '" data-name="' + student.name + '" data-email="' + student.email + '" data-toggle="modal" data-target="#deleteStudentModal">Delete</button></td></tr>');
                      });
                  }
                  else {
                      tableBody.append('<tr><td colspan="4">No students found</td></tr>');
                  }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                  console.error(textStatus, errorThrown);
              }
          });
        });    

        $('th a').on('click', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html',
                headers: {
                  'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(data) {
                    $('#resultsTable tbody').html(data);
                    window.history.pushState("", "", url); // Update URL without reloading the page
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                    alert('An error occurred. Please try again.');
                }
            });
         });

         $.ajax({
          url: "{{ route('admin.studentResults') }}",
          type: "GET",
          dataType: "html",
          headers: {
              'X-Requested-With': 'XMLHttpRequest'
          },
          success: function(data) {
              $('#resultsTable tbody').html(data);
          },
          error: function(jqXHR, textStatus, errorThrown) {
              console.error('Error:', textStatus, errorThrown);
              alert('An error occurred. Please try again.');
          }
        });

      
    });


      
    
</script>


@endsection
