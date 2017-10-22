<div class="row carousel-holder">
  <div class="col-md-12">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
          <?php
          //Query database
          $sql = mysqli_query($conn,"SELECT * FROM slider ORDER BY no_urut ASC");
          //$sql = mysql_query("SELECT * FROM carousel ORDER BY active DESC");
          while($row = mysqli_fetch_assoc($sql)){
            echo '
            <div class="item '; if($row['active'] == 1){ echo 'active'; } echo '">
              <img class="slide-image" src="'.$base_url.'images/slider/'.$row['img'].'" title="'.$row['judul_slider'].'" alt="'.$row['judul_slider'].'" width="100%"/>
              <div class="carousel-caption">
                <h1 class="carousel-caption-header"></h1>
                <p class="carousel-caption-text hidden-sm hidden-xs"></p>
              </div>
            </div>
            ';
          }
          ?>
        
      </div>
      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
    </div>
  </div>
</div>