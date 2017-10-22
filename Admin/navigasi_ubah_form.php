<?php
$id_nav     = mysqli_real_escape_string($conn,$_GET['id_nav']);
$sql        = "SELECT * FROM navigasi WHERE id_nav = '$id_nav' ";
$result     = mysqli_query($conn, $sql);
$data       = mysqli_fetch_array($result);
$tampil_isi = str_replace("<br>","\r\n",$data['isi']);
?>

<form action="navigasi_ubah_proses.php" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-body">
          <input name="id_nav" type="hidden" id="id_nav" value="<?php echo $data['id_nav'] ?>">
          <div class="form-group"><label>SEO Deskripsi</label>
            <input type="text" class="form-control" name="seo_deskripsi" id="seo_deskripsi" value="<?php echo $data['seo_deskripsi'] ?>" placeholder="Isilah deskripsi halaman <?php include 'navigasi_judul.php'; ?>">
          </div>
          <div class="form-group"><label>SEO Keywords</label>
            <input type="text" class="form-control" name="seo_keywords" id="seo_keywords" value="<?php echo $data['seo_keywords'] ?>" placeholder="Isilah dengan huruf kecil semua">
          </div>
          <div class="form-group"><label>Isi</label>
            <textarea rows="10" id="isi" name="isi"><?php echo "$tampil_isi" ?></textarea>
            <script type="text/javascript">var editor = CKEDITOR.replace('isi');</script>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" name="submit" class="btn btn-success">Submit</button>
          <button type="reset" name="reset" class="btn btn-danger">Reset</button>
        </div>
      </div>
    </div>
  </div>
</form>

<?php include '../fungsi/tinymce.php'; ?>