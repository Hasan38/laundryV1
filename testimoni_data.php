<?php 
// Mengambil nilai berdasarkan halaman dengan metode GET
if(isset($_GET['halaman']))
{
  $halaman = mysqli_real_escape_string($conn,$_GET['halaman']);
}
  else 
  {
    $halaman = 1;
  }

// Limit/ batas data yang ditampilkan per halaman
$per_halaman = 12;

// Penempatan awal data yang ditampilkan dalam tiap halaman
if($halaman > 1) 
{
  $start = ($halaman * $per_halaman - $per_halaman);
}
  else
  {
    $start = 0;
  }

// Memanggil data dari tabel produk diurutkan dengan id_testi secara DESC dan dibatasi sesuai $start dan $per_halaman
$data     = mysqli_query($conn, "SELECT * FROM testimoni WHERE status = 1 ORDER BY id_testi DESC LIMIT $start, $per_halaman");
$numrows  = mysqli_num_rows($data); 
?>

<?php
// Jika data ketemu, maka akan ditampilkan dengan while
if($numrows > 0)
{
  while($row = mysqli_fetch_assoc($data)) 
  {
    $tgl_upload = tgl_indo($row['tgl_upload']);
    $isi        = $row['isi'];

    echo "
    <div class='col-md-8'><b>$row[nama]</b>, $tgl_upload<br>
                          $isi<br><br>
    </div>";
  }
}
  else
  {
    echo "Belum ada data";
  }
?>

<?php
  // Menghitung data pada tabel testimoni
  $count    = mysqli_query($conn, "SELECT * FROM testimoni ");
  $total    = mysqli_num_rows($count);
  
  // Membuat variabel halamans dari hasil pembagian $total dan per_halaman menggunakan ceil (penggenapan koma keatas)
  $halamans = ceil($total / $per_halaman);

  echo "<div class='col-md-12'><h4 align='center'>Halaman: </h4>";
  echo "<nav align='center'><ul class='pagination'>";
  
  // Melakukan pengulangan penampilan nomor paging
  for($x = 1; $x <= $halamans; $x++) 
  {
    // Apabila berada di suatu halaman
    if($halaman == $x) 
    {
      // Maka akan membuat angka di tombol paging menjadi cetak tebal dan tidak bisa diklik
      echo "<li><a href='#'><b>$x</b></a>";
    }
      else 
      {
        // Jika tidak akan seperti biasa dan dapat diklik
        echo "<li><a href='$base_url"."testimoni/halaman/".$x."/'>".$x."</a>";
      }
      echo "</li>";
  }
  echo "</ul></nav></div>";
?>