<?php

class Database
{   
	
	private $con;
	public function connect(){
		$this->con = new Mysqli("sql311.epizy.com", "epiz_29222218", "XFBb2yWY0P06W", "epiz_29222218_hms_3");
		return $this->con;
	}
}


?>