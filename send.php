<?php
include 'config.php';
include 'fungsi/base_url.php';

if(isset($_POST['submit']))
{
  $nama       = mysqli_real_escape_string($conn,$_POST['nama']);
  $username   = mysqli_real_escape_string($conn,$_POST['username']);
  $email      = mysqli_real_escape_string($conn,$_POST['email']);
  $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $telepon    = mysqli_real_escape_string($conn,$_POST['telepon']);
  $alamat     = mysqli_real_escape_string($conn,$_POST['alamat']);
  $kopos      = mysqli_real_escape_string($conn,$_POST['kopos']);
  $prov       = mysqli_real_escape_string($conn,$_POST['prov']);
  $kot        = mysqli_real_escape_string($conn,$_POST['kot']);
  $kec        = mysqli_real_escape_string($conn,$_POST['kec']);

  $sql        = "SELECT * FROM customer WHERE email = '$email' and status = 1 ";
  $cek_email  = mysqli_query($conn,$sql);
  if(empty($nama))
  {
    echo "<script>alert('Nama harus diisi!');history.go(-1)</script>";
  }
  elseif(empty($username))
  {
    echo "<script>alert('Username harus diisi!');history.go(-1)</script>";
  }
  elseif(empty($email))
  {
    echo "<script>alert('email harus diisi!');history.go(-1)</script>";
  }
  elseif(empty($password))
  {
    echo "<script>alert('password harus diisi!');history.go(-1)</script>";
  }
  elseif(empty($telepon))
  {
    echo "<script>alert('telepon harus diisi!');history.go(-1)</script>";
  }
  elseif(mysqli_num_rows($cek_email) > 0)
  {
    // Alert/ pemberitahuan email yang dipakai telah ada/ tidak
    echo "<script>alert('Email telah terpakai, silahkan gunakan email yang lain!');history.go(-1)</script>";
  }
    else
    {      
      // Membuat kode unik untuk aktivasi akun dengan format md5
      $hash = md5(uniqid(rand(), true)); 
      
      // Subject: Judul pada email penerima
      $subject  = 'Aktivasi akun Anda di namatoko.com';
      
      // Headers: Email pengirim, veri mime, dan jenis halaman
      $headers  = "From: register@namatoko.com \r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
      
      // url: Membuat teks yang apabila di klik oleh user, maka akan masuk ke halaman aktivasi akun pada website
      $url      = $base_url.'activation.php?email='.urlencode($email)."&hash=$hash";

      // message: Isi pesan dari email
      $message  = "<p>Silahkan klik tombol dibawah ini untuk mengaktifkan akun Anda di namatoko.com</p>";
      $message .= "<table cellspacing='0' cellpadding='0'> <tr>";
      $message .= "<td align='center' width='300' height='40' bgcolor='#000091' style='-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;
                  color: #ffffff; display: block;'>";

      $message .= "<a href='".$url."' style='color: #ffffff; font-size:16px; font-weight: bold; font-family: Helvetica, Arial, sans-serif; text-decoration: none;
                  line-height:40px; width:100%; display:inline-block'>KLIK DISINI</a>";
      
      $message .= "</td></tr></table>";

      // Menjalankan fungsi mail dari php
      mail($email, $subject, $message, $headers);

      // Proses insert data customer
      $create = "INSERT INTO customer ( nama,
                                        username,
                                        email,
                                        password,
                                        telepon,
                                        alamat,
                                        kopos,
                                        provinsi,
                                        kota,
                                        kecamatan,
                                        hash,
                                        status) 
                                VALUES ('$nama',
                                        '$username',
                                        '$email',
                                        '$password',
                                        '$telepon',
                                        '$alamat',
                                        '$kopos',
                                        '$prov',
                                        '$kot',
                                        '$kec',
                                        '$hash',
                                        '0')";

      if (mysqli_query($conn, $create)) 
      {
        echo "<script>alert('Registrasi berhasil! Silahkan cek email Anda untuk verifikasi');location.replace('$base_url')</script>";
      } 
      else 
      {
        echo "Error updating record: " . mysqli_error($conn);
      }
    }
}
?>