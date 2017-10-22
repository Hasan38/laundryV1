<?php session_start(); 
include 'config.php';                     // Panggil koneksi ke database
include 'fungsi/base_url.php';            // Panggil fungsi base_url
include 'fungsi/setting.php';             // Panggil data setting
include 'fungsi/tgl_indo.php';            // Panggil fungsi tanggal indonesia
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public

$id_supersubkat = mysqli_real_escape_string($conn,$_GET['id_supersubkat']);

$query     = "SELECT a.id_produk, a.nama_produk, a.harga, a.harga_diskon, a.img, a.judul_seo,
              b.judul_kat AS kat, c.judul_subkat AS subkat, d.judul_supersubkat AS supersubkat, d.kategori_seo
              FROM produk a 
              LEFT JOIN kategori b on b.id_kat = a.kat 
              LEFT JOIN subkat c on c.id_subkat = a.subkat 
              LEFT JOIN supersubkat d on d.id_supersubkat = a.supersubkat
              WHERE id_supersubkat = '$id_supersubkat' OR d.kategori_seo = '$id_supersubkat' 
              ORDER BY a.id_produk DESC";
$hasil     = mysqli_query($conn,$query);
$hasil1    = mysqli_query($conn,$query);
$numrows   = mysqli_num_rows($hasil);
$kategori  = mysqli_fetch_array($hasil);
if($numrows == 0){echo "<script>alert('Belum ada data');location.replace('$base_url')</script>";}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Kategori: <?php echo $kategori['supersubkat'] ?>" />
    <meta name="keywords" content="kategori: <?php echo $kategori['supersubkat'] ?>" />
    <meta name="author" content="<?php echo $author ?>" />
    <title>Kategori: <?php echo $kategori['supersubkat'] ?> | <?php echo $namatoko ?></title>

    <!-- CSS Bootstrap -->
    <link href="<?php echo $base_url ?>template/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>template/css/shop-item.css" rel="stylesheet">
    <!-- Favicon -->
    <link href="<?php echo $base_url ?>images/fav.ico" rel="shortcut icon"/>
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-sm-push-3">
          <div class="thumbnail">
            <div class="col-md-12">
              <h3>Kategori: <?php echo $kategori['supersubkat']; ?></h3>
              <hr/>
            </div>
            <div class="caption-full">
              <h5 align="center">Ada <?php echo $numrows; ?> barang di kategori ini</h5>
              <?php include 'kategori_data.php'; ?>
            </div>
          </div>
        </div>

        <?php include 'sidebar.php'; ?>

      </div>

      <hr/>

      <?php include 'footer.php'; ?>

    </div>
    
    <!-- Memanggil file JS -->
    <script src="<?php echo $base_url ?>template/js/jquery.js"></script>
    <script src="<?php echo $base_url ?>template/js/bootstrap.min.js"></script>
  </body>
</html>