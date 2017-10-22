<?php
$id_user  = mysqli_real_escape_string($conn, $_GET['id_user']);
$sql      = "SELECT * FROM user WHERE id_user = '$id_user' ";
$result   = mysqli_query($conn, $sql);
$data     = mysqli_fetch_array($result);
?>
<form action="user_ubah_proses.php" method="post">
  <div class="row">
    <div class="col-md-6">      
      <div class="box box-primary">
        <div class="box-body">
          <input type="hidden" name="id_user" class="form-control" value="<?php echo $data['id_user'] ?>" />
          <div class="form-group"><label>Nama</label>
            <input type="text" name="nama" class="form-control" required value="<?php echo $data['nama'] ?>" />
          </div>
          <div class="form-group"><label>Username</label>
            <input type="text" name="username" class="form-control" required value="<?php echo $data['username'] ?>"/>
          </div>
          <div class="form-group"><label>Tipe User</label><br/>
            <?php echo
            "<input type='radio' name='usertype' value='superadmin' ".($data['usertype'] == "superadmin"?'checked':'')."> Super Admin &nbsp ".
            "<input type='radio' name='usertype' value='admin' ".($data['usertype'] == "admin"?'checked':'')."> Admin &nbsp ";
            ?>
          </div>
          <div class="form-group"><label>Hak Akses</label><br/>
            <?php echo 
            "<input type='radio' name='access' value='3' ".($data['access'] == "3"?'checked':'')."> Full Access &nbsp ".
            "<input type='radio' name='access' value='2' ".($data['access'] == "2"?'checked':'')."> Change &nbsp ".
            "<input type='radio' name='access' value='1' ".($data['access'] == "1"?'checked':'')."> Read &nbsp ".
            "<input type='radio' name='access' value='0' ".($data['access'] == "0"?'checked':'')."> No Access &nbsp ";
            ?>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" name="submit" class="btn btn-success">Submit</button>
          <button type="reset" name="reset" class="btn btn-danger">Reset</button>
        </div>
      </div>
    </div>
  </div>
</form>