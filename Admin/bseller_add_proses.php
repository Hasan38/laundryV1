<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session
include '../fungsi/cek_aksi_tambah.php';  // Panggil fungsi boleh tamabah data atau tidak

if(isset($_POST['submit']))
{
  $no_urut    = mysqli_real_escape_string($conn, $_POST['no_urut']);
  $judul_bs   = mysqli_real_escape_string($conn, $_POST['judul_bs']);

  $cekdata = "SELECT no_urut FROM bseller WHERE no_urut = '$no_urut' ";
  $ada     = mysqli_query($conn, $cekdata);
  if(mysqli_num_rows($ada) > 0)
  { 
    echo "<script>alert('ERROR: No. Urut telah terdaftar, silahkan pakai No. Urut lain!');history.go(-1)</script>";
  }
    else
    {
      // Proses insert data dari form ke db
      $sql = "INSERT INTO bseller (no_urut,
                                  judul_bs,
                                  uploader,
                                  jam_upload,
                                  tgl_upload)
                          VALUES ('$no_urut',
                                  '$judul_bs',
                                  '$sesen_username',
                                  now(),
                                  now())";
      if(mysqli_query($conn, $sql)) 
      {
        echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('bseller_list.php')</script>";
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