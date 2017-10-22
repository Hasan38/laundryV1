<?php
include "../config.php";
$sql = "SELECT * FROM kategori ORDER BY judul_kat";
$getComboNegara = mysqli_query($conn, $sql) or die ('Query Gagal'); 
?>