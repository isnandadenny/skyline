<?php
session_start();

if (!isset($_SESSION["login"])) {
	# code...
	header("Location: login.php");
	exit;
}

require 'functions.php';
if (isset($_POST["submit"])) {

	// cek keberhasilan upload data

	if ( tambah($_POST) > 0 ) {
		echo "
			<script>
				alert('Data Berhasil Ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
		// echo "Data Gagal Ditambahkan!";
		// echo "<br>";
		// echo "Harap Upload Ulang Data";
	}

}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Mahasiswa</title>
</head>
<body>

	<h1>Tambah Data Mahasiswa</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<ul>
			<li>
				<label for="nama">Nama : </label>
				<input type="text" name="nama" id="nama" required>
			</li>
			<li>
				<label for="nim">NIM : </label>
				<input type="text" name="nim" id="nim" required>
			</li>
			<li>
				<label for="email">E-mail : </label>
				<input type="text" name="email" id="email" required>
			</li>
			<li>
				<label for="jurusan">Jurusan/Prodi : </label>
				<input type="text" name="jurusan" id="jurusan" required>
			</li>
			<li>
				<label for="foto">Foto : </label>
				<input type="file" name="gambar" id="foto">
			</li>
			
				<button type="submit" name="submit">Tambah Data</button>
			
		</ul>

	</form>

</body>
</html>