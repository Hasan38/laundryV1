<?php session_start(); 
include 'config.php';                     // Panggil koneksi ke database
include 'fungsi/base_url.php';            // Panggil fungsi base_url
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public
include 'fungsi/navigasi.php';            // Panggil data navigasi
include 'fungsi/setting.php';             // Panggil data setting
include 'fungsi/tgl_indo.php';            // Panggil fungsi merubah tanggal menjadi format seperti 2 Mei 2015

// Mengambil nilai berdasarkan id_produk dengan metode GET
$id_produk = mysqli_real_escape_string($conn,$_GET['id_produk']);

$query        = "SELECT a.id_produk, a.nama_produk, a.judul_seo, a.seo_deskripsi, a.seo_keywords, a.berat, a.stok, a.warna, a.garansi, a.deskripsi, a.harga, a.harga_diskon, a.img, 
                b.judul_kat AS judul_kategori, c.judul_subkat AS judul_subkategori, 
                d.judul_supersubkat AS judul_supersubkategori, d.kategori_seo AS kategori_seo
                FROM produk a 
                LEFT JOIN kategori b on b.id_kat = a.kat 
                LEFT JOIN subkat c on c.id_subkat = a.subkat 
                LEFT JOIN supersubkat d on d.id_supersubkat = a.supersubkat
                WHERE a.judul_seo = '$id_produk'";
$hasil        = mysqli_query($conn,$query);
$produk       = mysqli_fetch_array($hasil);
$harga_normal = number_format($produk['harga'], 0, ',', '.').",-";
$harga_diskon = number_format($produk['harga_diskon'], 0, ',', '.').",-";

// Jika data tidak ditemukan maka akan muncul alert belum ada data
if(mysqli_num_rows($hasil) == 0)
{echo "<script>alert('Belum ada data');location.replace('$base_url')</script>";}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $produk['nama_produk']; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $produk['seo_deskripsi'] ?>" />
    <meta name="keywords" content="<?php echo $produk['seo_keywords'] ?>" />
    <meta name="author" content="<?php echo $namatoko ?>" />
    <!-- Facebook SEO -->    
    <meta property="og:title" content="<?php echo $produk['nama_produk']; ?> | <?php echo $namatoko ?>" />
    <meta property="og:url" content="<?php echo $base_url; echo "produk/"; echo $produk['judul_seo']; echo ".html" ?>" />
    <meta property="og:image" content="<?php echo $base_url; echo "images/produk/"; echo $produk['img']; ?>" />
    <meta property="og:description" content="Dapatkan <?php echo $produk['nama_produk']; ?> dan barang lainnya dengan harga yang terjangkau, berkualitas, dan bergaransi hanya di <?php echo $namatoko ?>" />
    <!-- CSS Bootstrap -->
    <link href="<?php echo $base_url ?>template/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>template/css/shop-item.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>template/css/jquery.fancybox.css" rel="stylesheet"/>
    <!-- Favicon -->
    <link href="<?php echo $base_url ?>images/fav.ico" rel="shortcut icon"/>
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <div class="container">
      <?php include 'produk_data.php'; ?>

      <hr/>

      <?php include 'footer.php'; ?>

    </div>
    
    <!-- Memanggil file JS -->
    <script src="<?php echo $base_url ?>template/js/jquery-1.7.2.min.js"></script>
    <script src="<?php echo $base_url ?>template/js/jquery.fancybox.js"></script>
    <script src="<?php echo $base_url ?>template/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#fancybox").fancybox();
      });
      </script>
  </body>
</html>