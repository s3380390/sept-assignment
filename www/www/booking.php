<?php
include_once("../lib/JSONHandler.php");
class Book{
	public function bookFunction($db){
		$j = new JSONHandler;
		$data = array("company" => $this -> Company,
			"employee" => $this -> Employee,
			"customer" => $this -> Customer,
			"day" => $this -> BookDay,
			"shift" => $this -> BookShift,
			"description" => $this -> Description);
		$j->addToFile($db, $data);
	}

	function informationProcessor($information){
		if (empty($information)){
			return false;
		}
		$this -> Description = $information["description"];
		$informationArray = explode("||", array_pop(array_keys($information)));
		$this -> Company = $informationArray[0];
		$this -> Employee = str_replace("_", " ", $informationArray[1]);
		$this -> BookDay = $informationArray[2];
		$this -> BookShift = $informationArray[3];
		$this -> Customer = str_replace("_", " ", $$informationArray[4]);
		return true;
	}
}
?>
