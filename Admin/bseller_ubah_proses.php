<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_aksi_ubah.php';    // Panggil fungsi boleh ubah data atau tidak
include '../fungsi/cek_session.php';      // Panggil fungsi cek session

if(isset($_POST['submit']))
{
  $id_bs    = mysqli_real_escape_string($conn, $_POST['id_bs']);
  $no_urut  = mysqli_real_escape_string($conn, $_POST['no_urut']);
  $judul_bs = mysqli_real_escape_string($conn, $_POST['judul_bs']);

  $sql = "UPDATE bseller SET id_bs      = '$id_bs',
                            no_urut     = '$no_urut',
                            judul_bs    = '$judul_bs',
                            updater     = '$sesen_username',
                            jam_update  = now(),
                            tgl_update  = now() 
                      WHERE id_bs       = '$id_bs' ";
                            
  if(mysqli_query($conn, $sql)) 
  {
    echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('bseller_list.php')</script>";
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