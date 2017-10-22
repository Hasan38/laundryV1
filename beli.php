<?php session_start(); 
include "config.php"; 
include "faktur.php"; 
include "fungsi/base_url.php"; 
include "fungsi/cek_login_public.php";
include "fungsi/cek_session_public.php";

$id_produk = mysqli_real_escape_string($conn,$_GET['id_produk']);

$cari_barang  = "SELECT * FROM produk WHERE id_produk = '$id_produk' ";
$hasil_barang = mysqli_query($conn, $cari_barang);
$data_barang  = mysqli_fetch_array($hasil_barang);

$nama_produk  = $data_barang['nama_produk'];
$berat        = $data_barang['berat'];
$harga_diskon = $data_barang['harga_diskon'];
$stok         = $data_barang['stok'];
  
if(mysqli_num_rows($hasil_barang) > 0)
{
  if($stok == 0)
  {
    echo "<script>alert('Mohon maaf, stok sedang kosong');location.replace('$base_url')</script>";      
  }
    else
    {
      $cari_transaksi   = "SELECT * FROM transaksi_detail WHERE username = '$sesen_username' 
                          AND id_produk = '$id_produk' AND notransaksi = '$faktur' ";
      $hasil_transaksi  = mysqli_query($conn,$cari_transaksi);
      $data_transaksi   = mysqli_fetch_array($hasil_transaksi);
      
      if(mysqli_num_rows($hasil_transaksi) == 0)
      {
        $query1 = "INSERT INTO transaksi_detail (notransaksi,
                                                username,
                                                id_produk,
                                                nama_produk,
                                                berat,
                                                harga_diskon,
                                                jumlah_berat,
                                                jumlah,
                                                subtotal)
                                        VALUES ('$faktur',
                                                '$sesen_username',
                                                '$id_produk',
                                                '$nama_produk',
                                                '$berat',
                                                '$harga_diskon',
                                                '$berat',
                                                '1',
                                                '$harga_diskon')";
        
        if(mysqli_query($conn, $query1)) 
        {
          header("location: $base_url"."keranjang.html");
        } 
          else 
          {
            echo "Error updating record: " . mysqli_error($conn);
          }
      }
        else
        {
          $jmllama          = $data_transaksi['jumlah'];
          $jmltambah        = $jmllama + 1;
          $subtotaltambah   = $jmltambah * $harga_diskon;

          $jmlberatlama     = $data_transaksi['berat'];
          $jmlberattambah   = $jmlberatlama * $jmltambah;
          
          $query = "UPDATE transaksi_detail SET jumlah        = '$jmltambah', 
                                                jumlah_berat  = '$jmlberattambah', 
                                                subtotal      = '$subtotaltambah' 
                                          WHERE notransaksi   = '$faktur' AND id_produk = '$id_produk'";
          
          if(mysqli_query($conn, $query)) 
          {
            header("location: $base_url"."keranjang.html");
          } 
            else 
            {
              echo "Error updating record: " . mysqli_error($conn);
            }
        }
    }
}
  else
  {
    echo "<script>alert('Barang yang ingin Anda beli tidak ada');location.replace('$base_url')</script>";
  }
?>