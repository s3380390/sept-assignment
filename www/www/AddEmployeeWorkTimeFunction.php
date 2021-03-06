<?php
	session_start();

	include("config.php");
	

        
	$worktimedb = $database["employees"];
	$l = new AddEmployeeWorkTimeFunctions;
        //creaion of array to hold employee work times
	$inputTime = array(
	"monday" => array(
		//array filled using input from add employee page 
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
        //checking if adding work times was successful
	if($reason = $l->addWorkTimes($worktimedb, $_POST["name"], $inputTime)=="success")
	{	
		//If operation is a success, a message displayed and user is redirected to confrimation page
		$log->addInfo("Employee " . $_POST["name"] . " work time added successfully" );
		header("Location: addWorkTimeConfirmation.html");
	} else {
		//If operation fails, error mesage displayed and user remains on same page
		$log->addInfo("Employee " . $_POST["name"] . " work time change failed, reason: " . $reason);
		$_SESSION["reason"] = $reason;
		header("Location: addEmployeeWorkTime.html");
	}
	
class AddEmployeeWorkTimeFunctions{
	public function addWorkTimes($worktimedb, $name, $inputTime){
		$j = new JSONHandler;
		$edited = false;
		$bookedTimeConflict = false;
		if (!empty($viewArray = $j->getFileContents($worktimedb))){
			foreach ($viewArray as $e_key => $employee){
				if ($employee["name"]==str_replace("_", " ", $name)){
					foreach ($employee["workingtimes"] as $dkey => $day){
						foreach ($inputTime as $in_dkey => $in_day){
							if ($in_dkey==$dkey){
								foreach ($day as $skey => $shift){
									foreach ($in_day as $tkey => $value){
										if ($tkey==$skey){ 
											if ($value!=NULL){
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
		}
		if ($edited && !$bookedTimeConflict){
			$json = json_encode($viewArray, JSON_PRETTY_PRINT);
			file_put_contents($worktimedb, $json);
			return "success";
		}
		return "noChange";
	}
}

?>
