<?php
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="fordgt45";
	$dbname="widget_corp";

	$connection=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

	if(mysqli_connect_errno()){
		die("Database conncetion failed".mysqli_connect_error()."(".mysqli_connect_errno().")");
	}
?>