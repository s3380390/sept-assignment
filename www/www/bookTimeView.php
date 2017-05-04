<?php
include_once("../lib/JSONHandler.php");

class View{
	public function viewFunction($employeeDatabase, $companyDatabase, $booking, $userType, $userName){
		$j = new JSONHandler;
		
		if ($userType=="Customer"){
			$customerName = $userName;
		}

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
								$this -> write($employee, $booking, NULL);
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
									$this -> write($employee, $booking, $customerName);
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

	function write($employee, $booking, $customerName){
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
						if ($booking){
							echo "Booked";
						} else {
							if (!empty($customerName)
							&& !empty($bookDetail = $this->checkBookingCustomer($employee, $dkey, $skey, $customerName))){
								echo "$newline$t_tab<form action='ViewBookingDetail.html' method='post'>"
								. "$newline$t_tab\t<input type='submit' name='" 
									. $bookDetail["company"] . "||" . $bookDetail["employee"] . "||" . $dkey . "||" . $skey . "||" . $customerName . "||" . $bookDetail["description"] . "' value='View'>"
								. "$newline$t_tab</form>";
							}
						}
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

	function checkBookingCustomer($employee, $day, $shift, $customerName){
		$bookingDatabase = '../database/booking.json';

		$j = new JSONHandler;

		if (!empty($booking = $j->getFileContents($bookingDatabase))){
			foreach ($booking as $bookingDetail){
				if ($bookingDetail["company"]==$employee["company"]
				&& $bookingDetail["employee"]==$employee["name"]
				&& $bookingDetail["day"]==$day
				&& $bookingDetail["shift"]==$shift
				&& $bookingDetail["customer"]==$customerName){
					return $bookingDetail;
				}
			}
		}
	}
}

?>
