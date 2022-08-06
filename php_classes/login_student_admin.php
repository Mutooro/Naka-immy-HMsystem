<?php 
session_start();
/**
 * 
 */
class Credentials
{
	
	private $con;
	
	function __construct()
	{ 
		include("../admin/php_classes/database.php");
		$db = new Database();
		$this->con = $db->connect();
	}


	public function loginStudent($student_reg_no, $password){
		$q = $this->con->query("SELECT * FROM student_tbl WHERE student_reg_no = '$student_reg_no' LIMIT 1");
		if ($q->num_rows > 0) {
			$row = $q->fetch_assoc();
			if ($password == $row['password']) {
				$_SESSION['student_name'] = $row['f_name'].' '.$row['l_name'];
				$_SESSION['student_reg_no'] = $row['student_reg_no'];
				return ['status'=> 202, 'message'=> 'Login Successfully'];
			}else{
				return ['status'=> 303, 'message'=> 'Invalid password.'];
			}
		}else{
			return ['status'=> 303, 'message'=> 'Account not created yet with this Regestration number.'];
		}
	}

	public function loginAdmin($username, $password){
		$q = $this->con->query("SELECT * FROM admins WHERE username = '$username' AND password= '$password' LIMIT 1");
		if ($q->num_rows > 0) {
			$row = $q->fetch_assoc();
				$_SESSION['admin_names'] = $row['full_names'];
				$_SESSION['admin_username'] = $row['username'];
				return ['status'=> 202, 'message'=> 'Login Successfully'];
		}else{
			return ['status'=> 303, 'message'=> 'Invalid username or password.'];
		}
	}

}



if (isset($_POST['student_login'])) {
	extract($_POST);
	if (!empty($student_reg_no) && !empty($password)) {
		$c = new Credentials();
		$result = $c->loginStudent($student_reg_no, $password);
		echo json_encode($result);
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Empty fields']);
		exit();
	}
}

if (isset($_POST['admin_login'])) {
	extract($_POST);
	if (!empty($username) && !empty($password)) {
		$c = new Credentials();
		$result = $c->loginAdmin($username, $password);
		echo json_encode($result);
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Empty fields']);
		exit();
	}
}
//logout
if(isset($_POST['logout_student_btn']))
   	{
       session_destroy();
       unset($_SESSION['student_name']);
       unset($_SESSION['student_reg_no']);
   	}

//for admin
  if(isset($_POST['logout_admin_btn']))
   	{
       session_destroy();
       unset($_SESSION['admin_names']);
       unset($_SESSION['admin_username']);
   	} 	


?>