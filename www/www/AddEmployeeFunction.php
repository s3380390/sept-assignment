<?php

include("../lib/JSONHandler.php");
	
	$l = new AddEmployeeFunctions;
	$l->addEmployee($_POST["firstname"], $_POST["lastname"], $_POST["gender"], $_POST["working-day"], 
				$_POST["contact"], $_POST["address"]);
	
class AddEmployeeFunctions{
	public function addEmployee($firstname, $lastname, $gender, $workingDay, $address, $contact){
		$j = new JSONHandler;
		$employeedb = "../database/employees.json";
		if (!empty($j->search($employeedb, "workingDay", $workingDay))){
			echo "Someone is already working at this time!";
			return false;
		} else {
			$data = array("name" => $firstname." ".$lastname, "gender" => $gender, "workingDay" => $workingDay,
							"address" => $address, "phoneno" => $contact);
			$j->addToFile($employeedb, $data);
			return true;
		}
	}
}

?>