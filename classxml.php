<?php
header("Content-type: type/xml");
echo "<?xml version='1.0' encoding = 'UTF-8' ?>";
include 'dbconnect.php';
$sql = "SELECT class_id,description,schedule,room FROM class";
$result = mysqli_query($conn,$sql);

	echo "<class>";
	foreach($result as $row){
		echo "<id>".$row['class_id']."</id>";
		echo "<description>".$row['description']."</description>";
		echo "<schedule>".$row['schedule']."</schedule>";
		echo "<room>".$row['room']."</room>";
	}
	echo "</class>";
	
?>