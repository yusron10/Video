<?php
 // Koneksi 
 $db = mysqli_connect("localhost", "root", "" , "datach");

 function query($query) {
 	global $db;
 	$result = mysqli_query($db, $query);
 	$rows = [];
 	while( $row = mysqli_fetch_assoc ($result) )
 	{
 		$rows [] = $row;
 	}
 	return $rows;
 } 

 function register($data) {
 	global $db;
 	$username = strtolower(stripcslashes($data["username"]));
 	$password = mysqli_real_escape_string($db, $data["password"]);
 	$password2 = mysqli_real_escape_string($db, $data["password2"]);

 	// Check username ada atau tidak
 	$cek = mysqli_query($db, "SELECT username FROM user WHERE username = '$username'");
 	if ( mysqli_fetch_assoc($cek) ) {
 		echo "<script>
 		alert ('Username Sudah Terdaftar')</script>";
 		return false;
 	}

 	// Cek Konfirmasi password
 	if ($password !== $password2) {
 		
 		echo "<script>
 		alert('Password GK SAMA !! ')
 		</script>";
 		return false;
 	}

 	// enkripsi Password

 	$password = password_hash($password, PASSWORD_DEFAULT);

 	// Tambah User baru

 	mysqli_query($db, "INSERT INTO user VALUES('', '$username', '$password')");
 	return mysqli_affected_rows($db);

 }
 ?>