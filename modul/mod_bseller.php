<h3>Best Seller</h3>
<hr/>
<div align="center">
  <marquee direction="up" height="175" width="160" scrollamount="3" scrolldelay="1" onMouseOut="this.start()" onMouseOver="this.stop()">  
    <p align="center">
    <?php
    $sql    = "SELECT a.id_bs, a.no_urut, a.jam_upload, a.tgl_upload, a.uploader, 
              b.nama_produk AS judul_bs, c.img AS img, d.judul_seo AS judul_seo
              FROM bseller a
              LEFT JOIN produk b ON b.id_produk = a.judul_bs
              LEFT JOIN produk c ON c.img = b.img
              LEFT JOIN produk d ON d.id_produk = c.id_produk
              ORDER BY a.id_bs ASC";
    $result = mysqli_query($conn, $sql);
    $no = 1;
    if (mysqli_num_rows($result) > 0)
    {
      while ($data = mysqli_fetch_array($result)) // Ganti id_barang apabila ingin merubah menjadi seo url ke judul_seo
      {
        echo "<b><font face='arial' size='2' color=red'>".$data['no_urut']."</font></b>
              <a href='$base_url"."produk/".$data['judul_seo'].".html' class='info'>
                <br><font color='blue'>".$data['judul_bs']."</font><br>
                <img id='image' src='$base_url"."images/produk/".$data['img']." ' title='".$data['judul_bs']."' alt='".$data['judul_bs']."' style='width:150px; height:150px;' valign='top'/>
              </a>
              <br />
              <br />
              <br />
              ";
          $no++;
      }
    }
    else
    {
      echo "<div id='description'>Belum ada data.</div>";
    }
    ?>
    </p>
  </marquee>  
</div>