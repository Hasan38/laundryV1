<?php
include 'record/record_bseller.php';      include 'record/record_kategori.php';   include 'record/record_subkat.php';
include 'record/record_supersubkat.php';  include 'record/record_produk.php';     include 'record/record_resi.php';
include 'record/record_slider.php';       include 'record/record_testi_new.php';  include 'record/record_testi_acc.php';
include 'record/record_user.php';
// Super Admin Menu
if ($sesen_usertype == "superadmin")
{
  echo "
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-green'>
      <div class='inner'><h3> $bseller </h3><p>Best Seller</p></div>
      <div class='icon'><i class='fa fa-thumbs-up'></i></div>
      <a href='bseller_list.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-purple'>
      <div class='inner'><h3> $kategori </h3><p>Kategori</p></div>
      <div class='icon'><i class='fa fa-tag'></i></div>
      <a href='kategori_list.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-purple'>
      <div class='inner'><h3> $subkat </h3><p>Sub Kategori</p></div>
      <div class='icon'><i class='fa fa-tag'></i></div>
      <a href='subkat_list.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-purple'>
      <div class='inner'><h3> $supersubkat </h3><p>Supersub Kategori</p></div>
      <div class='icon'><i class='fa fa-tag'></i></div>
      <a href='supersubkat_list.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-red'>
      <div class='inner'><h3> $produk </h3><p>Produk</p></div>
      <div class='icon'><i class='fa fa-cart-plus'></i></div>
      <a href='produk_list.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-red'>
      <div class='inner'><h3> $resi </h3><p>Resi</p></div>
      <div class='icon'><i class='fa fa-plane'></i></div>
      <a href='resi_list.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-red'>
      <div class='inner'><h3> $slider </h3><p>Slider</p></div>
      <div class='icon'><i class='fa fa-credit-card'></i></div>
      <a href='slider_list.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-orange'>
      <div class='inner'><h3> $testinew </h3><p>Testimonial Baru</p></div>
      <div class='icon'><i class='fa fa-comment-o'></i></div>
      <a href='testi_new.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-orange'>
      <div class='inner'><h3> $testiacc </h3><p>Total Testimonial</p></div>
      <div class='icon'><i class='fa fa-comment-o'></i></div>
      <a href='testi_acc_list.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-olive'>
      <div class='inner'><h3> $user </h3><p>User</p></div>
      <div class='icon'><i class='fa fa-user'></i></div>
      <a href='user_list.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>";
}
elseif ($sesen_usertype == "admin")
{
  echo "
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-green'>
      <div class='inner'><h3> $bseller </h3><p>Best Seller</p></div>
      <div class='icon'><i class='fa fa-thumbs-up'></i></div>
      <a href='bseller_list.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-purple'>
      <div class='inner'><h3> $kategori </h3><p>Kategori</p></div>
      <div class='icon'><i class='fa fa-tag'></i></div>
      <a href='kategori_list.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-purple'>
      <div class='inner'><h3> $subkat </h3><p>Sub Kategori</p></div>
      <div class='icon'><i class='fa fa-tag'></i></div>
      <a href='subkat_list.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-purple'>
      <div class='inner'><h3> $supersubkat </h3><p>Supersub Kategori</p></div>
      <div class='icon'><i class='fa fa-tag'></i></div>
      <a href='supersubkat_list.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-red'>
      <div class='inner'><h3> $produk </h3><p>Produk</p></div>
      <div class='icon'><i class='fa fa-cart-plus'></i></div>
      <a href='produk_list.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-red'>
      <div class='inner'><h3> $resi </h3><p>Resi</p></div>
      <div class='icon'><i class='fa fa-plane'></i></div>
      <a href='resi_list.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-red'>
      <div class='inner'><h3> $slider </h3><p>Slider</p></div>
      <div class='icon'><i class='fa fa-credit-card'></i></div>
      <a href='slider_list.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-orange'>
      <div class='inner'><h3> $testinew </h3><p>Testimonial Baru</p></div>
      <div class='icon'><i class='fa fa-comment-o'></i></div>
      <a href='testi_new.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>
  <div class='col-lg-3 col-xs-6'>
    <div class='small-box bg-orange'>
      <div class='inner'><h3> $testiacc </h3><p>Total Testimonial</p></div>
      <div class='icon'><i class='fa fa-comment-o'></i></div>
      <a href='testi_acc_list.php' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
    </div>
  </div>";
}
?>