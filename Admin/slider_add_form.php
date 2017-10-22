<form action="slider_add_proses.php" method="post" enctype="multipart/form-data">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-body">
          <div class="form-group"><label>No. Urut</label>
            <input class="form-control" name="no_urut" type="text" id="no_urut" size="30" placeholder="Huruf besar diawal lalu kecil"/>
          </div>
          <div class="form-group"><label>Judul Slider</label>
            <input class="form-control" name="judul_slider" type="text" id="judul_slider" size="30" placeholder="Huruf besar diawal lalu kecil"/>
          </div>
          <div class="form-group"><label>Link</label>
            <input class="form-control" name="link" type="text" id="link" size="30" placeholder="Ex: http://www.google.com"/>
          </div>
          <div class="form-group"><label>Gambar Slider</label><br/>
            <input type="file" name="img" id="img" onchange="tampilkanPreview(this,'preview')" required/>
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