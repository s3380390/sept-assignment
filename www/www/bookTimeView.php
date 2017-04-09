<?php
include_once("../lib/JSONHandler.php");
	
$db = "../database/employeeWorkTime.json";
$v = new View;
if (!$v->viewFunction($db)){
	echo "<p>"
	. "Booking time file is either not found or corrupted"
	. "<p>";
}

class View{
	public function viewFunction($db){
		$j = new JSONHandler;
		$f_tab = "\t\t";
		$s_tab = "\t\t\t";
		$t_tab = "\t\t\t\t";
		$newline = "\r\n";
		if (!empty($viewArray = $j->getFileContents($db))){
			foreach ($viewArray as $employee){
				if (empty($employee["company"])
				|| empty($employee["name"])
				|| empty($employee["gender"])
				|| empty($employee["address"])
				|| empty($employee["phoneno"])){
					return false;
				}
				echo "$newline"
				. "$f_tab<p>"
				. "{$employee["name"]} from {$employee["company"]}"
				. "<p>$newline";
				echo "$f_tab<table>$newline$s_tab<tr>$newline" 
				. "$t_tab<th>Day</th>$newline"
				. "$t_tab<th>Shift</th>$newline "
				. "$t_tab<th>Working</th>$newline"
				. "$t_tab<th>Booked</th>$newline$s_tab</tr>$newline";
				foreach ($employee["workingtimes"] as $dkey => $day){
					foreach ($day as $skey => $shift){
						echo "$s_tab<tr>$newline"
						. "$t_tab<td>$dkey</td>$newline"
						. "$t_tab<td>$skey</td>$newline"
						. "$t_tab<td>";
						echo $shift["working"] ? "Yes" : "No";
						echo "</td>$newline"
						. "$t_tab<td>";
						echo $shift["booked"] ? "Yes" : "No";
						echo "</td>$newline"
						. "$s_tab</tr>$newline";
					}
				}
				echo "$f_tab</table>$newline";
			}
			return true;
		}
		return false;
	}
}

?>
