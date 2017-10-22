<?php
include 'config.php';
include 'fungsi/base_url.php';

$email  = mysqli_escape_string($conn,$_GET['email']);
$hash   = mysqli_escape_string($conn,$_GET['hash']);

if(isset($email) && isset($hash))
{  
  $sql = mysqli_query($conn,"SELECT * FROM customer WHERE email = '$email' AND hash = '$hash' ");
  $array = mysqli_fetch_array($sql);

  if(mysqli_num_rows($sql) > 0)
  {
    $aktiv = "UPDATE customer SET status = 1 WHERE email = '$email' ";
    
    if(mysqli_query($conn, $aktiv)) 
    {
      echo "<script>alert('Proses Aktivasi berhasil, Anda sekarang bisa Login.');location.replace('$base_url')</script>";
    } 
      else 
      {
        echo "<script>alert('Mohon maaf, aktivasi akun tidak berhasil.');location.replace('$base_url')</script>";
      }
  } 
  
  else 
  {
    echo "<script>alert('Akun Anda tidak ditemukan.');location.replace('$base_url')</script>";
  }    
}
?>