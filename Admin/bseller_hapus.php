<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_aksi_hapus.php'; 	// Panggil fungsi boleh hapus data atau tidak

$id_bs   = mysqli_real_escape_string($conn, $_GET['id_bs']);

$sql = "DELETE FROM bseller WHERE id_bs = '$id_bs' ";
if (mysqli_query($conn, $sql)) 
{
  echo "<script>alert('Hapus data berhasil! Klik ok untuk melanjutkan');location.replace('bseller_list.php')</script>"; 
}
  else 
  {
      echo "Error updating record: " . mysqli_error($conn);
  }
?>