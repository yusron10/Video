// Ambil Element yang di butuhkan
var keyword = document.getElementById('keyword');
var tombolCari = document.getElementById('tombol-cari');
var container = document.getElementById('container');

// Tambahlan event ketika Keyword di tulis

keyword.addEventListener('keyup', function () {

	// Buat Object AJAX
	var xhr = new XMLHttpRequest();

	// Cek Kesiapan Ajax
	xhr.onreadystatechange = function() {
		if ( xhr.readyState == 4 && xhr.status == 200) {
			container.innerHTML = xhr.responseText;
		}
	}

	// eksekusi ajax
	xhr.open('GET', 'ajax/data.php?keyword=' +  keyword.value, true);
	xhr.send();
});