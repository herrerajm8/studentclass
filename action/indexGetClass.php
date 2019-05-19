<?php
	require("db_connection.php");
	
	$str = "SELECT class_id, description, schedule, room, student_id
			FROM class 
			WHERE student_id ";
	if(empty($_POST['student_id'])) {
		$str .= "IS NULL";
	}else{
		$str .= "= '{$_POST['student_id']}';";
	}
	$res = mysqli_query($conn, $str);
	if(!$res) {
		echo "Error in collecting data!";
		exit();
	}
	
?>
<table id="classTable" class='table table-bordered'>
<thead>
	<tr>
		<th>Description</th>
		<th>Schedule</th>
		<th>Room</th>
		<th>Options</th>
	</tr>
</thead>
<?php
	while($cla = mysqli_fetch_assoc($res)){
		echo "
		<tr>
			<td>{$cla['description']}</td>
			<td>{$cla['schedule']}</td>
			<td>{$cla['room']}</td>
			<td >
				<ul class='list-inline'>
					<li><button type='submit' id='ediClass' class='btn btn-default btn-xs' name='id' value='{$cla['student_id']}'>O</button></li>
					<li><button type='submit' id='delClass' class='btn btn-danger btn-xs' name='id' value='{$cla['student_id']}'>X</button></li>
				</ul>
			</td>
		</tr>
	";
	}
?>

</table>