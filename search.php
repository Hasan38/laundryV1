<?php session_start();                    // Memulai session
include 'config.php';                     // Panggil koneksi ke database
include 'fungsi/base_url.php';            // Panggil fungsi base_url
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public
include 'fungsi/navigasi.php';            // Panggil data navigasi
include 'fungsi/setting.php';             // Panggil data setting
$searchterm = mysqli_real_escape_string($conn,$_POST['searchterm']); 

if((isset($_POST['searchterm'])) AND ($_POST['searchterm'] <> "")) 
{  
  $query_cari = "SELECT * FROM produk WHERE seo_keywords LIKE '%$searchterm%' ";
  $hasil_cari = mysqli_query($conn, $query_cari);
  $data_cari  = mysqli_num_rows($hasil_cari); 
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Hasil Pencarian | <?php echo $namatoko ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $katalog['seo_deskripsi'] ?>" />
    <meta name="keywords" content="<?php echo $katalog['seo_keywords'] ?>" />
    <meta name="author" content="<?php echo $author ?>" />    
    <!-- CSS Bootstrap -->
    <link href="<?php echo $base_url ?>template/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>template/css/shop-item.css" rel="stylesheet">
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
              <h3>HASIL PENCARIAN</h3>
              <hr/>
              <h5><span><?php echo $data_cari ?> barang ditemukan</span></h5>
            </div>
            <div class="caption-full">
              <div class="row text-center">
                <?php
                while($data_cari = mysqli_fetch_array($hasil_cari))
                {
                  $harga_diskon = $data_cari['harga_diskon'];
                  $harga = $data_cari['harga'];
              ?>
                <div class='col-md-4 col-sm-6'>
                  <div class='thumbnail'>
                    <a href='produk/<?php echo $data_cari['judul_seo']; ?>.html' class='title'>
                      <h4 align='center'><?php echo $data_cari['nama_produk']; ?></h4>
                    </a>
                    <a href="produk/<?php echo $data_cari['judul_seo']; ?>.html">
                      <img alt="<?php echo $data_cari['nama_produk']; ?>" src="<?php echo base_url(); ?>images/produk/<?php echo $data_cari['img']; ?>"/>
                    </a>
                    <div class="caption" align="center">
                      <h4><strike><?php echo "Rp " .number_format($harga, 0, ',', '.').",-" ?></strike></h4>
                      <h4><font color="red"><?php echo "Rp " .number_format($harga_diskon, 0, ',', '.').",-" ?></font></h4>
                      <a href='beli/<?php echo $data_cari['id_produk']; ?>' class='btn btn-primary'>Beli</a> 
                      <a href='produk/<?php echo $data_cari['judul_seo']; ?>.html' class='btn btn-default'>Detail</a>
                    </div>
                  </div>
                </div>
              <?php } ?>
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