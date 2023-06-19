<?php include 'sidebar.php' ?>

<?php 
  if(isset($_POST['submitkeluar'])){
    $id = $_POST['produk'];
    $tgl = $_POST['tgl_brgkeluar'];
    $jumlah = $_POST['jumlah'];
    $keterangan = $_POST['keterangan'];

    $data = mysqli_query($conn, "SELECT * from produk WHERE idproduk ='$id'");
    $dt = mysqli_fetch_array($data);
    $jmlhtotal = $dt['stok_barang']-$jumlah;
    if($jmlhtotal < 0){
        echo "<div class='alert alert-warning'>
        <strong>Failed!</strong> Redirecting you back in 1 seconds.
      </div>
     <meta http-equiv='refresh' content='1; url= keluar.php'/> ";
    } else {
        $q1 = mysqli_query($conn, "UPDATE produk SET stok_barang='$jmlhtotal' WHERE idproduk = '$id'");
        $q2 = mysqli_query($conn, "INSERT INTO barangkeluar (idproduk, tgl_brgkeluar, jumlah, keterangan) VALUES ('$id', '$tgl', '$jumlah', '$keterangan')");
        echo " <div class='alert alert-success'>
        <strong>Success!</strong> Redirecting you back in 1 seconds.
      </div>
    <meta http-equiv='refresh' content='1; url= keluar.php'/>  ";
    }
  }
?>

    <h1 class="h3 mb-0">
        Barang Keluar
        <button class="btn btn-primary btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#MasukProduk">+ Tambah Barang Keluar</button>
    </h1>
    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="MasukProduk" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <form method="post">
          <div class="modal-header bg-purple">
            <h5 class="modal-title text-white">Barang Keluar</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label class="samll">Tanggal Keluar :</label>
                <input type="date" name="tgl_brgmasuk" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="samll">Pilih Produk :</label>
                <select name="produk" id="produk" class="custom-select form-control">
                <option selected>Pilih Produk</option>
                <?php 
                  $kode = mysqli_query($conn,"SELECT * FROM produk ORDER BY idproduk ASC");
                  while($k = mysqli_fetch_object($kode)){
                    ?>
                      <option value="<?= $k -> idproduk ?>"><?= $k ->  nama_produk?>[<?= $k -> idproduk ?>]</option>
                    <?php
                  }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label class="samll">Jumlah :</label>
                <input type="number" placeholder="0" name="jumlah" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="samll">Keterangan :</label>
                <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" name="submitkeluar" class="btn btn-primary">Simpan</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- end Modal Produk -->

    <table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
      <thead>
        <tr>
          <th>No</th>
          <th>ID Barang Keluar</th>
          <th>ID Produk</th>
          <th>Tanggal Barang Keluar</th>
          <th>Jumlah Barang Keluar</th>
          <th>Keterangan</th>
        </tr>
      <tbody>
        <?php 
          $no = 1;
          $data = mysqli_query($conn, "SELECT * FROM barangkeluar");
          while($d = mysqli_fetch_object($data)){
            ?> 
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?= $d -> id_brgkeluar ?></td>
                <td><?= $d -> idproduk ?></td>
                <td><?= $d -> tgl_brgkeluar ?></td>
                <td><?= $d -> jumlah ?></td>
                <td><?= $d -> keterangan ?></td>
              </tr>
            <?php
          }
        ?>
      </tbody>
      </thead>
    </table>

    <script type="text/javascript">

$(document).ready(function(){

  swal({
    position: "top-end",
    type: "success",
    title: "Your work has been saved",
    showConfirmButton: false,
    timer: 1500
  })
});

</script>

<?php include 'footer.php'?>