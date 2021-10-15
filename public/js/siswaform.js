/*
 * Script ini buat ganti pilihan kelas ketika pilihan jurusan diganti
 * @returns void
 */
$(document).ready(function() {
	// Cek jurusan setelah form tampil
	cekJurusan()
	// Cek jurusan ketika jurusan terganti
	$('#jurusan').change(cekJurusan);
});

function cekJurusan() {
	var akhir = 0;

	switch($('#jurusan').val()) {
		case 'AK': akhir = 5;	break;
		case 'RPL': akhir = 1; break;
		case 'TKJ': akhir = 2; break;
	}

	$('#kelas').children().each((i, pilihan) => {
		if (i <= akhir) {
			$(pilihan).prop('hidden', false);
		} else {
			$(pilihan).prop('hidden', true);
		}
	});
}
