
<?php
	include("db_connection.php");
	if(isset($_POST))
	{
		$student_id = $_POST['student_id'];
		$name = $_POST['name'];
		$course = $_POST['course'];
		$year = $_POST['year'];
		// insert student details
		$query = "INSERT INTO student (student_id, name,course,year) VALUES('$student_id','$name','$course','$year')";
		
		
		if (!$result = mysqli_query($conn,$query)) {
			
			exit(mysql_error());
		}
		$data['student_id'] = $student_id;
		$data['name'] = $name;
		$data['course'] = $course;
		$data['year'] = $year;
		
		echo json_encode($data);
	}
	
?>
