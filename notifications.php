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

  <title>Notifications - Hostel Booking</title>

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
          <h1 class="h2 mb-4 text-gray-800">NOTIFICATIONS:</h1>
           <?php
      $output='';
      if(isset($_SESSION['student_reg_no'])){
       $student_reg_no = $_SESSION['student_reg_no'];
        $student_name = $_SESSION['student_name'];
        $payment_status = 'PAID';
      $q = "SELECT*FROM bookings WHERE student_reg_no='$student_reg_no' AND payment_status='$payment_status' LIMIT 1";  
      $run_query = mysqli_query($con,$q) or die(mysqli_error($con)); 
      if(mysqli_num_rows($run_query) > 0){
        $row = mysqli_fetch_assoc($run_query);

        $end_date = $row['end_date'];

        //how to put the alert message
        $today_date = date('Y-m-d');
        $today_date= new DateTime($today_date);
        $end_date= new DateTime($end_date);

        $datediff=$today_date->diff($end_date);

        $finaly=$datediff->format('%r%a days');

        if($finaly <= 10 && $finaly >= 1){
          $output .='
                <div class="mb-4">
              <div class="card border-left-warning shadow  py-6">
                <div class="card-body">
                  <div class=" d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">'.date('d-M-Y').'</div>
                   <div class="font-weight-bold">Rent Alert: Dear '.$_SESSION['student_name'].' you are only Left with <span class="text-danger">'.$finaly.'</span> for our rent contract to expire.</div>
                  </div>
                </div>
                </div>
              </div>
            </div>
                  ';
         }else if($finaly == 0) {
            $output .='
              <div class="mb-4">
              <div class="card border-left-warning shadow  py-6">
                <div class="card-body">
                  <div class=" d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">'.date('d-M-Y').'</div>
                   <div class="font-weight-bold">Rent Alert: Dear '.$_SESSION['student_name'].' you are only Left with <span class="text-danger">Hours</span> for our rent contract to expire.</div>
                  </div>
                </div>
                </div>
              </div>
            </div>
                   '; 
         }else if($finaly < 0){
          $output .='
            <div class="mb-4">
              <div class="card border-left-danger shadow  py-6">
                <div class="card-body">
                  <div class=" d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-danger">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">'.date('d-M-Y').'</div>
                   <div class="font-weight-bold">Rent Alert: Dear '.$_SESSION['student_name'].' our rent contract has expired, You are adviced to pay in time before the room is given to another person.</div>
                  </div>
                </div>
                </div>
              </div>
            </div>
                    ';
         }
      }


      $q= "SELECT*FROM notification_tbl ORDER BY id DESC";
      $run_query = mysqli_query($con,$q) or die(mysqli_error($con));
      if(mysqli_num_rows($run_query) > 0){
      while($row = mysqli_fetch_array($run_query)){
      $output .='
             <div class="mb-4">
              <div class="card border-left-info shadow h-100 py-6">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-ms font-weight-bold text-info mb-0">Date: '.$row['not_date'].'</div>
                      <hr class="mt-1">
                      <div class="text-gray-800">'.$row['not_desc'].'</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
 }
 echo $output;
}
}
 ?> 

       
    
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Created by Nakaziba &copy; 2023</span>
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
          <a id="logout_btn" class="btn btn-info" href="#">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script src="js_2/load_hostel_rooms.js"></script>
<script src="js_2/logout.js"></script>

</body>

</html>


              