<?php 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data) {
	global $conn;

	//ambil data dari tiap elemen dalam form
	$nama = htmlspecialchars($data["nama"]);
	$nim = htmlspecialchars($data["nim"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);

	// upload gambar dulu
	$gambar = upload();
	if ( !$gambar ) {
		return false;
	}

	// query insert data
	$query = "INSERT INTO mahasiswa
				VALUES
				('','$nama','$nim','$email','$jurusan','$gambar')
				";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}
function upload() {

	$namafile = $_FILES['gambar']['name'];
	$ukuranfile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpname = $_FILES['gambar']['tmp_name'];

	//cek apakah tidak ada agambar yang diupload
	if ($error === 4) {
		# code...
		echo "<script>
				alert ('Silahkan Pilih Gambar Terlebih Dahulu');
			  </script>";
		return false;
	}

	//cek apakah yang diupload adalah gambar
	$extensigambarvalid = ['jpg','jpeg','png'];
	$extensigambar = explode('.', $namafile);
	$extensigambar = strtolower(end($extensigambar));
	if (!in_array($extensigambar, $extensigambarvalid)) {
		# code...
		echo "<script>
				alert ('Yang Anda Upload Bukan Gambar');
			  </script>";
		return false;
	}

	// cek jika ukuran gambar terlalu besar
	if ($ukuranfile > 1000000) {
		# code...
		echo "<script>
				alert ('Ukuran Gambar Terlalu Besar');
			  </script>";
		return false;
	}

	//lolos dari ketiga pengecekan, file diupload
	// generate nama gambar baru

	$namafilebaru = uniqid();
	$namafilebaru .= '.';
	$namafilebaru .= $extensigambar;

	move_uploaded_file($tmpname, 'img/uploaded/' . $namafilebaru);
	return $namafilebaru;
}

function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function ubah($data) {
	global $conn;

	//ambil data dari tiap elemen dalam form
	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$nim = htmlspecialchars($data["nim"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$gambarlama = htmlspecialchars($data["gambarlama"]);

	// cek apakah user pilih gambar baru atau tidak
	if ($_FILES['gambar']['error'] === 4) {
		# code...
		$gambar = $gambarlama;
	} else {
		$gambar = $upload();
	}
	// $gambar = htmlspecialchars($data["gambar"]);

	// query insert data
	$query = "UPDATE mahasiswa SET
				nama = '$nama',
				nim = '$nim',
				email = '$email',
				jurusan = '$jurusan',
				gambar = '$gambar'
				WHERE id = $id
				";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function cari($keyword) {
	$query = "SELECT * FROM mahasiswa
				WHERE
			  nama LIKE '%$keyword%' OR
			  nim LIKE '%$keyword%' OR
			  email LIKE '%$keyword%' OR
			  jurusan LIKE '%$keyword%'
			 ";
	return query($query);
}

function registrasi($data) {
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
	if (mysqli_fetch_assoc($result)) {
		# code...
		echo "<script>
				alert('Username Sudah Terdaftar!');
			</script>";
			return false;
	}
	// cek konfirmasi password
	if ( $password !== $password2 ) {
		# code...
		echo "<script>
				alert('Konfirmasi Password Tidak Sesuai');
			</script>";
		return false;
	}
	
	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);
	
	// var_dump($password); die;
	mysqli_query($conn, "INSERT INTO user VALUES ('','$username','$password')");
	return mysqli_affected_rows($conn);
}
?>