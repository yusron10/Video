<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';
$datac = query("SELECT * FROM kategori");
if( isset($_POST["submit"]) ) {
	if ( tambah($_POST) > 0) {
		 echo "<script>
		alert('data berhasil di tambahkan');
		document.location.href = 'index.php';
		</script>";
	} else {
		echo "data Gagal";
	}
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Tambah Data</title>
 	<link rel="stylesheet" href="">
 </head>
 <body>
 	<h1>Tambah Data</h1>
 	<form action="" method="post" enctype="multipart/form-data">
 		
 		<ul>
 			<li>
 				<label for="judul">Judul : </label>
 				<input type="text" name="judul" id="judul" required>
 			</li>
 			<br>
 			<li>
 				<label for="kategori_id">Kategori : </label>
 				<select name="kategori_id" id="kategori_id">
 					<?php foreach ($datac as $k) : ?>
 					<option value="<?php echo $k["nama"] ?>"><?php echo $k["nama"] ?></option>
 				<?php endforeach; ?>
 				</select>
 			</li>
 			<br>
 			<li>
 				<label for="gambar">Gambar : </label>
 				<input type="file" name="gambar" id="gambar">
 			</li>

 			<br>

 			<li>
 				<label for="yt_id">ID YOUTUBE : </label>
 				<input type="text" name="yt_id" id="yt_id">
 			</li>

 			<br>

 			<li>
 				<button type="submit" name="submit">Create Data</button>
 			</li>
 		</ul>
 	</form>
 </body>
 </html>
