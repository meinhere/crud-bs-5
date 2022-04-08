<?php
session_start();
require 'functions.php';

if (isset($_POST['tambah'])) {

	if (tambah($_POST) > 0) {
		$result = query("SELECT * FROM tb_siswa");
		$jmlData = count($result);
		$result = end($result);
		$rowAkhir = $result['id_siswa'];

		$_SESSION['berhasil'] = "Data Dengan Nama : <a href='kelola.php?ubah=$rowAkhir' class='alert-link'>" . $_POST['nama'] . "</a> Berhasil Ditambahkan | Jumlah Data Sekarang : " . $jmlData . " Orang";
		header("Location: index.php");
		exit();
	} else {
		$_SESSION['nisn'] = $_POST['nisn'];
		$_SESSION['nama'] = $_POST['nama'];
		$_SESSION['jkel'] = $_POST['jkel'];
		$_SESSION['alamat'] = $_POST['alamat'];
		header("Location: kelola.php");
		exit();
	}
}

if (isset($_POST['ubah'])) {
	$id = intval($_POST['id_siswa']);
	$jmlData = count(query("SELECT * FROM tb_siswa"));

	if (ubah($_POST) > 0) {
		$_SESSION['berhasil'] = "Data Dengan Nama : <a href='kelola.php?ubah=$id' class='alert-link'>" . $_POST['nama'] . "</a> Berhasil Diubah | Jumlah Data Sekarang : " . $jmlData . " Orang";
		header("Location: index.php");
		exit();
	} elseif (ubah($_POST) == 0) {
		setcookie("pesan", "Data tidak ada yang berubah, silahkan ulangi kembali", time() + 1);
		$_SESSION['nisn'] = $_POST['nisn'];
		$_SESSION['nama'] = $_POST['nama'];
		$_SESSION['jkel'] = $_POST['jkel'];
		$_SESSION['alamat'] = $_POST['alamat'];
		header("Location: kelola.php?ubah=" . $id);
		exit();
	} else {
		$_SESSION['nisn'] = $_POST['nisn'];
		$_SESSION['nama'] = $_POST['nama'];
		$_SESSION['jkel'] = $_POST['jkel'];
		$_SESSION['alamat'] = $_POST['alamat'];
		header("Location: kelola.php?ubah=" . $id);
		exit();
	}
}

if (isset($_GET['hapus'])) {
	$id = intval($_GET['hapus']);
	$data = query("SELECT * FROM tb_siswa");
	$jmlData = count($data) - 1;
	$idPertama = $data[0]['id_siswa'];
	$result = query("SELECT nama_siswa FROM tb_siswa WHERE id_siswa = $id")[0];
	$nama = $result['nama_siswa'];

	if ($id == $idPertama) {
		$_SESSION['warning'] = "Data dari seorang Administrator tidak dapat dihapus";
		header("Location: index.php");
		exit();
	}

	if (hapus($id) > 0) {
		$_SESSION['berhasil'] = "Data Dengan Nama : <strong>" . $nama . "</strong> Berhasil Dihapus | Jumlah Data Sekarang : " . $jmlData . " Orang";
		header("Location: index.php");
		exit();
	} else {
		$_SESSION['warning'] = "Data Gagal Dihapus";
		header("Location: index.php");
		exit();
	}
}

if (isset($_POST['login'])) {
	if (login($_POST) > 0) {
		$_SESSION['login'] = true;
		$_SESSION['username'] = $_POST['username'];
		header("Location: admin/index.php");
		exit();
	} else {
		$_SESSION['warning'] = "Username atau Password yang anda masukkan salah, silahkan <a href='#' class='alert-link btn-login' data-bs-toggle='modal' data-bs-target='#mainModal'>login</a> kembali";
		header("Location: index.php");
		exit();
	}
}

if (isset($_POST['aksi_id'])) {
	$ubah_aksi = isset($_POST['ubah_aksi']) ? $_POST['ubah_aksi'] : '';
	$hapus_aksi = isset($_POST['hapus_aksi']) ? $_POST['hapus_aksi'] : '';
	$role_aksi = isset($_POST['role_aksi']) ? $_POST['role_aksi'] : '';

	if ($role_aksi == 'on') {
		echo '5';
		die;
	}

	if ($ubah_aksi == 'on' && $hapus_aksi == 'on') {
		echo '1';
		die;
	} elseif ($ubah_aksi == 'on' && $hapus_aksi == '') {
		echo '2';
		die;
	} elseif ($ubah_aksi == '' && $hapus_aksi == 'on') {
		echo '3';
		die;
	} elseif ($ubah_aksi == '' && $hapus_aksi == '') {
		echo '4';
		die;
	}
}
