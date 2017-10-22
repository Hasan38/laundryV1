<div class="box">
  <div class="box-body table-responsive padding">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="text-align: center">No.</th>
          <th style="text-align: center">Nama</th>
          <th style="text-align: center">Isi</th>
          <th style="text-align: center">Jam</th>
          <th style="text-align: center">Tanggal</th>
          <th style="text-align: center">Aksi</th>
        </tr>
      </thead>
      <tbody>

      <?php
      $sql = "SELECT * FROM testimoni WHERE status = 2 ORDER BY id_testi ASC";
      $result = mysqli_query($conn, $sql);
      $no = 1;
      if (mysqli_num_rows($result) > 0)
      {
        while ($data = mysqli_fetch_array($result))
        {
          echo "<tr>
                  <td style='text-align: center'>".$no."</td>
                  <td style='text-align: left'>".$data['nama']."</td>
                  <td style='text-align: left'>".$data['isi']."</td>
                  <td style='text-align: center'>".$data['jam_upload']."</td>
                  <td style='text-align: center'>".tgl_indo($data['tgl_upload'])."</td>
                  <td style='text-align: center'>
                    <a href='testi_acc.php?id_testi=".$data['id_testi']."' '>
                      <button type='submit' class='btn btn-success'>Terima</button>
                    </a>
                    <a href='testi_hapus.php?id_testi=$data[id_testi]'>
                      <button type='submit' class='btn btn-danger' OnClick=\"return confirm('Apakah Anda yakin?');\">Hapus</button>
                    </a>
                  </td>
                </tr>";
                $no++;
        }
      }else{echo "Belum ada data";}
    ?>
    </tbody>
  </table>
  </div>
</div>