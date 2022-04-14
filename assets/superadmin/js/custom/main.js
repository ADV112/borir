$(document).ready(function () {
	$.each($('a.nav-link'), function (k, v) {
		$(this).removeClass('active');
		if ($(this).attr('href') == window.location.href) {
			$(this).addClass('active');
		} else if (window.location.href.includes('branch') && $(this).attr('href').includes('branch')) {
			$(this).addClass('active');
		} else if (window.location.href.includes('transaction') && $(this).attr('href').includes('transaction')) {
			$(this).addClass('active');
		}
	});
});
