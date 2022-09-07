<?php 
session_start();

if (isset($_SESSION["login"]) ) {
	header("Location: index.php");
	exit;
}
require 'function.php';

if (isset($_POST["login"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];

	$cek = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");

		// Check username
	if (mysqli_num_rows($cek) === 1) {

			// Check password
		$row = mysqli_fetch_assoc($cek);
		if (password_verify($password, $row["password"]) ) {

				// Set SESSION
			$_SESSION["login"] = true;
			header("Location: index.php");
			exit;
		}
	}
	$error = true;
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<h1>Login</h1>
	<?php if(isset($error)) : ?>
		<p style="color: red; font-style: italic;">Ada yang salah Silahkan Di Cek Sendiri </p>
	<?php endif ?>
	<form action="" method="post">
		<ul>
			<li>
				<label for="username">Username</label>
				<input type="text" name="username" id="username">
			</li>
			<br>
			<li><label for="password">Password</label>
				<input type="password" name="password" id="password">
			</li>
			<br>
			<a href="register.php">Register Now!!</a>
			<br>
			<br>
			<li>
				<button type="submit" name="login">Login</button>
			</li>

		</ul>
	</form>
</body>
</html>