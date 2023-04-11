<?php
session_start();
require 'functions.php';

if (isset($_SESSION['login'])) {
	header("Location: admin/index.php");
	exit();
}

$siswa = query("SELECT * FROM tb_siswa");
$laki_laki  = query("SELECT * FROM tb_siswa WHERE jenis_kelamin = 'Laki-Laki'");
$perempuan  = query("SELECT * FROM tb_siswa WHERE jenis_kelamin = 'Perempuan'");

$admin = query("SELECT * FROM admin");

$aksi_id = 5;
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Templates CSS -->
	<link rel="stylesheet" href="BS/css/bootstrap.min.css">
	<link rel="stylesheet" href="fonts/css/font-awesome.min.css">
	<link rel="stylesheet" href="datatables/datatables.css">

	<!-- Custom CSS -->
	<link rel="stylesheet" href="css/main.css">

	<title>Halaman Beranda || Belajar CRUD</title>
</head>

<body>
	<!-- Start Navbar -->
	<nav class="navbar navbar-dark bg-light">
		<div class="container-fluid d-flex align-items-center">
			<a href="index.php" class="navbar-brand">
				<i class="fa fa-rocket"></i>
				CRUD - Bootstrap 5
			</a>
			<marquee class="left-marquee" behavior="scroll" direction="left" width="41%" onmouseover="this.stop()" onmouseout="this.start()">Selamat Datang di website yang penuh pembelajaran</marquee>
			<marquee class="right-marquee" behavior="scroll" scrolldelay="107" direction="right" width="41%" onmouseover="this.stop()" onmouseout="this.start()">Belajar CRUD - Bootsrap 5</marquee>
		</div>
	</nav>
	<!-- End Navbar -->

	<div class="container mb-4">
		<!-- Start Header -->
		<div class="row">
			<div class="col-8">
				<figure class="mt-4">
					<h1>Data Siswa</h1>
					<blockquote class="blockquote">
						<p>Berikut berisi data siswa dari dalam database</p>
					</blockquote>
					<figcaption class="blockquote-footer">
						CRUD <cite title="Source Title">Create - Read - Update - Delete</cite>
					</figcaption>
				</figure>

				<a href="kelola.php" class="btn btn-primary mb-4">
					<i class="fa fa-plus"></i>
					Tambah Data
				</a>
			</div>
			<div class="col-4 text-end">
				<!-- Start Menu Dropdown -->
				<div class="dropdown mt-5 mb-3 d-inline-block">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-list"></i>
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<li>
							<h6 class="dropdown-header">Administrator</h6>
						</li>
						<li><span class="dropdown-item">Sabil Ahmad Hidayat</span></li>
						<li><span class="dropdown-item">XII - TKJ 1</span></li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li>
							<h6 class="dropdown-header">Jumlah Data</h6>
						</li>
						<li><span class="dropdown-item">Total Siswa : <?= count($siswa); ?> Orang</span></li>
						<li><span class="dropdown-item">Laki - Laki : <?= count($laki_laki); ?> Orang</span></li>
						<li><span class="dropdown-item">Perempuan : <?= count($perempuan); ?> Orang</span></li>
					</ul>
				</div>
				<!-- End Menu Dropdown -->
				<button class="btn btn-primary btn-login" data-bs-toggle="modal" data-bs-target="#mainModal">
					<i class="fa fa-sign-in"></i>
					Login Admin
				</button>
			</div>
		</div>
		<!-- End Header -->

		<!-- Notify Success dan Warning -->
		<?php if (isset($_SESSION['berhasil']) || isset($_SESSION['warning'])) : ?>
			<div class="alert alert-<?= (isset($_SESSION['berhasil'])) ? 'success' : 'warning'; ?> alert-dismissible fade show" role="alert">
				<i class="fa fa-<?= (isset($_SESSION['berhasil'])) ? 'check-circle' : 'exclamation-triangle'; ?>"></i>
				<?= (isset($_SESSION['berhasil'])) ? $_SESSION['berhasil'] : $_SESSION['warning']; ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<?php session_destroy(); ?>
		<?php endif; ?>

		<!-- Start Tabel Data -->
		<div class="table-responsive">
			<table class="table align-middle table-striped table-hover" id="dt">
				<thead>
					<tr>
						<th class="text-center">No</th>
						<th>NISN</th>
						<th>Nama Siswa</th>
						<th>Jenis Kelamin</th>
						<th class="text-center">Foto Siswa</th>
						<th>Alamat</th>
						<th class="text-center">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach ($siswa as $row) : ?>
						<tr>
							<?php $id_siswa = $row['id_siswa']; ?>
							<td class="text-center id-hide"><?= $i++; ?></td>
							<td><?= $row['nisn']; ?></td>
							<td><?= $row['nama_siswa']; ?></td>
							<td><?= $row['jenis_kelamin']; ?></td>
							<td class="text-center">
								<img src="img/<?= $row['foto_siswa']; ?>" class="rounded-3" style="width: 100px;">
							</td>
							<td><?= $row['alamat']; ?></td>
							<td class="text-center aksi">
								<a href="kelola.php?ubah=<?= $row['id_siswa']; ?>" class="btn btn-success btn-sm btn-ubah" <?= ($row['aksi_id'] == $aksi_id) ? "data-bs-toggle='modal' data-bs-target='#mainModal' data-id=$id_siswa" : ''; ?>>
									<i class="fa fa-pencil"></i>
								</a>
								<button type="button" class="btn btn-danger btn-sm btn-hapus" data-bs-toggle="modal" data-bs-target="#mainModal" data-id="<?= $row['id_siswa']; ?>">
									<i class="fa fa-trash"></i>
								</button>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<!-- End Tabel Data -->
	</div>

	<!-- Modal Popup -->
	<div class="modal fade" id="mainModal" tabindex="-1" aria-labelledby="mainModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content text-dark">
				<div class="modal-header">
					<h5 class="modal-title" id="mainModalLabel">Konfirmasi Hapus Data</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="proses.php" method="post">
					<div class="modal-body">
						<p>Apakah anda yakin ingin menghapus data berikut ?</p>
						<input type="hidden" value="hapus" id="labelHidden">
						<div class="row mb-3" id="row">
							<div class="col-2 usernameLabel"></div>
							<div class="col-10 inputUsername"></div>
						</div>
						<div class="row mb-3" id="row">
							<div class="col-2 passwordLabel"></div>
							<div class="col-10 inputPassword"></div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="hapus" class="btn btn-primary">
							<i class="fa fa-check-circle"></i>
							<span>Yakin</span>
						</button>
				</form>
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">
					<i class="fa fa-reply"></i>
					<span>Batal</span>
				</button>
			</div>
		</div>
	</div>
	</div>

	<!-- Templates Javascript -->
	<script src="BS/js/bootstrap.bundle.min.js"></script>
	<script src="datatables/datatables.js"></script>

	<!-- Custom Javascript -->
	<script src="js/script.js"></script>
</body>

</html>