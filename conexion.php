<?php
$dbhost='localhost';
$dbuser='edufycom_iet';
$dbpass='iet2019';
$dbname='edufycom_ietBK';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	else{
		echo "cualquier pendejada";
	}

?>