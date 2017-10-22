<?php
include "../config.php";

$kot 	= $_GET['kot'];
$kec 	= "SELECT id_kec,nama_kec FROM kec WHERE id_kabkot = '$kot' order by nama_kec";
$result = mysqli_query($conn, $kec);
if (mysqli_num_rows($result) > 0)
{
	while ($data = mysqli_fetch_array($result))
	{
  		echo "<option value='".$data['id_kec']."'>".$data['nama_kec']."</option>\n";
	}
}
	else
	{
  		echo "Belum ada data";
	}
?>