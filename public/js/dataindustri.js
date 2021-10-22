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
			$('#industriId').val(data.industri.id);
			$('#industriNama').val(data.industri.nama);
			$('#industriBidang').val(data.industri.bidang);
			$('#industriKontak').val(data.industri.kontak);
			$('#industriAlamat').val(data.industri.alamat);
			$('#industriKuota').val(data.industri.kuota);
			$('#industriTahun').val(data.industri.tahun);
			$('#industriNamaPem').val(data.industri.nama_pembimbing);
			$('#industriNIPPem').val(data.industri.nip_pembimbing);

			// Menyesuaikan baris input catatan dengan jumlah baris jika ada catatan
			if (data.industri.catatan) {
				let baris = data.industri.catatan.match(/\n/)
					? data.industri.catatan.match(/\n/g).length + 1
					: 2;
				$('#industriCatatan').val(data.industri.catatan);
				$('#industriCatatan').attr('rows', baris);
			} else {
				$('#industriCatatan').val('');
				$('#industriCatatan').attr('rows', 2);
			}

			// Jika ada data pengaju maka industri adalah ajuan
			if (data.pengaju) {
				$('#industriPengaju').val(data.industri.nis_pengaju);
				$('#industriPengajuTeks').html(`Diajukan oleh ${data.pengaju.nama} (${data.pengaju.nis})`);
				$('#industriStatus').html('Gunakan input dibawah untuk mengalihkan status industri');
				$('#industriTerimaAjuan').prop('disabled', false);
				$('#industriTerimaAjuan').prop('checked', data.industri.status);
			} else {
				$('#industriPengaju').val('');
				$('#industriPengajuTeks').html('Industri ini dari sekolah');
				$('#industriStatus').html('');
				$('#industriTerimaAjuan').prop('disabled', true);
				$('#industriTerimaAjuan').prop('checked', true);
			}

			$('#industriNama').focus();
		});

	});

	/* 
	 * Validasi form
	 * TODO: Highlight input jurusan dan ganti alert
	 */
	$('#tambahIndustriSubmit').click(function () {
		if (!$('#tambahIndustri input[name="jurusan[]"]').filter(':checked').length) {
			$('#tambahIndustri .form-group').eq(4).css('border', 'red 1px solid');
			alert("Harap isi minimal 1 jurusan!");
			return false;
		}
	});

	$('#editIndustriSubmit').click(function () {
		if (!$('#editIndustri input[name="jurusan[]"]').filter(':checked').length) {
			alert("Harap isi minimal 1 jurusan!");
			return false;
		}
	});

	/*
	 * Fitur cari industri
	 */
	$('#industriCari').on('keyup', function () {
		let cari = $(this).val().toLowerCase().trim().split(' ');

		$('#industriTabel tr').each(function () {
			let industri = $(this).text().toLowerCase();
			let cocok = false;

			cari.forEach(function (i) {
				if (industri.indexOf(i) > -1) cocok = true;
			});

			$(this).toggle(cocok);
		});
	});

}); 
