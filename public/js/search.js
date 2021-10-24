$(document).ready(function() {
	// Simpan data dalam tabel untuk dicari
	const tabel = $('#cariTabel tr');
	const data = {};
	$(tabel).each(function (i) {
		data[i] = $(this).text().toLowerCase()
			.replaceAll('\n', '').replaceAll('  ', '');
	});

	$('#cari').on('keyup', function () {
		if ($(this).val() === '') {
			$('#cariTabel tr').show();
			return;
		}

		const cari = $(this).val().toLowerCase().trim();
		const regex = new RegExp(cari, "g")

		for (let index in data) {
			if (data[index].match(regex)) {
				$(tabel).eq(index).toggle(true);
			} else {
				$(tabel).eq(index).toggle(false);
			}
		}
	});
});
