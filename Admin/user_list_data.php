<div class="box">
  <div class="box-body table-responsive padding">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="text-align: center">No.</th>
          <th style="text-align: center">Nama</th>
          <th style="text-align: center">Username</th>
          <th style="text-align: center">Tipe User</th>
          <th style="text-align: center">Jam Buat</th>
          <th style="text-align: center">Tgl Buat</th>
          <th style="text-align: center">Aksi</th>
        </tr>
      </thead>
      <tbody>

      <?php
      $sql = "SELECT * FROM user WHERE id_user > 0 ORDER BY id_user ASC";
      $result = mysqli_query($conn, $sql);
      $no = 1;
      if (mysqli_num_rows($result) > 0)
      {
        while ($data = mysqli_fetch_array($result))
        {
          echo "<tr>
                  <td style='text-align: center'>".$no."</td>
                  <td style='text-align: left'>".$data['nama']."</td>
                  <td style='text-align: center'>".$data['username']."</td>
                  <td style='text-align: center'>".$data['usertype']."</td>
                  <td style='text-align: center'>".$data['jam_upload']."</td>
                  <td style='text-align: center'>".tgl_indo($data['tgl_upload'])."</td>
                  <td style='text-align: center'>
                    <a href='user_ubah.php?id_user=".$data['id_user']."' '>
                      <button type='submit' class='btn btn-primary'>Ubah</button>
                    </a>
                    <a href='user_hapus.php?id_user=".$data['id_user']."' '>
                      <button type='submit' class='btn btn-danger' OnClick=\"return confirm('Apakah Anda yakin?');\">Hapus</button>
                    </a>
                  </td>
                </tr>";
                $no++;
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