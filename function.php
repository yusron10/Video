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

 

 function tambah($data) {
 	global $db;
 	$judul = htmlspecialchars($data["judul"]);
 	$kategori = $data["kategori_id"];
 	$ytid = htmlspecialchars($data["yt_id"]);


 	// Upload Gambar

 	$gambar = upload();
 	if(!$gambar) {
 		return false;
 	}

 	// Query Insert

 	$query = "INSERT INTO isidata VALUES
 	('', '$kategori', '$judul', '$gambar', '$ytid')
 	";

 	mysqli_query($db, $query);

 	return mysqli_affected_rows ($db);
 }

 function upload() {
 	$namafile = $_FILES ['gambar']['name'];
 	$ukuranfile = $_FILES['gambar']['size'];
 	$error =$_FILES['gambar']['error'];
 	$tmpname = $_FILES['gambar']['tmp_name'];

 	// CEK UPLOAD GAMBAR

 	if ( $error === 4) {
 		echo "<script>
 		alert ('Pilih Gambar dulu ya :)');
 		</script>";

 		return false;
 	}

 	// Cek Apakah Yang di upload adalah gambar

 	$Eksigambarvalid = ['jpg','jpeg','png'];
 	$Eksigambar = explode('.', $namafile);
 	$Eksigambar = strtolower(end($Eksigambar));

 	if ( !in_array($Eksigambar, $Eksigambarvalid) ) {
 		 echo "<script>
 		alert ('Bukan Gambar');
 		</script>";

 		return false;
 	}

 	// CEK SIZE

 	if (  $ukuranfile > 3000000) {
 		echo "<script>
 		alert('Size terlalu Besar');
 		</script>";
 		return false;
 	}

 	// Jika LOLOS GENERATE NAMA BARU

 	$namafilebaru = uniqid();
 	$namafilebaru = '.';
 	$namafilebaru = $Eksigambar;
 	move_uploaded_file($tmpname, 'img/' . $namafilebaru);
 	return $namafilebaru;
 }

 function hapus($id) {
 	global $db;
 	mysqli_query($db, "DELETE FROM isidata WHERE id = $id");
 	return mysqli_affected_rows($db);
 }

 function ubah($data) {
 	global $db;
 	$id = $data["id"];
 	$kategori_id = htmlspecialchars($data["kategori_id"]);
 	$judul = htmlspecialchars($data["judul"]);
 	$gambarlama = htmlspecialchars($data["gambarlama"]);
 	
 	$yt_id = htmlspecialchars($data["yt_id"]);


 	// CEK apakah user Pilih gambar Baru

 	if ( $_FILES['gambar']['error'] === 4) {
 		$gambar = $gambarlama;
 	} else {
 		$gambar = upload();
 	}

 	// Query INSERT data

 	$query = "UPDATE isidata SET
 	kategori_id = '$kategori_id',
 	judul = '$judul',
 	gambar = '$gambar',
 	yt_id = '$yt_id'
 	WHERE id =$id
 	";

 	mysqli_query ($db, $query);

 	return mysqli_affected_rows ($db);
 }


 function cari($keyword) {
	$query = "SELECT * FROM isidata WHERE 
	judul LIKE '%$keyword%'
	";

	return query ($query);
}
 ?>