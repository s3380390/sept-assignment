<?php
include_once("../lib/JSONHandler.php");
	
$db = "../database/booking.json";
$v = new Summary;
//check if database is in correct format and display in table view
if (!$v->viewFunction($db, $summary)){
	echo "<p>"
	. ""
	. "<p>";
}

class Summary{
	public function viewFunction($db, $summary){
		$j = new JSONHandler;
		$f_tab = "\t\t";
		$s_tab = "\t\t\t";
		$t_tab = "\t\t\t\t";
		$newline = "\r\n";
		if (!empty($viewArray = $j->getFileContents($db))){
			//Initializing the table
			echo "$f_tab<table>$newline$s_tab<tr>$newline" 
			. "$t_tab<th>Employee</th>$newline"
			. "$t_tab<th>Customer</th>$newline"
			. "$t_tab<th>Day</th>$newline"
			. "$t_tab<th>Shift</th>$newline"
			. "$t_tab<th>Description</th>$newline$s_tab</tr>$newline";
			
			foreach ($viewArray as $employee){
				if (empty($employee["company"])
				|| empty($employee["employee"])
				|| empty($employee["customer"])
				|| empty($employee["day"])
				|| empty($employee["shift"])){
					return false;
				}
				if ($employee["company"] == $_SESSION['UserName']){
					echo "$s_tab<tr>$newline"
					. "$t_tab<th>{$employee["employee"]}</th>$newline "
					. "$t_tab<th>{$employee["customer"]}</th>$newline"
					. "$t_tab<th>{$employee["day"]}</th>$newline"
					. "$t_tab<th>{$employee["shift"]}</th>$newline"
					. "$t_tab<th>{$employee["description"]}</th>$newline$s_tab</tr>$newline";
				}
			}
		}
	}
}