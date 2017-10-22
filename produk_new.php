<div class="row text-center">
  <?php 
  $query   = "SELECT * FROM paket ORDER BY idpaket DESC LIMIT 0,8";
  $hasil   = mysqli_query($conn, $query);
  $numrows = mysqli_num_rows($hasil);
  if($numrows == 0)
  {
    echo "Belum ada data";
  }
  else
  {
    while($data = mysqli_fetch_array($hasil))
    {
      $harga_normal = number_format($data['harga'], 0, ',', '.').",-";
      $harga_diskon = number_format($data['harga_diskon'], 0, ',', '.').",-";
  ?>
      <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
          <a href="<?php echo $base_url ?>produk/<?php echo $data['judul_seo']; ?>.html" class="title">
            <h4><?php echo $data['namapaket']; ?></h4>
          </a>
          <img alt="<?php echo $data['namapaket']; ?>" src="<?php echo $base_url ?>images/produk/<?php echo $data['img']; ?>"/>
          <div class="caption">
            <h4><strike>Rp <?php echo $harga_normal ?></strike></h4>
            <h4><font color="red">Rp <?php echo $harga_diskon ?></font></h4>
            <a href="<?php echo $base_url ?>beli/<?php echo $data['idpaket']; ?>" class="btn btn-primary">Pilih Paket</a> 
            <a href="<?php echo $base_url ?>produk/<?php echo $data['judul_seo']; ?>.html" class="btn btn-default">Detail</a>
          </div>
        </div>
      </div>
<?php 
    } 
  } 
?>
</div>