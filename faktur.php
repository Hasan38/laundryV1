<?php 
include "fungsi/cek_session_public.php"; 
include "fungsi/cek_login_public.php"; 

$cari  = "SELECT * FROM transaksi WHERE username = '$sesen_username' AND status = 0 ORDER BY notransaksi DESC";
$query = mysqli_query($conn,$cari);
$hasil = mysqli_fetch_array($query);

if($hasil > 0)
{
	$faktur = $hasil['notransaksi'];
}
	else
	{
		$query 	= "INSERT INTO transaksi (username,tgl_checkout,status) VALUES ('$sesen_username',now(),'0')";
		$result = mysqli_query($conn,$query);

		$cari 	= "SELECT * FROM transaksi ORDER BY notransaksi DESC";
		$query 	= mysqli_query($conn,$cari);
		$hasil 	= mysqli_fetch_array($query);
		
		if ($hasil > 0)
		{
			$faktur = $hasil['notransaksi'];
		}
}
?>