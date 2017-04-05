<?php

include("../lib/JSONHandler.php");

	$l = new AddEmployeeWorkTimeFunctions;
	if($l->addWorkTimes($_POST["name"], 
					$_POST["monMorning"], $_POST["monNoon"], $_POST["monAfternoon"], $_POST["monEvening"],
					$_POST["tueMorning"], $_POST["tueNoon"], $_POST["tueAfternoon"], $_POST["tueEvening"],
					$_POST["wedMorning"], $_POST["wedNoon"], $_POST["wedAfternoon"], $_POST["wedEvening"],
					$_POST["thuMorning"], $_POST["thuNoon"], $_POST["thuAfternoon"], $_POST["thuEvening"],
					$_POST["friMorning"], $_POST["friNoon"], $_POST["friAfternoon"], $_POST["friEvening"]))
	{
		header("Location: ");		
	} else {
		header("Location: addEmployeeWorkTime.html");
	}
	
class AddEmployeeWorkTimeFunctions{
	public function addWorkTimes($name, $monMorning, $monNoon, $monAfternoon, $monEvening,
										$tueMorning, $tueNoon, $tueAfternoon, $tueEvening,
										$wedMorning, $wedNoon, $wedAfternoon, $wedEvening,
										$thuMorning, $thuNoon, $thuAfternoon, $thuEvening,
										$friMorning, $friNoon, $friAfternoon, $friEvening){
		$j = new JSONHandler;
		$employeedb = "../database/employees.json";
		$worktimedb = "../database/employeeWorkTime.json";
		if (!empty($j->search($employeedb, "name", $name))){
			$data = array("name" => $name, 
					"monMorning" => $monMorning, "monNoon" => $monNoon,  "monAfternoon" => $monAfternoon, "monEvening" => $monEvening, 
					"tueMorning" => $tueMorning, "tueNoon" => $tueNoon,  "tueAfternoon" => $tueAfternoon, "tueEvening" => $tueEvening, 
					"wedMorning" => $wedMorning, "wedNoon" => $wedNoon,  "wedAfternoon" => $wedAfternoon, "wedEvening" => $wedEvening, 
					"thuMorning" => $thuMorning, "thuNoon" => $thuNoon,  "thuAfternoon" => $thuAfternoon, "thuEvening" => $thuEvening, 
					"friMorning" => $friMorning, "friNoon" => $friNoon,  "friAfternoon" => $friAfternoon, "friEvening" => $friEvening);
			$j->addToFile($worktimedb, $data);
			return true;
		} else {
			//If employee name does not match
			return false;
		}
	}
}

?>