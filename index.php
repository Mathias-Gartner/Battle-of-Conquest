<?php
date_default_timezone_set("UTC"); // Sladi gets a PHP exeption without this.

require 'configuration.php';

spl_autoload_extensions('.php'); // comma-separated list
spl_autoload_register();

session_start();

RequestHandler::handle();


?>
