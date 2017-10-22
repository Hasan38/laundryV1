<?php session_start();
include '../config.php';                    // Panggil koneksi ke database
include '../fungsi/cek_login.php';          // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_aksi_ubah.php';      // Panggil fungsi boleh ubah data atau tidak
include '../fungsi/cek_hal_superadmin.php'; // Panggil fungsi hanya superadmin yang boleh melakukan aksi

$id_testi    = mysqli_real_escape_string($conn, $_GET['id_testi']);

if(isset($id_testi))
{
  $sql = "UPDATE testimoni SET status = 1 WHERE id_testi = '$id_testi' ";

  if(mysqli_query($conn, $sql)) 
  {
    echo "<script>alert('ACC Testimoni berhasil! Klik ok untuk melanjutkan');location.replace('testi_acc_list.php')</script>";
  } 
    else 
    {
      echo "Error updating record: " . mysqli_error($conn);
    }
}
  else
  {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
  } 
?>