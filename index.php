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


// $datach = query("SELECT * FROM isidata LIMIT $awaldata, $JDataPer");


if( isset($_POST["cari"]) ) {
	$datach = cari($_POST["keyword"]);
}

if ( isset($_GET["cari-kategori"])) {
	$kategori = $_GET["kategori"];

	$output = query("SELECT * FROM isidata WHERE kategori_id = '$kategori'");
} else {

	$output = query("SELECT * FROM isidata LIMIT $awaldata, $JDataPer");

}
$data = $output;

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Home</title>

	<style>
		.loader {
			width: 30px;
			position: absolute;
			top: 110;
			left: 320;
			z-index: 1;
			display: none;
			
		}
	</style>
	<script src="js/jquery-3.6.1.min.js"></script>
	<script src="js/script.js"></script>
	<link rel="stylesheet" href="">
</head>
<body>
	<h1>Data</h1>
	<form action="" method="post">
		<input type="text" name="keyword" placeholder="Hayo Liat apa.." size="40" autofocus autocomplete="off" id="keyword">
		<button type="submit" name="cari" id="tombol-cari">Cari</button>
		<img src="load/loader.gif" class="loader">
	</form>

	<br>
	<br>

	<form action="" method="get">
		<ul>
			<li>
				<label for="kategori">Cari Kategori</label>
				<input type="text" name="kategori" id="kategori">
			</li>
			<li>
				<button type="submit" name="cari-kategori">Filter</button>
			</li>
		</ul>
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
				
				<?php foreach ($data as $d) : ?>

					<tr>
						<td><?php echo $i; ?></td>
						<td><img src="img/<?php echo $d["gambar"]; ?>" width="50" alt=""></a></td>
						<td><?php echo $d["judul"] ?></td>
						<td><?php echo $d["kategori_id"] ?></td>
						<td>

							<?php 
							 ?>
							<a href="ubah.php?id=<?= $d["id"] ?>">Ubah</a>
							<a href="hapus.php?id= <?= $d["id"];?>">Delete</a>
							<a href="nonton.php?watch=<?php echo $d["yt_id"] ?>">Tonton</a>
						</td>
					</tr>
					<?php $i++; ?>
				<?php endforeach; ?>
			</table>
			<br>
				<button><a href="create.php">Tambah</button></a>
				<button><a href="logout.php">Logout</a></button>
			
			<br>
		</div>


	</body>
	</html>