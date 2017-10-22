<div class="row text-center">
  <?php 
  $query  = "SELECT a.id_bs, a.no_urut, a.judul_bs, b.id_produk, c.nama_produk, d.img, e.judul_seo, f.harga, g.harga_diskon
            FROM bseller a
            LEFT JOIN produk b ON b.id_produk = a.judul_bs
            LEFT JOIN produk c ON c.id_produk = b.id_produk
            LEFT JOIN produk d ON d.img = c.img
            LEFT JOIN produk e ON e.judul_seo = d.judul_seo
            LEFT JOIN produk f ON f.id_produk = a.judul_bs
            LEFT JOIN produk g ON g.id_produk = a.judul_bs
            ORDER BY a.id_bs ASC";
	$hasil 	= mysqli_query($conn, $query);
	$numrows= mysqli_num_rows($hasil);
  if($numrows == 0){echo "Belum ada data";}
  else
  {
    while($data=mysqli_fetch_array($hasil))
    {
      $harga_normal = number_format($data['harga'], 0, ',', '.').",-";
      $harga_diskon = number_format($data['harga_diskon'], 0, ',', '.').",-";
  ?>
  <div class="col-md-3 col-sm-6 hero-feature">
    <div class="thumbnail">
      <a href="<?php echo $base_url ?>produk/<?php echo $data['judul_seo']; ?>.html" class="title">
        <h4><?php echo $data['nama_produk']; ?></h4>
      </a>
      <img alt="<?php echo $data['nama_produk']; ?>" src="<?php echo $base_url ?>images/produk/<?php echo $data['img']; ?>"/>
      <div class="caption">
        <h4><strike>Rp <?php echo $harga_normal ?></strike></h4>
        <h4><font color="red">Rp <?php echo $harga_diskon ?></font></h4>
        <a href="<?php echo $base_url ?>beli/<?php echo $data['id_produk']; ?>" class="btn btn-primary">Beli</a> 
        <a href="<?php echo $base_url ?>produk/<?php echo $data['judul_seo']; ?>.html" class="btn btn-default">Detail</a>
      </div>
    </div>
  </div>
  <?php } } ?>
</div>