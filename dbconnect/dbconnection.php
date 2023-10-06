<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "registrationform"; 

//connection to the database
 if(!mysql_connect($hostname, $username, $password)||!mysql_select_db($dbname) )
 {
	echo "Unable to connect to MySQL";
 }
?>