<?php session_start();
include 'config.php';
include 'fungsi/base_url.php';

if(isset($_POST['submit']))
{
  $errors     = array();
  $username   = mysqli_real_escape_string($conn, $_POST['username']);
  $pass       = mysqli_real_escape_string($conn, $_POST['password']);

  if (empty($username) && empty($pass)) 
  {
    echo "<script language='javascript'>alert('Isikan USERNAME dan PASSWORD'); history.go(-1)</script>";
  }
  elseif (empty($username))
  {
    echo "<script language='javascript'>alert('Isikan USERNAME'); history.go(-1)</script>";
  }
  elseif (empty($pass)) 
  {
    echo "<script language='javascript'>alert('Isikan PASSWORD'); history.go(-1)</script>";
  }
  
  $sql    = "SELECT * FROM customer WHERE username = '$username' ";
  $result = mysqli_query($conn, $sql);
  $data   = mysqli_fetch_array($result);
  
  if (mysqli_num_rows($result) == 0)
  {
  	echo "<script>alert('Username yang Anda masukkan tidak terdaftar!');history.go(-1)</script>";
  }
  elseif($data['status'] == 0)
  {
  	echo "<script>alert('Akun Anda belum diverifikasi, silahkan verifikasi via email dahulu!');history.go(-1)</script>";
	}
		else
		{
	    if(password_verify($pass, $data['password']))
	    {
	      if(empty($errors))
	      {
	        $_SESSION['id_customer']= $data['id_customer'];
	        $_SESSION['username']   = $data['username'];
	        $_SESSION['nama']       = $data['nama'];
	        $_SESSION['kecamatan']  = $data['kecamatan'];
	        $_SESSION['kota']       = $data['kota'];
	        $_SESSION['provinsi']   = $data['provinsi'];
	        
	        echo "<script language='javascript'>alert('Anda berhasil Login'); location.replace('$base_url')</script>";
	      } 
	    }
	      else
	      {
	        echo "<script>alert('PASSWORD SALAH!');history.go(-1)</script>";
	      }
	  }
}
  else
  {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombolnya!');location.replace('$base_url')</script>";
  } 
?>