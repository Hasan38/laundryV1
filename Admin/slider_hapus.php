<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_aksi_hapus.php'; 	// Panggil fungsi boleh hapus data atau tidak

$id_slider   = mysqli_real_escape_string($conn, $_GET['id_slider']);

$del_img 	= "SELECT img FROM slider WHERE id_slider = '$id_slider' ";
$res      	= mysqli_query($conn, $del_img);
$data     	= mysqli_fetch_array($res);
$img   		= $data['img'];
$tmpfile 	= "../images/slider/$img";

$sql = "DELETE FROM slider WHERE id_slider = '$id_slider' ";
if (mysqli_query($conn, $sql)) 
{
	unlink ($tmpfile);
  echo "<script>alert('Hapus data berhasil! Klik ok untuk melanjutkan');location.replace('slider_list.php')</script>"; 
}
  else 
  {
      echo "Error updating record: " . mysqli_error($conn);
  }
?>