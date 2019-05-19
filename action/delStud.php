<?php
// check request
if(isset($_POST['student_id']) && isset($_POST['student_id']) != "")
{
    // include Database connection file
    include("db_connection.php");

    // get user id
    $student_id = $_POST['student_id'];

    // delete User
    $query = "DELETE FROM student WHERE student_id = '$student_id'";
    if (!$result = mysqli_query($conn,$query)) {
        exit(mysql_error());
    }
}
?>