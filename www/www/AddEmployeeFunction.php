<?php
include_once("config.php");
	
class AddEmployeeFunctions{
	public function addEmployee($firstname, $lastname, $gender, $address, $contact){
		$j = new JSONHandler;
		$employeedb = "../database/employees.json";
		$data = array("company" => $_SESSION['UserName'], "name" => $firstname." ".$lastname, "gender" => $gender,
							"address" => $address, "phoneno" => $contact, "workingtimes" => 
									["monday" =>  //initialising new employee work times
										["morning" => ["working" => false, "booked" => false],
										 "midday" => ["working" => false, "booked" => false],
										 "afternoon" => ["working" => false, "booked" => false],
										 "night" => ["working" => false, "booked" => false]],
									"tuesday" => 
										["morning" => ["working" => false, "booked" => false],
										 "midday" => ["working" => false, "booked" => false],
										 "afternoon" => ["working" => false, "booked" => false],
										 "night" => ["working" => false, "booked" => false]],
									"wednesday" => 
										["morning" => ["working" => false, "booked" => false],
										 "midday" => ["working" => false, "booked" => false],
										 "afternoon" => ["working" => false, "booked" => false],
										 "night" => ["working" => false, "booked" => false]],
									"thursday" => 
										["morning" => ["working" => false, "booked" => false],
										 "midday" => ["working" => false, "booked" => false],
										 "afternoon" => ["working" => false, "booked" => false],
										 "night" => ["working" => false, "booked" => false]],
									"friday" => 
										["morning" => ["working" => false, "booked" => false],
										 "midday" => ["working" => false, "booked" => false],
										 "afternoon" => ["working" => false, "booked" => false],
										 "night" => ["working" => false, "booked" => false]],
									"saruday" => 
										["morning" => ["working" => false, "booked" => false],
										 "midday" => ["working" => false, "booked" => false],
										 "afternoon" => ["working" => false, "booked" => false],
										 "night" => ["working" => false, "booked" => false]],
									"sunday" => 
										["morning" => ["working" => false, "booked" => false],
										 "midday" => ["working" => false, "booked" => false],
										 "afternoon" => ["working" => false, "booked" => false],
										 "night" => ["working" => false, "booked" => false]]]
									);
		$j->addToFile($employeedb, $data);
		return true;
		
	}
}

?>
