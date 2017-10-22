<?php session_start();
include '../config.php';                    // Panggil koneksi ke database
include '../fungsi/cek_login.php';          // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';        // Panggil fungsi cek session
include '../fungsi/cek_aksi_tambah.php';    // Panggil fungsi boleh tambah data atau tidak
include '../fungsi/cek_hal_superadmin.php'; // Panggil fungsi hanya superadmin yang boleh melakukan aksi
include '../fungsi/setting.php';            // Panggil data setting
include '../fungsi/tgl_indo.php';           // Panggil fungsi merubah tanggal menjadi format seperti 2 Mei 2015
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Daftar User | <?php include "title.php" ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../images/fav.ico" />
    <!-- JS -->
    <?php include 'js.php'; ?>
    <!-- Data Tables -->
    <link href="template/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
    <script src="template/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="template/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <!-- Skrip Datatables -->
    <script type="text/javascript">
    $(function () {
    $("#example1").dataTable();
    $('#example2').dataTable({
      "bPaginate": true,
      "bLengthChange": false,
      "bFilter": false,
      "bSort": true,
      "bInfo": true,
      "bAutoWidth": false,
    });
    });
    </script>
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      <?php include "header.php" ?>
      
      <div class="content-wrapper">
        <section class="content-header">
          <h1>Daftar User <small><a href="user_add.php">Tambah User Baru</a></small></h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>User</li>
            <li class="active"><a href="user_list.php">Daftar User</a></li>
          </ol>
        </section>

        <section class="content">
          <?php include "user_list_data.php" ?>
        </section>
      </div>

      <?php include "footer.php" ?>

    </div>

  </body>
</html>