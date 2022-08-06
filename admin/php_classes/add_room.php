 <?php

/**
 * 
 */
class Room 
{
	
	private $con;
	
	function __construct()
	{ 
		include("database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function getData(){
		$q = $this->con->query("SELECT * FROM rooms order by room_id desc");
		$ar = [];
		if ($q->num_rows > 0) {
			while ($row = $q->fetch_assoc()) {
				$ar[] = $row;
			}
		}
		return ['status'=> 202, 'message'=> $ar];
	}

	public function getHostel(){
		$q = $this->con->query("SELECT * FROM hostel_name");
		$output ='';
		$output .='<select name="hostel_name" class="form-select form-control">
                      <option value="">Choose</option>';
		if ($q->num_rows > 0) {
			while ($row = $q->fetch_assoc()) {
				$output .= '<option value="'.$row['name'].'">'.$row['name'].'</option>';
			}
		}
		$output .='</select>';
		echo $output;
	}


	public function addRoom($hostel_name,
								$seater,
								$fee,
								$cooking,
								$file){
		/**
		creating a avariable that will tell user the avalible space remainng each 
		time someone book for a room 
		 **/
        $space_availability=$seater;

        $_FILES['image']['name']=$file;
		$fileName = $_FILES['image']['name'];
		$fileNameAr= explode(".",$fileName);
		$extension = end($fileNameAr);
		$ext = strtolower($extension);

		if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
			
			//print_r($file['size']);

			if ($_FILES['image']['size'] > (1024 * 2)) {
				
				$uniqueImageName = time()."_".$_FILES['image']['name'];
				if (move_uploaded_file($_FILES['image']['tmp_name'], "../uploaded-img/".$uniqueImageName)) {
					
					$q = $this->con->query("INSERT INTO `rooms`(`hostel_name`, `seater`, `fee`, `cooking`, `room_image_1`,`space_availability`) VALUES ('$hostel_name', '$seater', '$fee', '$cooking', '$uniqueImageName', '$space_availability')");

					if ($q) {
						return ['status'=> 202, 'message'=> 'Room Added Successfully..!'];
					}else{
						return ['status'=> 303, 'message'=> 'Failed to run query'];
					}

				}else{
					return ['status'=> 303, 'message'=> 'Failed to upload image'];
				}

			}else{
				return ['status'=> 303, 'message'=> 'Large Image ,Max Size allowed 2MB'];
			}

		}else{
			return ['status'=> 303, 'message'=> 'Invalid Image Format [Valid Formats : jpg, jpeg, png]'];
		}

	}


	public function updateRoom($room_id,
		                     $hostel_name,
							 $seater,
							 $fee,
							 $cooking,
							 $file){

        $_FILES['image']['name']=$file;
		$fileName = $_FILES['image']['name'];
		$fileNameAr= explode(".",$fileName);
		$extension = end($fileNameAr);
		$ext = strtolower($extension);

		$q = $this->con->query("SELECT*FROM bookings WHERE room_id='$room_id' AND payment_status= 'PAID'");
		if ($q) {

			$q = $this->con->query("SELECT rooms.hostel_name,rooms.fee,rooms.seater FROM rooms WHERE room_id='$room_id'");
			if ($q->num_rows > 0) {
			$row = $q->fetch_assoc();
		   }
		   /*
		   checking if the value entered match the one in
		    the database since they can not be edited becoz the room
		     has starterd being booked
		   */
            if ($row['hostel_name']==$hostel_name &&
                $row['fee']==$fee &&
                $row['seater']==$seater) {
            	
			if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
			
			//print_r($file['size']);

			if ($_FILES['image']['size'] > (1024 * 2)) {
				
				$uniqueImageName = time()."_".$_FILES['image']['name'];
				if (move_uploaded_file($_FILES['image']['tmp_name'], "../uploaded-img/".$uniqueImageName)) {
					
					$q = $this->con->query("UPDATE rooms SET 
										hostel_name = '$hostel_name', 
										seater = '$seater', 
										fee = '$fee', 
										cooking = '$cooking', 
										room_image_1 = '$uniqueImageName'
										WHERE room_id = '$room_id'");

					if ($q) {
						return ['status'=> 202, 'message'=> 'Updated Successfully..!'];
					}else{
						return ['status'=> 303, 'message'=> 'Failed to run query'];
					}

				}else{
					return ['status'=> 303, 'message'=> 'Failed to upload image'];
				}

			}else{
				return ['status'=> 303, 'message'=> 'Large Image ,Max Size allowed 2MB'];
			}

		}else{
			return ['status'=> 303, 'message'=> 'Invalid Image Format [Valid Formats : jpg, jpeg, png]'];
		}
			
		}else{
			return ['status'=> 303, 'message'=> 'Changes are only made on the image and cooking..since the room has started been booked'];
			exit();
		}
		}

		
		

		

	}

	public function deleteRoom($bid = null){
		if ($bid != null) {
			$q = $this->con->query("DELETE FROM rooms WHERE room_id = '$bid'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Deleted.'];
			}else{
				return ['status'=> 202, 'message'=> 'Failed to run query'];
			}
			
		}else{
			return ['status'=> 303, 'message'=>'Invalid cattegory id'];
		}

	}

}
//for fetching rooms
if (isset($_POST['Get_Data'])) {
	$p = new Room();
	echo json_encode($p->getData());
	exit();
	
}
		

//for fetching hostel
if (isset($_POST['Get_Hostel'])) {
	$p = new Room();
	$p->getHostel();
	exit();
}


if (isset($_POST['add_room_details'])) {

	extract($_POST);
	if (!empty($hostel_name) 
	&& !empty($seater) 
	&& !empty($fee)
	&& !empty($cooking)
	&& !empty($_FILES['image']['name'])) {
		

		$p = new Room();
		$result = $p->addRoom($hostel_name,
								$seater,
								$fee,
								$cooking,
								$_FILES['image']['name']);
		
		echo json_encode($result);
		exit();


	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Empty fields']);
		exit();
	}

}

//for editing/update

if (isset($_POST['edit_room'])) {

	extract($_POST);
	if (!empty($room_id)
	&& !empty($hostel_name) 
	&& !empty($seater) 
	&& !empty($fee)
	&& !empty($cooking)
    && !empty($_FILES['image']['name'])) {
		
		    $p = new Room();
			$result = $p->updateRoom($room_id,
								$hostel_name,
								$seater,
								$fee,
								$cooking,
								$_FILES['image']['name']);
		echo json_encode($result);
		exit();
		}
         else{
		echo json_encode(['status'=> 303, 'message'=> 'Empty fields']);
		exit();
	}
}

//for deleting
if (isset($_POST['DELETE_DATA'])) {
	if (!empty($_POST['bid'])) {
		$p = new Room();
		echo json_encode($p->deleteRoom($_POST['bid']));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Invalid details']);
		exit();
	}
}



 ?>