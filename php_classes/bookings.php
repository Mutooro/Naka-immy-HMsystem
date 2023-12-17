<?php
session_start();
header('Content-Type: application/json');

class Booking
{   
	private $con;
	
	function __construct()
	{ 
		include("../admin/php_classes/database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function comfirmBooking($room_id,
	                               $student_reg_no,
	                               $start_date,
	                               $days_number,
	                               $new_fee,
	                               $end_date,
	                               $payment_number)
	{

        $q = $this->con->query("SELECT * FROM rooms INNER JOIN student_tbl 
         WHERE (room_id = {$room_id} AND student_reg_no = {$student_reg_no})");
       if ($q->num_rows > 0) {
           $q = $this->con->query("SELECT student_reg_no FROM bookings WHERE student_reg_no = '$student_reg_no' AND room_id = '$room_id' ");
		if ($q->num_rows > 0) {
			return ['status'=> 303, 'message'=> 'This room was booked by you.'];
		}else{

            $q = $this->con->query("SELECT student_reg_no FROM bookings WHERE student_reg_no = '$student_reg_no'");
            if ($q->num_rows > 5) {
               return json_encode(['status'=> 303, 'message'=> 'Booking is done once.']);
            }else{

			$q = $this->con->query("SELECT space_availability,fee FROM rooms WHERE room_id = '$room_id'");
			if ($q->num_rows > 0) {
			$row = $q->fetch_assoc();
				$space_availability = $row['space_availability'];
				$fee = $row['fee'];
				if ($space_availability > 0) {

	

      
		
			}else{
		        return json_encode(['status' => 303, 'message' => 'Incorrect registration number.']);
			  
		}
				
		}
    }	
  }
         }else{
		  return ['status'=> 303, 'message'=> 'Incorrect registration number.'];
			
		}
}


}

if (isset($_POST['comfirm_booking'])) {
	extract($_POST);
	if (!empty($room_id) &&
	    !empty($start_date) &&
	    !empty($days_number) &&
        !empty($new_fee) &&
        !empty($end_date) )
	{
		$student_reg_no=$_SESSION['student_reg_no'];

			$c = new Booking();
			$result = $c->comfirmBooking($room_id ,$student_reg_no,$start_date,$days_number,$new_fee,$end_date,$payment_number);
			echo json_encode($result);
			exit();
		}else{
		echo json_encode(['status'=> 303, 'message'=> 'empty fields']);
		exit();
		}
	
	}



?>