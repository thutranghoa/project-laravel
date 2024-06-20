@extends('admin.layouts.admin')

@section('content')

<h2 class='mb-4'>Subjects</h2>


<div class="container">
  <div class="row">
    <div class="ml-auto">
      <form id="searchForm" method="GET" action="{{ route('admin.searchSubjects') }}">
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



<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSubjectModal">
  Add Subject
</button>
<br><br>

<table class="table table-striped" id="resultsTable">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Subject Name</th>
      <th scope="col">Description</th>
      <th scope="col">Created at</th>
      <th scope="col">Updated at</th>
      <th scope="col">Actions</th>

    </tr>
  </thead>
  <tbody>
    @if (count($subjects) > 0)
        @foreach($subjects as $subject)
        <tr>
          <th scope="row">{{$subject->id}}</th>
          <td>{{$subject->name}}</td>
          <td>{{$subject->title}}</td>
          <td>{{$subject->created_at}}</td>
          <td>{{$subject->updated_at}}</td>
          <td>
            <button type="button" class="btn btn-info edit-button" data-id="{{ $subject->id }}" data-name="{{ $subject->name }}" data-desp =  "{{ $subject->title }}" data-created = "{{ $subject->created_at }}" data-updated = "{{ $subject->updated_at }}" data-toggle="modal" data-target="#editSubjectModal">
                Edit
            </button>
            <button type="button" class="btn btn-danger delete-button" data-id="{{ $subject->id }}" data-name="{{ $subject->name }}" data-toggle="modal" data-target="#deleteSubjectModal">
                Delete
            </button>
          </td>
        </tr>
        @endforeach
    @else
        <tr>
            <td colspan="3">No subjects found</td>
        </tr>
    @endif
  </tbody>
</table>

<!-- Add Subject Modal -->
<div class="modal fade" id="addSubjectModal" tabindex="-1" aria-labelledby="addSubjectModelLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSubjectModalLabel">Add Subject</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id = 'addSubject' method="post" action="{{ route('admin.addSubject') }}" >
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label> Subject Name:</label>
            <input type="text" class="w-100" name="name" id = "add-subject-name" required>
          </div>
          <div class="form-group">
            <label> Description:</label>
            <input type="text" class="w-100" name="description" id="add-subject-description" >
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Subject</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Subject Modal -->
<div class="modal fade" id="editSubjectModal" tabindex="-1" aria-labelledby="editSubjectModelLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editSubjectModalLabel">Edit Subject</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id = 'editSubject' method="post" action="{{ route('admin.editSubject') }}">
        @csrf
        <div class="modal-body">
        <input type="hidden" name="id" id="edit-subject-id">
          <div class="row mt-3">
            <div class="col">
              <label> Subject Name:</label>
              <input type="text" class="w-100" placeholder="Enter Subject name" name="name" id = 'edit-subject-name' required> 
            </div>
          </div>

          <div class="row mt-3">
            <div class="col">
              <label> Description:</label>
              <input type="text" class="w-100" placeholder="Enter Subject description" name="description" id="edit-subject-description" >
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Edit Subject</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Subject Modal -->

<div class="modal fade" id="deleteSubjectModal" tabindex="-1" aria-labelledby="deleteSubjectModelLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteSubjectModalLabel">Delete Subject</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
          <!-- <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <form id = 'deleteSubject' method="post" action="{{ route('admin.deleteSubject') }}">
        @csrf
        <div class="modal-body">
            <p>Are you sure you want to delete this subject?</p>
            <input type="hidden" name="id" id="delete-subject-id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete Subject</button>
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
        $('#addSubject').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this); 
            console.log("Form Data being sent for addition:", formData);
            $.ajax({

              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
                url: "{{ route('admin.addSubject') }}",
                type: 'POST',
                data: formData,
                processData: false, 
                contentType: false,
                success: function(data) {
                    console.log("Response Data:", data);
                    if (data.success) {
                        $('#addSubjectModal').modal('hide');
                        alert('Subject added successfully');
                        location.reload();
                    } else {
                        alert(data.msg);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            
            });
        });

        $('.edit-button').on('click', function() {
            var subjectId = $(this).data('id');
            var subjectName = $(this).data('name');
            var subjectDesp = $(this).data('desp');

            $('#edit-subject-id').val(subjectId);
            $('#edit-subject-name').val(subjectName);
            $('#edit-subject-description').val(subjectDesp);
        });

        $('#editSubject').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this); 
            console.log("Form Data being sent for editing:", formData.get('id'), formData.get('name'), formData.get('description'));

            $.ajax({
                url: "{{ route('admin.editSubject') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.success) {
                        $('#editSubjectModal').modal('hide');
                        alert('Subject updated successfully');
                        location.reload();
                    } else {
                        alert(data.msg);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        $('.delete-button').on('click', function() {
            var subjectId = $(this).data('id');
            $('#delete-subject-id').val(subjectId);
            $('#deleteSubjectModal').modal('show');
        });

        $('#deleteSubject').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            console.log("Form Data being sent for deletion:", formData); 
            $.ajax({
                url: "{{ route('admin.deleteSubject') }}",
                type: 'POST',
                data: formData,
                success: function(data) {
                    if (data.success) {
                        $('#deleteSubjectModal').modal('hide');
                        alert('Subject deleted successfully');
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
              url: "{{ route('admin.searchSubjects') }}",
              type: 'GET',
              data: { search: searchQuery },
              success: function(data) {
                  var tableBody = $('#resultsTable tbody');
                  tableBody.empty();

                  if (data.length > 0) {
                    $.each(data, function(index, subject) {
                      tableBody.append('<tr><th scope="row">' + subject.id + '</th><td>' + subject.name + '</td><td>' + subject.title + '</td><td>' + subject.created_at + '</td><td>' + subject.updated_at + '</td><td> <button type="button" class="btn btn-info edit-button" data-id="' + subject.id + '" data-name="' + subject.name + '" data-desp="' + subject.title + '" data-toggle="modal" data-target="#editSubjectModal">Edit</button><button type="button" class="btn btn-danger delete-button" data-id="' + subject.id + '" data-name="' + subject.name + '" data-toggle="modal" data-target="#deleteSubjectModal">Delete</button></td></tr>');
                  });
                  } else {
                      tableBody.append('<tr><td colspan="3">No subjects found</td></tr>');
                  }
              },
              error: function(error) {
                  console.log(error);
              }
          });
      });

    });

    $(document).on('click', '.edit-button', function() {

        var subjectId = $(this).data('id');
        var subjectName = $(this).data('name');
        var subjectDesp = $(this).data('desp');

        $('#edit-subject-id').val(subjectId);
        $('#edit-subject-name').val(subjectName);
        $('#edit-subject-description').val(subjectDesp);
    });

      $('#editSubject').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this); 

            $.ajax({
                url: "{{ route('admin.editSubject') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.success) {
                        $('#editSubjectModal').modal('hide');
                        alert('Subject updated successfully');
                        location.reload();
                    } else {
                        alert(data.msg);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

    $(document).on('click', '.delete-button', function() {
            var subjectId = $(this).data('id');
            $('#delete-subject-id').val(subjectId);
            $('#deleteSubjectModal').modal('show');
        });
      $('#deleteSubject').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            console.log("Form Data being sent for deletion:", formData); 
            $.ajax({
                url: "{{ route('admin.deleteSubject') }}",
                type: 'POST',
                data: formData,
                success: function(data) {
                    if (data.success) {
                        $('#deleteSubjectModal').modal('hide');
                        alert('Subject deleted successfully');
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
</script>


@endsection