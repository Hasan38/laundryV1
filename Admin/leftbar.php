<ul class="sidebar-menu">
  <li class="header">MENU UTAMA</li>
  <li class="active treeview">
    <a href="home.php">
      <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
  </li>
  <li class='treeview'>
    <a href='pesanan.php'><i class='fa fa-shopping-cart'></i><span> Pesanan Barang Baru</span></a>
  </li>
  <li class='treeview'>
    <a href='#'><i class='fa fa-thumbs-up'></i><span> Best Seller </span><i class='fa fa-angle-left pull-right'></i></a>
    <ul class='treeview-menu'>
      <li><a href='bseller_add.php'><i class='fa fa-circle-o'></i> Tambah Best Seller </a></li>
      <li><a href='bseller_list.php'><i class='fa fa-circle-o'></i> Data Best Seller </a></li>
    </ul>
  </li>

  
  <li class='treeview'>
    <a href='#'><i class='fa fa-truck'></i><span> Ongkir </span><i class='fa fa-angle-left pull-right'></i></a>
    <ul class='treeview-menu'>
      <li><a href='ongkir_list.php'><i class='fa fa-circle-o'></i> Data Ongkir </a></li>
    </ul>
  </li>
  <li class='treeview'>
    <a href='#'><i class='fa fa-cart-plus'></i><span> Paket </span><i class='fa fa-angle-left pull-right'></i></a>
    <ul class='treeview-menu'>
      <li><a href='paket_add.php'><i class='fa fa-circle-o'></i> Tambah Paket </a></li>
      <li><a href='paket_list.php'><i class='fa fa-circle-o'></i> Data Paket </a></li>
    </ul>
  </li>
  
  <li class='treeview'>
    <a href='#'><i class='fa fa-credit-card'></i><span> Slider </span><i class='fa fa-angle-left pull-right'></i></a>
    <ul class='treeview-menu'>
      <li><a href='slider_add.php'><i class='fa fa-circle-o'></i> Tambah Slider </a></li>
      <li><a href='slider_list.php'><i class='fa fa-circle-o'></i> Data Slider </a></li>
    </ul>
  </li>
  <li class='treeview'>
    <a href='#'><i class='fa fa-comments'></i><span> Testimonial </span><i class='fa fa-angle-left pull-right'></i></a>
    <ul class='treeview-menu'>
      <li><a href='testi_new.php'><i class='fa fa-circle-o'></i> Testi Baru </a></li>
      <li><a href='testi_acc_list.php'><i class='fa fa-circle-o'></i> Testi yang Diterima </a></li>
    </ul>
  </li>
  <li class='treeview'>
    <?php
    if ($sesen_usertype == "superadmin")
    {
      echo "
      <a href='#'><i class='fa fa-user'></i><span> User </span><i class='fa fa-angle-left pull-right'></i></a>
        <ul class='treeview-menu'>
          <li><a href='user_add.php'><i class='fa fa-circle-o'></i> Tambah User </a></li>
          <li><a href='user_list.php'><i class='fa fa-circle-o'></i> Data User </a></li>
        </ul>
      ";
    }
    ?>
  </li>
  <li class="header">PENGATURAN</li>
  <li class='treeview'>
    <a href='#'><i class='fa fa-cogs'></i><span> Halaman </span><i class='fa fa-angle-left pull-right'></i></a>
    <ul class='treeview-menu'>
      <?php
      $sql        = "SELECT * FROM navigasi ORDER BY judul ASC";
      $result     = mysqli_query($conn, $sql);
      while($data = mysqli_fetch_array($result)) 
      {
        $id_nav = $data['id_nav'];
        $judul  = $data['judul'];
        echo " <li><a href='navigasi.php?id_nav=$id_nav'><i class='fa fa-circle-o'></i>$judul</a></li>";
      }
      ?>
    </ul>
  </li>
  <li class='treeview'>
    <a href='#'><i class='fa fa-asterisk'></i><span> Password </span><i class='fa fa-angle-left pull-right'></i></a>
    <ul class='treeview-menu'>
      <li><a href='ubah_pass.php?username=<?php echo $sesen_username ?>'><i class='fa fa-circle-o'></i> Ubah Password Sendiri</a></li>
      <?php
      // Admin Menu
      if ($sesen_usertype == "superadmin")
      {echo "<li><a href='ubah_pass_usr.php'><i class='fa fa-circle-o'></i> Ubah Password User Lain </a></li>";}
      ?>
    </ul>
  </li>
  <li class='treeview'>
    <a href='#'><i class='fa fa-wrench'></i><span> Lainnya </span><i class='fa fa-angle-left pull-right'></i></a>
    <ul class='treeview-menu'>
      <?php
      $sql        = "SELECT * FROM setting ORDER BY judul_setting ASC";
      $result     = mysqli_query($conn, $sql);
      while($data = mysqli_fetch_array($result)) 
      {
        $id_setting     = $data['id_setting'];
        $judul_setting  = $data['judul_setting'];
        echo "<li><a href='setting.php?id_setting=$id_setting'><i class='fa fa-circle-o'></i>$judul_setting</a></li>";
      }
      ?>
    </ul>
  </li>  
  <li>
    <a href='logout.php'>
      <i class="fa fa-sign-out"></i> <span>Logout</span>
    </a>
  </li>
</ul>