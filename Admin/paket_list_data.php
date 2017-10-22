<div class="box">
  <div class="box-body table-responsive padding">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="text-align: center">No.</th>
          <th style="text-align: center">Nama Paket</th>
          <th style="text-align: center">Harga Per Kg/bulan</th>
          <th style="text-align: center">Aksi</th>
        </tr>
      </thead>
      <tbody>

      <?php
      $sql = "SELECT * FROM paket 
              ORDER BY idpaket ASC";
      $result = mysqli_query($conn, $sql);
      $no = 1;
      if (mysqli_num_rows($result) > 0)
      {
        while ($data = mysqli_fetch_array($result))
        {
          $harga_diskon  = number_format($data['harga_diskon'], 0, ',', '.');
          echo "
          <tr>
            <td valign='top' align='center'>".$no."</td>
            <td style='text-align: left'>".$data['namapaket']."</td>
            
            <td style='text-align: center'>$harga_diskon </td>
            <td style='text-align: center'>
              <a href='produk_ubah.php?id=$data[idpaket]' '>
                <button type='submit' class='btn btn-primary'>Ubah</button>
              </a>
              <a href='produk_hapus.php?id=$data[idpaket]'>
                <button type='submit' class='btn btn-danger' OnClick=\"return confirm('Apakah Anda yakin?');\">Hapus</button>
              </a>
            </td>
          </tr>";
          $no++;
        }
      }
      else {echo "Belum ada data";}
    ?>
    </tbody>
  </table>
  </div>
</div>