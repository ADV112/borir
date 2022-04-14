$(document).ready(function () {
	$('.select2').select2();
	var phone = $('#phone').val();
	var text = $('#text-to-send').html();

	$('#kirim').attr('href', 'https://wa.me/' + phone + '?text=' + text);
});
