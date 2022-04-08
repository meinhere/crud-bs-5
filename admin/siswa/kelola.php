<?php
require_once '../layout/header.php';
require_once '../../functions.php';

$getUbah = (isset($_GET['ubah'])) ? $_GET['ubah'] : '';

if (isset($_GET['ubah'])) {
  $id = intval($_GET['ubah']);
  $siswa = query("SELECT * FROM tb_siswa WHERE id_siswa = $id");
  $head  = "Form Ubah Data";
} else {
  $query = [
    'id_siswa'             => '',
    'nisn'                => '',
    'nama_siswa'          => '',
    'jenis_kelamin'        => '',
    'foto_siswa'          => '',
    'alamat'              => '',
    'aksi_id'              => ''
  ];
  $siswa = [$query];
  $head  = "Form Tambah Data";
}
?>
<div class="container mb-4">
  <h2 class="my-4"><?= $head; ?></h2>

  <!-- Notify Error -->
  <?php if (isset($_COOKIE['pesan'])) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="fa fa-exclamation-triangle"></i>
      <?= $_COOKIE['pesan'] ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <!-- Start Form Input -->
  <form action="<?= BASEURL; ?>/proses.php" method="post" enctype="multipart/form-data">
    <?php foreach ($siswa as $row) : ?>
      <input type="hidden" name="id_siswa" value="<?= $row['id_siswa'] ?>">
      <input type="hidden" name="fotoLama" value="<?= $row['foto_siswa']; ?>">
      <div class="mb-3 row">
        <label for="nisn" class="col-sm-4 col-md-2 col-form-label">NISN</label>
        <div class="col-sm-8 col-md-10 input">
          <input type="text" name="nisn" id="nisn" class="form-control" placeholder="Ex: 112233" value="<?= (isset($_COOKIE['pesan'])) ? $_SESSION['nisn'] : $row['nisn']; ?>" autofocus>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="nama" class="col-sm-4 col-md-2 col-form-label">Nama Siswa</label>
        <div class="col-sm-8 col-md-10">
          <input type="text" name="nama" id="nama" class="form-control" placeholder="Ex: Alpha Rector" value="<?= (isset($_COOKIE['pesan'])) ? $_SESSION['nama'] : $row['nama_siswa']; ?>">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="jkel" class="col-sm-4 col-md-2 col-form-label">Jenis Kelamin</label>
        <div class="col-sm-8 col-md-10">
          <?php $jkel = (isset($_SESSION['jkel'])) ? $_SESSION['jkel'] : ''; ?>
          <select class="form-select" name="jkel" id="jkel">
            <option value="0">Pilih Jenis Kelamin</option>
            <option <?= ($row['jenis_kelamin'] == 'Laki-Laki' || $jkel == 'Laki-Laki') ? 'selected' : ''; ?> value="Laki-Laki">Laki-Laki</option>
            <option <?= ($row['jenis_kelamin'] == 'Perempuan' || $jkel == 'Perempuan') ? 'selected' : ''; ?> value="Perempuan">Perempuan</option>
          </select>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="foto" class="col-sm-4 col-md-2 col-form-label d-flex" style="align-items: center;">Foto Siswa</label>
        <div class="col-sm-8 col-md-2 text-center mb-3">
          <div class="img-boy">
            <span class="d-block mb-2">Laki-Laki</span>
            <img src="<?= BASEURL; ?>/img/boy.svg" class="img-thumbnail mb-4" style="width: 80px;">
          </div>
          <div class="img-girl">
            <span class="d-block mb-2">Perempuan</span>
            <img src="<?= BASEURL; ?>/img/girl.svg" class="img-thumbnail" style="width: 80px;">
          </div>
        </div>
        <div class="col-sm-4 col-md-2 d-flex align-items-center justify-content-center mb-3 mt-2">
          <img src="<?= BASEURL; ?>/img/<?= ($row['foto_siswa'] == '') ? 'default.svg' : $row['foto_siswa']; ?>" class="img-thumbnail img-prev" style="width: 200px;">
        </div>
        <div class="col-sm-8 col-md-6 d-flex flex-column justify-content-center">
          <input class="form-control" type="file" name="foto" id="foto" onchange="previewImg()">
          <ul class="text-danger mt-1">
            <li><cite>Format gambar : jpg, jpeg, png, svg</cite></li>
            <li><cite>Max ukuran : 1.000KB (1MB)</cite></li>
          </ul>
        </div>
      </div>
      <div class="mb-4 row">
        <label for="alamat" class="col-sm-4 col-md-2 col-form-label">Alamat</label>
        <div class="col-sm-8 col-md-10">
          <textarea class="form-control" name="alamat" id="alamat" placeholder="Ex: Kec. Tanjuganom Kab. Nganjuk"><?= (isset($_COOKIE['pesan'])) ? $_SESSION['alamat'] :  $row['alamat']; ?></textarea>
        </div>
      </div>
    <?php endforeach; ?>

    <button type="submit" name="<?= ($getUbah) ? 'ubah' : 'tambah'; ?>" class="btn btn-primary">
      <i class="fa fa-floppy-o"></i>
      <?= ($getUbah) ? 'Simpan Perubahan' : 'Tambahkan'; ?>
    </button>
    <a href="<?= BASEURL; ?>/admin/siswa/index.php" class="btn btn-danger">
      <i class="fa fa-reply"></i>
      Kembali
    </a>
  </form>
  <!-- End Form Input -->
</div>

<?php require_once '../layout/footer.php'; ?>