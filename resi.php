<?php session_start();                    // Memulai session
include 'config.php';                     // Panggil koneksi ke database
include 'fungsi/base_url.php';            // Panggil fungsi base_url
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public
include 'fungsi/navigasi.php';            // Panggil data navigasi
include 'fungsi/setting.php';             // Panggil data setting
include 'fungsi/tgl_indo.php';            // Panggil fungsi merubah tanggal menjadi format seperti 2 Mei 2015
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $resi['judul'] ?> | <?php echo $namatoko ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $resi['seo_deskripsi'] ?>" />
    <meta name="keywords" content="<?php echo $resi['seo_keywords'] ?>" />
    <meta name="author" content="<?php echo $author ?>" />    
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
              <h3><?php echo $resi['judul']; ?></h3>
              <hr/>
            </div>
            <div class="caption-full">
              <div class="row text-left">
                <?php include 'resi_data.php'; ?>
              </div>
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