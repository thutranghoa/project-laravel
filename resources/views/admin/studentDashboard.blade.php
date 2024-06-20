@extends('admin.layouts.admin')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">


<h2 class='mb-4'>Students</h2>

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


<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">
  Add Student
</button>
<br><br>

<table class="table table-striped" id = resultsTable>
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Full Name</th>
      <th scope="col">Image</th>
      <th scope="col">Gender</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @if (count($students) > 0)
        @foreach($students as $student)
        <tr>
          <th scope="row">{{$student->id}}</th>
          <td>{{$student->name}}</td>
          <!-- <td> {{ $student-> image}} </td> -->
          <td><img src="{{ asset('storage/images/'. $student-> image) }}" alt="Student image" style="width: 100px; height: 100px;"></td>
          <td> {{$student->gender}} </td>
          <td>{{$student->email}}</td>
          <td>{{$student->phone}}</td>

          <td>
          <button type="button" class="btn btn-info edit-button" data-id="{{ $student->id }}" data-name="{{ $student->name }}" data-email="{{ $student->email }}" data-gender = "{{ $student->gender }}" data-phone= "{{ $student->phone }}" data-dob = "{{ $student->dob }}" 
         data-toggle="modal" data-target="#editStudentModal">
                Edit
            </button>
        <button type="button" class="btn btn-danger delete-button" data-id="{{ $student->id }}" data-name="{{ $student->name }}" data-email="{{ $student->email }}" data-toggle="modal" data-target="#deleteStudentModal">
            Delete
        </button>
        
          </td>
        </tr>
        @endforeach
    @else
        <tr>
            <td colspan="4">No students found</td>
        </tr>
    @endif
  </tbody>
</table>

{{ $students->links() }}

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id='addStudent' method="post" action="{{ route('admin.addStudent') }}" enctype="multipart/form-data>
        @csrf
        <div class="modal-body">
            <div class="row mt-3">
                <div class="col">
                  <label> Name </label>
                    <input type="text" class="w-100" name="name" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                  <label> Email</label>
                    <input type="email" class="w-100"  name="email" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                  <label> Gender</label>
                    <!-- <input type="email" class="w-100"  name="gender" required> -->
                    <select name="gender" class="w-100" required>
                      <option value = "Male" > Male </option>
                      <option value = "Female"> Female </option>
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                   <label> Phone no.</label>
                    <input type="text" class="w-100" name="phone" required>
                </div>
            </div> 

            <div class="row mt-3">
                <div class="col">
                   <label> Date of birth</label>
                    <input type="date" class="w-100 " name="dob" required>
                </div>
            </div> 

            <div class="row mt-3">
              <div class="col">
                 <label> Profile image </label>
                  <input type="file" class="w-100" name="image" required>
              </div>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Student</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Student Modal -->

<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id='editStudent' method="post" action="{{ route('admin.editStudent') }}">
        @csrf
        <div class="modal-body">
            <input type="hidden" name="id" id="edit-student-id">
            <div class="row mt-3">
                <div class="col">
                    <input type="text" class="w-100" placeholder="Enter Student name" name="name" id="edit-student-name" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <input type="email" class="w-100" placeholder="Enter Student email" name="email" id="edit-student-email" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label> Gender </label>
                    <select name="gender" class="w-100" id="edit-student-gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label> Phone </label>
                    <input type="text" class="w-100" placeholder="Enter Student phone" name="phone" id="edit-student-phone" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label> Date of Birth </label>
                    <input type="date" class="w-100" name="dob" id="edit-student-dob" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label> Profile Image </label>
                    <input type="file" class="w-100" name="image" id="edit-student-image">
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary ">Edit Student</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Student Modal -->

<div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deleteStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteStudentModalLabel">Delete Student</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id='deleteStudent' method="post" action="{{ route('admin.deleteStudent') }}">
        @csrf
        <div class="modal-body">
            <p>Bạn có muốn xoá học viên này không ?</p>
            <input type="hidden" name="id" id="delete-student-id">

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger ">Delete Student</button>
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
        $('.edit-button').on('click', function() {
            var studentId = $(this).data('id');
            var studentName = $(this).data('name');
            var studentEmail = $(this).data('email');
            var studentGender = $(this).data('gender');
            var studentPhone = $(this).data('phone');
            var studentDob = $(this).data('dob');
            // var studentImage = $(this).data('image');

            $('#edit-student-id').val(studentId);
            $('#edit-student-name').val(studentName);
            $('#edit-student-email').val(studentEmail);
            $('#edit-student-gender').val(studentGender);
            $('#edit-student-phone').val(studentPhone);
            $('#edit-student-dob').val(studentDob);
            // $('#edit-student-image').val(studentImage);
        });

        $('#editStudent').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('admin.editStudent') }}",
                type: "POST",
                data: formData,
                success: function(data) {
                    if (data.success) {
                        $('#editStudentModal').modal('hide');
                        alert('Student updated successfully');
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

        $('#addStudent').on('submit', function(e) {
            e.preventDefault();
            // var formData = $(this).serialize();
            var formData = new FormData(this); 
            console.log("Form Data being sent for addition:", formData);

            for (var pair of formData.entries()) {
                console.log(pair[0]+ ': ' + pair[1]); 
            }
            $.ajax({
                url: "{{ route('admin.addStudent') }}",
                type: "POST",
                data: formData,
                processData: false, 
                contentType: false, 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log("Response Data:", data);
                    if (data.success) {
                        $('#addStudentModal').modal('hide');
                        alert('Student added successfully');
                        location.reload();
                    } else {
                        alert(data.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                  console.error("Error:", textStatus, errorThrown);
                  console.error("Response Text:", jqXHR.responseText);
                    alert("An error occurred. Please try again.");
                }
            });
        });

        $('.delete-button').on('click', function() {
            var studentId = $(this).data('id');
            $('#delete-student-id').val(studentId);
            $('#deleteStudentModal').modal('show');

            console.log(studentId);
        });

        $('#deleteStudent').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            console.log("Form Data being sent for deletion:", formData); // Debugging step
            $.ajax({
                url: "{{ route('admin.deleteStudent') }}",
                type: "POST",
                data: formData,
                success: function(data) {
                    if (data.success) {
                        $('#deleteStudentModal').modal('hide');
                        alert('Student deleted successfully');
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
      
    });


    $(document).on('click', '.edit-button', function() {
      $('.edit-button').on('click', function() {
        var studentId = $(this).data('id');
            var studentName = $(this).data('name');
            var studentEmail = $(this).data('email');

            $('#edit-student-id').val(studentId);
            $('#edit-student-name').val(studentName);
            $('#edit-student-email').val(studentEmail);
            
        });
      
        $('#editStudent').on('submit', function(e) {
          e.preventDefault();
          var formData = $(this).serialize();
          $.ajax({
              url: "{{ route('admin.editStudent') }}",
              type: "POST",
              data: formData,
              success: function(data) {
                  if (data.success) {
                      $('#editStudentModal').modal('hide');
                      alert('Student updated successfully');
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
      });


    $(document).on('click', '.delete-button', function() {

      $('.delete-button').on('click', function() {
        var studentId = $(this).data('id');
        $('#delete-student-id').val(studentId);
        $('#deleteStudentModal').modal('show');
      });

      $('#deleteStudent').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: "{{ route('admin.deleteStudent') }}",
            type: "POST",
            data: formData,
            success: function(data) {
                if (data.success) {
                    $('#deleteStudentModal').modal('hide');
                    alert('Student deleted successfully');
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
    });   

      
    
</script>


@endsection
