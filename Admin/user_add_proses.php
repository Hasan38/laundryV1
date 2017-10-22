<?php session_start();
include '../config.php';                    // Panggil koneksi ke database
include '../fungsi/cek_login.php';          // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';        // Panggil fungsi cek session
include '../fungsi/cek_aksi_tambah.php';    // Panggil fungsi boleh tambah data atau tidak
include '../fungsi/cek_hal_superadmin.php'; // Panggil fungsi hanya superadmin yang boleh melakukan aksi

if(isset($_POST['submit']))
{
  $nama       = mysqli_real_escape_string($conn,$_POST['nama']);
  $username   = mysqli_real_escape_string($conn,$_POST['username']);
  $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $usertype   = mysqli_real_escape_string($conn,$_POST['usertype']);
  $access     = mysqli_real_escape_string($conn,$_POST['access']);

  $cekdata = "SELECT username FROM user WHERE username = '$username' ";
  $ada     = mysqli_query($conn, $cekdata);
  if(mysqli_num_rows($ada) > 0)
  { 
    echo "<script>alert('ERROR: Username telah terdaftar, silahkan pakai Username lain!');history.go(-1)</script>";
  }
    else
    {
      // Proses insert data dari form ke db
      $sql = "INSERT INTO user (nama,
                                username,
                                password,
                                usertype,
                                access,
                                uploader,
                                jam_upload,
                                tgl_upload)
                        VALUES ('$nama',
                                '$username',
                                '$password',
                                '$usertype',
                                '$access',
                                '$sesen_username',
                                now(),
                                now())";

      if(mysqli_query($conn, $sql)) 
      {
        echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('user_list.php')</script>";
      } 
        else 
        {
          echo "Error updating record: " . mysqli_error($conn);
        }
    }
}
  else
  {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
  }
?>