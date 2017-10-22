<?php
$id_produk        = mysqli_real_escape_string($conn, $_GET['id_produk']);
$sql              = "SELECT * FROM produk WHERE id_produk = $id_produk ";
$result           = mysqli_query($conn, $sql);
$data             = mysqli_fetch_array($result);
$tampil_deskripsi = str_replace("<br>","\r\n",$data['deskripsi']);
?>
<form action="produk_ubah_proses.php" method="post" enctype="multipart/form-data">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-body">
          <input name="id_produk" type="hidden" id="id_produk" value="<?php echo $data['id_produk'] ?>">
          <div class="form-group"><label>Judul Produk</label>
            <input class="form-control" name="nama_produk" type="text" id="nama_produk" size="30" value="<?php echo $data['nama_produk'] ?>"/>
          </div>
          <div class="form-group"><label>SEO Deskripsi</label>
            <input class="form-control" name="seo_deskripsi" type="text" id="seo_deskripsi" value="<?php echo $data['seo_deskripsi'] ?>"/>
          </div>
          <div class="form-group"><label>SEO Keywords</label>
            <input class="form-control" name="seo_keywords" type="text" id="seo_keywords" value="<?php echo $data['seo_keywords'] ?>"/>
          </div>
          <div class="form-group"><label>Deskripsi Produk</label>
            <textarea rows="10" id="deskripsi" name="deskripsi"><?php echo "$tampil_deskripsi" ?></textarea>
          </div>
          <div class="row">
            <div class="col-xs-3"><label>Warna</label>
              <input class="form-control" name="warna" type="text" id="warna" size="30" placeholder="Huruf besar diawal lalu kecil" value="<?php echo $data['warna'] ?>" size="30"/>
            </div>
            <div class="col-xs-3"><label>Berat</label>
              <input class="form-control" name="berat" type="text" id="berat" size="30" placeholder="Isi dgn angka saja" value="<?php echo $data['berat'] ?>"/>
            </div>
            <div class="col-xs-3"><label>Stok</label>
              <input class="form-control" name="stok" type="text" id="stok" size="30" placeholder="Isi dgn angka saja" value="<?php echo $data['stok'] ?>"/>
            </div>
            <div class="col-xs-3"><label>Garansi</label>
              <input class="form-control" name="garansi" type="text" id="garansi" size="30" placeholder="Misal: 3 bulan" value="<?php echo $data['garansi'] ?>"/>
            </div>
          </div><br/>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
      <!-- left column -->
    </div>

    <!-- right column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-body">
          <div class="row">
            <input class="form-control" name="hd" type="hidden" id="c" size="30" onkeyup="hitung();" readonly/>
            <div class="col-xs-4"><label>Harga Awal</label>
              <input class="form-control" name="harga" type="text" id="b" size="30" placeholder="Isi angka saja" onkeyup="hitung();" value="<?php echo $data['harga'] ?>"/>
            </div>
            <div class="col-xs-4"><label>Diskon %</label>
              <input class="form-control" name="diskon" type="text" id="a" size="30" placeholder="Isi angka saja" onkeyup="hitung();" value="<?php echo $data['diskon'] ?>"/>
            </div>
            <div class="col-xs-4"><label>Harga Promo</label>
              <input class="form-control" name="harga_diskon" type="text" id="d" size="30" onkeyup="hitung();" readonly value="<?php echo $data['harga_diskon'] ?>"/>
            </div>
          </div><br/>
          <div class="row">
            <div class="col-xs-4"><label>Kategori</label>
              <br/>
              <select name="cmbkat" id="cmbkat" class="form-control" required>
              <option value="">--Pilih Kategori--</option>
                <?php
                $kat            = "SELECT * FROM kategori ORDER BY judul_kat ASC";
                $result         = mysqli_query($conn, $kat);
                while($datakat  = mysqli_fetch_array($result))
                {
                  echo "<option value='$datakat[id_kat]'".($data['kat']==$datakat['id_kat']?' selected':'').">$datakat[judul_kat]</option>\n";
                }
                ?>
              </select>
              <img src="<?php echo $base_url ?>images/loading.gif" width="18" id="imgLoad" style="display:none;" />
            </div>
            <div class="col-xs-4"><label>SubKategori</label>
              <select name="cmbsubkat" id="cmbsubkat" class="form-control">
                <option>--Pilih Kategori Terlebih Dahulu--</option>
                <?php
                $subkat           = "SELECT * FROM subkat ORDER BY judul_subkat ASC";
                $result           = mysqli_query($conn, $subkat);
                while($datasubkat = mysqli_fetch_array($result))
                {
                  echo "<option value='$datasubkat[id_subkat]'".($data['subkat']==$datasubkat['id_subkat']?' selected':'').">$datasubkat[judul_subkat]</option>\n";
                }
                ?>
              </select>
              <img src="../images/loading.gif" width="18" id="imgLoad" style="display:none;" />
            </div>
            <div class="col-xs-4"><label>SupersubKat</label>
              <select name="cmbsupersubkat" id="cmbsupersubkat" class="form-control">
                <option value="">--Pilih Sub Kategori Terlebih Dahulu--</option>
                <?php
                $supersubkat            = "SELECT * FROM supersubkat ORDER BY judul_supersubkat ASC";
                $result                 = mysqli_query($conn, $supersubkat);
                while($datasupersubkat  = mysqli_fetch_array($result))
                {
                  echo "<option value='$datasupersubkat[id_supersubkat]'".($data['supersubkat']==$datasupersubkat['id_supersubkat']?' selected':'').">$datasupersubkat[judul_supersubkat]</option>\n";
                }
                ?>
              </select>
              <img src="../images/loading.gif" width="18" id="imgLoad" style="display:none;" />
            </div>
          </div><br/>
          <div class="form-group"><label>Gambar Sebelumnya</label>
            <br/>
            <?php echo "<img src='../images/produk/".$data['img']."' width='150' height='150'>"; ?>
          </div>
          <div class="form-group"><label>Gambar Baru</label>
            <input type="file" name="img" id="img" onchange="tampilkanPreview(this,'preview')"/>
            <br><b>Preview Gambar</b><br>
            <img id="preview" src="" alt="" width="50%"/>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" name="submit" class="btn btn-success">Submit</button>
          <button type="reset" name="reset" class="btn btn-danger">Reset</button>
        </div>
      </div>
      <!-- right column -->
    </div>
  </div>
</form>

<?php 
include "../fungsi/imgpreview.php"; // Preview gambar yang akan diupload
include "../fungsi/tinymce.php";    // Editor teks Tinymce + Ajax File/ Photo Manager
?>