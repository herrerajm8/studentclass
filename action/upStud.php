
<?php
	include("db_connection.php");
	if(isset($_POST['student_id']) and isset($_POST['name']) and isset($_POST['course']) and isset($_POST['year']) )
	{
		$student_id = $_POST['student_id'];
		$name = $_POST['name'];
		$course = $_POST['course'];
		$year = $_POST['year'];
		// Updaste User details
		if($student_id){
			$query = "UPDATE student SET name = '$name', course = '$course', year= $year WHERE student_id = $student_id";
		}
		
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