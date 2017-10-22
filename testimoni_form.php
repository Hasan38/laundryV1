<form method="post" id="form-register" action="capcay_cek.php">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-body">
          <div class="form-group"><label>Komentar</label>
            <textarea class="form-control" name="isi" id="isi" required></textarea>
          </div>
          <div class="form-group">
            <form method="POST" action="capcay_cek.php">
              <div class="col-md-3">
                <img src="capcay_random.php" width="40" height="40"><br/><br/>
              </div>
              <br/><br/>
              <input type="text" class="form-control" name="check" placeholder="Isikan angka diatas di form ini" required>
            </form>
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" name="submit" class="btn btn-success">Kirim</button>
          <button type="reset" name="reset" class="btn btn-danger">Reset</button>
        </div>
      </div><!-- /.box -->
      <!-- left column -->
    </div>
  </div>
</form>