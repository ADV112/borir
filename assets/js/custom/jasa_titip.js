var url = window.location.href;
url = url.split('/');
url.pop();
url = url.join('/');

$(document).ready(function () {
	var count = 0;
	$('#tambah-penerima').click(function () {
		count += 1;

		var html = '<div class="uk-width-1-3@m">' +
			'<div class="uk-card uk-card-default uk-card-small uk-margin-small-bottom uk-box-shadow-small">' +
			'<div class="uk-card-body">';

		$('#penerima-form input').each(function (index, value) {
			$('#tagihan-form').append('<input type="hidden" id="' + $(this).attr('name') + count + '" name="' + $(this).attr('name') + '[]" value="' + $(this).val() + '"/>');
		});

		html += '<span class="uk-label">Rp. ' + $('input[name=harga_barang]').val() + '</span>';
		html += '<p class="uk-text-bold uk-margin-small-top">' + $('input[name=jenis_barang]').val() + '</p>';

		html += '</div>' +
			'<div class="uk-card-footer">' +
			'<button type="button" class="uk-button uk-button-danger uk-button-small hapus-alamat uk-width-expand" id="' + count + '">Hapus Barang</button>' +
			'</div>' +
			'</div>';

		$('#item-container').append(html);
		$('#penerima-form').trigger('reset');
	});

	$('#bayar').click(function () {
		// if ($('input[name=order_count]').val() < 2) {
		// 	$('#warning').trigger('click');
		// } else {
		$('#alamat-pengirim select').each(function (index, value) {
			$('input[name=' + $(this).attr('id') + '_pengirim]').remove();
			$('#tagihan-form').append('<input type="hidden" value="' + $(this).val() + '" name="' + $(this).attr('id') + '_pengirim"/>');
		});

		$('#tagihan-form').append('<input type="hidden" value="' + $('#alamat').val() + '" name="alamat_pengirim"/>')

		$('#tagihan-form').submit();

		// }
	});

	$('textarea#alamat_pembelian').on('input', function () {
		$('input[name=alamat_beli]').val($(this).val());
	});

	$('#item-container').on('click', '.hapus-alamat', function () {
		$(this).parent().parent().remove();
		var order = $(this).attr('id');
		$('#penerima-form input').each(function (index, value) {
			$('#' + $(this).attr('name') + order).remove();
		});

		count -= 1;
	});

	$('select#province').change(function () {
		if ($(this).val() != '') {
			var val = $(this).val();
			$.ajax({
				url: url + '/getCity',
				type: 'POST',
				data: {
					_token: $('input[name=_token]').val(),
					prov_id: val
				},
				success: function (res) {
					res = JSON.parse(res);
					$('select#city').empty().append('<option value="" selected disabled>Choose City</option>');
					$.each(res, function (k, v) {
						$('select#city').append('<option value="' + v.city_id + '">' + v.city_name + '</option>');
					})

					$('select#city').prop('disabled', false);
				}
			});
		}
	});

	$('select#city').change(function () {
		if ($(this).val() != '') {
			var val = $(this).val();
			$.ajax({
				url: url + '/getDistrict',
				type: 'POST',
				data: {
					_token: $('input[name=_token]').val(),
					city_id: val
				},
				success: function (res) {
					res = JSON.parse(res);
					$('select#district').empty().append('<option value="" selected disabled>Choose District</option>');
					$.each(res, function (k, v) {
						$('select#district').append('<option value="' + v.dis_id + '">' + v.dis_name + '</option>');
					})

					$('select#district').prop('disabled', false);
				}
			});

		}
	});

	$('select#district').change(function () {
		if ($(this).val() != '') {
			var val = $(this).val();
			$.ajax({
				url: url + '/getSubdistrict',
				type: 'POST',
				data: {
					_token: $('input[name=_token]').val(),
					dis_id: val
				},
				success: function (res) {
					res = JSON.parse(res);
					$('select#subdistrict').empty().append('<option value="" selected disabled>Choose Subdistrict</option>');
					$.each(res, function (k, v) {
						$('select#subdistrict').append('<option value="' + v.subdis_id + '">' + v.subdis_name + '</option>');
					})

					$('select#subdistrict').prop('disabled', false);
				}
			});

		}
	});
});
