<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session

if($sesen_usertype == 'superadmin')
{
  if(isset($_POST['submit']))
  {
    $nama           = $_POST['nama'];
    $password       = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "UPDATE user SET password = '$password' WHERE id_user = '$nama' ";

    if(mysqli_query($conn, $sql))
    {
      echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('ubah_pass_usr.php')</script>";
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
}
  else
  {
    echo '<script>alert("Anda bukan Super Admin! Silahkan login menjadi Super Admin terlebih dahulu");location.replace("index.php")</script>';
  }
?>
