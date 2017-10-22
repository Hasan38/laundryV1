<div class="box">
  <div class="box-body table-responsive padding">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="text-align: center">No.</th>
          <th style="text-align: center">Nama Kelurahan</th>
          <th style="text-align: center">Nama Kecamatan</th>
          <th style="text-align: center">Ongkir REG JNE</th>
          <th style="text-align: center">Aksi</th>
        </tr>
      </thead>
      <tbody>

      <?php
      $sql  = "SELECT kelurahan.idkelurahan, kelurahan.namakelurahan, kelurahan.idkecamatan, kelurahan.ongkir, kecamatan.idkecamatan, kecamatan.namakecamatan
              FROM kelurahan
              INNER JOIN kecamatan ON kelurahan.idkecamatan = kecamatan.idkecamatan
              ORDER BY namakelurahan ASC ";
      $result = mysqli_query($conn, $sql);
      $no = 1;
      if (mysqli_num_rows($result) > 0)
      {
        while ($data = mysqli_fetch_array($result))
        {
          echo "
          <tr>
            <td valign='top' align='center'>".$no."</td>
            <td style='text-align: left'>".$data['namakelurahan']."</td>
            <td style='text-align: center'>".$data['namakecamatan']."</td>
            <td style='text-align: center'>".$data['ongkir']."</td>
            <td style='text-align: center'>
              <a href='ongkir_ubah.php?id=$data[idkelurahan]'>
                <button type='submit' class='btn btn-primary'>Ubah</button>
              </a>
              
            </td>
          </tr>";
          $no++;
        }
      }
      else{echo "Belum ada data";}
      ?>
    </tbody>
  </table>
  </div>
</div>