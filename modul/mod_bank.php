<h3>Bank</h3>
<hr/>
<?php 
$query = "SELECT isi FROM navigasi WHERE id_nav = 6";
$hasil = mysqli_query($conn, $query);
$data  = mysqli_fetch_array($hasil);
if(mysqli_num_rows($hasil) > 0)
{echo $data['isi'];}
else{echo "Belum ada data";}
?>