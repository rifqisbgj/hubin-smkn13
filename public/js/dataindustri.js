/* 
 * Script ini untuk mendapatkan data sebuah industri dan menampilkan
 * ke modal bootstrap
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

		$.post('industri/' + id, function (industri) {
			// Mendapatkan array jurusan
			let jurusanlist = industri.jurusan.split(',');

			// Matikan semua checkbox dan aktifkan yang ada dalam array
			$('.industriJurusan').prop('checked', false);
			jurusanlist.forEach((jurusan) => {
				$(`.industriJurusan[value="${jurusan}"]`).prop('checked', true);
			});

			$('#industriModal').modal('show');
			$('#modalTitle').html('Informasi ' + industri.nama);
			$('#industriId').val(industri.id);
			$('#industriNama').val(industri.nama);
			$('#industriBidang').val(industri.bidang);
			$('#industriKontak').val(industri.kontak);
			$('#industriAlamat').val(industri.alamat);
			// $('#industriJurusan').val(industri.jurusan);
			$('#industriKuota').val(industri.kuota);
			$('#industriTahun').val(industri.tahun);
		});

	});

}); 
