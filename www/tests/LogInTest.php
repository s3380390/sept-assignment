<?php
use PHPUnit\Framework\TestCase;

include_once("config.php");

class LogInTest extends TestCase
{
  public function test()
  {
    $l = New LoginFunctions;
    $success = $l->login('jbrown', 'ap6&svTT', $database['customers'], 'customer');
    $this->assertEquals($success, true);
  }

  public function test2()
  {
    $l = New LoginFunctions;
    $success = $l->login('admin', 'fake', $database['customers'], 'customer');
    $this->assertEquals($success, false);
  }

  public function test3()
  {
    $l = New LoginFunctions;
    $success = $l->login('asmith', '9gH*4b%!', $database['customers'], 'customer');
    $this->assertEquals($success, true);
  }

  public function test4()
  {
    $l = New LoginFunctions;
    $success = $l->login('twilson', 'ap6&svTT', $database['customers'], 'customer');
    $this->assertEquals($success, false);
  }

  public function test5()
  {
    $l = New LoginFunctions;
    $success = $l->login('twilson', 'L*9HmbaS', $database['customers'], 'customer');
    $this->assertEquals($success, true);
  }

  public function test6()
  {
    $l = New LoginFunctions;
    $success = $l->login('admin', 'L*9HmbaS', $database['customers'], 'customer');
    $this->assertEquals($success, false);
  }

  public function test7()
  {
    $l = New LoginFunctions;
    $success = $l->login('jbrown', 'L*9HmbaS', $database['customers'], 'customer');
    $this->assertEquals($success, false);
  }

  public function test8()
  {
    $l = New LoginFunctions;
    $success = $l->login('twilson', 'L*9HmbaS', $database['owners'], 'owner');
    $this->assertEquals($success, false);
  }

  public function test9()
  {
    $l = New LoginFunctions;
    $success = $l->login('securoco', 'stRF4%Q!', $database['owners'], 'owner');
    $this->assertEquals($success, true);
  }

  public function test10()
  {
    $l = New LoginFunctions;
    $success = $l->login('securoco', 'stRF4%Q!', $database['customers'], 'customer');
    $this->assertEquals($success, false);
  }
}
?>
