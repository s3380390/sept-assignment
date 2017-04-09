<?php
use PHPUnit\Framework\TestCase;

require_once '../www/AddEmployeeWorkTimeFunction.php';

class AddEmployeeWorkTimeTest extends TestCase
{
  public function test()
  {
    $l = New AddEmployeeWorkTimeFunctions;
	$inputTime = array(
	"monday" => array(
		"morning" => true,
		"midday" => true,
		"afternoon" => false,
    	"night" => true),
    "tuesday" => array(
		"morning" => true,
		"midday" => true,
		"afternoon" => true,
    	"night" => false),
    "wednesday"=> array(
		"morning" => true,
		"midday" => true,
		"afternoon" => false,
    	"night" => true),
    "thursday"=> array(
		"morning" => true,
		"midday" => true,
		"afternoon" => false,
    	"night" => true),
    "friday"=> array(
		"morning" => true,
		"midday" => true,
		"afternoon" => false,
    	"night" => true),
    "saturday"=> array(
		"morning" => false,
		"midday" => true,
		"afternoon" => true,
    	"night" => false),
    "sunday"=> array(
		"morning" => false,
		"midday" => true,
		"afternoon" => true,
    	"night" => false));
    $success = $l->addWorkTimes('Suzy Coner', $inputTime);
    $this->assertEquals($success, true);
  }  
  public function test1()
  {
    $l = New AddEmployeeWorkTimeFunctions;
    $success = $l->addWorkTimes('Doesnt Exists', 'true', 'false', 'false', 'true',
												'false', 'false', 'false', 'true',
												'true', 'true', 'false', 'false',
												'true', 'false', 'true', 'true',
												'false', 'true', 'false', 'true',
												'false', 'true', 'false', 'true',
												'false', 'true', 'false', 'true');
    $this->assertEquals($success, false);
  }
}

?>