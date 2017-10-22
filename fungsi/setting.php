<?php 
// Query atau Pemanggilan data dari database setting berdasarkan id_setting
$query_namatoko 		= "SELECT isi_setting FROM setting WHERE id_setting = 1 ";
$hasil_namatoko			= mysqli_query($conn,$query_namatoko); 
$data_namatoko  		= mysqli_fetch_array($hasil_namatoko);
$namatoko 					= $data_namatoko['isi_setting'];

$query_alamat_toko 	= "SELECT isi_setting FROM setting WHERE id_setting = 2 ";
$hasil_alamat_toko	= mysqli_query($conn,$query_alamat_toko); 
$data_alamat_toko  	= mysqli_fetch_array($hasil_alamat_toko);
$alamat_toko				= $data_alamat_toko['isi_setting'];

$query_bank 				= "SELECT isi_setting FROM setting WHERE id_setting = 3 ";
$hasil_bank					= mysqli_query($conn,$query_bank); 
$data_bank  				= mysqli_fetch_array($hasil_bank);
$bank								= $data_bank['isi_setting'];

$query_author 			= "SELECT isi_setting FROM setting WHERE id_setting = 4 ";
$hasil_author 			= mysqli_query($conn,$query_author); 
$data_author   			= mysqli_fetch_array($hasil_author);
$author 						= $data_author['isi_setting'];

$query_footer 			= "SELECT isi_setting FROM setting WHERE id_setting = 5 ";
$hasil_footer 			= mysqli_query($conn,$query_footer); 
$data_footer   			= mysqli_fetch_array($hasil_footer);
$footer 						= $data_footer['isi_setting'];
?>