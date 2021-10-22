/*
 * Script ini buat ganti pilihan kelas ketika pilihan jurusan diganti
 * @returns void
 */
$(document).ready(function() {
	// Cek jurusan setelah form tampil
	cekJurusan()
	// Cek jurusan ketika jurusan terganti
	$('#jurusan').change(cekJurusan);

	/*
	 * Fitur search siswa
	 */
	$('#siswaCari').on('keyup', function () {
		let cari = $(this).val().toLowerCase().trim().split(' ');

		$('#siswaTabel tr').each(function () {
			let siswa = $(this).text().toLowerCase();
			let cocok = false;

			cari.forEach(function (i) {
				if (siswa.indexOf(i) > -1) cocok = true;
			});

			$(this).toggle(cocok);
		});
	});

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

			if ($('#kelas').val() > i && i == akhir) {
				$(pilihan).prop('selected', true);
			}

		} else {
			$(pilihan).prop('hidden', true);
		}
	});
}
