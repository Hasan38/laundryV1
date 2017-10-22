<?php
include "../config.php";
$id_subkat = $_POST['id_subkat'];
if($id_subkat == '')
{
	exit;
}
else
{
	$supersubkategori = "SELECT * FROM supersubkat WHERE id_subkat ='$id_subkat' ORDER BY judul_supersubkat";
	$result = mysqli_query($conn,$supersubkategori);
	while($supersubkat = mysqli_fetch_array($result))
	{
	    echo "<option value=\"".$supersubkat['id_supersubkat']."\">".$supersubkat['judul_supersubkat']."</option>\n";
	}
}
?>