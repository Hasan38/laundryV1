<div class="row">
  <div class="col-sm-9 col-sm-push-3">
    <div class="thumbnail">
      <div class="col-md-12">
        <h3><a href="#"><?php echo $produk['nama_produk']; ?></a></h3>
        <hr/>
      </div>
      <div class="col-md-4">
        <a href="<?php echo $base_url ?>images/produk/<?php echo $produk['img']; ?>" title="<?php echo $produk['nama_produk']; ?>" id="fancybox" class="thumbnail" data-fancybox-group="group1">
          <img class="img-responsive" src="<?php echo $base_url ?>images/produk/<?php echo $produk['img']; ?>" alt="<?php echo $produk['nama_produk']; ?>"/>
        </a>
      </div>
      <div class="caption-full">
        <b>Kategori</b>: <a href="<?php echo $base_url ?>kategori/<?php echo $produk['kategori_seo']; ?>"> <?php echo $produk['judul_supersubkategori']; ?></a><br/>
        <b>Berat</b>: <?php echo $produk['berat']; ?><br/>
        <b>Garansi</b>: <?php echo $produk['garansi']; ?><br/>
        <b>Warna</b>: <?php echo $produk['warna']; ?><br/>
        <b>Stok</b>: <?php echo $produk['stok']; ?><br/><br/>
        Harga Normal: <strike>Rp <?php echo $harga_normal ?></strike>
        <h4>
          <strong>
            <font color="red">HARGA PROMO: Rp <?php echo $harga_diskon ?>
            </font>
          </strong>
        </h4><br/>
        <a href="<?php echo $base_url ?>beli/<?php echo $produk['id_produk']; ?>">
          <button type="submit" name="submit" class="btn btn-primary">Beli</button>
        </a>
      </div>

      <br/><br/>
      
      <div class="caption-full">
        <b>Deskripsi</b>:<br/>
        <?php echo $produk['deskripsi']; ?>
      </div>
    </div>

    <h3>Produk Terkait</h3>
    <hr/>
    <?php include "related.php";?>

  </div>

  <?php include 'sidebar.php'; ?>
</div>