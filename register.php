<?php
require 'function.php';
if (isset($_POST["register"]) ) {
 	
 	if (register($_POST) > 0) {
 		echo "<script>
 		alert ('udah berhasil gak usah maksa !!')</script>";
 	} else {
 		echo mysqli_error($db);
 	}
 } 
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Halaman Daftar</title>
 	<style>
 		label {
 			display: block;
 		}
 	</style>
 	<link rel="stylesheet" href="">
 </head>
 <body>
 	<h1>Halaman Daftar</h1>
 	<form action="" method="post">
 	<ul>
 		<li>
 			<label for="username">Username : </label>
 			<input type="text" name="username" id="username" autofocus>
 		</li>
 		<br>
 		<li>
 			<label for="passowrd">Password : </label>
 			<input type="password" name="password" id="password">
 		</li>
 		<li>
 			<label for="password2">Konfirmasi Password : </label>
 			<input type="password" name="password2" id="password2">
 		</li>
 		<br>
 		<li>
 			<button type="submit" name="register">Daftar</button>
 		</li>
 		
 	</ul>
 	</form>
 </body>
 </html>