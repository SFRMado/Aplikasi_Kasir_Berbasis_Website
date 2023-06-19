<?php include 'sidebar.php' ?>

<?php 
  if(isset($_POST['submitmasuk'])){
    $id = $_POST['produk'];
    $tgl = $_POST['tgl_brgmasuk'];
    $jumlah = $_POST['jumlah'];
    $keterangan = $_POST['keterangan'];

    $data = mysqli_query($conn, "SELECT * from produk WHERE idproduk ='$id'");
    $dt = mysqli_fetch_array($data);
    $jmlhtotal = $dt['stok_barang']+$jumlah;
    
    $q1 = mysqli_query($conn, "UPDATE produk SET stok_barang='$jmlhtotal' WHERE idproduk = '$id'");
    $q2 = mysqli_query($conn, "INSERT INTO barangmasuk (idproduk, tgl_brgmasuk, jumlah, keterangan) VALUES ('$id', '$tgl', '$jumlah', '$keterangan')");
  }
?>

    <h1 class="h3 mb-0">
        Barang Masuk
        <button class="btn btn-primary btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#MasukProduk">+ Tambah Barang Masuk</button>
    </h1>
    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="MasukProduk" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <form method="post">
          <div class="modal-header bg-purple">
            <h5 class="modal-title text-white">Barang Masuk</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label class="samll">Tanggal Masuk :</label>
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
            <button type="submit" name="submitmasuk" class="btn btn-primary">Simpan</button>
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
          <th>ID Barang Masuk</th>
          <th>ID Produk</th>
          <th>Tanggal Barang Masuk</th>
          <th>Jumlah Barang Masuk</th>
          <th>Keterangan</th>
        </tr>
      <tbody>
        <?php 
          $no = 1;
          $data = mysqli_query($conn, "SELECT * FROM barangmasuk");
          while($d = mysqli_fetch_object($data)){
            ?> 
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?= $d -> id_brgmasuk ?></td>
                <td><?= $d -> idproduk ?></td>
                <td><?= $d -> tgl_brgmasuk ?></td>
                <td><?= $d -> jumlah ?></td>
                <td><?= $d -> keterangan ?></td>
              </tr>
            <?php
          }
        ?>
      </tbody>
      </thead>
    </table>

<?php include 'footer.php'?>