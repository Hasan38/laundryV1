<div class="row text-center">
<?php
  while($row = mysqli_fetch_array($hasil1)) 
  {
    $harga_diskon = $row['harga_diskon'];
    $harga = $row['harga'];
?>

  <div class="col-md-4">
    <div class="thumbnail">
      <a href="<?php echo $base_url ?>produk/<?php echo $row['judul_seo']; ?>.html" class="title">
        <h4><?php echo $row['nama_produk']; ?></h4>
      </a>
      <img alt="<?php echo $row['nama_produk']; ?>" src="<?php echo $base_url ?>images/produk/<?php echo $row['img']; ?>"/>
      <div class="caption">
        <h4><strike><?php echo "Rp " .number_format($harga, 0, ',', '.').",-" ?></strike></h4>
        <h4><font color="red"><?php echo "Rp " .number_format($harga_diskon, 0, ',', '.').",-" ?></font></h4>
        <a href="<?php echo $base_url ?>beli/<?php echo $row['id_produk']; ?>" class="btn btn-primary">Beli</a> 
        <a href="<?php echo $base_url ?>produk/<?php echo $row['judul_seo']; ?>.html" class="btn btn-default">Detail</a>
      </div>
    </div>
  </div>
  
<?php } ?>
</div>