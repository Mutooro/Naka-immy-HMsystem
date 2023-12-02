<?php
class Students
{   
	private $con;
	
	function __construct()
	{ 
		include("../admin/php_classes/database.php");
		$db = new Database();
		$this->con = $db->connect();
	}


	public function registerStudent($f_name, $l_name, $gender, $student_no, $address, $student_reg_no, $course, $emmercence_no, $father_names, $place, $occupation, $phone_1, $phone_2, $email, $password)
{
    
    $q = $this->con->query("SELECT student_reg_no FROM student_add_tbl WHERE student_reg_no = '$student_reg_no'");
    if ($q->num_rows > 0) {
        
        $q = $this->con->query("SELECT student_reg_no FROM student_tbl WHERE student_reg_no = '$student_reg_no'");
        if ($q->num_rows > 0) {
           
            return ['status' => 303, 'message' => 'Please login..! You can NOT register twice.'];
            
        } else {
       
            $q = $this->con->query("INSERT INTO student_tbl (f_name, l_name, gender, student_no, address, student_reg_no, course, emmercence_no, father_names, place, occupation, phone_1, phone_2, email, password) VALUES ('$f_name', '$l_name', '$gender', '$student_no', '$address', '$student_reg_no', '$course', '$emmercence_no', '$father_names', '$place', '$occupation', '$phone_1', '$phone_2', '$email', '$password')");
            if ($q) {
               
                return ['status' => 202, 'message' => 'Registered Successfully.! Please login.'];
             
            }
        }
    } else {
 
        return ['status' => 303, 'message' => 'Registration number is NOT available or INCORRECT.! Please try again.'];
        
    }
}

}

//php codes for registering a students 
if (isset($_POST['student_add'])) {
	extract($_POST);
	if (!empty($f_name) && !empty($l_name) && !empty($gender) && !empty($student_no) && !empty($address) && !empty($student_reg_no) && !empty($course) && !empty($emmercence_no) && !empty($father_names) && !empty($place) && !empty($occupation) && !empty($phone_1) && !empty($phone_2) && !empty($email) && !empty($password) && !empty($c_password))
	{
		if($password == $c_password){
			$c = new Students();
			$result = $c->registerStudent($f_name, $l_name,$gender ,$student_no ,$address ,$student_reg_no ,$course ,$emmercence_no ,$father_names ,$place ,$occupation ,$phone_1 ,$phone_2 ,$email ,$password);
			echo json_encode($result);
			exit();
		}else{
		echo json_encode(['status'=> 303, 'message'=> 'Passwords DO NOT Match.!']);	
		exit();
		}

		}else{
		echo json_encode(['status'=> 303, 'message'=> 'Empty fields.!']);
		exit();
	}
}