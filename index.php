<?php

require 'configuration.php';

spl_autoload_extensions('.php'); // comma-separated list
spl_autoload_register();

RequestHandler::handle();


?>
