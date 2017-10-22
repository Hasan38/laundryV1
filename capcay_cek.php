<?php session_start();
include "config.php";
include "fungsi/base_url.php";
include "fungsi/cek_session_public.php";

$cek  = $_POST['check'];
$isi  = mysqli_real_escape_string($conn, $_POST['isi']);

if (!isset($_SESSION['username']))
{ // Jika Tidak Arahkan Kembali ke Halaman Login
  echo "<script language='javascript'>alert('HARAP LOGIN DULU'); location.replace('$base_url"."register.html')</script>";
}
else{
if(!isset($_POST['submit']))
{echo "<script>alert('Pencet dulu tombolnya');location.replace('$base_url"."testimoni.html')</script>";}
elseif(empty($cek)) 
{echo "<script>alert('Isi dulu capcay nya');location.replace('$base_url"."testimoni.html')</script>";}
elseif($cek != $_SESSION['check']) 
{echo "<script>alert('Capcay salah');location.replace('$base_url"."testimoni.html')</script>";}
else
{
	$query = "INSERT INTO testimoni (nama,username,kota,isi,status,jam_upload,tgl_upload) 
													VALUES ('$sesen_nama','$sesen_username','$sesen_kota','$isi',2,now(),now())";
	if(mysqli_query($conn, $query)) 
  {
    echo "<script>alert('Testimoni Anda berhasil terkirim, terima kasih');location.replace('$base_url"."testimoni.html')</script>";
  } 
  else {echo "Error updating record: " . mysqli_error($conn);}
}
}
?>