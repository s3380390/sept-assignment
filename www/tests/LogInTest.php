<?php
use PHPUnit\Framework\TestCase;

require_once '../www/LoginFunction.php';

class LogInTest extends TestCase
{
  public function test()
  {
    $l = New LoginFunctions;
    $success = $l->login('jbrown', 'ap6&svTT');
    $this->assertEquals($success, true);
  }

  public function test2()
  {
    $l = New LoginFunctions;
    $success = $l->login('admin', 'fake');
    $this->assertEquals($success, false);
  }

  public function test3()
  {
    $l = New LoginFunctions;
    $success = $l->login('asmith', '9gH*4b%!');
    $this->assertEquals($success, true);
  }

  public function test4()
  {
    $l = New LoginFunctions;
    $success = $l->login('twilson', 'ap6&svTT');
    $this->assertEquals($success, false);
  }

  public function test5()
  {
    $l = New LoginFunctions;
    $success = $l->login('twilson', 'L*9HmbaS');
    $this->assertEquals($success, true);
  }

  public function test6()
  {
    $l = New LoginFunctions;
    $success = $l->login('admin', 'L*9HmbaS');
    $this->assertEquals($success, false);
  }

  public function test7()
  {
    $l = New LoginFunctions;
    $success = $l->login('jbrown', 'L*9HmbaS');
    $this->assertEquals($success, false);
  }
}
?>
