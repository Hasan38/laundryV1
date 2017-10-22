<?php session_start();                    // Memulai session
include 'config.php';                     // Panggil koneksi ke database
include 'fungsi/base_url.php';            // Panggil fungsi base_url
include 'fungsi/setting.php';             // Panggil data Nama Toko Online
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Konfirmasi Pembayaran | <?php echo $namatoko ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Konfirmasi Pembayaran" />
    <meta name="keywords" content="konfirmasi pembayaran" />
    <meta name="author" content="<?php echo $author ?>" />    
    <!-- CSS Bootstrap -->
    <link href="<?php echo $base_url ?>template/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>template/css/shop-item.css" rel="stylesheet">
    <!-- JS -->
    <script src="<?php echo $base_url ?>template/js/bootstrap.min.js"></script>
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
              <h3>Konfirmasi Pembayaran Anda</h3>
              <hr/>
            </div>
            <div class="caption-full">
              <form method="post" id="form-register" action="konfirmasi_kirim.php">
                <div class="row">
                  <div class="col-md-12">
                    <div class="box box-primary">
                      <div class="box-body">
                        <div class="row">
                          <div class="col-xs-3"><label>No. Invoice</label>
                            <input class="form-control" name="no_invoice" type="text" id="no_invoice" placeholder="Isikan angka saja" onkeypress='return isNumberKey(event)' required/>
                          </div>
                          <div class="col-xs-5"><label>Nama Pengirim</label>
                            <input class="form-control" name="nama_pengirim" type="text" id="nama_pengirim" required/>
                          </div>
                          <div class="col-xs-4"><label>Email</label>
                            <input class="form-control" name="email" type="text" id="email"/>
                          </div>
                        </div><br/>
                        <div class="row">
                          <div class="col-xs-3"><label>Transfer Ke</label>
                            <input class="form-control" name="transfer_ke" type="text" id="transfer_ke" placeholder="" required/>
                          </div>
                          <div class="col-xs-5"><label>Jumlah Transfer</label>
                            <input class="form-control" name="jml_transfer" type="text" id="jml_transfer" placeholder="Isikan angka saja" onkeypress='return isNumberKey(event)' required/>
                          </div>
                          <div class="col-xs-4"><label>Tanggal Transfer</label>
                            <input class="form-control" name="tgl_transfer" type="text" id="tgl_transfer"/>
                          </div>
                        </div><br/>
                        <div class="form-group"><label>Catatan</label>
                          <textarea class="form-control" name="catatan" id="catatan" placeholder="Tidak wajib diisi"></textarea>
                        </div>
                      </div><!-- /.box-body -->
                      <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
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
    <!-- Fungsi JS untuk membuat form hanya bisa diisi oleh angka saja -->
    <script type="text/javascript">
    function isNumberKey(evt)
    {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))

      return false;
      return true;
    }
    </script>
  </body>
</html>