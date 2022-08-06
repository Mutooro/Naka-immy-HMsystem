<?php
class Dashboard{

	private $con;
	
	function __construct()
	{ 
		include("database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

    	public function getBookings(){
		$q = $this->con->query("SELECT * FROM bookings");
		return $q->num_rows;
	}
	public function getHostels(){
		$q = $this->con->query("SELECT * FROM hostel_name");
		return $q->num_rows;
	}
	public function getRooms(){
		$q = $this->con->query("SELECT * FROM rooms");
		return $q->num_rows;
	}
	public function getStudents(){
		$q = $this->con->query("SELECT * FROM student_tbl");
		return $q->num_rows;
	}
	public function getAverage(){
		$q = $this->con->query("SELECT * FROM rooms");
		$totalNumber = $q->num_rows;
        $fee = 0;
		if ($q->num_rows > 0) {
			while ($row = $q->fetch_assoc()) {
				$fee = $fee + $row['fee'];
			}

		return $fee/$totalNumber;
	}
}
}


//for fetching total bookings
if (isset($_POST['get_bookings'])) {
	$p = new Dashboard();
	echo $p->getBookings();
	exit();	
}

//for fetching total romms
if (isset($_POST['get_hostels'])) {
	$p = new Dashboard();
	echo $p->getHostels();
	exit();	
}

//for fetching total bookings
if (isset($_POST['get_rooms'])) {
	$p = new Dashboard();
	echo $p->getRooms();
	exit();	
}

//for fetching total bookings
if (isset($_POST['get_students'])) {
	$p = new Dashboard();
	echo $p->getStudents();
	exit();	
}

//for getting avarage from user index.php page
if (isset($_POST['get_average'])) {
	$p = new Dashboard();
	echo $p->getAverage();
	exit();	
}
?>