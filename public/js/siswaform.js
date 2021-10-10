/*
 * Script ini buat ganti pilihan kelas ketika pilihan jurusan diganti
 * @returns void
 */
$(document).ready(function() {
	$('#jurusan').change(function () {
		var akhir = 0;

		switch($('#jurusan').val()) {
			case 'AK':
				akhir = 5;
				break;
			case 'RPL':
				akhir = 1;
				break;
			case 'TKJ':
				akhir = 2;
				break;
		}

		$('#kelas').children().each((i, pilihan) => {
			if (i <= akhir) {
				$(pilihan).prop('hidden', false);
			} else {
				$(pilihan).prop('hidden', true);
			}
		});
	});
});
