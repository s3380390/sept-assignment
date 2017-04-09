<?php

include("../lib/JSONHandler.php");

	$l = new AddEmployeeWorkTimeFunctions;
	$inputTime = array(
	"monday" => array(
		"morning" => $_POST["monMorning"],
		"midday" => $_POST["monNoon"],
		"afternoon" => $_POST["monAfternoon"],
    	"night" => $_POST["monEvening"]),
    "tuesday" => array(
		"morning" => $_POST["tueMorning"],
		"midday" => $_POST["tueNoon"],
		"afternoon" => $_POST["tueAfternoon"],
    	"night" => $_POST["tueEvening"]),
    "wednesday"=> array(
		"morning" => $_POST["wedMorning"],
		"midday" => $_POST["wedNoon"],
		"afternoon" => $_POST["wedAfternoon"],
    	"night" => $_POST["wedEvening"]),
    "thursday"=> array(
		"morning" => $_POST["thuMorning"],
		"midday" => $_POST["thuNoon"],
		"afternoon" => $_POST["thuAfternoon"],
    	"night" => $_POST["thuEvening"]),
    "friday"=> array(
		"morning" => $_POST["friMorning"],
		"midday" => $_POST["friNoon"],
		"afternoon" => $_POST["friAfternoon"],
    	"night" => $_POST["friEvening"]),
    "saturday"=> array(
		"morning" => $_POST["satMorning"],
		"midday" => $_POST["satNoon"],
		"afternoon" => $_POST["satAfternoon"],
    	"night" => $_POST["satEvening"]),
    "sunday"=> array(
		"morning" => $_POST["sunMorning"],
		"midday" => $_POST["sunNoon"],
		"afternoon" => $_POST["sunAfternoon"],
    	"night" => $_POST["sunEvening"]));
	if($l->addWorkTimes($_POST["name"], $inputTime))
	{	
		header("Location: addWorkTimeConfirmation.html");
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
	public function addWorkTimes($name, $inputTime){
		$j = new JSONHandler;
		$worktimedb = "../database/employees.json";
		$edited = false;
		if (!empty($viewArray = $j->getFileContents($worktimedb))){
			foreach ($viewArray as $e_key => $employee){
				if ($employee["name"]==$name){
					foreach ($employee["workingtimes"] as $dkey => $day){
						foreach ($inputTime as $in_dkey => $in_day){
							if ($in_dkey==$dkey){
								foreach ($day as $skey => $shift){
									foreach ($in_day as $tkey => $value){
										if ($tkey==$skey){
											if ($value=="true"){
												$viewArray[$e_key]["workingtimes"][$dkey][$skey]["working"] = true;
											} else {
												$viewArray[$e_key]["workingtimes"][$dkey][$skey]["working"] = false;
											}
											$edited = true;
										}
									}
								}
							}
						}
					}
				}
			}
		}
		if ($edited){
			$json = json_encode($viewArray, JSON_PRETTY_PRINT);
			file_put_contents($worktimedb, $json);
		}
		return $edited;
	}
}

?>
