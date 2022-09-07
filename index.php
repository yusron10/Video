<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';
$datach = query("SELECT * FROM isidata");
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Home</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<h1>Data</h1>
<form action="" method="post">
	<input type="text" placeholder="Hayo Liat apa..">
</form>
<br>
	<table border="1" cellpadding="10" cellspacing="0">
	<tr>
		<th>No.</th>
		<th>Gambar</th>
		<th>Judul</th>
		<th>Kategori</th>
	</tr>
	<?php $i = 1; ?>
	<?php foreach ($datach as $d) : ?>

	<tr>
		<td><?php echo $i; ?></td>
		<td> <a href="nonton.php?watch=<?php echo $d ["yt_id"] ?>"><img src="img/ex1.jpg" width="50" alt=""></a></td>
		<td><?php echo $d["judul"] ?></td>
		<td><?php echo $d["kategori_id"] ?></td>
	</tr>
	<?php $i++; ?>
<?php endforeach; ?>
	</table>

	

</body>
</html>