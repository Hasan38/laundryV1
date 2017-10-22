<?php
  // batas threshold 75%
  $threshold = 75;
  // jumlah maksimum artikel terkait yg ditampilkan 10 buah
  $maksArtikel = 10;

  // array yang nantinya diisi judul artikel terkait
  $listArtikel = Array();

  // membaca judul artikel dari ID tertentu (ID artikel acuan)
  // judul ini nanti akan dicek kemiripannya dengan artikel yang lain
  $query = "SELECT nama_produk,harga,harga_diskon,img FROM produk WHERE judul_seo = '$id_produk'";
  $hasil = mysqli_query($conn,$query);
  $data  = mysqli_fetch_array($hasil);
  $nama_produk = $data['nama_produk'];

  // membaca semua data artikel selain ID artikel acuan
  $query = "SELECT id_produk, nama_produk, judul_seo, img FROM produk WHERE id_produk <> '$id_produk'";
  $hasil = mysqli_query($conn,$query);
  while ($data = mysqli_fetch_array($hasil))
  {
    // cek similaritas judul artikel acuan dengan judul artikel lainnya
    similar_text($nama_produk, $data['nama_produk'], $percent);
    if ($percent >= $threshold)
    {
      // jika prosentase kemiripan judul di atas threshold
      if (count($listArtikel) <= $maksArtikel)
      {
        // jika jumlah artikel belum sampai batas maksimum, tambahkan ke dalam array
        $listArtikel[] = 
        "<div class='col-md-4 col-sm-6'>
          <div class='thumbnail'>
            <a href='$base_url"."produk/$data[judul_seo].html' class='title'>
              <h4 align='center'>$data[nama_produk]</h4>
            </a>
            <img alt='$data[nama_produk]' src='$base_url"."images/produk/$data[img]'/>
            <div class='caption' align='center'>
              <a href='$base_url"."beli/$data[id_produk]' class='btn btn-primary'>Beli</a> 
              <a href='$base_url"."produk/$data[judul_seo].html' class='btn btn-default'>Detail</a>
            </div>
          </div>
        </div>";
      }
    }
  } 

  // jika array listartikel tidak kosong, tampilkan listnya
  // jika kosong, maka tampilkan 'tidak ada artikel terkait'
  if (count($listArtikel) > 0)
  { echo "<ul>";
    for ($i=0; $i<=count($listArtikel)-1; $i++)
    {echo $listArtikel[$i];}
    echo "</ul>";
  }
  else echo "<p>Tidak ada produk terkait</p>";
?>