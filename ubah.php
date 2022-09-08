<?php 
session_start();

if ( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

// Ambil Data Dari URL
$id = $_GET["id"];


// query Data Berdasarkan ID

$d = query("SELECT * FROM isidata WHERE id = $id")[0];

if( isset($_POST ["submit"]) ) {
	if ( ubah($_POST) > 0) {
		echo "<script>
		alert('DATA BERHASIL di ubah');
		document.location.href = 'index.php';
		</script>";
	} else {
		echo "Data GAGAL";
	}
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>EDIT DATA</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<h1>EDIT DATA</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $d["id"]; ?>">
		<input type="hidden" name="gambarlama" value="<?php echo $d["gambar"]; ?>">

		<ul>
			<li>
				<label for="judul">Judul : </label>
				<input type="text" name="judul" id="judul" required value="<?php echo $d["judul"]; ?>">
			</li>
			<br>

			<li>
				<label for="kategori_id">Kategori :</label>
				<input type="text" name="kategori_id" id="kategori_id" readonly value="<?php echo $d["kategori_id"] ?>">
			</li>

			<br>

			<li>

				<label for="yt_id">ID YOUTUBE : </label>
				<input type="text" name="yt_id" id="yt_id" readonly value="<?php echo $d["yt_id"] ?>">
			</li>

			<br>

			<li>
				<label for="gambar">Gambar : </label>
				<br>
				<br>
				<img src="img/<?= $d['gambar']; ?>" width="100">
				<br>

				<br>
				<input type="file" name="gambar" id="gambar">
			</li>

			<br>

			<li>
				<button type="submit" name="submit">Simpan</button>
			</li>
		</ul>
	</form>
</body>
</html>
