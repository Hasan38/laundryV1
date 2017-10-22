<?php
$id_slider  = mysqli_real_escape_string($conn,$_GET['id_slider']);
$sql        = "SELECT * FROM slider WHERE id_slider = '$id_slider' ";
$result     = mysqli_query($conn, $sql);
$data       = mysqli_fetch_array($result);
?>

<form action="slider_ubah_proses.php" method="post" enctype="multipart/form-data">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-body">
          <input name="id_slider" type="hidden" id="id_slider" value="<?php echo $data['id_slider'] ?>">
          <div class="form-group"><label>No. Urut</label>
            <input class="form-control" name="no_urut" type="text" id="no_urut" size="30" value="<?php echo $data['no_urut'] ?>" required/>
          </div>
          <div class="form-group"><label>Judul Slider</label>
            <input class="form-control" name="judul_slider" type="text" id="judul_slider" size="30" value="<?php echo $data['judul_slider'] ?>" required/>
          </div>
          <div class="form-group"><label>Link</label>
            <input class="form-control" name="link" type="text" id="link" size="30" value="<?php echo $data['link'] ?>" required/>
          </div>
          <div class="form-group"><label>Gambar Sebelumnya</label>
            <br/>
            <img src="../images/slider/<?php echo $data['img'] ?> " width="75%" height="75%" />
          </div>
          <div class="form-group"><label>Gambar Baru</label>
            <input type="file" name="img" id="img" onchange="tampilkanPreview(this,'preview')"/>
            <br><b>Preview Gambar</b><br>
            <img id="preview" src="" alt="" width="50%"/>
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

<?php 
include "../fungsi/imgpreview.php"; // Preview gambar yang akan diupload
?>