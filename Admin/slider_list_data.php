<div class="box">
  <div class="box-body table-responsive padding">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="text-align: center">No. Urut</th>
          <th style="text-align: center">Judul Slider</th>
          <th style="text-align: center">Foto</th>
          <th style="text-align: center">Tgl Upload</th>
          <th style="text-align: center">Active</th>
          <th style="text-align: center">Uploader</th>
          <th style="text-align: center">Aksi</th>
        </tr>
      </thead>
      <tbody>

      <?php
      $sql = "SELECT * FROM slider ORDER BY no_urut ASC";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0)
      {
        while ($data = mysqli_fetch_array($result))
        {
          echo "<tr>
                  <td style='text-align: center'>".$data['no_urut']."</td>
                  <td style='text-align: left'>".$data['judul_slider']."</td>
                  <td style='text-align: center'><img src='../images/slider/".$data['img']."' width='200px' height='100px'></td>
                  <td style='text-align: center'>".tgl_indo($data['tgl_upload'])."</td>
                  <td style='text-align: center'>".$data['active']."</td>
                  <td style='text-align: center'>".$data['uploader']."</td>
                  <td style='text-align: center'>
                    <a href='slider_ubah.php?id_slider=$data[id_slider]'>
                      <button type='submit' class='btn btn-primary'>Ubah</button>
                    </a>
                    <a href='slider_hapus.php?id_slider=$data[id_slider]'>
                      <button type='submit' class='btn btn-danger' OnClick=\"return confirm('Apakah Anda yakin?');\">Hapus</button>
                    </a>
                    <a href='slider_active.php?id_slider=$data[id_slider]'>
                      <button type='submit' class='btn btn-success'>Set Active</button>
                    </a>
                  </td>
                </tr>";
        }
      }
      else
      {
        echo "Belum ada data";
      }
    ?>
    </tbody>
  </table>
  </div>
</div>