<?php
use PHPUnit\Framework\TestCase;

require_once '../www/SignUpFunction.php';

class SignUpTest extends TestCase
{
  public function test()
  {
    $l = New SignUpFunctions;
    $success = $l->signup('Grannys', 'Smith', 'grannys', 'granny101', 'granny101', '01234567890', '123 Granny, Idk, 3210');
    $this->assertEquals($success, true);
  }
  public function test1()
  {
    $l = New SignUpFunctions;
    $success = $l->signup('Grannys', 'Smith2', 'grannys', 'asfasgasfd', 'asfasgasfd', '01234567890', '123 Granny, Idk, 3210');
    $this->assertEquals($success, false);
  }
  public function test2()
  {
    $l = New SignUpFunctions;
    $success = $l->signup('John', 'Doe', 'jdoe', 'r4e3w2q1', 'r4e3w2', '09876543210', '123 Dont Know, What, 3210');
    $this->assertEquals($success, false);
  }
  public function test3()
  {
    $l = New SignUpFunctions;
    $success = $l->signup('Xin Yin', 'Tee', 'txy', 'asianpassword', 'asianpassword', '09546743210', '123 Asian Street, Not Racist, 3210');
    $this->assertEquals($success, true);
  }
  public function test4()
  {
    $l = New SignUpFunctions;
    $success = $l->signup('Will', 'Smith', 'willsm', 'samepassword', 'samepassword', '09809873210', '123 Smith 1, Fake, 3210');
    $this->assertEquals($success, true);
  }
  public function test5()
  {
    $l = New SignUpFunctions;
    $success = $l->signup('Another', 'Will', 'anotherwill', 'samepassword', 'samepassword', '09876598210', '123 Smith 2, Fake, 3210');
    $this->assertEquals($success, true);
  }
  public function test6()
  {
    $l = New SignUpFunctions;
    $success = $l->signup('Fake', 'Person', 'fakeperson', 'fakepassword', 'fakepassword2', '09876543210', '123 Dont Know, What, 3210');
    $this->assertEquals($success, false);
  }
}

?>