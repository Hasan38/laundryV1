<div class="title-menu">Testimonial</div>
<hr/>
<div style="overflow:auto;width:200px;height:250px;padding:1px;margin:10px auto;border:1px solid #eee">
<?php
$sql    = "SELECT * FROM testimoni ORDER BY id_testi DESC LIMIT 0,10 ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)
{
  while ($data = mysqli_fetch_array($result)) 
  {echo "<b>$data[nama]</b>, ".tgl_indo($data['tgl_upload'])."<br>$data[isi]<br><br>";}
}
else{echo "Belum ada data.";}
?>
<a href="<?php echo $base_url ?>testimoni.html">Selengkapnya</a>
</div>