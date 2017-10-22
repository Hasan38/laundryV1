<?php
$query  = "SELECT sum(jumlah_berat) AS totalberat FROM transaksi_detail 
          INNER JOIN produk ON produk.id_produk = transaksi_detail.id_produk
          INNER JOIN transaksi ON transaksi.notransaksi = transaksi_detail.notransaksi 
          WHERE transaksi.notransaksi = '$faktur' 
	          AND transaksi_detail.username = '$sesen_username' 
	          AND transaksi.status ='1'";
$hasil  = mysqli_query($conn,$query);
$data   = mysqli_fetch_assoc($hasil);
if(mysqli_num_rows($hasil) > 0)
{$berat_total =  ceil($data['totalberat']);}

$cek = "SELECT * FROM kabkot INNER JOIN customer on customer.kota = kabkot.id_kabkot
        WHERE customer.username = '$sesen_username' ";
$hasil  = mysqli_query($conn,$cek);
$data   = mysqli_fetch_array($hasil);

$ongkir = $data['jne_reg'];

$totalongkir = $berat_total * $ongkir;
echo " ".number_format($totalongkir, 0, ',', '.').",- ";
?>