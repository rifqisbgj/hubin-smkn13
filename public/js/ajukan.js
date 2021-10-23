$(document).ready(function () {

	/*
	 * Menyesuaikan input NIS dengan kuota
	 */
	var form = $('#nis').clone();
	form.children('small').remove();
	form.children('input').removeAttr('value');
	form.children('input').prop('readonly', false);
	form.children('input').prop('required', false);
	form.children('input').attr('name', 'nis[]');

	$('#kuota').change(function () {
		var kuota = $(this).val() > 5
			? 5
			: $(this).val() <= 1
			? 0
			: $(this).val() - 1;

		$('#nisGroup').children().remove();

		for (kuota; kuota--; kuota > 1) {
			form.children('label').text(`NIS Siswa ${kuota + 1}`);

			$('#nisGroup').prepend('<div class="form-group mb-0 mt-2">' +
				form.html() +
				'</div>');
		}
	});

});
