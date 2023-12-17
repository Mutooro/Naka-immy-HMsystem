<?php
include "config/db.php";
session_start();
// Getting rooms from db
if(isset($_POST["Get_Rooms"])){
	$output="";
	$q = "SELECT * FROM rooms  order by room_id desc LIMIT 6";
	$run_query = mysqli_query($con,$q) or die(mysqli_error($con));
	$output .='<div class="row">';
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$output.='
			<div class="card m-3 shadow" style="width: 18rem;">
             <img height="200" class="card-img-top" src="admin/uploaded-img/'.$row["room_image_1"].'" alt="Card image cap">
               <div class="card-body">
                 <h5 class="card-title text-success">'.$row["hostel_name"].'</h5>
               <p class="card-text">Daily Fee: <span class="font-weight-bold">Ush '.$row["fee"].'/=</span> <br>Cooking: <span class="font-weight-bold">'.$row["cooking"].'</span>  <br>Rooms: <span class="font-weight-bold">'.$row["seater"].'</span> <br>Available Space: <span class="font-weight-bold">'.$row["space_availability"].'</span> </p>
                <a href="#" room_id="'.$row["room_id"].'" fee="'.$row["fee"].'" class="btn btn-info btn-block booking_btn">Book</a>
              </div>
             </div>';
			
		}
		$output .='</div>';
		echo $output;
	}
}


//Loading more rooms button
if(isset($_POST["Load_More"])){

	$loadCount=$_POST["loadCount"];
	$output="";
	$q = "SELECT * FROM rooms order by room_id desc LIMIT $loadCount";
	$run_query = mysqli_query($con,$q) or die(mysqli_error($con));
	$output .='<div class="row">';
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$output.='
			<div class="card m-3 shadow" style="width: 18rem;">
             <img height="200" class="card-img-top" src="admin/uploaded-img/'.$row["room_image_1"].'" alt="Card image cap">
               <div class="card-body">
                 <h5 class="card-title text-success">'.$row["hostel_name"].'</h5>
               <p class="card-text">Daily Fee: <span class="font-weight-bold">Tsh '.$row["fee"].'/=</span> <br>Cooking: <span class="font-weight-bold">'.$row["cooking"].'</span>  <br>Seater: <span class="font-weight-bold">'.$row["seater"].'</span> <br>Available Space: <span class="font-weight-bold">'.$row["space_availability"].'</span> </p>
                <a href="#" room_id="'.$row["room_id"].'" fee="'.$row["fee"].'" class="btn btn-info btn-block booking_btn">Booking</a>
              </div>
             </div>';
			
		}
		$output .='</div>';
		echo $output;
	}
}


//for loading hostel to be displayed on hostel_list.php
if(isset($_POST["Get_Hostel"])){
	
	$q = "SELECT * FROM hostel_name";
	$run_query = mysqli_query($con,$q) or die(mysqli_error($con));
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$ar[]=$row;
		}
		 echo json_encode($ar);

	}
}

//selecting rooms that are in the same hostel for which  session opens up on single_hostel_rooms.php 
if(isset($_POST["GET_Hostel_rooms"])){
	$hostel_name=$_POST["hostel_name"];
		$_SESSION['get_hostel_name'] = $hostel_name;
}

//success modal message display (welcome user)
if(isset($_POST["Get_Name"])){
	echo '<div class="alert alert-success text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <b>Welcome to Bookings '.ucwords($_SESSION['student_name']).'.</b></div>';
}

//for geting hostel contacts

if(isset($_POST["get_hostel_contacts"])){
	
	$q = "SELECT hostel_name.name,hostel_name.call_number_1,hostel_name.call_number FROM hostel_name";
	$run_query = mysqli_query($con,$q) or die(mysqli_error($con));
	if(mysqli_num_rows($run_query) > 0){
		while($row = mysqli_fetch_array($run_query)){
			$ar[]=$row;
		}
		 echo json_encode($ar);

	}
}

//student booking_lists which combines the two tables bookings and rooms to provide the output
if(isset($_POST["get_student_bookings"])){
	$student_reg_no = $_SESSION['student_reg_no'];

	$q="SELECT bookings.booking_id,bookings.payment_status,bookings.payment_number,bookings.TransactionReference,bookings.new_fee,rooms.room_image_1,rooms.room_id FROM bookings LEFT JOIN rooms ON bookings.room_id=rooms.room_id WHERE bookings.student_reg_no='$student_reg_no' ";       
	$run_query = mysqli_query($con,$q) or die(mysqli_error($con));
	if(mysqli_num_rows($run_query) > 0){
     while($row = mysqli_fetch_assoc($run_query)){
     	$ar[]=$row;
     }
     echo json_encode($ar);
	}
}

// viewing student bookings using any eye_btn

if(isset($_POST["viewing_booking"])){
    extract($_POST);
    $output='';
    $payment_status='';
	$q="SELECT bookings.payment_status,bookings.payment_number,bookings.new_fee,bookings.TransactionReference,bookings.start_date,bookings.end_date,bookings.days_number,rooms.room_image_1,rooms.fee,rooms.cooking,rooms.hostel_name,rooms.seater FROM bookings INNER JOIN rooms ON bookings.room_id=rooms.room_id WHERE bookings.booking_id='$booking_id' ";
	$output='
        <div class="table-responsive">
         <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
		';       
	$run_query = mysqli_query($con,$q) or die(mysqli_error($con));
	if(mysqli_num_rows($run_query) > 0){
     while($row = mysqli_fetch_assoc($run_query)){
     	if($row['payment_status'] == 'PAID'){
     		$payment_status .='<span class="badge badge-success">PAID</span>';
     	}
     	$output .='
                <tr class="align-center"> 
                    <td colspan="2"><img src="admin/uploaded-img/'.$row['room_image_1'].'"></td>  
                </tr> 
                <tr>  
                     <td width="30%"><label>Hostel Name</td>  
                     <td width="70%" class="text-success">'.$row['hostel_name'].'</td>  
                </tr> 
                <tr>  
                     <td width="30%"><label>Seater</td>  
                     <td width="70%">'.$row['seater'].'</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>Payment Status</td>  
                     <td width="70%">'.$payment_status.'</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>Transaction reference</td>  
                     <td width="70%">'.$row['TransactionReference'].'</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>Payment number</td>  
                     <td width="70%">'.$row['payment_number'].'</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>Daily Fee</td>  
                     <td width="70%">'.$row['fee'].'</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>Number of days</td>  
                     <td width="70%">'.$row['days_number'].'</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>Total Fee</td>  
                     <td width="70%">'.$row['fee'].' * '.$row['days_number'].' = '.$row['new_fee'].'</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>Cooking</td>  
                     <td width="70%">'.$row['cooking'].'</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>Staring date</td>  
                     <td width="70%">'.$row['start_date'].'</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>Ending date</td>  
                     <td width="70%">'.$row['end_date'].'</td>  
                </tr>';
     }
     $output .='</div></div>';
     echo $output;
	}
}


?>

