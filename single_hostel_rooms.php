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

  <title>Single - Hostel Booking</title>

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
<?php        
if(isset($_SESSION['get_hostel_name']))
{
  $hostel_name=$_SESSION['get_hostel_name'];

  $query= "SELECT * FROM rooms WHERE hostel_name='$hostel_name'";
  $query_2= "SELECT * FROM hostel_name WHERE name='$hostel_name'";
  $run_query_2=mysqli_query($con,$query_2);
  if($row=mysqli_fetch_array($run_query_2)){
    echo'
         <!-- Page Heading -->
          <h1 class="h2 mb-3 text-success">'.$row["name"].':</h1>
          <p class="mb-2 text-gray-800">'.$row["description"].'</p>
  <p class="mb-0 text-gray-800">Call number 1: '.$row["call_number_1"].'</p>
           <p class="mb-0 text-gray-800">Call number 2: '.$row["call_number"].'</p>
      <hr>
    ';
}
 
 $output=''; 
 $run_query=mysqli_query($con,$query);
 $output.='<div class="row">';
if(mysqli_num_rows($run_query) > 0){
 while($row = mysqli_fetch_array($run_query)){
 $output.='
    <!--  Room Cards ---->       
   <div class="card m-3 shadow" style="width: 18rem;">
             <img height="200" class="card-img-top" src="admin/uploaded-img/'.$row["room_image_1"].'" alt="Card image cap">
               <div class="card-body">
                 <h5 class="card-title text-success">'.$row["hostel_name"].'</h5>
               <p class="card-text">Daily Fee: <span class="font-weight-bold">Ush '.$row["fee"].'/=</span> <br>Cooking: <span class="font-weight-bold">'.$row["cooking"].'</span>  <br>Rooms: <span class="font-weight-bold">'.$row["seater"].'</span> <br>Available Space: <span class="font-weight-bold">'.$row["space_availability"].'</span> </p>
                <a href="#" room_id="'.$row["room_id"].'" fee="'.$row["fee"].'" class="btn btn-info btn-block booking_btn">Book</a>
              </div>
             </div>      
    <!-- End room card-->
    ';   
  }
   $output.='</div>';
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
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script src="js_2/load_hostel_roomsXX.js"></script>
  <script src="js_2/load_roomsTEST-4.js"></script>
  <script src="js_2/logout.js"></script>

</body>

</html>


            