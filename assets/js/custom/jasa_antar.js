var url = window.location.href;
url = url.split('/');
url.pop();
url = url.join('/');

$(document).ready(function () {
	$('#phone_number').on('input', function () {
		$('input[name=phone_number]').val($(this).val());
	});

	$('#bayar').click(function () {
		if ($('input[name=order_count]').val() < 2) {
			$('#warning').trigger('click');
		} else {
			$('#alamat-pengirim select').each(function (index, value) {
				$('input[name=' + $(this).attr('id') + '_pengirim]').remove();
				$('#tagihan-form').append('<input type="hidden" value="' + $(this).val() + '" name="' + $(this).attr('id') + '_pengirim"/>');
			});

			$('#tagihan-form').append('<input type="hidden" value="' + $('#alamat').val() + '" name="alamat_pengirim"/>')

			$('#tagihan-form').submit();

		}
	});

	$('#tambah-penerima').click(function () {
		var count = $('input[name=order_count]').val();
		$('input[name=order_count]').val(parseInt(count) + 1);
		var html = '<div class="uk-card uk-margin-small-bottom uk-card-small uk-card-default uk-box-shadow-small">' +
			'<div class="uk-card-body"><p>';

		$('#penerima-form input[type=text]').each(function (index, value) {
			$('#tagihan-form').append('<input type="hidden" id="' + $(this).attr('name') + count + '" name="' + $(this).attr('name') + '[]" value="' + $(this).val() + '"/>');
			if (index == 0) {
				html += '<span class="uk-label">' + $(this).val() + '</span><br><br>';
			} else {
				html += $(this).val();
			}

			if (index == 1) {
				html += ' [ '
			}
		});

		$('#tagihan-form').append('<input type="hidden" id="alamat' + count + '" name="alamat[]" value="' + $('#penerima-form textarea').val() + '"/>');

		html += ' ]</p><small class="uk-text-meta">' + $('#penerima-form textarea').val() +
			'</small>' +
			'</div>' +
			'<div class="uk-card-footer uk-text-right">' +
			'<button type="button" class="uk-button uk-button-danger uk-button-small hapus-alamat" id="' + count + '">Hapus Alamat</button>' +
			'</div>' +
			'</div>';

		$('#penerima-container').append(html);
		$('#penerima-form').trigger('reset');
	});

	$('#penerima-container').on('click', '.hapus-alamat', function () {
		$(this).parent().parent().remove();
		var order = $(this).attr('id');
		$('#penerima-form input').each(function (index, value) {
			$('#' + $(this).attr('name') + order).remove();
		});

		$('#alamat' + order).remove();

		var count = $('input[name=order_count]').val();
		$('input[name=order_count]').val(parseInt(count) - 1);

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
