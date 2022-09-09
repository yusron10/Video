<?php 
require '../function.php';
$keyword = $_GET["keyword"];
$query = "SELECT * FROM isidata WHERE 
judul LIKE '%$keyword%' OR 
kategori_id LIKE '%$keyword%'
";
$isidata = query($query);


?>

<table border="1" cellpadding="10" cellspacing="0">
	<tr>
		<th>No.</th>
		<th>Gambar</th>
		<th>Judul</th>
		<th>Kategori</th>
		<th>Aksi</th>
	</tr>
	<?php $i = 1; ?>
	<?php foreach ($isidata as $d) : ?>

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