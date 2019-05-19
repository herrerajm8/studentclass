<?php
	// include Database connection file 
	include("db_connection.php");
	$query = "SELECT * FROM pawnshop WHERE statuz=2";
	$result = mysqli_query($conn,$query);
	if (!$result) {
        exit(mysql_error());
    }
	$resArr = array();
	while($row=mysqli_fetch_array($result)){
		$resArr[] = array(
			'pawn_id' => $row['pawn_id'],
			'user_id'=>$row['user_id'],
			'kind' => $row['kind'],
			'type' => $row['type'],
			'brand' => $row['brand'],
			'model' => $row['model'],
			'karat' => $row['karat'],
			'weight' => $row['weight'],
			'total_price' => $row['total_price'],
			'statuz' => $row['statuz'],
			'date' => $row['date'],
			'aprove_date' => $row['aprove_date']
			
		);
	}
	if(EMPTY($resArr)){
		echo "No Records Found";
	}
	echo json_encode($resArr);
?>