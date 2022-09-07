<?php 
require 'function.php';
$datach = query("SELECT * FROM isidata")
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Nonton</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<h1>Contoh</h1>
	<?php foreach ($datach as $d ) : ?>
	<iframe width="853" height="480" src="https://www.youtube.com/embed/<?php echo $d["yt_id"] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?php endforeach; ?>
</body>
</html>