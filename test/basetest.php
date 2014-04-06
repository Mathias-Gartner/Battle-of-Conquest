<?php

include_once '../torm/torm.php';

spl_autoload_register(function ($class)
{
	$path = realpath(str_replace("\\", "/", "../".strtolower($class).".php"));
	if (file_exists($path))
		include $path;
	else
		return false;
}
);
//spl_autoload_extensions('.php'); // comma-separated list
//spl_autoload_register();

class BaseTest extends PHPUnit_Framework_TestCase
{
	static $con;
	
	public function setUp()
	{
		$file = realpath(dirname(__FILE__)."/database/test.sqlite3");
		self::$con  = new PDO("sqlite:$file");
		// self::$con  = new PDO('mysql:host=localhost;dbname=boc', 'boc', 'asd');

		TORM\Connection::setConnection(self::$con,"test");
		TORM\Connection::setDriver("sqlite");
		// TORM\Connection::setDriver("mysql");
		TORM\Log::enable(false);
	}
}
