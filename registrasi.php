<?php 
require 'functions.php';
 
if (isset($_POST["register"])) {
	# code...
	if (registrasi($_POST) > 0) {
		# code...
		
		echo "<script>
				alert('User Baru Berhasil Ditambahkan!');
			</script>";

	} else {
		echo mysqli_error($conn);
	}
}

 ?>
 <!DOCTYPE html>
<html>
<head>
	<title>Halaman Registrasi</title>
	<style>
		label	{
			display: block;
		}
	</style>
</head>
<body>

<h1>Halaman Registrasi</h1>

<form action="" method="post">
	
	<ul>
		<li>
			<label for="username">username :</label>
			<input type="text" name="username" id="username">
		</li>
		<li>
			<label for="password">password :</label>
			<input type="password" name="password" id="password">
		</li>
		<li>
			<label for="password2">konfirmasi password :</label>
			<input type="password" name="password2" id="password2">
		</li><br>
			<button type="submit" name="register">Sign Up</button>
			<button><a href="login.php">Halaman Login</a></button>
		</ul>

</form>

</body>
</html>