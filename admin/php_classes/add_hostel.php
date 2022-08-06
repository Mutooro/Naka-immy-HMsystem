<?php
class Hostel
{   
	private $con;
	
	function __construct()
	{ 
		include("database.php");
		$db = new Database();
		$this->con = $db->connect();
	}


	public function addHostel($hostel_name,
	                          $hostel_desc,
	                          $call_number_1,
	                          $call_number){
		$q = $this->con->query("INSERT INTO `hostel_name`(`name`,`description`,`call_number_1`,`call_number`) VALUES ('$hostel_name','$hostel_desc','$call_number_1','$call_number')");
			if ($q) {
				return ['status'=> 202, 'message'=> 'added successfully.!'];
			}

		}


	public function getData(){
		$q = $this->con->query("SELECT * FROM hostel_name");
		$ar = [];
		if ($q->num_rows > 0) {
			while ($row = $q->fetch_assoc()) {
				$ar[] = $row;
			}
		}
		return ['status'=> 202, 'message'=> $ar];
	}

	public function deleteHostel($bid = null){
		if ($bid != null) {
			$q = $this->con->query("DELETE FROM hostel_name WHERE hostel_id = '$bid'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Deleted.'];
			}else{
				return ['status'=> 202, 'message'=> 'Failed to run query'];
			}
			
		}else{
			return ['status'=> 303, 'message'=>'Invalid cattegory id'];
		}

	}


	  public function updateHostel($post = null){
		extract($post);
		if (!empty($hid) && 
			!empty($hostel_name) &&
		    !empty($hostel_desc) &&
		    !empty($call_number_1) &&
		    !empty($call_number)) {
			$q = $this->con->query("UPDATE hostel_name SET 
				                                         name='$hostel_name', 
				                                         description='$hostel_desc',
				                                         call_number_1='$call_number_1',
				                                         call_number='$call_number' 
				                                         WHERE hostel_id = '$hid'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Updated Successfully.'];
			}else{
				return ['status'=> 202, 'message'=> 'Failed to run query'];
			}
			
		}else{
			return ['status'=> 303, 'message'=>'Invalid id'];
		}

	}	

}

  

//php codes for adding Hostels details
if (isset($_POST['add_hostel'])) {
	extract($_POST);
	if (!empty($hostel_name) &&
        !empty($hostel_desc) &&
        !empty($call_number_1)     &&
        !empty($call_number)) {
			$c = new Hostel();
			$result = $c->addHostel($hostel_name,$hostel_desc,$call_number_1,$call_number);
			echo json_encode($result);
			exit();
		}else{
		echo json_encode(['status'=> 303, 'message'=> 'Empty fields.!']);
		exit();
	}
}

//for fetching hostel
if (isset($_POST['Get_Data'])) {
	$p = new Hostel();
	echo json_encode($p->getData());
	exit();
	
}

//for deleting
if (isset($_POST['DELETE_DATA'])) {
	if (!empty($_POST['bid'])) {
		$p = new Hostel();
		echo json_encode($p->deleteHostel($_POST['bid']));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Invalid details']);
		exit();
	}
}

//for edditing/upadate
if (isset($_POST['edit_hostel'])) {
	if (!empty($_POST['hid'])) {
		$p = new Hostel();
		echo json_encode($p->updateHostel($_POST));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Invalid id']);
		exit();
	}
}




?>