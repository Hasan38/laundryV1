<h3>Keranjang Belanja</h3>
<hr/>
<table width="250" border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
  	<td colspan="2" align="center" valign="top" scope="col">
  	<?php
		if(isset($sesen_username))
		{
			$query 		= "SELECT * FROM transaksi_detail 
									INNER JOIN produk ON produk.id_produk = transaksi_detail.id_produk 
									INNER JOIN transaksi ON transaksi.notransaksi = transaksi_detail.notransaksi 
									WHERE transaksi_detail.username = '$sesen_username' AND transaksi.status ='0' LIMIT 0,3";
			$hasil 		= mysqli_query($conn,$query);
			if (mysqli_num_rows($hasil) > 0)
			{
				while ($data = mysqli_fetch_array($hasil))
				{
					echo "
								<tr>
									<td><a href='$base_url"."produk/$data[judul_seo].html'/><b>".$data['nama_produk']."</b></a>
									<br>
									Rp ".number_format($data['harga_diskon'], 0, ',', '.')." x ".$data['jumlah']." = Rp ".number_format($data['subtotal'], 0, ',', '.')."
									<br><br>
									</td>
								</tr>";
				}
			}
				else
				{
					echo "<img src='$base_url"."images/cart.png' width='100' height='85'/>";
				}
		}
		else
		{
			echo "<img src='$base_url"."images/cart.png' width='100' height='85'/>";
		}
		?>
  	</td>
  </tr>
  <tr>
    <th colspan="2" align="left" valign="top" scope="col"> <hr />
      <p><a href="<?php echo $base_url ?>keranjang.html">Selengkapnya</a></p>
    </th>
  </tr>
</table>
</p>