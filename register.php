<?php session_start();          // Memulai session
include 'config.php';           // Panggil koneksi ke database
include 'fungsi/base_url.php';  // Panggil fungsi base_url
include 'fungsi/setting.php';   // Panggil data author

// Query atau Pemanggilan data dari database navigasi berdasarkan id_nav 9 atau halaman testimoni
$query_navigasi   = "SELECT judul,seo_deskripsi,seo_keywords,isi FROM navigasi WHERE id_nav = 10 ";
$hasil_navigasi   = mysqli_query($conn,$query_navigasi); 
$data_navigasi    = mysqli_fetch_array($hasil_navigasi);
if(isset($_SESSION['username']))
{
  // Jika user telah login dan ingin masuk ke halaman ini kembali, maka akan diarahkan ke halaman index/ home
  die ("<script>alert('Anda telah login'); location.replace('$base_url')</script>");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $data_navigasi['judul'] ?> | <?php echo $namatoko ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $data_navigasi['seo_deskripsi'] ?>" />
    <meta name="keywords" content="<?php echo $data_navigasi['seo_keywords'] ?>" />
    <meta name="author" content="<?php echo $author ?>" />
    <!-- CSS Bootstrap -->
    <link href="<?php echo $base_url ?>template/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>template/css/shop-item.css" rel="stylesheet">
    <!-- JS -->
    <script src="<?php echo $base_url ?>template/js/jquery.js"></script>
    <script src="<?php echo $base_url ?>template/js/jquery-1.7.2.min.js"></script>
    <script src="<?php echo $base_url ?>template/js/jquery.scrolltotop.js"></script>
    <script src="<?php echo $base_url ?>template/js/jquery.validate.js"></script>
    <!-- Favicon -->
    <link href="<?php echo $base_url ?>images/fav.ico" rel="shortcut icon"/>
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <!-- Awal Konten Utama -->
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-sm-push-3">
          <div class="thumbnail">
            <div class="col-md-12">
              <h3><?php echo $data_navigasi['judul']; ?></h3>
              <hr/>
            </div>
              
            <div class="caption-full">
              <h3 align="center">Login</h3>
              <hr/>
              <?php include "login_form.php" ?>
              
              <hr/>
              
              <h3 align="center">Register</h3>
              <hr/>
              <?php include "register_form.php" ?>
            </div>
          </div>
        </div>

        <?php include 'sidebar.php'; ?>
        
      </div>

      <hr/>

      <!-- Awal Footer -->
      <?php include 'footer.php'; ?>
      <!-- Akhir Footer -->

    </div>
    <!-- Akhir Konten Utama -->
    
    <!-- Memanggil JS -->
    <script src="<?php echo $base_url ?>template/js/jquery.js"></script>
    <script src="<?php echo $base_url ?>template/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    var htmlobjek;
    $(document).ready(function(){
      //apabila terjadi event onchange terhadap object <select id=propinsi>
      $("#prov").change(function(){
        var prov = $("#prov").val();
        $.ajax({
            url: "fungsi/ambilkota.php",
            data: "prov="+prov,
            cache: false,
            success: function(msg){
                //jika data sukses diambil dari server kita tampilkan
                //di <select id=kota>
                $("#kot").html(msg);
            }
        });
      });
      $("#kot").change(function(){
        var kot = $("#kot").val();
        $.ajax({
            url: "fungsi/ambilkecamatan.php",
            data: "kot="+kot,
            cache: false,
            success: function(msg){
                $("#kec").html(msg);
            }
        });
      });
    });
    $(document).ready(function() 
    {
      $('#form-register').validate(
      {
        rules:  
        {
          nama: 
          {
            minlength:5
          },
          username: 
          {
            minlength:5
          },
          email: 
          {
            email: true
          },
          password: 
          {
            required: true,
            minlength:5
          },
          telp: 
          {
            digits: true,
            minlength:5
          },
        },
        messages: 
        {
          nama:
          {
            required: "* Nama harus diisi",
            minlength: "* Nama harus diisi minimal 5 huruf"
          },
          username:
          {
            required: "* Username harus diisi",
            minlength: "* Username harus diisi minimal 5 huruf"
          },
          email:
          {
            required: "* E-mail harus diisi",
            email: "* Format email tidak valid"
          },
          password:
          {
            required: "* Password harus diisi",
            minlength: "* Password harus diisi minimal 5 huruf"
          },
          telp:
          {
            required: "* Nomor telepon harus diisi"
          },
          alamat:
          {
            required: "* Alamat harus diisi"
          },
          kec:
          {
            required: "* Kecamatan harus diisi"
          },
          prov:
          {
            required: "* Provinsi harus diisi"
          },
          kota:
          {
            required: "* Kota harus diisi"
          },
        },
      });
      $('#form-login').validate(
      {
        rules:  
        {
          username: 
          {
            minlength: 5
          },
          pwd: 
          {
            required: true,
            minlength:5,
          },
        },
        messages: 
        {
          username:
          {
            required: "* Username harus diisi",
            minlength: "* Username harus diisi minimal 5 huruf"
          },
          pwd:
          {
            required: "* Password harus diisi",
            minlength: "* Password harus diisi minimal 5 huruf"
          },
        },
      });
    });
    </script>
    <style type="text/css">
      label.error {
      color: red; 
      padding-left: .5em;
      font-weight: normal;
      }
    </style>
  </body>
</html>