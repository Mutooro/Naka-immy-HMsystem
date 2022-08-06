<?php
class Student
{   
	private $con;
	
	function __construct()
	{ 
		include("database.php");
		$db = new Database();
		$this->con = $db->connect();
	}


	public function addStudent($student_reg_no, $Year){
		$q = $this->con->query("SELECT * FROM student_add_tbl WHERE student_reg_no = '$student_reg_no'");
		if ($q->num_rows > 0) {
           return ['status'=> 303, 'message'=> 'The Reg number is already in the database.'];
           exit();
		}

		$q = $this->con->query("INSERT INTO `student_add_tbl`(`student_reg_no`, `Year`) VALUES ('$student_reg_no','$Year')");
			if ($q) {
				return ['status'=> 202, 'message'=> 'Added Successfully.!'];
			}

		}

	public function addStudentCSV($file){


        $filename = $_FILES["student_csv"]["name"]; 
        $filenameAr= explode(".",$filename);
		$extension = end($filenameAr);
		$ext = strtolower($extension);


		if ($ext == "csv") {

        $file = fopen($_FILES["student_csv"]["tmp_name"], "r");
          while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
           {
            $q = $this->con->query("INSERT into student_add_tbl (student_reg_no,Year) 
                   values ('".$getData[0]."','".$getData[1]."')");
           } 
           fclose($file);       
        if($q)
        {
          return ['status'=> 202, 'message'=> 'Added Successfully.!'];    
        }else{
            return ['status'=> 303, 'message'=> 'Please check one of the registration number is in the data base.!'];
        }
    }else{
    	return ['status'=> 303, 'message'=> 'Invalid file. choose csv file!'];
    }
} 


  public function load_all_students(){
            ## Read value
			$draw = $_POST['draw'];
			$row = $_POST['start'];
			$rowperpage = $_POST['length']; // Rows display per page
			$columnIndex = $_POST['order'][0]['column']; // Column index
			$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
			$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
			$searchValue = $this->con->real_escape_string($_POST['search']['value']); // Search value

			## Search 
			$searchQuery = " ";
			if($searchValue != ''){
			   $searchQuery = " and (f_name like '%".$searchValue."%' or 
			        l_name like '%".$searchValue."%' or 
			        gender like'%".$searchValue."%' or
			        student_no like '%".$searchValue."%' or
			        student_reg_no like '%".$searchValue."%' or
			        course like '%".$searchValue."%' ) ";
			}

			## Total number of records without filtering
			$sel = $this->con->query("select count(*) as allcount from student_tbl");
			$records = $sel->fetch_assoc();
			$totalRecords = $records['allcount'];

			## Total number of record with filtering
			$sel = $this->con->query("select count(*) as allcount from student_tbl WHERE 1 ".$searchQuery);
			$records = $sel->fetch_assoc();
			$totalRecordwithFilter = $records['allcount'];

			## Fetch records
			$empQuery = "select * from student_tbl WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
			$empRecords = $this->con->query($empQuery);
			$data = array();

			while ($row = $empRecords->fetch_assoc()) {
			   $data[] = array( 
			     "f_name"=>$row['f_name'],
			      "l_name"=>$row['l_name'],
			      "gender"=>$row['gender'],
			      "student_no"=>$row['student_no'],
			      "address"=>$row['address'],
			      "student_reg_no"=>$row['student_reg_no'],
			      "course"=>$row['course'],
			      "emmercence_no"=>$row['emmercence_no'],
			      "father_names"=>$row['father_names'],
			      "place"=>$row['place'],
			      "occupation"=>$row['occupation'],
			      "phone_1"=>$row['phone_1'],
			      "phone_2"=>$row['phone_2'],
			      "email"=>$row['email']
			   );
			}

			## Response
			$response = array(
			  "draw" => intval($draw),
			  "iTotalRecords" => $totalRecords,
			  "iTotalDisplayRecords" => $totalRecordwithFilter,
			  "aaData" => $data
			);

			 return $response; 
			  }
  

 public function fetchStudentAdded(){
            ## Read value
			$draw = $_POST['draw'];
			$row = $_POST['start'];
			$rowperpage = $_POST['length']; // Rows display per page
			$columnIndex = $_POST['order'][0]['column']; // Column index
			$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
			$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
			$searchValue = $this->con->real_escape_string($_POST['search']['value']); // Search value

			## Search 
			$searchQuery = " ";
			if($searchValue != ''){
			   $searchQuery = " and (student_reg_no like '%".$searchValue."%' or 
			        Year like '%".$searchValue."%' ) ";
			}

			## Total number of records without filtering
			$sel = $this->con->query("select count(*) as allcount from student_add_tbl");
			$records = $sel->fetch_assoc();
			$totalRecords = $records['allcount'];

			## Total number of record with filtering
			$sel = $this->con->query("select count(*) as allcount from student_add_tbl WHERE 1 ".$searchQuery);
			$records = $sel->fetch_assoc();
			$totalRecordwithFilter = $records['allcount'];

			## Fetch records
			$empQuery = "select * from student_add_tbl WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
			$empRecords = $this->con->query($empQuery);
			$data = array();

			while ($row = $empRecords->fetch_assoc()) {
			   $data[] = array( 
			     "student_reg_no"=>$row['student_reg_no'],
			      "Year"=>$row['Year']
			   );
			}

			## Response
			$response = array(
			  "draw" => intval($draw),
			  "iTotalRecords" => $totalRecords,
			  "iTotalDisplayRecords" => $totalRecordwithFilter,
			  "aaData" => $data
			);

			 return $response; 
	 }
  

  }


//php codes for adding students details
if (isset($_POST['add_student'])) {
	extract($_POST);
	if (!empty($student_reg_no) && !empty($Year)) {
			$c = new Student();
			$result = $c->addStudent($student_reg_no, $Year);
			echo json_encode($result);
			exit();
		}else{
		echo json_encode(['status'=> 303, 'message'=> 'Empty fields.!']);
		exit();
	}
}
//for fetching students
if (isset($_POST['fetchStudentAdded'])) {
	$c = new Student();
	$result = $c->fetchStudentAdded();
	echo json_encode($result);
	exit();
}

//add student fro CSV file
if (isset($_POST['add_student_csv'])) {
	extract($_POST);
	if(!empty($_FILES['student_csv']['name'])){
		$c = new Student();
	    $result = $c->addStudentCSV($_FILES['student_csv']['name']);
	    echo json_encode($result);
	    exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Empty field.!']);
		exit();
	}
	
}

//for loading all student list and other impo information..from view_students.php
if (isset($_POST['load_all_students'])) {
	$c = new Student();
	$result = $c->load_all_students();
	echo json_encode($result);
	exit();
}





    


?>