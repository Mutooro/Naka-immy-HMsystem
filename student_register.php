<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register - Hostel Booking</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top" class="bg-gradient-info">
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

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

         
           

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle d-flex" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Menu</span>
                 <i class="fas fa-bars fa-sm fa-fw mr-2 text-gray-400"></i>
              </a>
              <!-- Dropdown - User Information -->
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
                <a class="dropdown-item" href="#" data-toggle="modal">
                  <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#adminLoginModal">LOGIN</button>
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

<!-----------------------Form for Registration----------------------->        
<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row justify-content-center">
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <div class="message text-center"></div>
              <h1 class="small  text-primary">Person Details</h1>
                <hr class="bg-primary">
              <form id="createStudent_form">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="title">First name:</label>
                    <input type="text" class="form-control form-control" name="f_name" placeholder="first Name">
                  </div>
                  <div class="col-sm-6">
                    <label for="title">Last name:</label>
                    <input type="text" class="form-control form-control" name="l_name" placeholder="last Name">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="title">Gender:</label>
                    <select name="gender" class="form-select form-control">
                      <option value="">Choose</option>
                      <option value="M">M</option>
                      <option value="F">F</option>
                    </select>
                  </div>
                  <div class="col-sm-6">
                  <label for="title">Program:</label>
                    <select name="course" class="form-select form-control">
                      <option value="">Choose</option>
                      <!-- <option value="Diploma">Diploma</option> -->
                      <option value="Degree">Degree</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="title" >Permanent Address:</label>
                  <input type="text" class="form-control form-control" name="address" placeholder="enter address">
                </div>
                <div class="form-group">
                    <label for="title">Telephone Number:</label>
                    <input type="number" class="form-control form-control" name="student_no" placeholder="enter number">
                </div>
                <div class="form-group">
                  <label for="title" >Emergence Phone Number:</label>
                  <input type="text" class="form-control form-control" name="emmercence_no" placeholder="emergence number">
                </div>
                
                <h1 class="small text-primary">Parents Details</h1>
                <hr class="bg-primary">
               
                <div class="form-group">
                  <label for="title" >Father Full Names:</label>
                  <input type="text" class="form-control form-control" name="father_names" placeholder="father">
                </div>
                <div class="form-group">
                  <label for="title" >Place:</label>
                  <input type="text" class="form-control form-control" name="place" placeholder="place">
                </div>
                <div class="form-group">
                  <label for="title" >Occupation:</label>
                  <input type="text" class="form-control form-control" name="occupation" placeholder="occupation">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="title">Phone number 1:</label>
                    <input type="number" class="form-control form-control" name="phone_1" placeholder="enter first number">
                  </div>
                  <div class="col-sm-6">
                    <label for="title">Phone number 2:</label>
                    <input type="number" class="form-control form-control" name="phone_2" placeholder="enter second number">
                  </div>
                </div>
                <div class="form-group">
                  <label for="title" >Email:</label>
                  <input type="text" class="form-control form-control" name="email" placeholder="email">
                </div>

                <h1 class="small  text-primary">LogIn Credetials</h1>
                <hr class="bg-primary">
               
                <div class="form-group">
                  <label for="title" >Registration No:</label>
                  <input type="text" class="form-control form-control" name="student_reg_no" placeholder="Enter registration No">
                  <small class="form-text text-warning">Make sure your registration number is available to our server</small>
                </div>
                <div class="form-group">
                  <label for="title" >Password:</label>
                  <input type="text" class="form-control form-control" name="password" placeholder="password">
                </div>
                <div class="form-group">
                  <label for="title" >Comfirm Password:</label>
                  <input type="text" class="form-control form-control" name="c_password" placeholder="comfirm password">
                </div>
                 <input type="hidden" name="student_add" value="1">
                 <input type="button" id="createStudent_btn" class="btn btn-info btn btn-block" value="Create">
                <hr>
              </form>
              <div class="message text-center"></div>
              <div class="text-center">
                <a class="small text-info" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small text-info" href="#" data-toggle="modal" data-target="#studentLoginModal">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<!-----------------------END Form for Registration----------------------->   
<div id="divMsg" style="display:none;">
    <img src="img/Spinner-5.gif"/>
</div>

     <!-- Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span class="text-white">Created by Nakaziba &copy; 2023</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

  </div>
 
 

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script src="js_2/student_register.js"></script>
  <script src="js_2/login_student_admin.js"></script>

</body>

</html>