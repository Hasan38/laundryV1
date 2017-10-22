<?php
$id_bs  = mysqli_real_escape_string($conn, $_GET['id_bs']);
$sql    = "SELECT * FROM bseller WHERE id_bs = '$id_bs' ";
$result = mysqli_query($conn, $sql);
$data   = mysqli_fetch_array($result);
?>

<form action="bseller_ubah_proses.php" method="post">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-body">
          <input class="form-control" name="id_bs" type="hidden" id="id_bs" value="<?php echo $data['id_bs'] ?>" required/>
          <div class="form-group"><label>No. Urut</label>
            <input class="form-control" name="no_urut" type="text" id="no_urut" value="<?php echo $data['no_urut'] ?>" required/>
          </div>
          <div class="form-group"><label>Judul Produk</label>
            <select name="judul_bs" id="judul_bs" class="form-control">
              <option>--Pilih Nama Barang--</option>
                <?php
                $produk = "SELECT * FROM produk ORDER BY nama_produk ASC";
                $result = mysqli_query($conn, $produk);
                while ($dataproduk = mysqli_fetch_array($result)) 
                {
                  echo "<option value='$dataproduk[id_produk]'".($data['judul_bs']==$dataproduk['id_produk']?' selected':'').">$dataproduk[nama_produk]</option>\n";
                }
                ?>
            </select>
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" name="submit" class="btn btn-success">Submit</button>
          <button type="reset" name="reset" class="btn btn-danger">Reset</button>
        </div>
      </div><!-- /.box -->
      <!-- left column -->
    </div>
  </div>
</form>