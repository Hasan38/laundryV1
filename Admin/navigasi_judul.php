<?php
if ($_GET['id_nav'] == 1) {
  echo "Home";
}
elseif ($_GET['id_nav'] == 2) {
  echo "Cara Order";
}
elseif ($_GET['id_nav'] == 3) {
  echo "Ketentuan";
}
elseif ($_GET['id_nav'] == 4) {
  echo "Kontak";
}
elseif ($_GET['id_nav'] == 5) {
  echo "Profil";
}
elseif ($_GET['id_nav'] == 6) {
  echo "Katalog Produk";
}
elseif ($_GET['id_nav'] == 7) {
  echo "Keranjang Belanja";
}
elseif ($_GET['id_nav'] == 8) {
  echo "Resi Pengiriman";
}
elseif ($_GET['id_nav'] == 9) {
  echo "Testimoni";
}
elseif ($_GET['id_nav'] == 10) {
  echo "Register/ Login";
}
else {
  echo "<script>alert('Maaf, data yang Anda cari tidak ditemukan');location.replace('home.php')</script>";
}
?>
