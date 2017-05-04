<?php
include_once("../lib/JSONHandler.php");
session_start();

class View{
	public function viewFunction($employeeDatabase, $companyDatabase, $booking, $userType, $userName){
		$j = new JSONHandler;

		if (!empty($company = $j->getFileContents($companyDatabase))){
			foreach ($company as $owner){
				$database = [];

				if ($userType=="Customer"){
					$userName = $owner["username"];
				}
				//check if database is empty
				if (!empty($viewArray = $j->getFileContents($employeeDatabase))){
					foreach ($viewArray as $employee){
						//check if information is empty
						if (empty($employee["company"])
						|| empty($employee["name"])
						|| empty($employee["gender"])
						|| empty($employee["address"])
						|| empty($employee["phoneno"])){
							return false;
						}
						if ($employee["company"]==$userName){
							if ($userType=="Customer"){
								$database[$userName][$employee["name"]]=$employee["name"];
							}
							if ($userType=="Owner"){
								$this -> write($employee, $booking);
							}
						}
					}

					if ($userType=="Owner"){
						return true;
					}
					
					echo "\r\n\t\t<details>\r\n\t\t<summary>" . key($database) . "</summary>";
					foreach ($database as $companyName => $employees){
						foreach ($employees as $employeeName){
							foreach ($viewArray as $employee){
								if ($companyName==$employee["company"] && $employeeName==$employee["name"]){
									$this -> write($employee, $booking);
								}
							}
						}
					}
					echo "\t\t</details>\r\n";
				}
			}
			return true;
		}
		return false;
	}

	function write($employee, $booking){
		$f_tab = "\t\t\t";
		$s_tab = "\t\t\t\t";
		$t_tab = "\t\t\t\t\t";
		$newline = "\r\n";

		echo "$newline"
		. "$f_tab<p>"
		. "{$employee["name"]}"
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
							echo "$newline$t_tab<form action='BookingDetail.html' method='post'>"
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
}

?>
