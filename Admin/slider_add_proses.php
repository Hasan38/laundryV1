<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session
include '../fungsi/cek_aksi_tambah.php';  // Panggil fungsi boleh tamabah data atau tidak

if(isset($_POST['submit']))
{
  $no_urut      = mysqli_real_escape_string($conn, $_POST['no_urut']);
  $judul_slider = mysqli_real_escape_string($conn, $_POST['judul_slider']);
  $link         = mysqli_real_escape_string($conn, $_POST['link']);

  $cekdata      = "SELECT judul_slider FROM slider WHERE judul_slider = '$judul_slider' ";
  $ada          = mysqli_query($conn, $cekdata);
  if(mysqli_num_rows($ada) > 0)
  { 
    echo "<script>alert('ERROR: Judul telah terdaftar, silahkan pakai Judul lain!');history.go(-1)</script>";
  }
    else
    {
      $allowed_ext  = array('jpg', 'jpeg', 'png', 'gif');
      $file_name    = $_FILES['img']['name'];
      $file_ext     = strtolower(end(explode('.', $file_name)));
      $file_size    = $_FILES['img']['size'];
      $file_tmp     = $_FILES['img']['tmp_name'];
      $lokasi       = '../images/slider/'.$judul_slider.'.'.$file_ext;
      $img          = $judul_slider.'.'.$file_ext;

      if(in_array($file_ext, $allowed_ext) === true)
      {
        move_uploaded_file($file_tmp, $lokasi);

        // Proses insert data dari form ke db
        $sql = "INSERT INTO slider (no_urut,
                                    judul_slider,
                                    link,
                                    jam_upload,
                                    tgl_upload,
                                    uploader,
                                    img)
                            VALUES ('$no_urut',
                                    '$judul_slider',
                                    '$link',
                                    now(),
                                    now(),
                                    '$sesen_username',
                                    '$img')";
        if(mysqli_query($conn, $sql)) 
        {
          echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('slider_list.php')</script>";
        } 
          else 
          {
            echo "Error updating record: " . mysqli_error($conn);
          }
      }
        else
        {
          echo "<script>alert('Jenis file tidak sesuai!');history.go(-1)</script>";
        }
    }
}
  else
  {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
  }
?>