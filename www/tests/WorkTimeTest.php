<?php
use PHPUnit\Framework\TestCase;

require_once '../www/AddEmployeeWorkTimeFunction.php';

class AddEmployeeWorkTimeTest extends TestCase
{
  public function test()
  {
    $l = New AddEmployeeWorkTimeFunctions;
    $success = $l->addWorkTimes('Suzy Conner', 'true', 'false', 'false', 'true',
												'false', 'false', 'false', 'true',
												'true', 'true', 'false', 'false',
												'true', 'false', 'true', 'true',
												'false', 'true', 'false', 'true');
    $this->assertEquals($success, true);
  }
  public function test1()
  {
    $l = New AddEmployeeWorkTimeFunctions;
    $success = $l->addWorkTimes('Doesnt Exists', 'true', 'false', 'false', 'true',
												'false', 'false', 'false', 'true',
												'true', 'true', 'false', 'false',
												'true', 'false', 'true', 'true',
												'false', 'true', 'false', 'true');
    $this->assertEquals($success, false);
  }
}

?>