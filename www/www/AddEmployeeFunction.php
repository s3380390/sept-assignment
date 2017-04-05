<?php

include("../lib/JSONHandler.php");
	
	$l = new AddEmployeeFunctions;
	if($l->addEmployee($_POST["firstname"], $_POST["lastname"], $_POST["gender"], 
				$_POST["contact"], $_POST["address"])==true){
		header("Location: addEmployeeConfirmation.html");
	} else {
		header("Location: addEmployee.html");
	}
	
class AddEmployeeFunctions{
	public function addEmployee($firstname, $lastname, $gender, $address, $contact){
		$j = new JSONHandler;
		$employeedb = "../database/employees.json";
		$data = array("name" => $firstname." ".$lastname, "gender" => $gender,
							"address" => $address, "phoneno" => $contact);
		$j->addToFile($employeedb, $data);
		return true;
		
	}
}

?>