<?php
if ($_GET['id_setting'] == 1) {echo "Nama Toko";}
elseif ($_GET['id_setting'] == 2) {echo "Alamat";}
elseif ($_GET['id_setting'] == 3) {echo "Bank";}
elseif ($_GET['id_setting'] == 4) {echo "Author";}
elseif ($_GET['id_setting'] == 5) {echo "Footer";}
else{echo "<script>alert('Maaf, data yang Anda cari tidak ditemukan');location.replace('home.php')</script>";}
?>