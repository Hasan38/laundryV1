<?php session_start();
include '../config.php';                  // Panggil koneksi ke database
include '../fungsi/cek_login.php';        // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';      // Panggil fungsi cek session
include '../fungsi/setting.php';          // Panggil data setting
include '../fungsi/tgl_indo.php';         // Panggil fungsi merubah tanggal menjadi format seperti 2 Mei 2015

$notransaksi  = mysqli_real_escape_string($conn, $_GET['notransaksi']);

$sql_pesanan  = mysqli_query($conn,"SELECT prov.id_prov,prov.nama_prov,produk.id_produk,
kec.id_kec,kec.nama_kec,kabkot.id_kabkot,kabkot.nama_kabkot,kabkot.jne_reg,kec.id_prov,kec.id_kabkot,
customer.id_customer,customer.nama,customer.username,customer.email,customer.telepon,customer.alamat,
customer.kopos,customer.kecamatan,customer.kota,customer.provinsi,
transaksi.notransaksi,transaksi.status,transaksi.tgl_checkout,
transaksi_detail.notransaksi,transaksi_detail.id_produk,transaksi_detail.nama_produk,transaksi_detail.berat,
transaksi_detail.jumlah_berat,transaksi_detail.notransaksi,transaksi_detail.harga_diskon,transaksi_detail.jumlah,
transaksi_detail.subtotal
FROM kabkot
LEFT JOIN kec ON kabkot.id_kabkot = kec.id_kabkot
INNER JOIN prov ON prov.id_prov = kec.id_prov
INNER JOIN customer ON customer.kota = kec.id_kabkot
AND customer.kecamatan = kec.id_kec
AND customer.provinsi = kec.id_prov,
transaksi
LEFT JOIN transaksi_detail ON transaksi.notransaksi = transaksi_detail.notransaksi
INNER JOIN produk ON produk.id_produk = transaksi_detail.id_produk
WHERE transaksi.notransaksi = '$notransaksi' 
AND transaksi.username = customer.username  
AND transaksi.status = 1 ");

$array        = mysqli_fetch_array($sql_pesanan);

$nama         = $array['nama'];
$username     = $array['username'];
$notransaksi  = $array['notransaksi'];
$tgl_checkout = tgl_indo($array['tgl_checkout']);
$alamat       = $array['alamat'];
$kecamatan    = $array['nama_kec'];
$kota         = $array['nama_kabkot'];
$provinsi     = $array['nama_prov'];
$kopos        = $array['kopos'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Invoice #<?php echo $notransaksi; echo " | "; echo $namatoko ?> </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../images/fav.ico" />
    <!-- JS -->
    <?php include 'js.php'; ?>
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      <?php include 'header.php'; ?>

      <div class="content-wrapper">
        <section class="content-header">
          <h1>NO. INVOICE #<?php echo $notransaksi ?> </h1>
          <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Pesanan</li>
            <li class="active"><a href="product_list.php">No. Invoice #<?php echo $notransaksi ?></a></li>
          </ol>
        </section>

        <section class="content">
          <div class="pad margin no-print">
            <div class="callout callout-info" style="margin-bottom: 0!important;">                        
              <h4><i class="fa fa-info"></i> Note:</h4>
              Halaman ini bisa langsung diprint dengan menekan tombol (ctrl + p) pada keyboard
            </div>
          </div>

          <!-- Main content -->
          <section class="invoice">
            <!-- title row -->
            <div class="row">
              <div class="col-xs-12">
                <h2 class="page-header">
                  <i class="fa fa-globe"></i> <?php echo $namatoko ?>
                </h2>
              </div><!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                Dari
                <address>
                  <strong><?php echo $namatoko ?></strong><br>
                  <?php echo $alamat_toko ?>
                </address>
              </div><!-- /.col -->
              <div class="col-sm-4 invoice-col">
                Kepada
                <address>
                  <strong><?php echo $nama ?></strong><br>
                  <?php echo $alamat; echo', '; 
                        echo $kecamatan; echo', '; 
                        echo $kota; echo', '; 
                        echo $provinsi; echo', '; 
                        echo $kopos;
                  ?>
                </address>
              </div><!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <b>No.Invoice #<?php echo $notransaksi ?></b><br/>
                <b>Tanggal Pemesanan: <?php echo $tgl_checkout ?></b><br/>
              </div><!-- /.col -->
            </div><!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Barang</th>
                      <th>Berat</th>
                      <th>Jumlah Berat</th>
                      <th>Harga</th>
                      <th>Qty</th>
                      <th>Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
<?php 
$sql_pesanan = mysqli_query($conn,"SELECT prov.id_prov,prov.nama_prov,produk.id_produk,
kec.id_kec,kec.nama_kec,kabkot.id_kabkot,kabkot.nama_kabkot,kabkot.jne_reg,kec.id_prov,kec.id_kabkot,
customer.id_customer,customer.nama,customer.username,customer.email,customer.telepon,customer.alamat,
customer.kopos,customer.kecamatan,customer.kota,customer.provinsi,
transaksi.notransaksi,transaksi.status,transaksi.tgl_checkout,
transaksi_detail.notransaksi,transaksi_detail.id_produk,transaksi_detail.nama_produk,transaksi_detail.berat,
transaksi_detail.jumlah_berat,transaksi_detail.notransaksi,transaksi_detail.harga_diskon,transaksi_detail.jumlah,
transaksi_detail.subtotal
FROM kabkot
LEFT JOIN kec ON kabkot.id_kabkot = kec.id_kabkot
INNER JOIN prov ON prov.id_prov = kec.id_prov
INNER JOIN customer ON customer.kota = kec.id_kabkot
      AND customer.kecamatan = kec.id_kec
      AND customer.provinsi = kec.id_prov,
transaksi
LEFT JOIN transaksi_detail ON transaksi.notransaksi = transaksi_detail.notransaksi
INNER JOIN produk ON produk.id_produk = transaksi_detail.id_produk 
WHERE transaksi.notransaksi = '$notransaksi' 
AND transaksi.username = customer.username  
AND transaksi.status = 1 ORDER BY transaksi_detail.nama_produk ASC");
$numrows  = mysqli_num_rows($sql_pesanan); 
          $no = 1;
          // Jika data ketemu, maka akan ditampilkan dengan While
          if($numrows > 0)
          {
            while($row = mysqli_fetch_array($sql_pesanan)) 
            {
              $harga_diskon = number_format($row['harga_diskon'], 0, ',', '.');
              $subtotal = number_format($row['subtotal'], 0, ',', '.');
           ?>
                     <tr>
                        <td align='center'><?php echo $no ?></td>
                        <td align='left'><?php echo $row['nama_produk'] ?></td>
                        <td style='text-align: center'><?php echo $row['berat'] ?></td>
                        <td style='text-align: center'><?php echo $row['jumlah_berat'] ?></td>
                        <td style='text-align: center'><?php echo $harga_diskon ?></td>
                        <td style='text-align: center'><?php echo $row['jumlah'] ?></td>
                        <td style='text-align: center'><?php echo $subtotal ?></td>
                      </tr>
                      <?php $no++;}} ?>
                  </tbody>
                </table>
              </div><!-- /.col -->
            </div><!-- /.row -->

            <div class="row">
              <div class="col-xs-12">
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <th>Ongkir Per Kg</th>
                      <td align="right">VIA JNE REG ke <?php echo $array['nama_kabkot'] ?></td>
                      <td></td>
                      <td align="right">
                      <?php
                      $keranjang_ongkir   = "SELECT * FROM kabkot INNER JOIN customer on customer.kota = kabkot.id_kabkot
                                            WHERE customer.username = '$username' ";
                      $hasil  = mysqli_query($conn,$keranjang_ongkir);
                      $data2   = mysqli_fetch_array($hasil);
                      $jne_reg = number_format($data2['jne_reg'], 0, ',', '.');
                      echo "$jne_reg,-";
                      ?>
                      </td>
                    </tr>
                    <tr>
                      <th>Total Berat</th>
                      <td></td>
                      <td></td>
                      <td align="right">
                      <?php
                      $query1 = "SELECT sum(jumlah_berat) AS jumlah_berat FROM transaksi_detail 
                                INNER JOIN produk ON produk.id_produk = transaksi_detail.id_produk 
                                INNER JOIN transaksi ON transaksi.notransaksi = transaksi_detail.notransaksi 
                                WHERE transaksi.notransaksi = '$notransaksi' 
                                  AND transaksi_detail.username = '$username' 
                                  AND transaksi.status = 1 ";
                      $hasil = mysqli_query($conn,$query1);
                      $data3 = mysqli_fetch_array($hasil);
                      $jumlah_berat = $data3['jumlah_berat'];
                      if(mysqli_num_rows($hasil) > 0){echo round($jumlah_berat,2);}
                      ?> kg
                      </td>
                    </tr>
                    <tr>
                      <th>Total Ongkir</th>
                      <td align="right">
                      <?php // Penggenapan jumlah berat (bulat keatas)
                      $query = "SELECT sum(jumlah_berat) AS jumlah_berat FROM transaksi_detail 
                                INNER JOIN produk ON produk.id_produk = transaksi_detail.id_produk 
                                INNER JOIN transaksi ON transaksi.notransaksi = transaksi_detail.notransaksi 
                                WHERE transaksi_detail.username = '$username' AND transaksi.status = 1 and transaksi.notransaksi = '$notransaksi' ";
                      $hasil = mysqli_query($conn,$query);
                      $data4 = mysqli_fetch_assoc($hasil);
                      $jumlah_berat = $data4['jumlah_berat'];
                      if(mysqli_num_rows($hasil) > 0){echo ceil($jumlah_berat);}
                      ?> kg x <?php echo $jne_reg ?>
                      </td>
                      <td align="right">Rp</td>
                      <td align="right">
                      <?php
                      $berat_total =  ceil($data4['jumlah_berat']);
                      $ongkir = $data2['jne_reg'];
                      $totalongkir = $berat_total * $ongkir;
                      echo " ".number_format($totalongkir, 0, ',', '.').",- ";
                      ?>
                      </td>
                    </tr>
                    <tr>
                      <th>Grand Total</th>
                      <td></td>
                      <td align="right">Rp</td>
                      <td align="right">
                        <?php 
                        $query  = "SELECT sum(subtotal) AS total FROM transaksi_detail 
                                  INNER JOIN produk ON produk.id_produk = transaksi_detail.id_produk 
                                  INNER JOIN transaksi ON transaksi.notransaksi = transaksi_detail.notransaksi 
                                  WHERE transaksi_detail.notransaksi = '$notransaksi' 
                                    AND transaksi_detail.username = '$username' 
                                    AND transaksi.status = 1 ";
                        $hasil  = mysqli_query($conn,$query);
                        $data5   = mysqli_fetch_assoc($hasil);
                        $subtotal = $data5['total'];
                        $grand_total = $totalongkir + $subtotal;
                        $grandtotal  = " ".number_format($grand_total, 0, ',','.').",- ";
                        echo "<b>$grandtotal</b>";
                         ?>
                      </td>
                    </tr>
                  </table>
                </div>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </section><!-- /.content -->
        </section>
      </div>

      <div class="row no-print">
        <?php include "footer.php" ?>
      </div>

    </div>

  </body>
</html>