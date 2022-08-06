<?php
class Bookings
{   
	private $con;
	
	function __construct()
	{ 
		include("database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

   public function get_bookings_list(){
		$q = $this->con->query("SELECT bookings.booking_id,bookings.student_reg_no,bookings.new_fee,bookings.payment_status,bookings.payment_number,rooms.room_image_1,rooms.hostel_name FROM bookings LEFT JOIN rooms ON bookings.room_id=rooms.room_id ORDER BY bookings.booking_id desc");
		$ar = [];
		if ($q->num_rows > 0) {
			while ($row = $q->fetch_assoc()) {
				$ar[] = $row;
			}
		}
		return ['status'=> 202, 'message'=> $ar];
	}

	public function viewData($booking_id){
		$output='';
		
		$q = $this->con->query("SELECT bookings.booking_id,bookings.student_reg_no,bookings.new_fee,bookings.payment_status,bookings.payment_number,rooms.room_image_1,rooms.hostel_name FROM bookings LEFT JOIN rooms ON bookings.room_id=rooms.room_id WHERE bookings.booking_id='$booking_id'");
		$output='
        <div class="table-responsive">
         <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
		';
		if ($q->num_rows > 0) {
			while ($row = $q->fetch_assoc()) {
				$output .='
                <tr class="align-center"> 
                    <td colspan="2"><img src="uploaded-img/'.$row['room_image_1'].'"></td>  
                </tr> 
                <tr>  
                     <td width="30%"><label>Hostel Name</label></td>  
                     <td width="70%">'.$row['hostel_name'].'</td>  
                </tr> 
                <tr>  
                     <td width="30%"><label>Payment Number</label></td>  
                     <td width="70%">'.$row['payment_number'].'</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>Fee</label></td>  
                     <td width="70%">'.$row['new_fee'].'</td>  
                </tr>
                <tr>  
                     <td width="30%"><label>Payment Status</td>  
                     <td width="70%"><span class="badge badge-success">'.$row['payment_status'].'</span></td>  
                </tr>
                <tr>  
                     <td width="30%"><label>Student RegNo</td>  
                     <td width="70%">'.$row['student_reg_no'].'</td>  
                </tr>';
			}
		}
		$output .='</div></div>';
		return $output;
	}

	public function download_csv(){ 
 
// Fetch records from database 
$q = $this->con->query("SELECT * FROM bookings ORDER BY booking_id ASC"); 
 
if($q->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "test.csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('ID', 'Reg No.', 'Amount', 'Status', 'No. of Days', 'Starting Date', 'Ending Date', 'Payment No.', 'Transaction Reference'); 
 fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $q->fetch_assoc()){ 
        $lineData = array($row['booking_id'], $row['student_reg_no'], $row['new_fee'], $row['payment_status'], $row['days_number'], $row['start_date'], $row['end_date'], $row['payment_number'], $row['TransactionReference']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
 
	}


}	

//for get bookings list that the student has done

if (isset($_POST['get_bookings_list'])) {
	$p = new Bookings();
	echo json_encode($p->get_bookings_list());
	exit();
}

//downloading staff
if (isset($_POST['download_csv'])) {
	$p = new Bookings();
    $p->download_csv();
    exit();
}

//view btn 
if (isset($_POST['view_data'])) {
	extract($_POST);
	if(!empty($booking_id)){
	$p = new Bookings();
	echo ($p->viewData($booking_id));
	exit();
}
}

?>