<?php
include_once("../lib/JSONHandler.php");
	
$db = "../database/employeeWorkTime.json";
$v = new View($db);

class View{
	public function view($db){
		$j = new JSONHandler;
		if (!empty($viewArray = $j->getFileContents($db))){
			foreach ($viewArray as $employee){
				echo "<p>{$employee["name"]}<p><table>";
				echo "<th>Day</th> <th>Shift</th> <th>Working</th> <th>Booked</th>\r\n";
				foreach ($employee["workingtimes"] as $dkey => $day){
					foreach ($day as $skey => $shift){
						echo "<tr> <td>$dkey</td> <td>$skey</td> <td>";
						echo $shift["working"] ? "Yes" : "No";
						echo "</td> <td>";
						echo $shift["booked"] ? "Yes" : "No";
						echo "</td> </tr>\r\n";
					}
				}
				echo "</table>";
			}
			return true;
		}
		return false;
	}
}

?>
