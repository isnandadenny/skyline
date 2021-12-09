<?php
session_start();

if (!isset($_SESSION["login"])) {
	# code...
	header("Location: login.php");
	exit;
}

require 'functions.php';

// ambil data di url
$id = $_GET["id"];

//query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

if (isset($_POST["submit"])) {
	// cek keberhasilan update data

	if ( ubah($_POST) > 0 ) {
		echo "
			<script>
				alert('Data Berhasil Diubah!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data Gagal Diubah!');
				document.location.href = 'index.php';
			</script>
		";
		// echo "Data Gagal Diubah!";
		// echo "<br>";
		// echo "Harap Upload Ulang Data";
	}

}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Ubah Data Mahasiswa</title>
</head>
<body>

	<h1>Ubah Data Mahasiswa</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $mhs["id"]; ?>">
		<input type="hidden" name="gambarlama" value="<?php echo $mhs["gambar"]; ?>">
		<ul>
			<li>
				<label for="nama">Nama : </label>
				<input type="text" name="nama" id="nama" required value="<?php echo $mhs["nama"]; ?>">
			</li>
			<li>
				<label for="nim">NIM : </label>
				<input type="text" name="nim" id="nim" required value="<?php echo $mhs["nim"]; ?>">
			</li>
			<li>
				<label for="email">E-mail : </label>
				<input type="text" name="email" id="email" required value="<?php echo $mhs["email"]; ?>">
			</li>
			<li>
				<label for="jurusan">Jurusan/Prodi : </label>
				<input type="text" name="jurusan" id="jurusan" required value="<?php echo $mhs["jurusan"]; ?>">
			</li>
			<li>
				<label for="foto">Foto : </label> <br>
				<img src="img/uploaded/<?php echo $mhs["gambar"];?>" width="150"> <br>
				<input type="file" name="gambar" id="foto">
			</li>
			
				<button type="submit" name="submit">Ubah Data</button>
			
		</ul>

	</form>

</body>
</html>