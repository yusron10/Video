<?php 

 if(isset($_GET['watch'])){
        $yt_id= $_GET['watch'];
    }
    else {
        die ("LOL");    
    }
    include "function.php";
    $query = mysqli_query($db, "SELECT * FROM isidata WHERE yt_id='$yt_id'");
    $r = mysqli_fetch_array($query);
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
	<h1><?php echo $r ["judul"] ?></h1>
	<iframe width="853" height="480" src="https://www.youtube.com/embed/<?php echo $r["yt_id"] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</body>
</html>