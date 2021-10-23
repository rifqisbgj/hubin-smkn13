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
		if ($(this).val() === '') {
			$('#siswaTabel tr').show();
			return;
		}

		let cari = $(this).val().toLowerCase().trim().match(/\w+|"[^"]+"|'[^']+'/g);

		$('#siswaTabel tr').each(function () {
			let siswa = $(this).text().toLowerCase();
			let cocok = false;

			cari.forEach(function (keyword) {
				keyword = keyword.replace(/\'\"/g, '');
				if (siswa.indexOf(keyword) > -1) cocok = true;
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
