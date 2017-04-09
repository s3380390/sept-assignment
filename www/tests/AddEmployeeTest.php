<?php
use PHPUnit\Framework\TestCase;

require_once '../www/AddEmployeeFunction.php';

class AddEmployeeTest extends TestCase
{
  public function test()
  {
    $l = New AddEmployeeFunctions;
    $success = $l->addEmployee('Suzy', 'Conner', 'female', '123 Where, ever, 3210', '01234567890');
    $this->assertEquals($success, true);
  }
  public function test1()
  {
    $l = New AddEmployeeFunctions;
    $success = $l->addEmployee('Lizzy', 'Pioneer', 'female', '123 Somewhere, far, 3210', '01238754890');
    $this->assertEquals($success, true);
  }
  public function test2()
  {
    $l = New AddEmployeeFunctions;
    $success = $l->addEmployee('Andy', 'Pickles', 'male', '123 Somewhere, else, 3210', '01298767890');
    $this->assertEquals($success, true);
  }
    public function test3()
  {
    $l = New AddEmployeeFunctions;
    $success = $l->addEmployee('Anonymous', 'Person', 'other', '123 Nowhere, Out there, 3210', '0123874390');
    $this->assertEquals($success, true);
  }
 }

?>