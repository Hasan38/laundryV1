<?php
$sql = "SELECT * FROM user";
$data = mysqli_query($conn, $sql);
$user = mysqli_num_rows($data);
?>