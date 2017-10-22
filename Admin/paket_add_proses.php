<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session
include '../fungsi/cek_aksi_tambah.php';  // Panggil fungsi boleh tamabah data atau tidak
include '../fungsi/judul_seo.php';        // Panggil fungsi judul_seo untuk merubah teks dalam format tanpa spasi dan simbol

if(isset($_POST['submit']))
{
  $nama_produk    = mysqli_real_escape_string($conn, $_POST['nama_produk']);
  $judul_seo      = judul_seo($nama_produk);
  $seo_deskripsi  = mysqli_real_escape_string($conn, $_POST['seo_deskripsi']);
  $seo_keywords   = mysqli_real_escape_string($conn, $_POST['seo_keywords']);
  $deskripsi      = mysqli_real_escape_string($conn, $_POST['deskripsi']);
  $warna          = mysqli_real_escape_string($conn, $_POST['warna']);
  $berat          = mysqli_real_escape_string($conn, $_POST['berat']);
  $harga          = mysqli_real_escape_string($conn, $_POST['harga']);
  $diskon         = mysqli_real_escape_string($conn, $_POST['diskon']);
  $harga_diskon   = mysqli_real_escape_string($conn, $_POST['harga_diskon']);
  $stok           = mysqli_real_escape_string($conn, $_POST['stok']);
  $garansi        = mysqli_real_escape_string($conn, $_POST['garansi']);
  $kat            = mysqli_real_escape_string($conn, $_POST['cmbkat']);
  $subkat         = mysqli_real_escape_string($conn, $_POST['cmbsubkat']);
  $supersubkat    = mysqli_real_escape_string($conn, $_POST['cmbsupersubkat']);

  $cekdata = "SELECT nama_produk FROM produk WHERE nama_produk = '$nama_produk' ";
  $ada     = mysqli_query($conn, $cekdata);
  if(mysqli_num_rows($ada) > 0)
  { 
    echo "<script>alert('ERROR: Judul telah terdaftar, silahkan pakai Judul lain!');history.go(-1)</script>";
  }
    else
    {
      $allowed_ext  = array('jpg', 'jpeg', 'png', 'gif');
      $file_name    = $_FILES['img']['name']; // File adalah name dari tombol input pada form
      $file_ext     = strtolower(end(explode('.', $file_name)));
      $file_size    = $_FILES['img']['size'];
      $file_tmp     = $_FILES['img']['tmp_name'];
      $lokasi       = '../images/produk/'.$judul_seo.'.'.$file_ext;
      $img          = $judul_seo.'.'.$file_ext;

      if(in_array($file_ext, $allowed_ext) === true)
      {
        move_uploaded_file($file_tmp, $lokasi);
        // Proses insert data dari form ke db
        $sql = "INSERT INTO produk (nama_produk,
                                    judul_seo,
                                    seo_deskripsi,
                                    seo_keywords,
                                    deskripsi,
                                    warna,
                                    berat,
                                    kat,
                                    subkat,
                                    supersubkat,
                                    harga,
                                    diskon,
                                    harga_diskon,
                                    stok,
                                    garansi,
                                    uploader,
                                    jam_upload,
                                    tgl_upload,
                                    img)
                            VALUES ('$nama_produk',
                                    '$judul_seo',
                                    '$seo_deskripsi',
                                    '$seo_keywords',
                                    '$deskripsi',
                                    '$warna',
                                    '$berat',
                                    '$kat',
                                    '$subkat',
                                    '$supersubkat',
                                    '$harga',
                                    '$diskon',
                                    '$harga_diskon',
                                    '$stok',
                                    '$garansi',
                                    '$sesen_username',
                                    now(),
                                    now(),
                                    '$img')";
        if(mysqli_query($conn, $sql)) 
        {
          echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('produk_list.php')</script>";
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