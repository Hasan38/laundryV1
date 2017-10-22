<div id="no-more-tables">
<form method="post" id="form1" action="keranjang_update.php">
	<?php		
	include 'faktur.php';                     // Panggil data faktur
	// Membuat join query 3 tabel: transaksi, transaksi_detail dan produk
	$cek_invoice = 	mysqli_query($conn,"SELECT transaksi.notransaksi,transaksi.username,transaksi.status,
									produk.id_produk,produk.nama_produk,produk.judul_seo,
									transaksi_detail.berat,transaksi_detail.harga_diskon,transaksi_detail.jumlah,
									transaksi_detail.jumlah_berat,transaksi_detail.subtotal
									FROM transaksi_detail
									LEFT JOIN transaksi ON transaksi.notransaksi = transaksi_detail.notransaksi
									INNER JOIN produk ON produk.id_produk = transaksi_detail.id_produk
									WHERE transaksi.notransaksi = '$faktur' 
									AND transaksi.username = '$sesen_username'  
									AND transaksi.status = 0");
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
				  <th>Aksi</th>
				  <th>Sub Total</th>
				</tr>
			</thead>";
			$i = 1;

		while($data_keranjang = mysqli_fetch_array($cek_invoice))
		{
			$harga_diskon = number_format($data_keranjang['harga_diskon'], 0, ',', '.');
			$subtotal 		= number_format($data_keranjang['subtotal'], 0, ',', '.');

			echo "
			<tbody>
				<tr>
					<td data-title='No.' align='center'>$i</td>
		    	<td data-title='Nama Produk' align='left'><a href='$base_url"."produk/$data_keranjang[judul_seo].html'>$data_keranjang[nama_produk]</a></td>
			    <td data-title='Harga Diskon' align='right'>$harga_diskon,-</td>
			    <td data-title='Berat' align='center'>$data_keranjang[berat]</td>
			    <td data-title='Jumlah Berat' align='center'>$data_keranjang[jumlah_berat]</td>
			    <td data-title='Qty' align='center'>
			      <input type='hidden' name='id".$i."' value='$data_keranjang[id_produk]'/>
			      <input type='text' name='jumlah".$i."' value='$data_keranjang[jumlah]' size='3' onkeypress='return isNumberKey(event)'/>
			    </td>
			    <td data-title='Aksi' align='center'>
			      <a href='keranjang_update.php?id=$data_keranjang[id_produk]'>
			      	<button name='update' type='submit' class='btn btn-warning' aria-label='Left Align' title='Update'>
							  <span class='glyphicon glyphicon-refresh' aria-hidden='true'></span>
							</button>
			      </a>
			      <a href='keranjang_hapus.php?id=$data_keranjang[id_produk]'>
			      	<button name='hapus' type='button' class='btn btn-danger' aria-label='Left Align' title='Hapus' OnClick=\"return confirm('Apakah Anda yakin?');\">
							  <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
							</button>
			      </a>
			    </td>
			    <td data-title='Sub Total' align='right'>$subtotal,-</td>
			  </tr>";
			$i++;
		}
		$no = $i-1;
	}
	?>
	<input type="hidden" name="n" value="<?php echo $no ?>" />
</table>
</div>

<hr/>

<?php 
include 'keranjang_total_berat.php';
$keranjang = 	mysqli_query($conn,"SELECT produk.id_produk,produk.nama_produk,produk.judul_seo,
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
                AND transaksi.status = 0 ");
$array        = mysqli_fetch_array($keranjang);
$ongkir 			= $array['jne_reg'];
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
	      	$query 				= "SELECT sum(subtotal) AS subtotal FROM transaksi_detail 
													INNER JOIN produk ON produk.id_produk = transaksi_detail.id_produk 
													INNER JOIN transaksi ON transaksi.notransaksi = transaksi_detail.notransaksi 
													WHERE transaksi_detail.notransaksi = '$faktur' 
													AND transaksi_detail.username = '$sesen_username' 
													AND transaksi.status = 0 ";
					$hasil 				= mysqli_query($conn,$query);
					$data 				= mysqli_fetch_assoc($hasil);
					$subtotal 		= $data['subtotal'];
					$grand_total 	= $totalongkir + $subtotal;
	      	echo number_format($grand_total, 0, ',', '.').',-'; 
	      	?>
	      </b></td>
	    </tr>
	  </tbody>
	 </table>
 </form>

 	<p>
 		<a href="keranjang_hapus_all.php">
			<button name="hapus" type="button" class="btn btn-danger" aria-label="Left Align" title="Kosongkan Keranjang Belanja" OnClick="return confirm('Apakah Anda yakin?');">
			  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Kosongkan Keranjang Belanja
			</button>
		</a>
		<a href="<?php echo $base_url ?>">
			<button name="hapus" type="button" class="btn btn-primary" aria-label="Left Align" title="Lanjut Belanja">
			  <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Lanjut Belanja
			</button>
		</a>
		<?php
		if(mysqli_num_rows($keranjang) > 0)
		{
			echo "
			<a href='checkout.html'>
				<button name='selesaikan' type='button' class='btn btn-success' aria-label='Left Align' title='Selesaikan Belanja' OnClick=\"return confirm('Apakah Anda yakin?');\">
				  <span class='glyphicon glyphicon-check' aria-hidden='true'></span> Selesaikan Belanja
				</button>
			</a>";
		}
		?>
	</p>
	<hr/>

	<p><strong>CATATAN</strong></p>
	<p>* Total berat akan dibulatkan ke atas dikarenakan sesuai dengan peraturan JNE</p>		

<?php } ?>