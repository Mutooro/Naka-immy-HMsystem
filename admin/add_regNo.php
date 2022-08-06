<?php session_start();
include('php_classes/security.php');
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Adminstrator-Hostel Booking</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../vendor/datatables/dataTables.bootstrap4.min.css">
 

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include("includes/side_bar.php"); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include("includes/top_bar.php"); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">STUDENT RegNo:</h1>
      <div class="card shadow mb-4">
    <div class="card-header py-3">

<div class="card-body">
  <div class="dropdown mb-3">
                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      ADD
                    </button>
                    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" data-toggle="modal" data-target="#add_student" href="#">Add student one by one</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" data-toggle="modal" data-target="#add_student_CSV_modal" href="#">Add Student by CVS file</a>
                    </div>
                  </div>
 <div class="table-responsive">
        <div class="message d-flex justify-content-center "></div>
        <table class="table table-bordered table-striped" id="fetchStudentAddedTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>RegNo</th>
              <th>Year</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="display_list">
              <td></td>
              <td></td>
              <td></td>
          </tbody>
          
        </table>
        
      </div>
    </div>
  </div>
  
</div>

<!-- Modal adding student using CVS-->
<div class="modal fade" id="add_student_CSV_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload CSV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="message_2"></div>
       <form id="add_student_CSV_form"  enctype="multipart/form-data">
        <div class="form-group">
          <label for="title">upload:</label>
          <input type="file" class="form-control" name="student_csv" >
          <small class="form-text text-muted">Make sure your the first column contains Student Reg No, The second column contains Year.</small>
        </div>
        <input type="hidden" name="add_student_csv" value="1">
        <input type="button" class="btn btn-success" id="add_student_CSV_btn" value="save">
      </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->


<!-- Modal adding student-->
<div class="modal fade" id="add_student" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="message_2"></div>
       <form id="add_student_form"  enctype="multipart/form-data">
        <div class="form-group">
          <label for="title">RegNo</label>
          <input type="text" class="form-control" name="student_reg_no" placeholder="Enter RegNo">
        </div>
        <div class="form-group">
          <label for="desc">Year</label>
          <input type="text" class="form-control" name="Year" placeholder="Enter Year">
        </div>
        <input type="hidden" name="add_student" value="1">
        <input type="button" class="btn btn-success" name="Year" id="add_student_btn" value="save">
      </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->



        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-info" id="logout_btn" href="#">Logout</a>
        </div>
      </div>
    </div>
  </div>

 <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
   <script>
  </script>
  <script src="js/add_studentTEST-4.js"></script>
  <script src="js/logout.js"></script>


</body>

</html>
