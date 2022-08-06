<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Hostel Booking</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
<!---------------------- Modal For admin -------------------->
<div class="modal fade" id="adminLoginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADMINSTRATOR LOGIN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="message_2 d-flex justify-content-center "></div>
       <form class="user" id="admin_login_form"  enctype="multipart/form-data">
        <div class="form-group">
          <input type="text" class="form-control form-control-user" name="username" placeholder="Enter username">
        </div>
        <div class="form-group">
          <input type="password" class="form-control form-control-user" name="password" placeholder="Enter password">
        </div>
        <input type="hidden" name="admin_login" value="1">
        <input type="button" class="btn btn-success btn-user btn-block" name="Year" id="admin_login_btn" value="login">
      </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal End-->


<!---------------------- Modal For student login  -------------------->
<div class="modal fade" id="studentLoginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">STUDENT LOGIN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="message_2"></div>
       <form class="user" id="student_login_form">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Enter Registration Number..." name="student_reg_no">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
                    </div>
                    <input type="hidden" name="student_login" value="student_login">
                    <input type="button" value="Login" class="btn btn-info btn-user btn-block" id="student_login_btn">
                  </form>      
            </div>
    </div>
  </div>
</div>
<!-- Modal End-->

            <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">


          <!-- Topbar Search -->
          <a href="index.php">
          <div class="d-inline text-info"><div class="h4 sidebar-brand-text mx-3">Hostel Booking</div></div>
          </a>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

           

            <!-- Nav Item - User information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle d-flex" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Menu</span>
                 <i class="fas fa-bars fa-sm fa-fw mr-2 text-gray-400"></i>
              </a>
              <!-- Dropdown - User information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item disabled" href="#">
                 <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400" ></i>
                  Student
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#studentLoginModal">LOGIN</button>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item disabled" href="#">
                 <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Administrator
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#adminLoginModal">LOGIN</button>
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->


<!-----------------------------------body-------------------------->
<div class="container">
 <div class="">
    <div class="card o-hidden border-0 shadow-lg ">
      <div class="card-body p-3 ">
        <div class="pt-2">
          <div class="text-center">
                <h3 class="h3 text-gray-900 mb-4">WELCOME TO HOSTEL BOOKING SYSTEM</h3>
              </div>
              <h1 class="small mb-20 text-center text-gray-900">Please book for a room in a Hostel that suites you, Make payment via M-PESA using a vodacom number to Purchase the room.</br></br>Have a nice visit..!!</h1>
                <hr>
          <div class="row justify-content-center">
               <!--  Cards 3 -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Average cost (Daily) </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Tsh <span id="display_1"></span></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

         <!-- Cards 1 -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">total Hostels</div>
                      <div id="display_2" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-building fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!--  Cards 2 -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">total Rooms </div>
                      <div id="display_3" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-bed fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          

       </div>
        <div class="text-center">
                <a class="small text-info" href="student_register.php">Register</a>
              </div>
              <div class="text-center">
                <a class="small text-info" href="#" data-toggle="modal" data-target="#studentLoginModal">Already have an account? Login!</a>
              </div>

          </div>
      </div>
    </div>
</div>
  </div>

  <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Created by Sydney Kibanga &copy; 2021</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script src="js_2/login_student_admin.js"></script>
  <script>
    $(document).ready(function(){
      get_average();
  function get_average(){
    $.ajax({
      url : 'admin/php_classes/dashboard.php',
      method : 'POST',
      data : {get_average:1},
      success : function(response){
        console.log(response);
             $("#display_1").html(response);
      }
    })
  }

  get_hostels();
  function get_hostels(){
    $.ajax({
      url : 'admin/php_classes/dashboard.php',
      method : 'POST',
      data : {get_hostels:1},
      success : function(response){
            $("#display_2").html(response);
      }
    })
    
  }
   get_rooms();
  function get_rooms(){
    $.ajax({
      url : 'admin/php_classes/dashboard.php',
      method : 'POST',
      data : {get_rooms:1},
      success : function(response){
             $("#display_3").html(response);
      }
    })
    
  }
      }); 
  </script>

</body>

</html>



                 