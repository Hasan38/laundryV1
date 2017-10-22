<?php
$sql 	= "SELECT * FROM banner";
$data 	= mysqli_query($conn, $sql);
$banner = mysqli_num_rows($data);
?>