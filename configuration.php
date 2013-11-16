<?php

require 'torm/torm.php';

$con = new PDO('mysql:host=localhost;dbname=boc', 'boc', 'q6MauL5cnp2355dH');
TORM\Connection::setConnection($con);
TORM\Connection::setDriver("mysql");

?>
