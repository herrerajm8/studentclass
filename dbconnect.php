<?php
  error_reporting( ~E_DEPRECATED & ~E_NOTICE );
 $conn = mysqli_connect("localhost","root","","estudyante");
 
 if ( !$conn ) {
  die("Connection failed : " . mysql_error());
 }
 
 ?>