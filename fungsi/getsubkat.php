<?php
include "../config.php";
$id_kat 	= $_POST['id_kat'];
if($id_kat == '')
{
	exit;
}
else
{
	$subkat = "SELECT * FROM subkat WHERE id_kat ='$id_kat' ORDER BY judul_subkat";
	$result = mysqli_query($conn,$subkat);
	while($datasubkat = mysqli_fetch_array($result))
	{
	    echo "<option value='".$datasubkat['id_subkat']."'>".$datasubkat['judul_subkat']."</option>\n";
	}
}
?>