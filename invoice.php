<?php session_start(); ob_start(); 
include 'config.php';                     // Panggil koneksi ke database
include 'faktur_selesai.php';             // Panggil data faktur yang telah selesai
include 'fungsi/base_url.php';            // Panggil fungsi base_url
include 'fungsi/cek_session_public.php';  // Panggil fungsi cek session public
include 'fungsi/cek_login_public.php'; 		// Panggil fungsi cek login public
include 'fungsi/setting.php';             // Panggil data Nama Toko Online
include 'fungsi/tgl_indo.php';            // Panggil fungsi tanggal indonesia

$notransaksi 	 = 	mysqli_real_escape_string($conn,$_GET['notransaksi']);
// Membuat join query 3 tabel: transaksi, transaksi_detail dan produk
$hasil_invoice = 	mysqli_query($conn,"SELECT transaksi.notransaksi,transaksi.username,transaksi.status,
                  produk.id_produk,produk.nama_produk,produk.judul_seo,
                  transaksi_detail.berat,transaksi_detail.harga_diskon,transaksi_detail.jumlah,
                  transaksi_detail.jumlah_berat,transaksi_detail.subtotal
                  FROM transaksi_detail
                  LEFT JOIN transaksi ON transaksi.notransaksi = transaksi_detail.notransaksi
                  INNER JOIN produk ON produk.id_produk = transaksi_detail.id_produk
                  WHERE transaksi.notransaksi = '$faktur' 
                  AND transaksi.username = '$sesen_username'  
                  AND transaksi.status = 1 ");
if(mysqli_num_rows($hasil_invoice) == 0)
{die ("<script>alert('Invoice yang Anda cari tidak ditemukan');location.replace('$base_url')</script>");}
?>  

<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->  
	<head>  
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  
    <title>Invoice #<?php echo $notransaksi; ?></title>
    <style type="text/css">
		.tabel2 {
		  width: 100%;
		  border-collapse: collapse;
		  border-spacing: 0;
		}
		.tabel2 tr.odd td {
		    background-color: #f9f9f9;
		}
		.tabel2 th, .tabel2 td {
	    padding: 4px 5px;
	    line-height: 20px;
	    text-align: left;
	    vertical-align: top;
	    border: 1px solid #dddddd;
		}
		</style>
  </head>
  <body>  
		<table>
		  <tr>
		    <td>
		      <font style="font-size: 25px; text-align: left"><br/><b><?php echo $namatoko ?></b></font><br/>
		      <font style="font-size: 15px; text-align: left">
		        <br/><?php echo $alamat_toko ?>
		      </font>        
		    </td>
		  </tr>
		</table>

		<hr/>

		<h3 align="center">NO. INVOICE: #<?php echo $notransaksi; ?></h3>

		<table class="tabel2" align="right">
		  <thead>
		    <tr>
		      <td style="text-align: center; background: #ddd"><b>No.</b></td>
		      <td style="text-align: center; background: #ddd"><b>NAMA PRODUK</b></td>
		      <td style="text-align: center; background: #ddd"><b>BERAT</b></td>
		      <td style="text-align: center; background: #ddd"><b>JUMLAH BERAT</b></td>
		      <td style="text-align: center; background: #ddd"><b>HARGA</b></td>
		      <td style="text-align: center; background: #ddd"><b>QTY</b></td>
		      <td style="text-align: center; background: #ddd"><b>SUBTOTAL</b></td>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php
        $i   = 1;
        while ($data_invoice = mysqli_fetch_array($hasil_invoice))
        {
        	$harga_diskon = number_format($data_invoice['harga_diskon'], 0, ',', '.');
        	$subtotal 		= number_format($data_invoice['subtotal'], 0, ',', '.')
        ?>
          <tr>
            <td style='text-align: center; width:20px'><?php echo $i ?></td>
            <td style='text-align: left; width:200px'><?php echo $data_invoice['nama_produk'] ?></td>
            <td style='text-align: center; width:50px'><?php echo $data_invoice['berat'] ?></td>
            <td style='text-align: center; width:50px'><?php echo $data_invoice['jumlah_berat'] ?></td>
            <td style='text-align: right; width:65px'><?php echo $harga_diskon.',-' ?></td>
            <td style='text-align: center; width:50px'><?php echo $data_invoice['jumlah'] ?></td>
            <td style='text-align: right; width:70px'><?php echo $subtotal.',-' ?></td>
          </tr>
        <?php $i++; } ?>
		  </tbody>
		</table>

<?php 
include 'keranjang_total_berat_selesai.php';
$keranjang =  mysqli_query($conn,"SELECT produk.id_produk,produk.nama_produk,produk.judul_seo,
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

		<table class="tabel2" align="right">
		  <thead>
		    <tr>
		      <td style="background: #ddd"></td>
		      <td style="background: #ddd"></td>
		      <td style="background: #ddd"></td>
		      <td style="background: #ddd"></td>
		    </tr>
		  </thead>
		  <tbody>
        <tr>
				  <td style='text-align: left; width:131px'><b>Ongkir Per Kg</b></td>
				  <td colspan="2" style='text-align: left; width:100px'><?php echo $nama_kota_kec ?></td>
				  <td style='text-align: right; width:70px'><?php echo number_format($ongkir, 0, ',', '.').',-' ?></td>
				</tr>
				<tr>
				  <td colspan="3" style='text-align: left; width:131px'><b>Total Berat</b></td>
				  <td style='text-align: right; width:70px'><?php echo $total_berat ?> kg</td>
				</tr>
				<tr>
				  <td style='text-align: left; width:131px'><b>Total Ongkir</b></td>
				  <td style='text-align: left; width:100px'><?php echo $total_berat_genap ?> kg x <?php echo number_format($ongkir, 0, ',', '.').',-' ?></td>
				  <td style='text-align: center; width:50px'>Rp </td>
				  <td style='text-align: right; width:70px'>
					  <?php $totalongkir = $total_berat_genap * $ongkir;
	          echo number_format($totalongkir, 0, ',', '.').',-'; 
	          ?>
	        </td>
				</tr>
        <tr>
				  <td colspan="2" style='text-align: left; width:131px'><b>Grand Total</b></td>
				  <td style='text-align: center; width:50px'><b>Rp</b></td>
				  <td style='text-align: right; width:70px'><b>
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
	          ?></b>
				  </td>
				</tr>
		  </tbody>
		</table>

		<hr/>
		
		<?php } ?>

		<p>Total biaya yang harus Anda bayar adalah sebesar <strong>Rp <?php echo number_format($grand_total, 0, ',', '.').',-'; ?></strong></p>
		<p>Apabila telah melakukan pembayaran, mohon konfirmasi ke halaman berikut: <a href="<?php echo $base_url.'konfirmasi.html' ?>">klik disini</a></p>
		<hr/>
		<p>Pembayaran ditujukan ke rekening kami di bawah ini: </p>
		<p><?php echo $bank ?></p>
		<hr/>
		<p>Setelah proses verifikasi pembayaran Anda selesai, maka kami akan mengirimkan barang ke:<br/>
		<?php
		  echo "<b>Atas Nama</b>: $array[nama]<br/>
		        <b>No. HP</b>: $array[telepon]<br/>
		        <b>Alamat</b>: $array[alamat], $array[nama_kec], $array[nama_kabkot], $array[nama_prov], $array[kopos]";
		?>
		</p>
		<hr/>
		<p align="center"><b>Terima Kasih telah berbelanja bersama kami, <?php echo $namatoko ?></b></p>
		<hr/>
	</body>  
</html><!-- Akhir halaman HTML yang akan di konvert -->  

<?php
// ob_get_clean = salah 1 fungsi dalam PHP
$content = ob_get_clean();
// Memanggil class HTML2PDF dari direktori html2pdf pada project kita
include 'html2pdf/html2pdf.class.php';
try
{
  // Mengatur invoice dalam format HTML2PDF
  // Keterangan: L = Landscape/ P = Portrait, A4 = ukuran kertas, en = bahasa, false = kode HTML2PDF, UTF-8 = metode pengkodean karakter
  $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'UTF-8', array(10, 5, 10, 0));
  // Mengatur invoice dalam posisi full page
  $html2pdf->pdf->SetDisplayMode('fullpage');
  // Menuliskan bagian content menjadi format HTML
  $html2pdf->writeHTML($content);
  // Mencetak nama file invoice
  $html2pdf->Output('invoice.pdf'); 
}
// Kodingan HTML2PDF
catch(HTML2PDF_exception $e) 
{
  echo $e;
  exit;
}
?>  