$(document).ready(function() {
	// Cek parameter get
	const url = new URLSearchParams(window.location.search);

	// Simpan data dalam tabel untuk dicari
	const tabel = $('#cariTabel tr');
	const data = {};
	$(tabel).each(function (i) {
		data[i] = $(this).text().toLowerCase()
			.replaceAll('\n', '').replaceAll('  ', '');
	});

	function cari() {
		if ($('#cari').val() === '') {
			$('#cariTabel tr').show();
			return;
		}

		const cari = $('#cari').val().toLowerCase().trim();
		const regex = new RegExp(cari, "g")

		for (let index in data) {
			if (data[index].match(regex)) {
				$(tabel).eq(index).toggle(true);
			} else {
				$(tabel).eq(index).toggle(false);
			}
		}
	}

	$('#cari').on('keyup', cari);

	if (url.has('cari')) {
		cari();
	}
});
