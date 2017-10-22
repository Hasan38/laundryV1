<?php
$id = mysqli_real_escape_string($conn,$_GET['id']);
$sql       = "SELECT * FROM kelurahan WHERE idkelurahan = '$id' ";
$result    = mysqli_query($conn, $sql);
$data      = mysqli_fetch_array($result);
?>

<form action="ongkir_ubah_proses.php" method="post">
  <div class="row">
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-body">
          <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $data['idkelurahan'] ?>">
          <div class="form-group"><label>Nama Kelurahan</label>
            <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $data['namakelurahan'] ?>" readonly >
          </div>
          <div class="form-group"><label>Ongkir</label>
            <input type="text" class="form-control" name="ongkir" id="ongkir" value="<?php echo $data['ongkir'] ?>">
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