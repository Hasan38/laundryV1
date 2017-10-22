
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" >
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo $base_url ?>"><?php echo $namatoko ?></a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <span class='glyphicon glyphicon-search' aria-hidden='true'></span> Cari<span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
          <li>
            <form method="POST" class="navbar-form navbar-left" action="<?php echo $base_url ?>search">
              <div class="form-group">
                <input name="searchterm" type="text" class="form-control" placeholder="Cari Barang...">
              </div>
            </form>
            </li>
          </ul>
        </li>
        <li>
          <a href='<?php echo $base_url ?>index.html'>
            <span class='glyphicon glyphicon-home' aria-hidden='true'></span> Home
          </a>
        </li>
        <li>
          <a href='<?php echo $base_url ?>katalog.html'>
            <span class='glyphicon glyphicon-book' aria-hidden='true'></span> Katalog
          </a>
        </li>
        <li>
          <a href='<?php echo $base_url ?>keranjang.html'>
            <span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span> Keranjang
          </a>
        </li>
			  <li>
          <a href='<?php echo $base_url ?>resi.html'>
            <span class='glyphicon glyphicon-plane' aria-hidden='true'></span> Resi
          </a>
        </li>
        <li>
          <a href='<?php echo $base_url ?>testimoni.html'>
            <span class='glyphicon glyphicon-comment' aria-hidden='true'></span> Testimoni
          </a>
        </li>
        <li>
          <a href='<?php echo $base_url ?>konfirmasi.html'>
            <span class='glyphicon glyphicon-bullhorn' aria-hidden='true'></span> Konfirmasi
          </a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <span class='glyphicon glyphicon-blackboard' aria-hidden='true'></span> Tentang Kami<span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href='<?php echo $base_url ?>page/cara_order.html'>
                <span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span> Cara Order
              </a>
            </li>
            <li>
              <a href='<?php echo $base_url ?>page/ketentuan.html'>
                <span class='glyphicon glyphicon-flag' aria-hidden='true'></span> Ketentuan Belanja
              </a>
            </li>
            <li>
              <a href='<?php echo $base_url ?>page/kontak.html'>
                <span class='glyphicon glyphicon-phone' aria-hidden='true'></span> Kontak
              </a>
            </li>
            <li>
              <a href='<?php echo $base_url ?>page/profil.html'>
                <span class='glyphicon glyphicon-user' aria-hidden='true'></span> Profil
              </a>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <?php 
      if(isset($_SESSION['username']))
      {
        echo "
        <li class='dropdown'>
          <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
            <span class='glyphicon glyphicon-user' aria-hidden='true'></span> Hai, ".$sesen_username." <span class='caret'></span>
          </a>
          <ul class='dropdown-menu'>
            <li>
              <a href='$base_url"."logout'>
                <span class='glyphicon glyphicon-log-out' aria-hidden='true'></span> Logout
              </a>
            </li>
          </ul>
        </li>";
      } 
        else
        {
          echo "<li><a href='$base_url"."register.html'><span class='glyphicon glyphicon-user' aria-hidden='true'></span> Register/ Login</a></li>";
        }
      ?>
      </ul>
    </div>
  </div>
</nav>