<?php
session_start();
include("config.php");
$bookingdb = $database["bookings"];
$worktimedb = $database["employees"];
$b = new Book;
$j = new JSONHandler;
$success = true;

if (empty($b->informationProcessor($_POST))){
	$success = false;
} else {
	$employeeArray = $j->getFileContents($worktimedb);
	foreach ($employeeArray as $e_key => $employee){
		if ($employee["name"] == $b -> Employee){
			$employeeArray[$e_key]["workingtimes"][$b -> BookDay][$b -> BookShift]["booked"] = true;
		}
	}
	$json = json_encode($employeeArray, JSON_PRETTY_PRINT);
	file_put_contents($worktimedb, $json);

	$b->bookFunction($bookingdb);
}
if ($success == false){
	echo "<p>"
	. "Booking file is either not found or corrupted"
	. "<p>";
	$log->addInfo("Booking was unsuccessful");
} else {
	echo "<p>"
	. "Booked Successfully"
	. "<p>";
	$log->addInfo("Booking successfully made");
}

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
		$Description = $information["description"];
		$informationArray = explode("||", array_pop(array_keys($information)));
		$this -> Company = $informationArray[0];
		$this -> Employee = str_replace("_", " ", $informationArray[1]);
		$this -> BookDay = $informationArray[2];
		$this -> BookShift = $informationArray[3];
		$this -> Customer = $informationArray[4];
		return true;
	}
}
?>
