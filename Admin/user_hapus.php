<?php session_start();
include '../config.php';					// Panggil koneksi ke database
include '../fungsi/cek_aksi_hapus.php';		// Panggil fungsi boleh hapus data atau tidak
include '../fungsi/cek_hal_superadmin.php'; // Panggil fungsi hanya superadmin yang boleh melakukan aksi

$id_user   = $_GET['id_user'];

$sql  = "DELETE FROM user WHERE id_user = $id_user";

if (mysqli_query($conn, $sql)) 
{
  echo "<script>alert('Hapus data berhasil! Klik ok untuk melanjutkan');location.replace('user_list.php')</script>";
} 
  else 
  {
    echo "Error updating record: " . mysqli_error($conn);
  }
?>