<form action="user_add_proses.php" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-body">
          <div class="form-group"><label>Nama</label>
            <input type="text" name="nama" class="form-control" required/>
          </div>
          <div class="form-group"><label>Username</label>
            <input type="text" name="username" class="form-control" required/>
          </div>
          <div class="form-group"><label>Password Login</label>
            <input type="password" name="password" class="form-control" required/>
          </div>
          <div class="form-group"><label>Tipe User</label><br/>
            <input type="radio" name="usertype" value="superadmin"> Super Admin &nbsp 
            <input type="radio" name="usertype" value="admin" checked> Admin &nbsp 
          </div>
          <div class="form-group"><label>Hak Akses</label><br/>
            <input type="radio" name="access" value="3"> Full Access &nbsp 
            <input type="radio" name="access" value="2"> Change &nbsp 
            <input type="radio" name="access" value="1"> Read &nbsp 
            <input type="radio" name="access" value="0" checked> No Access</td>
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