<?php session_start();
include '../config.php';                    // Panggil koneksi ke database
include '../fungsi/cek_login.php';          // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';        // Panggil fungsi cek session
include '../fungsi/cek_aksi_tambah.php';    // Panggil fungsi boleh tambah data atau tidak
include '../fungsi/cek_hal_superadmin.php'; // Panggil fungsi hanya superadmin yang boleh melakukan aksi

if(isset($_POST['submit']))
{
  $id_user    = mysqli_real_escape_string($conn,$_POST['id_user']);
  $nama       = mysqli_real_escape_string($conn,$_POST['nama']);
  $username   = mysqli_real_escape_string($conn,$_POST['username']);
  $usertype   = mysqli_real_escape_string($conn,$_POST['usertype']);
  $access     = mysqli_real_escape_string($conn,$_POST['access']);
  
  // Proses update data dari form ke db
  $sql = "UPDATE user SET id_user     = '$id_user',
                          nama        = '$nama',
                          username    = '$username',
                          usertype    = '$usertype',
                          access      = '$access',
                          updater     = '$sesen_username',
                          jam_update  = now(),
                          tgl_update  = now()
                    WHERE id_user     = '$id_user'";

  if(mysqli_query($conn, $sql)) 
  {
    echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('user_list.php')</script>";
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