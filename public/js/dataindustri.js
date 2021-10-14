/* 
 * Script ini digunakan untuk:
 * Mendapatkan data sebuah industri dan menampilkan ke modal bootstrap
 * Validasi form industri jurusan minimal ada satu
 * @returns void
 */
$(document).ready(function () {

	$('tr').on('click', function (event) {

		event.preventDefault();
		var id = $(this).data('id');

		$.ajaxSetup({
			headers:
			{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
		});

		$.post('industri/' + id, function (data) {
			// Mendapatkan array jurusan
			let jurusanlist = data.industri.jurusan.split(',');

			// Matikan semua checkbox dan aktifkan yang ada dalam array
			$('.industriJurusan').prop('checked', false);
			jurusanlist.forEach((jurusan) => {
				$(`.industriJurusan[value="${jurusan}"]`).prop('checked', true);
			});

			$('#industriModal').modal('show');
			$('#modalTitle').html('Informasi ' + data.industri.nama)
			$('#industriId').val(data.industri.id);
			$('#industriNama').val(data.industri.nama);
			$('#industriBidang').val(data.industri.bidang);
			$('#industriKontak').val(data.industri.kontak);
			$('#industriAlamat').val(data.industri.alamat);
			// $('#industriJurusan').val(data.industri.jurusan);
			$('#industriKuota').val(data.industri.kuota);
			$('#industriTahun').val(data.industri.tahun);

			if (data.pengaju) {
				$('#industriPengaju').html(`Diajukan oleh ${data.pengaju.nama} (${data.pengaju.nis})`);
			} else {
				$('#industriPengaju').html('');
			}

			$('#industriNama').focus();
		});

	});

	/* 
	 * Validasi form
	 * TODO: Highlight input jurusan dan ganti alert
	 */
	$('#tambahIndustriSubmit').click(function () {
		if (!$('#tambahIndustri input[type=checkbox]').filter(':checked').length) {
			$('#tambahIndustri .form-group').eq(4).css('border', 'red 1px solid');
			alert("Harap isi minimal 1 jurusan!");
			return false;
		}
	});

	$('#editIndustriSubmit').click(function () {
		if (!$('#editIndustri input[type=checkbox]').filter(':checked').length) {
			// $('#editIndustri .form-group').eq(4).css('border', 'red 1px solid');
			alert("Harap isi minimal 1 jurusan!");
			return false;
		}
	});

}); 
