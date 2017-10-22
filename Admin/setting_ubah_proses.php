<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_aksi_ubah.php';    // Panggil fungsi boleh ubah data atau tidak
include '../fungsi/cek_session.php';      // Panggil fungsi cek session

if(isset($_POST['submit']))
{
  $id_setting   = mysqli_real_escape_string($conn, $_POST['id_setting']);
  $isi_setting  = mysqli_real_escape_string($conn, $_POST['isi_setting']);

  $sql = "UPDATE setting SET  id_setting    = '$id_setting',
                              isi_setting   = '$isi_setting',
                              jam_update    = now(),
                              tgl_update    = now(),
                              updater       = '$sesen_username'
                       WHERE  id_setting    = '$id_setting' ";
                            
  if(mysqli_query($conn, $sql)) 
  {
    echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('setting.php?id_setting=$id_setting')</script>";
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