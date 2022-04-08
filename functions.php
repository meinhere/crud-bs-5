 <?php
	// Database Inisialisasi
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db   = 'xii_tkj1_31';
	$conn = mysqli_connect($host, $user, $pass, $db);

	// Function Query
	function query($query)
	{
		global $conn;

		$result = mysqli_query($conn, $query);
		$rows = [];
		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}

		return $rows;
	}

	// Function Tambah Data
	function tambah($data)
	{
		global $conn;

		$nisn 	= htmlentities($data['nisn']);
		$nama 	= htmlentities($data['nama']);
		$jkel 	= htmlentities($data['jkel']);
		$alamat = htmlentities($data['alamat']);

		if (empty($nisn) || empty($nama) || empty($alamat)) {
			setcookie("pesan", "Data gagal ditambahkan, harap isi semua field", time() + 1);
			return -1;
		}

		if ($jkel == "0") {
			setcookie("pesan", "Data gagal ditambahkan, silahkan pilih jenis kelamin", time() + 1);
			return -1;
		}

		$result = mysqli_query($conn, "SELECT nisn FROM tb_siswa WHERE nisn = '$nisn'");
		if (mysqli_fetch_assoc($result)) {
			setcookie("pesan", "Data gagal ditambahkan, NISN telah ada", time() + 1);
			return -1;
		}

		$foto   = upload();
		if ($foto == 1) {
			$foto = ($jkel == "Laki-Laki") ? "boy.svg" : "girl.svg";
		} elseif ($foto == 2) {
			setcookie("pesan", "Data gagal ditambahkan, yang anda kirim bukan gambar (format: 'jpg' 'jpeg' 'png' 'svg')", time() + 1);
			return -1;
		} elseif ($foto == 3) {
			setcookie("pesan", "Data gagal ditambahkan, file yang anda masukkan terlalu besar (max 1MB)", time() + 1);
			return -1;
		}

		$query 	= "INSERT INTO tb_siswa 
			   			 VALUES(null, '$nisn', '$nama', '$jkel', '$foto', '$alamat', 1)
			   			";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	// Function Hapus Data
	function hapus($id)
	{
		global $conn;

		$result = query("SELECT * FROM tb_siswa WHERE id_siswa = $id")[0];
		if ($result['foto_siswa'] != 'boy.svg' && $result['foto_siswa'] != 'girl.svg') {
			unlink('img/' . $result['foto_siswa']);
		}
		mysqli_query($conn, "DELETE FROM tb_siswa WHERE id_siswa = $id");

		return mysqli_affected_rows($conn);
	}

	// Function Upload Gambar
	function upload()
	{
		$namaFile 	= $_FILES['foto']['name'];
		$ukuranFile	= $_FILES['foto']['size'];
		$error	 	  = $_FILES['foto']['error'];
		$tmpName	  = $_FILES['foto']['tmp_name'];

		if ($error === 4) {
			return 1;
		}

		$ekstensiValid 	= ['jpg', 'jpeg', 'png', 'svg'];
		$ekstensiGambar	= explode('.', $namaFile);
		$ekstensiGambar = strtolower(end($ekstensiGambar));
		if (!in_array($ekstensiGambar, $ekstensiValid)) {
			return 2;
		}

		if ($ukuranFile > 1000000) {
			return 3;
		}

		$namaFileBaru = uniqid() . '.' . $ekstensiGambar;
		move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

		return $namaFileBaru;
	}

	// Function Ubah Data
	function ubah($data)
	{
		global $conn;

		$id 	= $data['id_siswa'];
		$nama 	= htmlentities($data['nama']);
		$jkel 	= htmlentities($data['jkel']);
		$alamat = htmlentities($data['alamat']);
		$fotoLama = htmlentities($data['fotoLama']);

		if (empty($nama) || empty($alamat)) {
			setcookie("pesan", "Data gagal diubah, harap isi semua field", time() + 1);
			return -1;
		}

		if ($jkel == "0") {
			setcookie("pesan", "Data gagal diubah, silahkan pilih jenis kelamin", time() + 1);
			return -1;
		}

		if ($_FILES['foto']['error'] === 4) {
			if ($jkel == 'Laki-Laki' && $fotoLama == 'girl.svg') {
				$foto = 'boy.svg';
			} elseif ($jkel == 'Perempuan' && $fotoLama == 'boy.svg') {
				$foto = 'girl.svg';
			} else {
				$foto = $fotoLama;
			}
		} elseif ($fotoLama != 'boy.svg' && $fotoLama != 'girl.svg') {
			$foto = upload();
			unlink('img/' . $fotoLama);
		} else {
			$foto = upload();
			if ($foto == 2) {
				setcookie("pesan", "Data gagal ditambahkan, yang anda kirim bukan gambar (format: 'jpg' 'jpeg' 'png' 'svg')", time() + 1);
				return -1;
			} elseif ($foto == 3) {
				setcookie("pesan", "Data gagal ditambahkan, file yang anda masukkan terlalu besar (max 1Mb)", time() + 1);
				return -1;
			}
		}

		$query 	= "UPDATE tb_siswa SET
			   			 nama_siswa 	  = '$nama',
			   			 jenis_kelamin  = '$jkel',
			   			 foto_siswa	   	= '$foto',
			   			 alamat 		   	= '$alamat'
			   			 WHERE id_siswa = $id
			   			";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}

	function login($data)
	{
		global $conn;

		$username = htmlentities($data['username']);
		$password = htmlentities($data['password']);

		$result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			// $password = password_verify($password, $row['password'])
			if ($password == $row['password']) {
				return true;
			}
		}

		return false;
	}
