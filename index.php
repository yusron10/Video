<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

// Page

$JDataPer = 15;
$jumlahdata = count(query("SELECT * FROM isidata"));
$jumlahHalaman = ceil($jumlahdata / $JDataPer);
$halAktif = (isset($_GET["halaman"]) ) ? $_GET ["halaman"] : 1;

$awaldata = ($JDataPer * $halAktif) - $JDataPer;


$datach = query("SELECT * FROM isidata LIMIT $awaldata, $JDataPer");


if( isset($_POST["cari"]) ) {
	$datach = cari($_POST["keyword"]);
}

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
	<input type="text" name="keyword"placeholder="Hayo Liat apa.." size="40" autofocus autocomplete="off" id="keyword">
	<button type="submit" name="cari" id="tombol-cari">Cari</button>
</form>

<br>
<br>
<!-- NAGASI -->

<?php if($halAktif > 1) : ?>
		<a href="?halaman=<?php echo $halAktif - 1;?>">&laquo;</a>

	<?php endif; ?>

	<?php for ($i=1; $i <= $jumlahHalaman ; $i++) : ?>
		<?php if ($i == $halAktif) : ?>
			<a href="?halaman=?<?php echo $i; ?>" style="font-weight: bold;color: red;"><?php echo $i; ?></a>

			<?php else : ?>

				<a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
<?php endif; ?>
<?php endfor; ?>

<?php if($halAktif < $jumlahHalaman) : ?>
	<a href="?halaman=<?php echo $halAktif + 1; ?>">&raquo;</a>
<?php endif; ?>
<br>
<div id="container">
	<table border="1" cellpadding="10" cellspacing="0">
	<tr>
		<th>No.</th>
		<th>Gambar</th>
		<th>Judul</th>
		<th>Kategori</th>
		<th>Aksi</th>
	</tr>
	<?php $i = 1; ?>
	<?php foreach ($datach as $d) : ?>

	<tr>
		<td><?php echo $i; ?></td>
		<td><img src="img/<?php echo $d["gambar"]; ?>" width="50" alt=""></a></td>
		<td><?php echo $d["judul"] ?></td>
		<td><?php echo $d["kategori_id"] ?></td>
		<td>
			<a href="ubah.php?id= <?= $d["id"];?>">Ubah</a>
			<a href="hapus.php?id= <?= $d["id"];?>">Delete</a>
			<a href="nonton.php?yt_id=<?php echo $d["yt_id"] ?>">Tonton</a>
		</td>
	</tr>
	<?php $i++; ?>
<?php endforeach; ?>
	</table>
	</div>
	<script src="js/script.js"></script>
	<br>
<div>
	<button><a href="create.php">Tambah</button></a>
	<button><a href="logout.php">Logout</a></button>
</div>
	

</body>
</html>