<?php

require 'torm/torm.php';
require 'pagehandlers/pagehandler.php';

$con = new PDO('mysql:host=localhost;dbname=boc', 'boc', 'q6MauL5cnp2355dH');
TORM\Connection::setConnection($con);
TORM\Connection::setDriver('mysql');

PageHandlers\PageHandler::setBaseDir('/var/www/boc/');
//PageHandlers\PageHandler::setBaseDir('/media/Data/FH/itp/Battle-of-Conquest/');
?>
