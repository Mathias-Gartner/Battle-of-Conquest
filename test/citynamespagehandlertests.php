<?php

include_once 'basetest.php';
//include_once '../pagehandlers/citynamespagehandler.php';

class CityNamesPageHandlerTests extends \BaseTest {
	public function testInvalidNoId()
	{
		$ph = new \PageHandlers\CityNamesPageHandler();
		$ph = $ph->handle();
		$this->assertEquals('attacks.php', $ph->getTemplate());
		$this->assertFalse(isset($ph->getPageDataArray()['value']));
	}
	
	public function testInvalidWrongId()
	{
		
	}
	
	public function testValidRequst()
	{
		
	}
}
