<?php
$conn = mysqli_connect("localhost", "root", "", "estudyante");

if(!$conn){
	echo "Error connecting to database!";
	exit();
}

?>