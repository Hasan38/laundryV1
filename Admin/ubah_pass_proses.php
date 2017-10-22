<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session

$pswlama  = $_POST['pswlama'];
$pswbaru  = password_hash($_POST['pswbaru'], PASSWORD_DEFAULT);
  
$cari     = "SELECT * FROM user WHERE username = '$sesen_username' ";
$result   = mysqli_query($conn,$cari);
if (mysqli_num_rows($result) > 0)
{
  while ($data = mysqli_fetch_array($result))
  {
    if(password_verify($pswlama, $data['password']))
    {
      $perintah = "UPDATE user SET password = '$pswbaru' WHERE username = '$sesen_username' ";
      if (mysqli_query($conn, $perintah)) 
      {
        echo "<script>alert('Ubah Password berhasil! Klik ok untuk melanjutkan');location.replace('index.php')</script>";
        session_destroy();
      } 
        else 
        {
          echo "Error updating record: " . mysqli_error($conn);
        }
    }
      else
      {
        echo "<script>alert('Password lama salah, input dengan benar password lama Anda!');history.go(-1)</script>";
      }
  }
}
  else
  {
    echo "<script>alert('Akun tidak ditemukan');history.go(-1)</script>";
  }
?>