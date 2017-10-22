<?php session_start();
include "../config.php";

  if(ISSET($_POST['submit']))
  {
    $nama      = $_POST['nama'];
    $username  = $_POST['username'];
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $usertype  = $_POST['usertype'];

    $cekdata   = "SELECT nama FROM usertbl WHERE nama = '$nama' ";
    $ada       = mysqli_query($conn, $cekdata);
    if(mysqli_num_rows($ada) > 0)
    { 
      echo "<script>alert('ERROR: Nama User telah terdaftar, silahkan pakai nama lain!');history.go(-1)</script>";
    }
      else
      {
        $allowed_ext  = array('jpg', 'png', 'gif');
        $file_name    = $_FILES['file']['name']; // File adalah name dari tombol input pada form
        $file_ext     = strtolower(end(explode('.', $file_name)));
        $file_size    = $_FILES['file']['size'];
        $file_tmp     = $_FILES['file']['tmp_name'];

        $lokasi       = '../images/user/'.$nama.'-'.$file_name;

        if(in_array($file_ext, $allowed_ext) === true)
        {
          if($file_size < 5242880) // Max Upload 5 MB | 1 MB = 1048576 KB
          {
            move_uploaded_file($file_tmp, $lokasi);

            // Proses insert data dari form ke db
            $sql = "INSERT INTO usertbl (nama,username,password,usertype,status,buatlog,file)
            VALUES ('$nama','$username','$password','$usertype','1',now(),'$lokasi')";

            if (mysqli_query($conn, $sql)) 
            {
              echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('user.php')</script>";
            } 
              else 
              {
                echo "Error updating record: " . mysqli_error($conn);
              }
          }
            else
            {
              echo "<script>alert('ERROR: Besar ukuran file (file size) maksimal 2 Mb!');history.go(-1)</script>";
            }
        } 
          else
          {
            echo "<script>alert('Jenis file tidak sesuai!');history.go(-1)</script>";
          }
      }
  }
    else
    {
      echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
    }

?>