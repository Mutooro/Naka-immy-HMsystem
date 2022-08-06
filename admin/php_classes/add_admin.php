<?php
class Admin
{   
	private $con;
	
	function __construct()
	{ 
		include("database.php");
		$db = new Database();
		$this->con = $db->connect();
	}


	public function addAdmin($full_names,$username,$password){
		$q = $this->con->query("INSERT INTO `admins`(`full_names`,`username`,`password`) VALUES ('$full_names','$username','$password')");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Added Successfully.!'];
			}

		}


	public function getData(){
		$q = $this->con->query("SELECT * FROM admins order by admin_id desc");
		$ar = [];
		if ($q->num_rows > 0) {
			while ($row = $q->fetch_assoc()) {
				$ar[] = $row;
			}
		}
		return ['status'=> 202, 'message'=> $ar];
	}

	public function deleteAdmin($bid){
			$q = $this->con->query("DELETE FROM admins WHERE admin_id = '$bid'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Deleted.'];
			}else{
				return ['status'=> 202, 'message'=> 'Failed to run query'];
			}
		

	}


}

  

//php codes for adding Admin
if (isset($_POST['add_admin_details'])) {
	extract($_POST);
	if (!empty($full_names) 
		&& !empty($username) 
		&& !empty($password)) {
			$c = new Admin();
			$result = $c->addAdmin($full_names,$username,$password);
			echo json_encode($result);
			exit();
		}else{
		echo json_encode(['status'=> 303, 'message'=> 'Empty fields.!']);
		exit();
	}
}

//for fetching hostel
if (isset($_POST['Get_Data'])) {
	$p = new Admin();
	echo json_encode($p->getData());
	exit();
	
}

//for deleting
if (isset($_POST['DELETE_DATA'])) {
	extract($_POST);
	if (!empty($bid)) {
		if ($name === 'sydney2323'){
			echo json_encode(['status'=> 303, 'message'=> 'This user cannt be deleted for a while']);
		   exit();
		}
		$p = new Admin();
		echo json_encode($p->deleteAdmin($bid));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Invalid details']);
		exit();
	}
}






?>