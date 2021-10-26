// Generasi warna secara acak, namun tetap sama setiap saat
function getRandomColor() {
	const letters = '456789ABCDEF';
	const random = function () {
		Math.seed = ((Math.seed || 6) * 9301 + 49297) % 233280;
		return Math.seed / 233280 * 12;
	};
	var color = '';

	for (var i = 0; i < 6; i++) {
		color += letters[Math.floor(random())];
	}

	return color;
}

$(document).ready(function () {

	/*
	 * Generasi avatar untuk setiap industri
	 */
	$('tr').each((index, row) => {
		const nama = $('td', row).eq(1).html();
		const ui = 'https://ui-avatars.com/api/?rounded=true' +
			'&background=' + getRandomColor() +
			'&name=' + nama;

		$('.avatar', row).attr('src', ui);
	});
});
