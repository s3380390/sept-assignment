<?php
use PHPUnit\Framework\TestCase;

require_once '../www/AddEmployeeFunction.php';

class AddEmployeeTest extends TestCase
{
  public function test()
  {
    $l = New AddEmployeeFunctions;
    $success = $l->addEmployee('Suzy', 'Conner', 'female', '2017-03-30T08:00', '01234567890', '123 Where, ever, 3210');
    $this->assertEquals($success, true);
  }
  public function test1()
  {
    $l = New AddEmployeeFunctions;
    $success = $l->addEmployee('Lizzy', 'Pioneer', 'female', '2017-03-30T08:00', '01238754890', '123 Somewhere, far, 3210');
    $this->assertEquals($success, false);
  }
  public function test2()
  {
    $l = New AddEmployeeFunctions;
    $success = $l->addEmployee('Andy', 'Pickles', 'male', '2017-03-30T09:00', '01298767890', '123 Somewhere, else, 3210');
    $this->assertEquals($success, true);
  }
    public function test3()
  {
    $l = New AddEmployeeFunctions;
    $success = $l->addEmployee('Anonymous', 'Person', 'other', '2017-04-01T14:00', '0123874390', '123 Nowhere, Out there, 3210');
    $this->assertEquals($success, true);
  }
 }

?>