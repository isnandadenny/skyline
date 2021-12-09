<?php 
session_start();

if (!isset($_SESSION["login"])) {
	# code...
	header("Location: login.php");
	exit;
}

require 'functions.php';

$mahasiswa =query("SELECT * FROM mahasiswa");

// tombol cari ditekan
if (isset($_POST["cari"])) {
	# code...
	$mahasiswa = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin</title>
	<style>
		.loader {
			width: 70px;
			position: absolute;
			top: 120px;
			z-index: -1;
			left: 230px;
			display: none;
			
		}

		@media print {
			.logout, .tambah, .form-cari, .aksi {
				display: none;
			}
		}
	</style>
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="js/script.js"></script>
</head>
<body>

<a href="logout.php" class="logout"><button>Logout</button></a> | <a href="print.php" target="_blank"><button>Print</button></a>

<h1>Daftar Mahasiswa</h1>

<a href="tambah.php" class="tambah">Tambah Data Mahasiswa</a>
<br><br>

<form action="" method="post" class="form-cari">

	<input type="text" name="keyword" size="30" autofocus placeholder="Masukkan Keyword Pencarian" autocomplete="off" id="keyword">
	<button type="submit" name="cari" id="tombolcari">Cari!</button>
	<img src="img/loader.gif" class="loader">
</form>
<br>

<div id="container">

<table border="1" cellpadding="10" cellspacing="0">
	
	<tr>
		<th>No.</th>
		<th class="aksi">Aksi</th>
		<th>Gambar</th>
		<th>NIM</th>
		<th>Nama</th>
		<th>Email</th>
		<th>Jurusan</th>
	</tr>

	<?php $i =1; ?>
	<?php foreach ($mahasiswa as $row) : ?>
	<tr>
		<td><?php echo $i; ?></td>
		<td class="aksi">
			<a href="ubah.php?id=<?php echo $row["id"]; ?>">ubah</a> |
			<a href="hapus.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
		</td>
		<td><img src="img/uploaded/<?php echo $row["gambar"]; ?>" width="40"></td>
		<td><?php echo $row["nim"]; ?></td>
		<td><?php echo $row["nama"]; ?></td>
		<td><?php echo $row["email"]; ?></td>
		<td><?php echo $row["jurusan"]; ?></td>
	</tr>
	<?php $i++; ?>
<?php endforeach; ?>

</table>

</div>

</body>
</html>