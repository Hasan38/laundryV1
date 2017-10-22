<h4>NO. INVOICE: #<?php echo $faktur ?></h4>

<p align="right">
  <a href='invoice/<?php echo $faktur; ?>'>
    <button type='button' class='btn btn-primary'>
      <span class='glyphicon glyphicon-download' aria-hidden='true'></span> Download Invoice
    </button>
  </a>
</p>

<div id="no-more-tables">
  <?php   
  include 'faktur_selesai.php';                     // Panggil data faktur
  // Membuat join query 3 tabel: transaksi, transaksi_detail dan produk
  $cek_invoice =  mysqli_query($conn,"SELECT transaksi.notransaksi,transaksi.username,transaksi.status,
                  produk.id_produk,produk.nama_produk,produk.judul_seo,
                  transaksi_detail.berat,transaksi_detail.harga_diskon,transaksi_detail.jumlah,
                  transaksi_detail.jumlah_berat,transaksi_detail.subtotal
                  FROM transaksi_detail
                  LEFT JOIN transaksi ON transaksi.notransaksi = transaksi_detail.notransaksi
                  INNER JOIN produk ON produk.id_produk = transaksi_detail.id_produk
                  WHERE transaksi.notransaksi = '$faktur' 
                  AND transaksi.username = '$sesen_username'  
                  AND transaksi.status = 1 ");
  if(mysqli_num_rows($cek_invoice) == 0)
  {echo "<center><h4>Keranjang belanja anda masih kosong</h4></center>";}
  else
  {
    echo "
    <table class='col-md-12 table-bordered table-striped table-condensed cf'>
      <thead class='cf'>
        <tr>
          <th>No.</th>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Berat</th>
          <th>J.Berat</th>
          <th>Qty</th>
          <th>Sub Total</th>
        </tr>
      </thead>";
    
    $no = 1;
    while($data_keranjang = mysqli_fetch_array($cek_invoice))
    {
      $harga_diskon = number_format($data_keranjang['harga_diskon'], 0, ',', '.');
      $subtotal     = number_format($data_keranjang['subtotal'], 0, ',', '.');

      echo "
      <tbody>
        <tr>
          <td data-title='No.' align='center'>".$no."</td>
          <td data-title='Nama Produk' align='left'><a href='$base_url"."produk/$data_keranjang[judul_seo].html'>$data_keranjang[nama_produk]</a></td>
          <td data-title='Harga Diskon' align='right'>$harga_diskon,-</td>
          <td data-title='Berat' align='center'>$data_keranjang[berat]</td>
          <td data-title='Jumlah Berat' align='center'>$data_keranjang[jumlah_berat]</td>
          <td data-title='Jumlah Berat' align='center'>$data_keranjang[jumlah]</td>
          <td data-title='Sub Total' align='right'>$subtotal,-</td>
        </tr>";
      $no++;
    }
  }
  ?>
</table>
</div>

<hr/>

<?php 
include 'keranjang_total_berat_selesai.php';
$keranjang =  mysqli_query($conn," SELECT produk.id_produk,produk.nama_produk,produk.judul_seo,
              transaksi.notransaksi,transaksi.username,transaksi.status,
              transaksi_detail.berat,transaksi_detail.harga_diskon,transaksi_detail.jumlah,transaksi_detail.jumlah_berat,transaksi_detail.subtotal,
              customer.username,customer.nama,customer.telepon,customer.alamat,customer.kopos,customer.kecamatan,customer.kota,customer.provinsi,kec.nama_kec,
              kabkot.nama_kabkot,kabkot.jne_reg,prov.nama_prov
              FROM transaksi_detail
              LEFT JOIN transaksi ON transaksi.notransaksi = transaksi_detail.notransaksi
              LEFT JOIN produk ON produk.id_produk = transaksi_detail.id_produk
              LEFT JOIN customer ON customer.username = transaksi_detail.username
              LEFT JOIN kec ON kec.id_kec = customer.kecamatan
              LEFT JOIN kabkot ON kabkot.id_kabkot = kec.id_kabkot AND kabkot.id_kabkot = customer.kota
              LEFT JOIN prov ON prov.id_prov = kabkot.id_prov AND prov.id_prov = customer.provinsi
              WHERE transaksi.notransaksi = '$faktur' 
                AND transaksi.username = '$sesen_username'  
                AND transaksi.status = 1");
$array        = mysqli_fetch_array($keranjang);
$ongkir       = $array['jne_reg'];
$nama_kota_kec= $array['nama_kabkot'].', '.$array['nama_kec'];
if(mysqli_num_rows($keranjang) > 0)
{
?>
  <table class="table">
    <thead>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">Ongkos Kirim</th>
        <td align="right">Via JNE REG</td>
        <td><?php echo $nama_kota_kec ?></td>
        <td align="right">Rp</td>
        <td align="right"><?php echo number_format($ongkir, 0, ',', '.').',-' ?></td>
      </tr>
      <tr>
        <th scope="row">Total Berat</th>
        <td></td>
        <td></td>
        <td></td>
        <td align="right"><?php echo $total_berat ?> kg</td>
      </tr>
      <tr>
        <th scope="row">Total Ongkos Kirim</th>
        <td align="right"><?php echo $total_berat_genap ?> kg</td>
        <td>x Rp <?php echo number_format($ongkir, 0, ',', '.').',-' ?></td>
        <td align="right">Rp</td>
        <td align="right">
          <?php $totalongkir = $total_berat_genap * $ongkir;
          echo number_format($totalongkir, 0, ',', '.').',-'; 
          ?>
        </td>
      </tr>
      <tr>
        <th scope="row">Grand Total</th>
        <td></td>
        <td></td>
        <td align="right">Rp</td>
        <td align="right">
        <b>
          <?php 
          $query        = "SELECT sum(subtotal) AS subtotal FROM transaksi_detail 
                          INNER JOIN produk ON produk.id_produk = transaksi_detail.id_produk 
                          INNER JOIN transaksi ON transaksi.notransaksi = transaksi_detail.notransaksi 
                          WHERE transaksi_detail.notransaksi = '$faktur' 
                          AND transaksi_detail.username = '$sesen_username' 
                          AND transaksi.status = 1 ";
          $hasil        = mysqli_query($conn,$query);
          $data         = mysqli_fetch_assoc($hasil);
          $subtotal     = $data['subtotal'];
          $grand_total  = $totalongkir + $subtotal;
          echo number_format($grand_total, 0, ',', '.').',-'; 
          ?>
        </b></td>
      </tr>
    </tbody>
   </table>

<?php } ?>

<hr/>

<p>Total biaya yang harus Anda bayar adalah sebesar <strong>Rp <?php echo number_format($grand_total, 0, ',', '.').',-';  ?></strong></p>
<p>Apabila telah melakukan pembayaran, mohon konfirmasi ke halaman berikut: <a href="<?php echo $base_url.'konfirmasi.html' ?>">klik disini</a></p>
<hr/>
<p>Pembayaran ditujukan ke rekening kami di bawah ini: </p>
<p><?php echo $bank ?></p>
<hr/>
<p>Setelah proses verifikasi pembayaran Anda selesai, maka kami akan mengirimkan barang ke:</p>

<p>
<?php
  echo "<b>Atas Nama</b>: $array[nama]<br/>
        <b>No. HP</b>: $array[telepon]<br/>
        <b>Alamat</b>: $array[alamat], $array[nama_kec], $array[nama_kabkot], $array[nama_prov], $array[kopos]";
?>
</p>
<hr/>
<?php echo $t_selesai['isi']; ?>
<p align="center">Terima kasih telah berbelanja bersama kami, <?php echo $namatoko ?>.</p>