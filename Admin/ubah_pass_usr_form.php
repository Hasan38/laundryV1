<form action="ubah_pass_usr_proses.php" method="post">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-body">
          <div class="form-group"><label>Nama User</label>
            <select name="nama" id="nama" class="form-control" required>
            <option value="">--Pilih Nama--</option>
              <?php
              $sql        = "SELECT * FROM user WHERE id_user > 0 ORDER BY id_user ASC";
              $result     = mysqli_query($conn, $sql);
              while($data = mysqli_fetch_array($result))
              {
                echo "<option value='$data[id_user]' required>$data[nama]</option>\n";
              }
              ?>
            </select>
          </div>
          <div class="form-group"><label>Password Baru</label>
            <input type="password" name="password" id="password" class="form-control" >
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
