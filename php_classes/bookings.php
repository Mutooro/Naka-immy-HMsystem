<?php
session_start();
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
               return ['status'=> 303, 'message'=> 'Booking is done once.'];
            }else{

			$q = $this->con->query("SELECT space_availability,fee FROM rooms WHERE room_id = '$room_id'");
			if ($q->num_rows > 0) {
			$row = $q->fetch_assoc();
				$space_availability = $row['space_availability'];
				$fee = $row['fee'];
				if ($space_availability > 0) {

       //api is used when all the authoratization is successfully done

		$payment_status='';
        $TransactionReference = 'T1234C';

		// include the location of the api.php for the open pesa
		include("../m-pesa_API/api.php");

	    // This is to ensure browser does not timeout after 30 seconds
		ini_set('max_execution_time', 300);
		set_time_limit(300);

		// Public key on the API listener used to encrypt keys
		$public_key = 'MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEArv9yxA69XQKBo24BaF/D+fvlqmGdYjqLQ5WtNBb5tquqGvAvG3WMFETVUSow/LizQalxj2ElMVrUmzu5mGGkxK08bWEXF7a1DEvtVJs6nppIlFJc2SnrU14AOrIrB28ogm58JjAl5BOQawOXD5dfSk7MaAA82pVHoIqEu0FxA8BOKU+RGTihRU+ptw1j4bsAJYiPbSX6i71gfPvwHPYamM0bfI4CmlsUUR3KvCG24rB6FNPcRBhM3jDuv8ae2kC33w9hEq8qNB55uw51vK7hyXoAa+U7IqP1y6nBdlN25gkxEA8yrsl1678cspeXr+3ciRyqoRgj9RD/ONbJhhxFvt1cLBh+qwK2eqISfBb06eRnNeC71oBokDm3zyCnkOtMDGl7IvnMfZfEPFCfg5QgJVk1msPpRvQxmEsrX9MQRyFVzgy2CWNIb7c+jPapyrNwoUbANlN8adU1m6yOuoX7F49x+OjiG2se0EJ6nafeKUXw/+hiJZvELUYgzKUtMAZVTNZfT8jjb58j8GVtuS+6TM2AutbejaCV84ZK58E2CRJqhmjQibEUO6KPdD7oTlEkFy52Y1uOOBXgYpqMzufNPmfdqqqSM4dU70PO8ogyKGiLAIxCetMjjm6FCMEA3Kc8K0Ig7/XtFm9By6VxTJK1Mg36TlHaZKP6VzVLXMtesJECAwEAAQ==';

		// Create Context with API to request a SessionKey
		$context = new APIContext();
		// Api key
		$context->set_api_key('Ka3w0ngVMoKeGa90xBQ98zvyXxpLiZFX');
		// Public key
		$context->set_public_key($public_key);
		// Use ssl/https
		$context->set_ssl(true);
		// Method type (can be GET/POST/PUT)
		$context->set_method_type(APIMethodType::GET);
		// API address
		$context->set_address('openapi.m-pesa.com');
		// API Port
		$context->set_port(443);
		// API Path
		$context->set_path('/sandbox/ipg/v2/vodacomTZN/getSession/');

		// Add/update headers
		$context->add_header('Origin', '*');

		// Parameters can be added to the call as well that on POST will be in JSON format and on GET will be URL parameters
		// context->add_parameter('key', 'value');

		// Create a request object
		$request = new APIRequest($context);

		// Do the API call and put result in a response packet
		$response = null;

		try {
			$response = $request->execute();
		} catch(exception $e) {
			echo 'Call failed: ' . $e->getMessage() . '<br>';
		}

		if ($response->get_body() == null) {
			throw new Exception('SessionKey call failed to get result. Please check.');
		}

		// Display results
		// echo $response->get_status_code() . '<br>';
		// echo $response->get_headers() . '<br>';
		// echo $response->get_body() . '<br>';

		// Decode JSON packet
		$decoded = json_decode($response->get_body());

		// The above call issued a sessionID which can be used as the API key in calls that needs the sessionID
		$context = new APIContext();
		$context->set_api_key($decoded->output_SessionID);
		$context->set_public_key($public_key);
		$context->set_ssl(true);
		$context->set_method_type(APIMethodType::POST);
		$context->set_address('openapi.m-pesa.com');
		$context->set_port(443);
		$context->set_path('/sandbox/ipg/v2/vodacomTZN/c2bPayment/singleStage/');

		$context->add_header('Origin', '*');

		$context->add_parameter('input_Amount', $new_fee);
		$context->add_parameter('input_Country', 'TZN');//tanzania
		$context->add_parameter('input_Currency', 'TZS');//tsh
		$context->add_parameter('input_CustomerMSISDN', $payment_number);
		$context->add_parameter('input_ServiceProviderCode', '000000');
		$context->add_parameter('input_ThirdPartyConversationID', rand());
		$context->add_parameter('input_TransactionReference', $TransactionReference);
		$context->add_parameter('input_PurchasedItemsDesc', $room_id);

		$request = new APIRequest($context);

		// SessionID can take up to 30 seconds to become 'live' in the system and will be invalid until it is
		sleep(30);

        $response = null;

		$response = $request->execute();

		$decoded = json_decode($response->get_body());

       //Geting the response
		$ResponseCode = $decoded->output_ResponseCode;
		$ResponseDesc = $decoded->output_ResponseDesc;
		$TransactionID = $decoded->output_TransactionID;
		$ConversationID = $decoded->output_ConversationID;
		$ThirdPartyConversationID = $decoded->output_ThirdPartyConversationID;

		//setting a payment status after the successfully or un-successfully response from the API using Switch case

		switch($ResponseCode){
			case "INS-0":
	    $payment_status = 'PAID';
        //decreasing the space availability
            $space_availability--;
            $q = $this->con->query("UPDATE rooms SET 
                                        space_availability = '$space_availability'
                                        WHERE room_id = '$room_id'");
            $q = $this->con->query("INSERT INTO `bookings`(`room_id`,
                                                           `student_reg_no`,
                                                           `fee`,
                                                           `payment_status`,
                                                           `start_date`,
                                                           `days_number`,
                                                           `new_fee`,
                                                           `end_date`,
                                                           `payment_number`,
                                                           `TransactionReference`,
                                                           `TransactionID`,
                                                           `ConversationID`,
                                                           `ThirdPartyConversationID`) 
                                         VALUES ('$room_id',
                                                 '$student_reg_no',
                                                 '$fee',
                                                 '$payment_status',
                                                 '$start_date',
                                                 '$days_number',
                                                 '$new_fee',
                                                 '$end_date',
                                                 '$payment_number',
                                                 '$TransactionReference',
                                                 '$TransactionID',
                                                 '$ConversationID',
                                                 '$ThirdPartyConversationID')");
            if ($q) {
                return ['status'=> 202, 'message'=> 'Thank you for Trusting us,</br>You have successfully Purchased the room</br>Go to contacts for futher information or report to the Hostel.'];
            }else{
                return ['status'=> 303, 'message'=> 'query problem. contact the system admin for help.'];
            }
			break;

			case "INS-1":
			return ['status'=> 303, 'message'=> 'Internal error.'];
			break;

			case "INS-6":
			return ['status'=> 303, 'message'=> 'Transaction Field.'];
			break;

			case "INS-9":
			return ['status'=> 303, 'message'=> 'Request Timeout'];
			break;

			default:
			return ['status'=> 303, 'message'=> 'Problem Has occured please contact the system Admin for help.'];


		}
		
		
			}else{
		        return ['status'=> 303, 'message'=> 'No available space in this room'];
			     exit();
		}
				
		}
    }	
  }
         }else{
		  return ['status'=> 303, 'message'=> 'Incorrect registration number.'];
			exit();
		}
}
/** one of the booking logic codes--ni kucheki receipts numbers
    this fuction checks if the receipt match with the one admin uploaded.
**/
 //  public function check_if_receipt_number_match(){

 //   $student_reg_no = $_SESSION['student_reg_no'];
 //   $payment_status = 'Verified';
 //   $receipt_match = 'Yes';
 //   $booking_id = [];
 //   $receipt_id = [];
 //  	$q = $this->con->query("SELECT bookings.booking_id,bookings.payment_status,receipts_tbl.receipt_match,receipts_tbl.receipt_id FROM bookings INNER JOIN receipts_tbl ON bookings.receipt_number=receipts_tbl.receipt_number  WHERE bookings.student_reg_no='$student_reg_no' AND bookings.new_fee=receipts_tbl.amount_paid");

 //     	if ($q->num_rows > 0) {
	// 		while ($row = $q->fetch_assoc()){
				
	// 	    $booking_id[]=$row['booking_id'];
	// 	    $receipt_id[]=$row['receipt_id'];
 //           }
 //           //updating the bookings and receipts table by putting new status
 //       if(!empty($booking_id) && !empty($receipt_id)){
 //       	$arrLength=count($booking_id);
 //       	 for ($i = 0; $i < $arrLength; $i++) {
 //       	 	$q = $this->con->query("UPDATE bookings SET payment_status = '$payment_status' WHERE booking_id = '$booking_id[$i]'");
 //       	 }
 //       	 $arrLength=count($receipt_id);
 //       	 for ($i = 0; $i < $arrLength; $i++) {
 //       	 	$q = $this->con->query("UPDATE receipts_tbl SET receipt_match = '$receipt_match',student_reg_no=$student_reg_no WHERE receipt_id = '$receipt_id[$i]'");
 //       	 }
 //       }

	// }

 // }


}

if (isset($_POST['comfirm_booking'])) {
	extract($_POST);
	if (!empty($room_id) &&
	    !empty($start_date) &&
	    !empty($days_number) &&
        !empty($new_fee) &&
        !empty($end_date) &&
        !empty($payment_number))
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

// //ffor checking the receipt number match with the one admin uploded
// if (isset($_POST['check_if_receipt_number_match'])) {
// 	$p = new Booking();
// 	$p->check_if_receipt_number_match();
// 	exit();
	
// }
			


?>