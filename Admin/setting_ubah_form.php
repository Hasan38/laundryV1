<?php
$id_setting = mysqli_real_escape_string($conn,$_GET['id_setting']);
$sql        = "SELECT * FROM setting WHERE id_setting = '$id_setting' ";
$result     = mysqli_query($conn, $sql);
$data       = mysqli_fetch_array($result);
$tampil_isi = str_replace("<br>","\r\n",$data['isi_setting']);
?>

<form action="setting_ubah_proses.php" method="post">
  <div class="row">
    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-body">
          <input name="id_setting" type="hidden" id="id_setting" value="<?php echo $data['id_setting'] ?>">
          <div class="form-group"><label>Isi</label>
            <textarea rows="10" id="isi_setting" name="isi_setting"><?php echo "$tampil_isi" ?></textarea>
            <script type="text/javascript">var editor = CKEDITOR.replace('isi_setting');</script>
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