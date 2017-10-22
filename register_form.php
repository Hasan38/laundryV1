<form method="post" id="form-register" action="send.php">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body">
          <div class="row">
            <div class="col-xs-4"><label>Nama Lengkap</label>
              <input class="form-control" name="nama" type="text" id="nama" size="30" required/>
            </div>
            <div class="col-xs-4"><label>Username</label>
              <input class="form-control" name="username" type="text" id="username" size="30" required/>
            </div>
            <div class="col-xs-4"><label>No. Telepon</label>
              <input class="form-control" name="telepon" type="text" id="telepon" size="30" required/>
            </div>
          </div><br/>
          <div class="row">
            <div class="col-xs-6"><label>Email</label>
              <input class="form-control" name="email" type="text" id="email" size="30" required/>
            </div>
            <div class="col-xs-6"><label>Password</label>
              <input class="form-control" name="password" type="password" id="password" size="30" required/>
            </div>
          </div><br/>
          <div class="form-group"><label>Alamat</label>
            <textarea class="form-control" name="alamat" id="alamat" required></textarea>
          </div>
          <div class="form-group"><label>Provinsi</label>
            <select name="prov" id="prov" class="form-control" required>
            <option value="">--Pilih Provinsi--</option>
              <?php
              $prov = "SELECT * FROM prov ORDER BY nama_prov";
              $result = mysqli_query($conn, $prov);
              if (mysqli_num_rows($result) > 0)
              {
                while ($data = mysqli_fetch_array($result))
                {
                  echo "<option value='$data[id_prov]'>$data[nama_prov]</option>\n";
                }
              }
                else
                {
                  echo "Belum ada data";
                }
              ?>
            </select>
          </div>
          <div class="form-group"><label>Kabupaten/ Kota</label>
            <select name="kot" id="kot" class="form-control" required>
              <option value="">--Pilih Kabupaten/ Kota--</option>
            </select>
          </div>
          <div class="form-group"><label>Kecamatan</label>
            <select name="kec" id="kec" class="form-control" required>
             <option value="">--Pilih Kecamatan--</option>
            </select>
          </div>
          <div class="form-group"><label>Kode Pos</label>
            <input class="form-control" name="kopos" type="text" id="kopos" size="30"/>
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" name="submit" class="btn btn-success">Submit</button>
          <button type="reset" name="reset" class="btn btn-danger">Reset</button>
        </div>
      </div>
    </div>
  </div>
</form>