<?php
include_once("../lib/JSONHandler.php");

$db = "../database/employees.json";
$l = new ListEmployee;
//check if the database is correct
if (!$l->listFunction($db)){
	//return to homepage if database is not
	header('Location: OwnerHome.html');
}

class ListEmployee{
	public function listFunction($db){
		$j = new JSONHandler;
		$tab = "\t\t\t\t";
		$newline = "\r\n";
		if (!empty($employeeArray = $j->getFileContents($db))){
			foreach ($employeeArray as $employee){
				if (empty($employee["name"])
				|| empty($employee["gender"])
				|| empty($employee["address"])
				|| empty($employee["phoneno"])){
					return false;
				}
				echo "$newline"
				. "$tab<option value=\"" . $employee["name"] . "\">"
				. "{$employee["name"]}"
				. "</option>";
			}
			echo "$newline$tab";
			return true;
		}
		return false;
	}
}

?>
