<?php
$hostname = 'localhost';
$username='root';
$password='';
$dbname='bakery';
$port=3307;

	global $hostname;
	global $username;
	global $password;
	global $dbname;
	global $port;
	$conn = mysqli_connect($hostname, $username, $password, $dbname, $port);

	//$conn = new mysqli($hostname, $username, $password, $dbname, $port);
    ?>
