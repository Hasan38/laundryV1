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
$per_halaman = 4;

// Penempatan awal data yang ditampilkan dalam tiap halaman
if($halaman > 1) 
{
  $start = ($halaman * $per_halaman - $per_halaman);
}
  else
  {
    $start = 0;
  }

// Memanggil data dari tabel resi diurutkan dengan id_resi secara DESC dan dibatasi sesuai $start dan $per_halaman
$data     = mysqli_query($conn, "SELECT * FROM resi ORDER BY id_resi DESC LIMIT $start, $per_halaman");
$numrows  = mysqli_num_rows($data); 
?>

<?php
// Jika data ketemu, maka akan ditampilkan dengan while
if($numrows > 0)
{
  while($row = mysqli_fetch_assoc($data)) 
  {
    $tgl = tgl_indo($row['tgl']);
    $isi = $row['isi'];

    echo "
    <div class='col-md-8'>$tgl<br>
                    $isi<br/>
    </div>";
  }
  ?>


<?php
  // Menghitung Data pada tabel resi
  $count    = mysqli_query($conn, "SELECT * FROM resi ");
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
        echo "<li><a href='$base_url"."resi/halaman/".$x."/'>".$x."</a>";
      }
      echo "</li>";
  }
  echo "</ul></nav></div>";
}
  else
  {
    echo "<script>alert('Data tidak ditemukan');location.replace('$base_url')</script>";
  }
?>