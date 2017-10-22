<?php session_start(); 
include "config.php"; 
include "faktur.php"; 
include "fungsi/base_url.php"; 
include "fungsi/cek_session_public.php"; 
include "fungsi/cek_login_public.php"; 

$cek		= "SELECT * FROM transaksi WHERE username = '$sesen_username' AND status ='0'";
$hasil 	= mysqli_query($conn,$cek);
$data 	= mysqli_fetch_array($hasil);

if(mysqli_num_rows($hasil) == 0)
{
	echo "<script>alert('Data tidak ditemukan');location.replace('keranjang.html')</script>";
}
else
{
	$faktur 		= $data['notransaksi'];
	$id_produk 	= $_GET['id'];

	$query = "DELETE FROM transaksi_detail WHERE notransaksi = '$faktur' AND id_produk = '$id_produk' ";
	
	if(mysqli_query($conn, $query)) 
  {
  	echo "<script>alert('Barang berhasil dihapus');location.replace('keranjang.html')</script>";
  }  
  	else
  	{
  		echo "Error updating record: " . mysqli_error($conn);
  	}
}
?>