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
  <link href="../vendor/datatables/dataTable.bootstrap4.css" rel="stylesheet" type="text/css">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

   <?php include("includes/side_bar.php"); ?>

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
          <h1 class="h3 mb-4 text-gray-800">ROOM DETAILS:</h1>

            <div class="card shadow mb-4">
    <div class="card-header py-3">

<div class="card-body">
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#add_room_modal">
          ADD
        </button>
      <div class="table-responsive">
        <div class="message"></div>
        <table class="table table-bordered table-striped" id="datatableid" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Hostel Name</th>
              <th>Seater</th>
              <th>Daily Fee</th>
              <th>Cooking</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="display">
             <!-- <td></td>
              <td></td>
              <td></td> -->
          </tbody>
          
        </table>
        
      </div>
    </div>
  </div>
  
</div>



<!-- Modal adding room-->
<div class="modal fade" id="add_room_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add a room </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="message_2"></div>
         <form id="add_room_form"  enctype="multipart/form-data">
          <div class="form-group">
                    <label for="title">Hostel:</label>
                    <div id="display_hostel"></div>
           
          </div>
          <div class="form-group">
                  <label for="title">Seaters:</label>
                    <select name="seater" class="form-select form-control">
                      <option value="">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                    </select> 
          </div>
        <div class="form-group">
          <label for="title">Daily Fee:</label>
          <input type="number" class="form-control" name="fee" placeholder="Enter fee">
        </div>
        <div class="form-group">
                  <label for="title">Cooking:</label>
                    <select name="cooking" class="form-select form-control">
                      <option value="">Choose</option>
                      <option value="Allowed">Allowed</option>
                      <option value="NOT allowed">NOT allowed</option>
                    </select> 
        </div>
        <div class="form-group">
          <label for="title">Upload Room Image:</label>
          <input type="file" class="form-control" name="image" >
        </div>
        <input type="hidden" name="add_room_details" value="1">
        <input type="button" class="btn btn-info" name="Year" id="add_room_btn" value="save">
      </form>
      </div>
    </div>
  </div>
</div>
<!--End of Modal -->

<!-- Modal Editing room-->
<div class="modal fade" id="edit_room_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Name:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="message_2"></div>
       <form id="edit_room_form"  enctype="multipart/form-data">
          <div class="form-group">
                    <label for="title">Hostel:</label>
                    <div id="display_hostel_2"></div>
              <!--  <select name="hostel_name" class="form-select form-control">
                      <option value="">Choose</option>
                      <option value="M">Hostel 1</option>
                      <option value="M">Hostel 2</option>
                    </select> -->
          </div>
          <div class="form-group">
                  <label for="title">Seaters:</label>
                    <select name="seater" class="form-select form-control">
                      <option value="">Choose</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                    </select> 
          </div>
        <div class="form-group">
          <label for="title">Daily Fee:</label>
          <input type="number" class="form-control" name="fee" placeholder="Enter fee">
        </div>
        <div class="form-group">
                  <label for="title">Cooking:</label>
                    <select name="cooking" class="form-select form-control">
                      <option value="">Choose</option>
                      <option value="Allowed">Allowed</option>
                      <option value="NOT allowed">NOT allowed</option>
                    </select> 
        </div>
        <div class="form-group">
          <label for="title">Upload Room Image:</label>
          <input type="file" class="form-control" name="image" >
        </div>
        <input type="hidden" name="room_id">
        <input type="hidden" name="edit_room" value="1">
        <input type="button" class="btn btn-info" name="Year" id="edit_room_btn" value="update">
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
            <span>Copyright &copy; Nakaziba Immy</span>
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
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

  <!-- Page level plugins -->
  

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
  <script src="js/roomTEST-1.js"></script>
  <script src="js/logout.js"></script>
  
 

</body>

</html>
