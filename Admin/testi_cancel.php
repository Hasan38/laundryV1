<?php session_start();
require "../../config.php";
require "../../cek/cek_login.php";
require "../../cek/cek_session.php";
require "../../cek/cek_aksi_ubah.php";
require "../../cek/cek_hal_superadmin.php";
require "../../fungsi/judul_seo.php";

if(isset($_POST['submit']))
{
  $id_berita    = mysqli_real_escape_string($conn, $_POST['id_berita']);
  $judul_berita = mysqli_real_escape_string($conn, $_POST['judul_berita']);
  $isi          = mysqli_real_escape_string($conn, $_POST['isi']);

  $sql = "UPDATE berita SET id_berita     = '$id_berita',
                            judul_berita  = '$judul_berita',
                            isi           = '$isi',
                            updater       = '$sesen_username',
                            jam_update    = now(),
                            tgl_update    = now() 
                      WHERE id_berita     = '$id_berita' ";

  if(mysqli_query($conn, $sql)) 
  {
    echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('berita_list.php')</script>";
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