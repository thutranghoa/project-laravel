<!doctype html>
<html lang="en">
  <head>
  	<title>Admin Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

		<link rel="stylesheet" href="{{ asset('css/style.css') }}">
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
	  		<h1><a href="/admin/dashboard" class="logo">Admin Dashboard</a></h1>
        <ul class="list-unstyled components mb-5">
          <li class="active">
            <a href="subjects"><span class="fa fa-book mr-3"></span> Môn học</a>
          </li>
          <li class="active">
            <a href="quizzes"><span class="fa fa-file mr-3"></span> Đề thi</a>
          </li>
          <li class="active">
            
            <a href="#studentSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
              <span class="fa fa-graduation-cap mr-3"></span> Học viên
            </a>
            <ul class="collapse list-unstyled" id="studentSubmenu">
              <li>
                <a href="students"><span class="fa fa-graduation-cap mr-3"></span> Học viên</a>
                <a href="student-results"><span class="fa fa-check mr-3"></span> Kết quả</a>
              </li>
            </ul>
          </li>
        
            <li>
                <a href="logout"><span class="fa fa-sign-out mr-3"></span> Logout</a>
        </ul>

    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
        @yield('content')
      </div>
		</div>

    <!-- <script src="{{ asset('js/jquery.min.js') }}"></script> -->
    <script src="{{ asset('js/popper.js') }}"></script>
    <!-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> -->
    <script src="{{ asset('js/main.js') }}"></script>
    
  </body>
</html>