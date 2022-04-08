<?php
require_once '../layout/header.php';
require_once '../../functions.php';

$siswa = query("SELECT * FROM tb_siswa");
?>

<div class="col-lg-8">
  <figure class="mt-4">
    <h1>Data Siswa</h1>
    <blockquote class="blockquote">
      <p>Berikut berisi data siswa dari dalam database</p>
    </blockquote>
    <figcaption class="blockquote-footer">
      CRUD <cite title="Source Title">Create - Read - Update - Delete</cite>
    </figcaption>
  </figure>

  <a href="<?= BASEURL; ?>/admin/siswa/kelola.php" class="btn btn-primary mb-3 rounded-pill">
    <i class="fa fa-plus"></i>
    Tambah Data
  </a>
</div>

<div class="table-responsive col-lg-8 mb-4">
  <table class="table table-striped table-sm align-middle" id="table">
    <thead>
      <tr>
        <th scope="col" class="text-center">No</th>
        <th scope="col">Nama Siswa</th>
        <th scope="col">Jenis Kelamin</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
      <?php foreach ($siswa as $row) : ?>
        <tr>
          <td class="text-center"><?= $i++; ?></td>
          <td><?= $row['nama_siswa']; ?></td>
          <td><?= $row['jenis_kelamin']; ?></td>
          <td>
            <a href="<?= BASEURL; ?>/admin/siswa/detail.php" class="btn btn-info btn-sm rounded-circle">
              <i class="fa fa-eye"></i>
            </a>
            <a href="<?= BASEURL; ?>/admin/siswa/kelola.php?ubah=<?= $row['id_siswa']; ?>" class="btn btn-warning btn-sm rounded-circle">
              <i class="fa fa-edit"></i>
            </a>
            <button type="button" class="btn btn-danger btn-sm rounded-circle btn-hapus" data-bs-toggle="modal" data-bs-target="#mainModal" data-id="<?= $row['id_siswa']; ?>">
              <i class="fa fa-trash"></i>
            </button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php require_once '../layout/footer.php'; ?>