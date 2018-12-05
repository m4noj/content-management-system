<?php 
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','cms');

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if (!$connection){
	die("Connection has failed".mysqli_error());
} 

function confirm_query($result){
	global $connection;
	if(!$result){
		die("QUERY FAILED ".mysqli_error($connection));
	}
}