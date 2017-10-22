<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_aksi_ubah.php';    // Panggil fungsi boleh ubah data atau tidak

$id_slider    = mysqli_real_escape_string($conn, $_GET['id_slider']);

$cekdata = "SELECT active FROM slider WHERE active = 1 ";
$ada     = mysqli_query($conn, $cekdata);
if(mysqli_num_rows($ada) > 0)
{ 
  $sql = mysqli_query($conn,"UPDATE slider SET active = 0 WHERE active = 1 ");

  $sql = "UPDATE slider SET active = 1 WHERE id_slider  = '$id_slider' ";
                            
  if(mysqli_query($conn, $sql)) 
  {
    echo "<script>alert('Set Active berhasil! Klik ok untuk melanjutkan');location.replace('slider_list.php')</script>";
  } 
    else 
    {
      echo "Error updating record: " . mysqli_error($conn);
    }
}
?>