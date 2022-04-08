<?php
require_once 'layout/header.php';
require_once '../functions.php';

$username = $_SESSION['username'];
$result   = query("SELECT * FROM admin WHERE username = '$username'");
?>

<div class="p-5 mb-4 bg-light rounded-3">
  <div class="container-fluid py-5">
    <h1 class="display-6 fw-bold mb-4">Selamat Datang <?= $username; ?>,</h1>
    <cite class="col-md-10 fs-6 d-block mb-5"><strong class="fs-3">``</strong> Ketika seseorang memberitahumu bahwa kamu akan gagal terhadap sesuatu, maka lakukan saja. Tidak ada yang lebih menakutkan daripada tidak pernah mencoba.</cite>
    <a href="siswa/index.php" class="btn btn-outline-dark">
      <i class="fa fa-eye"></i>
      Lihat Data
    </a>
  </div>
</div>

<?php require_once 'layout/footer.php'; ?>