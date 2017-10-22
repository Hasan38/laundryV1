<form method="post" id="form-login" action="login.php">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-body">
          <div class="form-group"><label>Username</label>
            <input class="form-control" name="username" type="text" id="username" size="30" required/>
          </div>
          <div class="form-group"><label>Password</label>
            <input class="form-control" name="password" type="password" id="password" size="30" required/>
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" name="submit" class="btn btn-success">Submit</button>
          <button type="reset" name="reset" class="btn btn-danger">Reset</button>
        </div>
      </div><!-- /.box -->
      <!-- left column -->
    </div>
  </div>
</form>