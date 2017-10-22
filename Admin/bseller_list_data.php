<div class="box">
  <div class="box-body table-responsive padding">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="text-align: center">No.</th>
          <th style="text-align: center">Nomor Urut</th>
          <th style="text-align: center">Judul Barang</th>
          <th style="text-align: center">Upload</th>
          <th style="text-align: center">Aksi</th>
        </tr>
      </thead>
      <tbody>

      <?php
      $sql = "SELECT a.id_bs,a.no_urut,a.jam_upload,a.tgl_upload,a.uploader,
      b.nama_produk as judul_bs FROM bseller 
      a LEFT JOIN produk 
      b on b.id_produk = a.judul_bs ORDER BY a.id_bs ASC";
      $result = mysqli_query($conn, $sql);
      $no = 1;
      if (mysqli_num_rows($result) > 0)
      {
        while ($data = mysqli_fetch_array($result))
        {
          echo "
          <tr>
            <td valign='top' align='center'>".$no."</td>
            <td style='text-align: center'>".$data['no_urut']."</td>
            <td style='text-align: left'>".$data['judul_bs']."</td>
            <td style='text-align: center'>".$data['jam_upload'].", ".tgl_indo($data['tgl_upload']).", ".$data['uploader']."</td>
            <td style='text-align: center'>
              <a href='bseller_ubah.php?id_bs=".$data['id_bs']."' '>
                <button type='submit' class='btn btn-primary'>Ubah</button>
              </a>
              <a href='bseller_hapus.php?id_bs=$data[id_bs]'>
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