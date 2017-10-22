<?php
$jumData = $data['jumData'];

// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
$jumPage = ceil($jumData/$dataPerPage);

echo "<hr/><div class='page'>Halaman: <br>"; 

// menampilkan link previous/ sebelumnya
if ($noPage > 1) echo "<a href='".$_SERVER['PHP_SELF']."?page=".($noPage-1)."'>&lt;&lt; Prev</a>";

// memunculkan nomor halaman dan linknya
for($page = 1; $page <= $jumPage; $page++)
{
  $showPage = $page;
  if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) 
  {   
    if (($showPage == 1) && ($page != 2)) echo "..."; 
    if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
    if ($page == $noPage) echo " <b>".$page."</b> ";

    // Menampilkan tombol angka sebelum/sesudah, ex: 1,2,3,4...
    else echo " <a href='".$_SERVER['PHP_SELF']."?page=".$page."'>".$page."</a> ";
  }
}

// menampilkan link next
if ($noPage < $jumPage) echo "<a href='".$_SERVER['PHP_SELF']."?page=".($noPage+1)."'>Next &gt;&gt;</a>";
echo "</div>";
?>