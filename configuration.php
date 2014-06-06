<?php

require 'torm/torm.php';
require 'pagehandlers/pagehandler.php';

$con = new PDO('mysql:host=localhost;dbname=boc', 'boc', 'asd');
TORM\Connection::setConnection($con);
TORM\Connection::setDriver('mysql');

PageHandlers\PageHandler::setBaseDir('D:/xampp/htdocs/ITP/Battle-of-Conquest/');
?>
