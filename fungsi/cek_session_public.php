<?php
if(isset($_SESSION['username']))
{
  $sesen_id         = $_SESSION['id_customer'];
  $sesen_username   = $_SESSION['username'];
  $sesen_nama       = $_SESSION['nama'];
  $sesen_kecamatan  = $_SESSION['kecamatan'];
  $sesen_kota       = $_SESSION['kota'];
  $sesen_provinsi   = $_SESSION['provinsi'];
}
?>