<?php session_start();                    // Memulai session
include 'config.php';                     // Panggil koneksi ke database
include 'fungsi/base_url.php';            // Panggil fungsi base_url
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public
include 'fungsi/tgl_indo.php';            // Panggil fungsi tanggal indonesia
include 'fungsi/setting.php';             // Panggil data setting
include 'fungsi/navigasi.php';            // Panggil data navigasi
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $keranjang['judul'] ?> | <?php echo $namatoko ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $keranjang['seo_deskripsi'] ?>" />
    <meta name="keywords" content="<?php echo $keranjang['seo_keywords'] ?>" />
    <meta name="author" content="<?php echo $author ?>" />    
    <!-- CSS Bootstrap -->
    <link href="<?php echo $base_url ?>template/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>template/css/shop-item.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>template/css/nomoretable.css" rel="stylesheet">
    <!-- Favicon -->
    <link href="<?php echo $base_url ?>images/fav.ico" rel="shortcut icon"/>
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-sm-push-3">
          <div class="thumbnail">
            <div class="col-md-12">
              <h3><?php echo $keranjang['judul']; ?></h3>
              <hr/>
            </div>
            <div class="caption-full">
              <?php include 'keranjang_data.php'; ?>
            </div>
          </div>
        </div>

        <?php include 'sidebar.php'; ?>
        
      </div>  
      
      <hr/>

      <?php include 'footer.php'; ?>

    </div>
    
    <!-- Membuat fungsi input pada qty barang hanya boleh diisi dengan angka -->
    <script>
    function isNumberKey(evt)
    {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
      return true;
    }
    </script>
    <script src="<?php echo $base_url ?>template/js/jquery.js"></script>
    <script src="<?php echo $base_url ?>template/js/bootstrap.min.js"></script>
  </body>
</html>