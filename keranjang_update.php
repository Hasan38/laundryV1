<?php session_start(); 
include "config.php"; 
include "faktur.php"; 
include "fungsi/base_url.php"; 
include "fungsi/cek_session_public.php"; 
include "fungsi/cek_login_public.php"; 

$cek    = "SELECT * FROM transaksi WHERE username = '$sesen_username' AND status = '0' ";
$hasil  = mysqli_query($conn,$cek);
$data   = mysqli_fetch_array($hasil);

$n      = $_POST['n'];

if(isset($_POST['update']))
{
  if(mysqli_num_rows($hasil) == 0)
  {
    echo "<script>alert('Transaksi tidak ditemukan');location.replace('$base_url')</script>";
  }
    $faktur = $data['notransaksi'];

    for ($i=1; $i<=$n; $i++)
    {
      $id_produk  = $_POST['id'.$i];

      $cari2        = "SELECT * FROM produk WHERE id_produk = '$id_produk' ";
      $hasil2       = mysqli_query($conn,$cari2);
      $data2        = mysqli_fetch_array($hasil2);
      
      $harga_diskon = $data2['harga_diskon'];
      $stok         = $data2['stok'];

      if(mysqli_num_rows($hasil2) > 0)
      {
        $jmlubah  = $_POST['jumlah'.$i];
        $beratnew = $jmlubah * $data2['berat'];
        $totubah  = $jmlubah * $harga_diskon;

        if($jmlubah > $data2['stok'])
        {
          header("location:keranjang.html");
        }
          else
          {
            $query = "UPDATE transaksi_detail SET jumlah        = '$jmlubah', 
                                                  jumlah_berat  = '$beratnew', 
                                                  subtotal      = '$totubah' 
                                            WHERE notransaksi   = '$faktur' 
                                            AND   username      = '$sesen_username'
                                            AND   id_produk     = '$id_produk' ";
          
            if(mysqli_query($conn, $query)) 
            {
              header("location:keranjang.html");
            } 
            else 
            {
              echo "Error updating record: " . mysqli_error($conn);
            }
          }
      }
        else
        {
          echo "<script>alert('Barang yang ingin Anda beli tidak ditemukan');location.replace('index.html')</script>";
        }
    }
}
  else
  {
    echo "<script>alert('Gak boleh tembak langsung ya!');location.replace('keranjang.html')</script>";
  } 
?>