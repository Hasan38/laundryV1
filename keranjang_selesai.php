<?php session_start();
include "config.php"; 
include "faktur.php"; 
include "fungsi/base_url.php"; 
include "fungsi/cek_session_public.php"; 
include "fungsi/cek_login_public.php"; 
include "fungsi/user_kota.php"; 
	
$cari 	= "SELECT * FROM transaksi WHERE notransaksi = '$faktur' AND username = '$sesen_username' AND status = '0' ";
$query 	= mysqli_query($conn,$cari);

if(mysqli_num_rows($query) == 0)
{
	echo "<script>alert('Mohon maaf, Anda belum melakukan pembelian');location.replace('cart.html')</script>";
}
	else
	{
		// Mengirimkan notifikasi ke email invoice pembelian barang ke ADMIN
		$cari 	= "SELECT * FROM customer WHERE username = '$sesen_username' ";
		$query 	= mysqli_query($conn,$cari);
		$data 	= mysqli_fetch_array($query);
		
		$mail_to 			= "azr27@ymail.com"; //Alamat email pembelian terbaru yang ditujukan ke admin
		$mail_subject = "Pembelian Barang Baru di dari $data[nama]"; //Judul email
		
		$mail_body.= "[BatreShop] Pesanan Terbaru di batreshop.com\n";
		$mail_body.= "Detail pesanan:\n";
		$mail_body = "Email: $data[email]\n\n";
		$mail_body.= "Nama Lengkap: $data[nama]\n\n";
		$mail_body.= "Alamat Lengkap: $data[alamat]\n\n";
		$mail_body.= "Telepon: $data[telepon]\n\n";

		$cari 	= "SELECT * FROM transaksi_detail WHERE notransaksi = '$faktur' ";
		$query 	= mysqli_query($conn,$cari);
		while($row = mysqli_fetch_array($query))
		{
			$mail_body.= "$row[nama_produk] / $row[jumlah] / $row[harga_diskon] / $row[subtotal]\n";
			$mail_body.="----------------------------------------------------------------------------------------------------------\n";
		}
		$mail_body.= "==========================================================================================================\n";
		
		$cari2 = "SELECT sum(subtotal) AS total FROM transaksi_detail INNER JOIN produk ON produk.id_produk = transaksi_detail.id_produk 
							INNER JOIN transaksi ON transaksi.notransaksi = transaksi_detail.notransaksi 
							WHERE transaksi_detail.username = '$sesen_username' AND transaksi.status = '0' ";
		$hasil = mysqli_query($conn,$cari2);
		$data_total = mysqli_fetch_assoc($hasil);
		$mail_body.= "Total : $data_total[total]\n";
		$mail_body.= "----------------------------------------------------------------------------------------------------------\n";
		$proses = explode(",",$mail_to);

		reset($proses);
		foreach ($proses as $tujuan) 
		{
			$kirim = mail($tujuan,$mail_subject,$mail_body, "From: $data[email]");
		}

		// Mengirimkan email invoice pembelian barang ke USER
		$cari 	= "SELECT * FROM customer WHERE username = '$sesen_username' ";
		$query 	= mysqli_query($conn,$cari);
		$data 	= mysqli_fetch_array($query);
		
		$mail_to 			= "$data[email]"; //Alamat email pembelian terbaru yang ditujukan ke user
		$mail_subject = "Invoice Pembelian Barang di batreshop.com"; //Judul email
					
		$mail_body 		= "Terima kasih telah berbelanja di website kami, harap menyimpan Invoice ini dengan baik sebagai bukti pembayaran\n\n";

		// Menampilkan No. Faktur pembeli
		$cari 				= "SELECT * FROM transaksi WHERE username = '$sesen_username' AND status = '0' ORDER BY notransaksi DESC";
		$query 				= mysqli_query($conn,$cari);
		$hasil 				= mysqli_fetch_array($query);

		if(mysqli_num_rows($query) > 0)
		{
			$faktur = $hasil['notransaksi'];
			$mail_body.= "No. Faktur: '$faktur' \n\n";
		}
			else
			{
				echo "<script>alert('Mohon maaf, Faktur pembelian tidak ditemukan');location.replace('cart.html')</script>";
			}

		// Menampilkan isi email invoice barang
		$mail_body.= "Barang pesanan Anda akan dikirimkan ke alamat di bawah ini sesudah Anda mentransfer dan konfirmasi kepada kami.\n\n";
		$mail_body.= "Nama Lengkap: $data[nama]\n\n";
		$mail_body.= "Email: $data[email]\n\n";
		$mail_body.= "Alamat Lengkap: $user[alamat], Kecamatan: $user[kecamatan], Kota: $user[kota], Provinsi: $user[provinsi], Kode Pos: $data[kopos]\n\n";
		$mail_body.= "No. HP: $data[telepon]\n\n";

		// Menampilkan detail order barang
		$cari 			= "SELECT * FROM transaksi_detail WHERE notransaksi = '$faktur' ";
		$query 			= mysqli_query($conn,$cari);
		
		while($row = mysqli_fetch_array($query))
		{
			$nama_produk 	= "$row[nama_produk]";
			$jumlah 			= "$row[jumlah]";
			$harga_diskon = "$row[harga_diskon]";
			$total 				= "$row[subtotal]";
			$berat 				= "$row[berat]";
			$jumlah_berat	= "$row[jumlah_berat]";

			$mail_body.= "Nama Barang: $nama_produk\n";
			$mail_body.= "Berat: Rp $berat\n";
			$mail_body.= "Jumlah: $jumlah unit\n";
			$mail_body.= "Jumlah Berat: Rp $jumlah_berat\n";
			$mail_body.= "Harga Satuan: Rp $harga_diskon\n";
			$mail_body.= "Sub Total: $total\n";
		}
		
		$cari2 = "SELECT sum(subtotal) AS total FROM transaksi_detail INNER JOIN produk ON produk.id_produk = transaksi_detail.id_produk 
							INNER JOIN transaksi ON transaksi.notransaksi = transaksi_detail.notransaksi 
							WHERE transaksi_detail.username='$sesen_username' AND transaksi.status ='0'";
		$hasil = mysqli_query($conn,$cari2);
		$data_total = mysqli_fetch_assoc($hasil);
		$mail_body.= "Grand Total : '$data_total[total]'\n";
		$mail_body.= "----------------------------------------------------------------------------------------------------------\n";

		$mail_body.= "Apabila terdapat kesalahan pada data diatas, harap menghubungi bagian customer service. Terima kasih telah berbelanja bersama kami.\n\n";
		$mail_body.= "Best regard,\n\n";
		$mail_body.= "Batre Shop";

		$proses = explode(",",$mail_to);

		reset($proses);
		foreach ($proses as $tujuan) 
		{
			$kirim = mail($tujuan,$mail_subject,$mail_body, "From: $data[email]");
		}
		if($kirim) 
		{
			$query = "UPDATE transaksi SET status = '1' WHERE username = '$member'";
			if(mysqli_query($conn, $query)) 
		  {
		  	header("location:$base_url"."keranjang_selesai.html");
		  } 
		  	else 
		  	{
		  		echo "Error updating record: " . mysqli_error($conn);
		  	}
		}
			else
			{
				echo "<script>alert('Mohon maaf, E-mail Anda belum terkirim. Harap ulangi kembali');location.replace('cart.html')</script>";
			}
	}
?>