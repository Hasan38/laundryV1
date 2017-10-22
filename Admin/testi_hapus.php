<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_aksi_hapus.php'; 	// Panggil fungsi boleh hapus data atau tidak
include '../fungsi/cek_hal_superadmin.php'; // Panggil fungsi hanya superadmin yang boleh melakukan aksi

$id_testi   = mysqli_real_escape_string($conn, $_GET['id_testi']);

$sql = "DELETE FROM testimoni WHERE id_testi = $id_testi";
if (mysqli_query($conn, $sql)) 
{
  echo "<script>alert('Hapus data berhasil! Klik ok untuk melanjutkan');location.replace('testi_new.php')</script>"; 
}
  else 
  {
      echo "Error updating record: " . mysqli_error($conn);
  }
?>