<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_aksi_ubah.php';    // Panggil fungsi boleh ubah data atau tidak
include '../fungsi/judul_seo.php';        // Panggil fungsi mengubah teks menjadi tanpa spasi dan simbol

if(isset($_POST['submit']))
{
  $id_produk      = mysqli_real_escape_string($conn, $_POST['id_produk']);
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

  $allowed_ext    = array('jpg', 'jpeg', 'png', 'gif');
  $file_name      = $_FILES['img']['name']; // File adalah name dari tombol input pada form
  $file_ext       = strtolower(end(explode('.', $file_name)));
  $file_size      = $_FILES['img']['size'];
  $file_tmp       = $_FILES['img']['tmp_name'];
  $lokasi         = '../images/produk/'.$judul_seo.'.'.$file_ext;
  $img            = $judul_seo.'.'.$file_ext;

  if(!empty($file_tmp))
  {
    if(in_array($file_ext, $allowed_ext) === true)
    {
      //Hapus photo yang lama jika ada
      $del  = "SELECT img FROM produk WHERE id_produk = '$id_produk' ";
      $res  = mysqli_query($conn, $del);
      $d    = mysqli_fetch_object($res);
      if(strlen($d->img)>3)
      if(file_exists($d->img))
      {
        // Memutuskan koneksi file yang lama
        unlink($d->img);
      }
      move_uploaded_file($file_tmp, $lokasi);
      // Update photo dengan yang baru
      $update = "UPDATE produk SET img = '$img' WHERE id_produk = '$id_produk' ";
      $upd = mysqli_query($conn, $update);
    } 
      else
      {
        echo "<script>alert('Format file tidak sesuai!');history.go(-1)</script>";
      } 
  }

  $sql = "UPDATE produk SET id_produk     = '$id_produk',
                            nama_produk   = '$nama_produk',
                            judul_seo     = '$judul_seo',
                            seo_deskripsi = '$seo_deskripsi',
                            seo_keywords  = '$seo_keywords',
                            deskripsi     = '$deskripsi',
                            warna         = '$warna',
                            berat         = '$berat',
                            harga         = '$harga',
                            diskon        = '$diskon',
                            harga_diskon  = '$harga_diskon',
                            stok          = '$stok',
                            garansi       = '$garansi',
                            kat           = '$kat',
                            subkat        = '$subkat',
                            supersubkat   = '$supersubkat',
                            updater       = '$sesen_username',
                            jam_update    = now(),
                            tgl_update    = now() 
                      WHERE id_produk     = '$id_produk' ";
                            
  if(mysqli_query($conn, $sql)) 
  {
    echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('produk_list.php')</script>";
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