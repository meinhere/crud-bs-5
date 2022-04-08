<?php
session_start();
require 'functions.php';

if (isset($_SESSION['login'])) {
	header("Location: admin/index.php");
	exit();
}

$aksi_id = '5';
$getUbah = isset($_GET['ubah']) ? $_GET['ubah'] : '';
$passwordValid = 'admin123';

if (isset($_POST['auth'])) {
	$password = $_POST['password'];

	if ($password != $passwordValid) {
		$_SESSION['warning'] = "Password yang anda masukkan salah, silahkan <a href='#' class='alert-link btn-ubah' data-bs-toggle='modal' data-bs-target='#mainModal' data-id=$getUbah>ulangi</a> kembali";
		header("Location: index.php");
		exit();
	}
}

if (isset($_GET['ubah'])) {
	$id = intval($_GET['ubah']);
	$idAksi = query("SELECT aksi_id FROM tb_siswa WHERE id_siswa = $id");
	$siswa = query("SELECT * FROM tb_siswa WHERE id_siswa = $id");

	foreach ($idAksi as $idValid) {
		if ($idValid == $aksi_id || $password != $passwordValid) {
			$_SESSION['warning'] = "Anda tidak bisa mengubah langsung data dari seorang Administrator, silahkan masukkan <a href='#' class='alert-link btn-ubah' data-bs-toggle='modal' data-bs-target='#mainModal' data-id=$id>password</a> terlebih dahulu";
			header("Location: index.php");
			exit();
		}
	}

	$title = "Halaman Ubah Data || Belajar CRUD";
	$head  = "Form Ubah Data";
} else {
	$query = [
		'id_siswa' 						=> '',
		'nisn'								=> '',
		'nama_siswa'					=> '',
		'jenis_kelamin'				=> '',
		'foto_siswa'					=> '',
		'alamat'							=> '',
		'aksi_id'							=> ''
	];
	$siswa = [$query];

	$title = "Halaman Tambah Data || Belajar CRUD";
	$head  = "Form Tambah Data";
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Templates CSS -->
	<link rel="stylesheet" href="BS/css/bootstrap.min.css">
	<link rel="stylesheet" href="fonts/css/font-awesome.min.css">

	<!-- Custom CSS -->
	<link rel="stylesheet" href="css/main.css">

	<title><?= $title; ?></title>
</head>

<body>
	<!-- Start Navbar -->
	<nav class="navbar navbar-dark bg-dark">
		<div class="container-fluid">
			<a href="index.php" class="navbar-brand">
				<i class="fa fa-rocket"></i>
				CRUD - Bootstrap 5
			</a>
			<marquee class="left-marquee" behavior="scroll" direction="left" width="41%" onmouseover="this.stop()" onmouseout="this.start()">Silahkan mengisi form data berikut "Terima Kasih"</marquee>
			<marquee class="right-marquee" behavior="scroll" scrolldelay="105" direction="right" width="41%" onmouseover="this.stop()" onmouseout="this.start()">Belajar CRUD - Bootsrap 5</marquee>
		</div>
	</nav>
	<!-- End Navbar -->

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
		<form action="proses.php" method="post" enctype="multipart/form-data">
			<?php foreach ($siswa as $row) : ?>
				<input type="hidden" name="id_siswa" value="<?= $row['id_siswa'] ?>">
				<input type="hidden" name="fotoLama" value="<?= $row['foto_siswa']; ?>">
				<div class="mb-3 row">
					<label for="nisn" class="col-sm-4 col-md-2 col-form-label">NISN</label>
					<div class="col-sm-8 col-md-10 input">
						<input type="text" name="nisn" id="nisn" class="form-control" placeholder="Ex: 112233" value="<?= (isset($_COOKIE['pesan'])) ? $_SESSION['nisn'] : $row['nisn']; ?>" <?= ($row['aksi_id'] != $aksi_id && $getUbah != '') ? 'readonly' : 'autofocus'; ?>>
					</div>
				</div>
				<div class="mb-3 row">
					<label for="nama" class="col-sm-4 col-md-2 col-form-label">Nama Siswa</label>
					<div class="col-sm-8 col-md-10">
						<input type="text" name="nama" id="nama" class="form-control" placeholder="Ex: Alpha Rector" value="<?= (isset($_COOKIE['pesan'])) ? $_SESSION['nama'] : $row['nama_siswa']; ?>" <?= ($getUbah) ? 'autofocus' : ''; ?>>
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
							<img src="img/boy.svg" class="img-thumbnail mb-4" style="width: 80px;">
						</div>
						<div class="img-girl">
							<span class="d-block mb-2">Perempuan</span>
							<img src="img/girl.svg" class="img-thumbnail" style="width: 80px;">
						</div>
					</div>
					<div class="col-sm-4 col-md-2 d-flex align-items-center justify-content-center mb-3 mt-2">
						<img src="img/<?= ($row['foto_siswa'] == '') ? 'default.svg' : $row['foto_siswa']; ?>" class="img-thumbnail img-prev" style="width: 200px;">
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
				<?php session_destroy(); ?>
			<?php endforeach; ?>

			<button type="submit" name="<?= ($getUbah) ? 'ubah' : 'tambah'; ?>" class="btn btn-primary">
				<i class="fa fa-floppy-o"></i>
				<?= ($getUbah) ? 'Simpan Perubahan' : 'Tambahkan'; ?>
			</button>
			<a href="index.php" class="btn btn-danger">
				<i class="fa fa-reply"></i>
				Kembali
			</a>
		</form>
		<!-- End Form Input -->
	</div>

	<!-- Templates Javascript -->
	<script src="BS/js/bootstrap.bundle.min.js"></script>

	<!-- Custom Javascript -->
	<script>
		function previewImg() {
			const foto = document.querySelector('#foto');
			const fotoSiswa = document.querySelector('.img-prev');

			const fileFoto = new FileReader();
			fileFoto.readAsDataURL(foto.files[0]);

			fileFoto.onload = function(e) {
				fotoSiswa.src = e.target.result;
			}
		}
	</script>

</body>

</html>