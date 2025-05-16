<?php
session_start();
if (!isset($_SESSION['ssLoginPOS'])) {
  header("location: ../auth/login.php");
  exit();
}

require '../config/config.php';
require '../config/functions.php';
// require '../module/mode-barang.php';

$title = 'Tambah barang | Market PPLG';
require '../template/header.php';
require '../template/navbar.php';
require '../template/sidebar.php';

if (isset($_POST['simpan'])) {
  if (insert($_POST) > 0) {
    echo "<script>alert('barang baru berhasil diregistrasi')</script>";
  }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">barangs</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= $main_url ?>barang/data-barang.php">barangs</a></li>
            <li class="breadcrumb-item active">Add barang</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-plus fa-sm"></i> Add barang</h3>
            <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i>
              Simpan</button>
            <button type="reset" class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-times"></i>
              Reset</button>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-8 mb-3">
                <div class="form-group">
                  <label for="kode">Kode</label>
                  <input type="text" name="kode" id="kode" class="form-control" placeholder="Masukan kode barang"
                    autofocus autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label for="barcode">Barcode</label>
                  <input type="text" name="barcode" id="barcode" class="form-control"
                    placeholder="Masukan barcode" autofocus autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label for="namabarang">Nama Barang</label>
                  <input type="text" name="namabarang" id="namabarang" class="form-control"
                    placeholder="Masukan nama barang" autofocus autocomplete="off" required>
                </div>
                <!-- <div class="form-group">
                  <label for="password">Konfirmasi Password</label>
                  <input type="password" name="password2" id="password2" class="form-control"
                    placeholder="Masukan Kembali Password" autofocus autocomplete="off" required>
                </div> -->
                <div class="form-group">
                  <label for="level">Satuan</label>
                  <select name="level" id="level" class="form-control" required>
                    <option value="">Satuan</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="hargabeli">Harga Beli</label>
                  <input type="number" name="hargabeli" id="hargabeli" class="form-control"
                    placeholder="Masukan harga beli" autofocus autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label for="hargajual">Harga Jual</label>
                  <input type="number" name="hargajual" id="hargajual" class="form-control"
                    placeholder="Masukan harga jual" autofocus autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label for="stockminimal">Stock Minimal</label>
                  <input type="number" name="stockminimal" id="hstockminimal" class="form-control"
                    placeholder="Masukan stock minimal" autofocus autocomplete="off" required>
                </div>
              </div>
              <div class="col-lg-4 text-center">
                <img src="<?= $main_url ?>assets/image/box.png" class="profile-barang-img  mb-3" style="width: 30%;" alt="barang">
                <input type="file" name="image" class="form-control">
                <span class="text-sm">Type file gambar JPG | PNG | GIF</span><br>
                <span class="text-sm">Width = Height</span>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>
<?php require '../template/footer.php'; ?>