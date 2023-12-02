<?php

class Database
{   
	
	private $con;
	public function connect(){
		$this->con = new Mysqli("127.0.0.1", "root", "", "hmsystem");
		return $this->con;
	}
}


?>