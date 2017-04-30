<?php
include_once("../lib/JSONHandler.php");
	
$db = "../database/employees.json";
$v = new View;
//check if database is in correct format and display in table view
if (!$v->viewFunction($db, $booking)){
	echo "<p>"
	. "Booking time file is either not found or corrupted"
	. "<p>";
}

class View{
	public function viewFunction($db, $booking){
		$j = new JSONHandler;
		$f_tab = "\t\t";
		$s_tab = "\t\t\t";
		$t_tab = "\t\t\t\t";
		$newline = "\r\n";
		//check if database is empty
		if (!empty($viewArray = $j->getFileContents($db))){
			foreach ($viewArray as $employee){
				//check if information is empty
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
				. "$t_tab<th></th>$newline"
				. "$t_tab<th>Morning</th>$newline "
				. "$t_tab<th>Mid Day</th>$newline"
				. "$t_tab<th>Afternoon</th>$newline"
				. "$t_tab<th>Night</th>$newline$s_tab</tr>$newline";
				foreach ($employee["workingtimes"] as $dkey => $day){
					echo "$s_tab<tr>$newline"
						. "$t_tab<td style=\"font-weight: bold\">$dkey</td>$newline";
					foreach ($day as $skey => $shift){
						echo "$t_tab<td>";
						if (!$shift["working"]){
							echo "Not Working";
						} else {
							if ($shift["booked"]){
								echo "Booked";
							} else {
								if (!$booking){
									echo "Not Booked";
								} else {
									echo "$newline$t_tab<form action='CustomerBookingDetail.html' method='post'>"
									. "$newline$t_tab\t<input type='submit' name='" 
										. $employee["company"] . "||" . $employee["name"] . "||" . $dkey . "||" . $skey . "' value='Book'>"
									. "$newline$t_tab</form>";
								}
							}
						}
						echo "</td>$newline";
					}
					echo "$s_tab</tr>$newline";
				}
				echo "$f_tab</table>$newline";
			}
			return true;
		}
		return false;
	}
}

?>
