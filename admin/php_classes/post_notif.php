<?php
class Notification
{   
	private $con;
	
	function __construct()
	{ 
		include("database.php");
		$db = new Database();
		$this->con = $db->connect();
	}


	public function postNotification($not_desc){
		$not_date= date('d-M-Y');
		$q = $this->con->query("INSERT INTO `notification_tbl`(`not_date`,`not_desc`) VALUES ('$not_date','$not_desc')");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Posted successfully.!'];
			}

		}

	public function getData(){
		$q = $this->con->query("SELECT * FROM notification_tbl order by id desc");
		$ar = [];
		if ($q->num_rows > 0) {
			while ($row = $q->fetch_assoc()) {
				$ar[] = $row;
			}
		}
		return ['status'=> 202, 'message'=> $ar];
	}

	 public function updateNotification($post = null){
		extract($post);
		if (!empty($id) && 
			!empty($not_desc)) {
			$q = $this->con->query("UPDATE notification_tbl SET 
				                                         not_desc='$not_desc' 
				                                         WHERE id = '$id'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Updated Successfully.'];
			}else{
				return ['status'=> 202, 'message'=> 'Failed to run query'];
			}
			
		}else{
			return ['status'=> 303, 'message'=>'Empty field.'];
		}

	}

	public function deleteNotification($id = null){
		if ($id != null) {
			$q = $this->con->query("DELETE FROM notification_tbl WHERE id = '$id'");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Deleted.'];
			}else{
				return ['status'=> 202, 'message'=> 'Failed to run query'];
			}
			
		}else{
			return ['status'=> 303, 'message'=>'Invalid  id'];
		}

	}	

}

//for posting notifications
if (isset($_POST['post_notification'])) {
	extract($_POST);
	if (!empty($not_desc)) {
			$c = new Notification();
			$result = $c->postNotification($not_desc);
			echo json_encode($result);
			exit();
		}else{
		echo json_encode(['status'=> 303, 'message'=> 'Empty fields.!']);
		exit();
	}
}

//for fetching notifications
if (isset($_POST['Get_Data'])) {
	$p = new Notification();
	echo json_encode($p->getData());
	exit();
}

//for edditing/upadate
if (isset($_POST['edit_post_notification'])) {
	if (!empty($_POST['id'])) {
		$p = new Notification();
		echo json_encode($p->updateNotification($_POST));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Invalid id']);
		exit();
	}
}

//for deleting
if (isset($_POST['DELETE_DATA'])) {
	if (!empty($_POST['id'])) {
		$p = new Notification();
		echo json_encode($p->deleteNotification($_POST['id']));
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Invalid details']);
		exit();
	}
}
