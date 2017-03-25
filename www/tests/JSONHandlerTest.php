<?php
use PHPUnit\Framework\TestCase;
require_once("../lib/JSONHandler.php");

class JSONHandlerTest extends TestCase
{
	protected $testarr;
	protected $testfile;
	protected $jh;
	
	public  function setUp() 
	{
		$this->jh = new JSONHandler;
		$this->testfile = 'testfile.json';
		$this->testarr = array(
		(0) => array
			(
				('name') => 'John',
				('surname') => 'Smith'
			),
		(1) => array
			(
				('name') => 'Jenny',
				('surname') => 'Brown'
			)
		);
		
		$this->jh->addToFile( $this->testfile, $this->testarr);
	}
	
	public function tearDown() 
	{
		unlink(realpath($this->testfile));
	}	
	
    public function testCreate()
	{	
		$this->jh->addToFile( 'createtest.json', $this->testarr);
		$this->assertFileExists('createtest.json');
		unlink(realpath('createtest.json'));
	}
	
	public function testRead()
	{
		$this->testarr = $this->jh->getFileContents($this->testfile);
		
		$this->assertEquals($this->testarr[0]['name'], 'John');
		$this->assertEquals($this->testarr[0]['surname'], 'Smith');
		$this->assertEquals($this->testarr[1]['name'], 'Jenny');
		$this->assertEquals($this->testarr[1]['surname'], 'Brown');
	}
	
	public function testMissingFileRead()
	{
		$this->expectException(Exception::class);
		$this->expectExceptionMessage('missing.json does not exist.');
		
		$missingtest = $this->jh->getFileContents('missing.json');
	}
	
	public function testIncorrectFileRead()
	{
		$this->expectException(Exception::class);
		$this->expectExceptionMessage('incorrect.json is not in correct JSON format.');
		
		$json = '[ { "nm: "Edmund lronside", "cty": "United Kingdom, "hse": "House of Wessex", "yrs": "1016" }, ';
		file_put_contents('incorrect.json', $json);

		$incorrecttest = $this->jh->getFileContents('incorrect.json');
	}
	
	public function testAppend()
	{
		$this->testarr = array(
		(0) => array
			(
				('name') => 'Jason',
				('surname') => 'Orange'
			)
		);
		
		$this->jh->addToFile( $this->testfile, $this->testarr);
		
		$this->testarr = $this->jh->getFileContents($this->testfile);
		
		$this->assertEquals($this->testarr[0]['name'], 'John');
		$this->assertEquals($this->testarr[1]['name'], 'Jenny');
		$this->assertEquals($this->testarr[2]['name'], 'Jason');
		
		$this->testarr = array(
			('name') => 'Bill',
			('surname') => 'Red'
		);
		
		$this->jh->addToFile( $this->testfile, $this->testarr);
		
		$this->testarr = $this->jh->getFileContents($this->testfile);
		
		$this->assertEquals($this->testarr[0]['name'], 'John');
		$this->assertEquals($this->testarr[1]['name'], 'Jenny');
		$this->assertEquals($this->testarr[2]['name'], 'Jason');
		$this->assertEquals($this->testarr[3]['name'], 'Bill');
		
		
	}
	
	public function testSearch()
	{
		$this->testarr= $this->jh->search($this->testfile, 'name', 'Jenny');
		
		$this->assertEquals($this->testarr['name'], 'Jenny');
		$this->assertEquals($this->testarr['surname'], 'Brown');
	}
	
	public function testSearchNotFound()
	{
		$this->testarr= $this->jh->search($this->testfile, "name", "Ben");
		$this->assertEquals($this->testarr, NULL);
	}
	
	public static function tearDownAfterClass()
	{
		unlink(realpath('incorrect.json'));
	}
}
?>
