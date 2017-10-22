<div class="box">
  <div class="box-body table-responsive padding">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="text-align: center">No.Invoice</th>
          <th style="text-align: center">Nama Pemesan</th>
          <th style="text-align: center">Alamat</th>
          <th style="text-align: center">No. Telpon</th>
          <th style="text-align: center">Aksi</th>
        </tr>
      </thead>
      <tbody>

      <?php
      $sql = "SELECT transaksi.notransaksi,transaksi.status,transaksi_detail.username,
      customer.nama,customer.telepon,customer.alamat
      FROM transaksi
      INNER JOIN transaksi_detail ON transaksi_detail.notransaksi = transaksi.notransaksi
      INNER JOIN customer ON transaksi_detail.username = customer.username
      WHERE transaksi.`status` = '1'
      GROUP BY transaksi.notransaksi";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0)
      {
        while ($data = mysqli_fetch_array($result))
        {
          echo "
          <tr>
            <td valign='top' align='center'>".$data['notransaksi']."</td>
            <td style='text-align: center'>".$data['nama']."</td>
            <td style='text-align: center'>".$data['alamat']."</td>
            <td style='text-align: center'>".$data['telepon']."</td>
            <td style='text-align: center'>
              <a href='pesanan_detail.php?notransaksi=$data[notransaksi]'><button type='submit' class='btn btn-success'>Selengkapnya</button></a> 
            </td>
          </tr>";
        }
      }
      else {echo "Belum ada data";}
    ?>
    </tbody>
  </table>
  </div>
</div>