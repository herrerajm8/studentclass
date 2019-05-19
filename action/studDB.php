<?php
	require_once '../dbconnect.php';

	$query = "SELECT * FROM student";
	
	$result = mysqli_query($conn,$query);
	if (!$result) {
        exit(mysql_error());
    }
	$resArr = array();
	while($row=mysqli_fetch_array($result)){
		$resArr[] = array(
			'student_id' => $row['student_id'],
			'name' => $row['name'],
			'course' => $row['course'],
			'year' => $row['year']
		);
	}
	if(EMPTY($resArr)){
		echo "No Records Found";
	}
	echo json_encode($resArr);
?>