<?php session_start();
include '../config.php';                // Panggil koneksi ke database
include '../fungsi/cek_login.php';      // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';    // Panggil fungsi cek session
include '../fungsi/cek_aksi_ubah.php';  // Panggil fungsi boleh ubah data atau tidak
include '../fungsi/setting.php';        // Panggil data setting
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Ubah Data Produk | <?php include "title.php" ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../images/fav.ico" />
    <!-- JS -->
    <?php include 'js.php'; ?>
    <script type="text/javascript">
    function hitung() {
      var a = $("#a").val();
      var b = $("#b").val();
      c = a * b/100; //Persentase: a x b dibagi 100%
      $("#c").val(c);
      d = b - c; //Harga Setelah Diskon: Harga Awal (b) - Harga Diskon (c)
      $("#d").val(d);
    }

    $(function() {
      $("#cmbkat").change(function(){
        $("img#imgLoad").show();
        var id_kat = $(this).val();
        $.ajax({
          type: "POST",
          dataType: "html",
          url: "../fungsi/getsubkat.php",
          data: "id_kat="+id_kat,
          success: function(msg){
            if(msg == ''){
                    $("select#cmbsubkat").html('<option value="">--Pilih Kategori Terlebih Dahulu--</option>');
                    $("select#cmbsupersubkat").html('<option value="">--Belum ada data--</option>');
            }else{
                      $("select#cmbsubkat").html(msg);                                                      
            }
            $("img#imgLoad").hide();

            getAjaxAlamat();                                                       
        }
      });                   
    });

    $("#cmbsubkat").change(getAjaxAlamat);
    function getAjaxAlamat(){
      $("img#imgLoadMerk").show();
      var id_subkat = $("#cmbsubkat").val();
      $.ajax({
        type: "POST",
        dataType: "html",
        url: "../fungsi/getsupersubkat.php",
        data: "id_subkat="+id_subkat,
        success: function(msg){
          if(msg == ''){
            $("select#cmbsupersubkat").html('<option value="">--Belum ada data--</option>');                                                                                 
          }else{
            $("select#cmbsupersubkat").html(msg);                             
          }
        $("img#imgLoadMerk").hide();                                                       
        }
      });
      }    
    });
    </script>
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      <?php include 'header.php'; ?>
      
      <div class="content-wrapper">
        <section class="content-header">
          <h1>Ubah Data Produk</h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Produk</li>
            <li class="active"><a href="#">Ubah Data Produk</a></li>
          </ol>
        </section>

        <section class="content">
          <?php include "produk_ubah_form.php" ?>
        </section>
      </div>

      <?php include "footer.php" ?>

    </div>
    
  </body>
</html>
