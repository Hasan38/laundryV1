<?php session_start();                    // Memulai session
include 'config.php';                     // Panggil koneksi ke database
include 'fungsi/base_url.php';            // Panggil fungsi base_url
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public
include 'fungsi/navigasi.php';            // Panggil data navigasi
include 'fungsi/setting.php';             // Panggil data setting
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $home['judul'] ?> | <?php echo $namatoko ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $home['seo_deskripsi'] ?>"/>
    <meta name="keywords" content="<?php echo $home['seo_keywords'] ?>"/>
    <meta name="author" content="<?php echo $author ?>"/>    
    <!-- CSS Bootstrap -->
    <link href="<?php echo $base_url ?>template/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>template/css/custom.css" rel="stylesheet">
    <!-- Favicon -->
    <link href="<?php echo $base_url ?>images/fav.ico" rel="shortcut icon"/>
  </head>
  <style >
  body {
    padding-top: 70px;
    background:   #FFC0CB; /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
}
</style>
  <body>
    <?php include 'navbar.php'; ?>

    <div class="container">
      <?php include 'slider.php'; ?>

      <hr/>

      

      <div class="row">
        <div class="col-lg-12">
          <h3>PAKET LAUNDRY</h3>
        </div>
      </div>

      <?php include 'produk_new.php'; ?>

      <hr/>

      <?php include 'footer.php'; ?>

    </div>
    
    <!-- Memanggil file JS -->
    <script src="<?php echo $base_url ?>template/js/jquery.js"></script>
    <script src="<?php echo $base_url ?>template/js/bootstrap.min.js"></script>
  </body>
</html>