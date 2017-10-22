<h3>Kategori</h3>
<hr/>
<div class="list-group" style="overflow:auto;height:250px;padding:1px;margin:10px auto;border:1px solid #eee">
  <?php
  include "config.php";
  $sql = "SELECT * FROM kategori ORDER BY judul_kat ASC"; // Memanggil kategori/ top kategori
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0)
  {
    echo '<ul class="list-group">';
    while ($row = mysqli_fetch_assoc($result))
    {
      $id_kat = $row['id_kat'];
      $sql2 = "SELECT * FROM subkat WHERE id_kat='$id_kat'"; // Memanggil subkategori/ middle kategori
      $result2 = mysqli_query($conn, $sql2);
      echo '<li class="list-group-item"><b>'.$row['judul_kat'].'</b>';
        echo '<ul class="list-group">';
          while($row2 = mysqli_fetch_assoc($result2))
          {
            $id_subkat = $row2['id_subkat'];
            $sql3 = "SELECT * FROM supersubkat WHERE id_subkat ='$id_subkat'"; // Memanggil supersubkategori/ bottom kategori
            $result3 = mysqli_query($conn, $sql3);
            echo '<li class="list-group-item">'.$row2['judul_subkat'];
                echo '<ul class="list-group">';
                  while($row3 = mysqli_fetch_assoc($result3))
                  {
                    echo "<li class='list-group-item'><a href='$base_url"."kategori/$row3[kategori_seo]'>".$row3['judul_supersubkat']."</a></li>";
                  }
                echo '</ul>';
            echo '</li>';
          }
        echo '</ul>';
      echo '</li>';
    }
    echo '</ul>';
  }
  ?>
</div>