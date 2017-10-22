<?php
if($_SESSION['usertype'] == 'superadmin') // Super Admin dengan unitkerja apapun bisa masuk
{}
elseif($_SESSION['usertype'] == 'admin') // Admin bisa masuk
{
	if($_SESSION['unitkerja'] != '01013') // Hanya unitkerja Perencanaan yang bisa masuk
	{
		echo "<script>alert('Anda tidak berhak masuk ke halaman ini, harap login menjadi Admin Perencanaan terlebih dahulu');location.replace('index.php')</script>";
		session_destroy();
	}
}
	else // User tidak bisa masuk
	{
		echo "<script>alert('Anda tidak berhak masuk ke halaman ini, harap login menjadi Admin Perencanaan terlebih dahulu');location.replace('index.php')</script>";
		session_destroy();
	}
?>