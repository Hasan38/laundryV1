<?php
// Skrip ini merupakan skrip untuk mengirim email dari form konfirmasi pembayaran yang dikirimkan oleh user
include 'config.php';
include 'phpmailer/PHPMailerAutoload.php';

// Jika tombol submit ditekan maka akan mulai proses pengiriman konfirmasi pembayaran ke email ADMIN
if(isset($_POST['submit']))
{
  $no_invoice     = mysqli_real_escape_string($conn,$_POST['no_invoice']);
  $nama_pengirim  = mysqli_real_escape_string($conn,$_POST['nama_pengirim']);
  $email          = mysqli_real_escape_string($conn,$_POST['email']);
  $transfer_ke    = mysqli_real_escape_string($conn,$_POST['transfer_ke']);
  $jml_transfer   = mysqli_real_escape_string($conn,$_POST['jml_transfer']);
  $tgl_transfer   = mysqli_real_escape_string($conn,$_POST['tgl_transfer']);
  $catatan        = mysqli_real_escape_string($conn,$_POST['catatan']);

  $mail = new PHPMailer;

  //$mail->SMTPDebug = 2;                                     // Enable verbose debug output

  $mail->isSMTP();                                            // Set mailer to use SMTP
  $mail->Host     = 'localhost';                            // Mengatur SMTP yg akan digunakan (yg ini pake gmail)
  $mail->SMTPAuth = true;                                     // Enable SMTP authentication

  $mail->Username = 'mail@toko.com';                      // SMTP username email penerima
  $mail->Password = 'password';                           // SMTP password email penerima
  $mail->Port     = 587;                                      // TCP port to connect to

  $mail->setFrom(' '.$email.' ');                             // Asal email pengirim
  $mail->addAddress('mail@toko.com', 'Email Website Toko');  // Email dan Nama Penerima Email
  $mail->addReplyTo(' '.$email.' ');                          // Set email yang akan dituju untuk dibalas dari penerima

  $mail->isHTML(true);                                        // Mengeset format email sebagai HTML

  $mail->Subject = 'Konfirmasi Pembayaran dari: '.$nama_pengirim.' ';
  $mail->Body    = 'No. Invoice: '.$no_invoice.' <br/><br/> 
                    Nama Pengirim: '.$nama_pengirim.' <br/><br/> 
                    Email pengirim: '.$email.' <br/><br/> 
                    Transfer Ke: '.$transfer_ke.' <br/><br/> 
                    Jumlah Transfer: '.$jml_transfer.' <br/><br/> 
                    Tanggal Transfer: '.$tgl_transfer.' <br/><br/> 
                    Catatan: '.$catatan.' ';
  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  // Jika pesan gagal dikirim, maka akan muncul alert: Pesan gagal terkirim, harap dicoba kembali
  if(!$mail->send()) 
  {
    echo "Pesan gagal terkirim, harap dicoba kembali";
  } 
    // Jika berhasil maka akan muncul alert: Pesan Anda berhasil terkirim
    else 
    {
      echo "<script>alert('Pesan Anda berhasil terkirim, terima kasih');history.go(-1)</script>";
    }
}
  // Peringatan apabila user tidak melalui proses yang seharusnya atau tembak langsung
  else
  {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombolnya!');history.go(-1)</script>";
  }
?>