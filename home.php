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

  <title>Home - Hostel Booking</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
   <?php include("include_user/side_bar.php"); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
       <?php include("include_user/top_bar.php"); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h2 mb-4 text-info">WELCOME.</h1>
          <p class="mb-2 text-gray-800">Welcome to our hostel booking system. Please have a good visit and Book for your prefered room. If you have got Questions go to Contacts and make a call. </p>

    <!--  Room Cards ---->      
   
    <div id="display_rooms"></div>
    
    <!-- End room card-->
      
<div class="row ml-1">
  <input type="button" class="btn btn-success" id="load_more_btn" value="LOAD MORE">
</div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Created by Sydney Kibanga &copy; 2021</span>
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

  <!-- Comfirm booking modal-->
  <div class="modal fade" id="comfirm_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to book for this room?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
       <form id="comfirm_booking_form">
        <div class="modal-body">
          <div class="message_2"></div>
          <div class="form-group">
              <label for="title">Starting Date:</label>
            <input type="date" id="startDate"  class="form-control form-control" name="start_date" >
          </div>
            <div class="form-group">
              <label for="title">Number of Days you wish to Pay:</label>
              <input type="text" id="daysNumber" class="form-select form-control" name="days_number" placeholder="Enter..">
            </div>
            <div class="form-group">
              <label for="title">Daily Fee:</label>
              <input type="text" id="fee" class="form-select form-control" name="fee" readonly >
          </div>
            <div class="form-group">
              <label for="title">Ending Date:</label>
              <input type="text" id="newDate" class="form-select form-control" name="end_date" readonly >
          </div>
          <div class="form-group">
            <label for="title">Total Amount:</label>
              <input type="text" id="newFee" class="form-select form-control" name="new_fee" readonly >
          </div>
          <div class="form-group">
            <label for="title">Payment Number (Vodacom):</label>
              <input type="number" id="newFee" class="form-select form-control" name="payment_number">
              <small class="form-text">Eg 255744010005.</small>
          </div>
        </div>

        <input type="hidden" id="room_id" name="room_id">
        <input type="hidden" name="comfirm_booking">
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button id="btn_loader" class="btn btn-info disabled" style="display:none;">
            <span class="row">
              <img class="ml-2" src="img/loader.gif"/>
              <span class="ml-2 mr-2">Please wait...</span> 
           </span>
          </button>
          <input class="btn btn-info" id="comfirm_booking_btn" type="button" value="Comfirm">
        </div>
        </form>
      </div>
    </div>
  </div>
  <!------- End modal------------->

 <!-- Success modal-->
  <div class="modal fade" id="success_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="message"></div>
        </div>
    </div>
  </div>
<!-----End success modal---->

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
          <a id="logout_btn" class="btn btn-info" href="#">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="js/jquery-ui.js"></script>
  <script src="vendor/jquery/jquery.min.js"></script>

  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/bootstrap-datetimepicker.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script src="js_2/load_roomsTEST-4.js"></script>
  <script src="js_2/logout.js"></script>
  
</body>

</html>



