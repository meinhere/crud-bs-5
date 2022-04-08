<?php
require_once '../layout/header.php';
require_once '../../functions.php';

$siswa = query("SELECT * FROM tb_siswa");
?>

<div class="col-lg-8">
  <figure class="mt-4">
    <h1>Mode CRUD Data</h1>
    <blockquote class="blockquote">
      <p>Berikut adalah mode yang dapat dilakukan oleh member </p>
    </blockquote>
    <figcaption class="blockquote-footer">
      CRUD <cite title="Source Title">Create - Read - Update - Delete</cite>
    </figcaption>
  </figure>
</div>

<div class="table-responsive col-lg-8 mb-4">
  <table class="table table-striped table-sm align-middle" id="table">
    <thead>
      <tr>
        <th scope="col" class="text-center">No</th>
        <th scope="col">Nama Siswa</th>
        <th scope="col" class="text-center">Ubah</th>
        <th scope="col" class="text-center">Hapus</th>
        <th scope="col" class="text-center">Admin</th>
        <th scope="col" class="text-center">Submit</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
      <?php foreach ($siswa as $row) : ?>
        <tr>
          <td class="text-center"><?= $i++; ?></td>
          <td><?= $row['nama_siswa']; ?></td>
          <form action="<?= BASEURL; ?>/proses.php" method="post" class="form-aksi">
            <td class="text-center">
              <input type="checkbox" <?= ($row['aksi_id'] == 1 || $row['aksi_id'] == 2) ? 'checked' : ''; ?> name="ubah_aksi" class="ubah_checked">
            </td>
            <td class="text-center">
              <input type="checkbox" <?= ($row['aksi_id'] == 1 || $row['aksi_id'] == 3) ? 'checked' : ''; ?> name="hapus_aksi" class="hapus_checked">
            </td>
            <td class="text-center role">
              <input type="checkbox" <?= ($row['aksi_id'] == 5) ? 'checked' : ''; ?> name="role_aksi" class="role_checked <?= ($row['aksi_id'] == 5) ? 'checked' : ''; ?>">
            </td>
            <td class="text-center">
              <button class="btn btn-success btn-sm rounded-pill" name="aksi_id">
                <i class="fa fa-send"></i>
              </button>
            </td>
          </form>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php require_once '../layout/footer.php'; ?>