<form action="bseller_add_proses.php" method="post">
  <div class="row">
    <!-- Kolom Kiri -->
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-body">
          <div class="form-group"><label>No. Urut</label>
            <input class="form-control" name="no_urut" type="text" id="no_urut" required/>
          </div>
          <div class="form-group"><label>Judul Produk</label>
            <select name="judul_bs" id="judul_bs" class="form-control">
              <option>--Pilih Nama Barang--</option>
                <?php
                $sql = "SELECT * FROM produk ORDER BY nama_produk ASC";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0)
                {
                  while ($data = mysqli_fetch_array($result)) 
                  {
                    echo "<option value='$data[id_produk]'>$data[nama_produk]</option>\n";
                  }
                }
                  else
                  {
                    echo "Belum ada data.";
                  }
                ?>
            </select>
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