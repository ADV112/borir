var url = window.location.href;
url = url.split('/');
url.pop();
url = url.join('/');

function check_form(form) {
	var checker = true;

	$.each($('form' + form + ' .form-control'), function (k, v) {
		if ($(this).val() == '') {
			var string = $(this).parent().find('label').html();
			toastr.error(string.charAt(0).toUpperCase() + string.slice(1) + ' is required');
			checker = false;
		}
	});

	return checker;
}

$(document).ready(function () {
	$('select#select2').select2({
		dropdownParent: "#exampleModal",
	});

	// CRUD CONTROL START
	var dt = $('table').DataTable({
		dom: '<"row"<"col-md-4 mt-3"B><"col-md-2 filterButton text-center mt-3"><"col-md-4 mt-3"f><"col-md-2 mt-3 addButton"><"col-12 mb-3"rt><"col-md-4"i><"col-md-8 d-flex justify-content-end"p>>',
		language: {
			"paginate": {
				"next": '<i class="fa fa-angle-right">',
				"previous": '<i class="fa fa-angle-left">',
			},
			"search": ""
		},
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		'responsive': true,
		'searching': true,
		'ajax': {
			'url': url + '/get-merchant',
			'data': function (d) {
				d._token = $('input[name=_token]').val();
			}
		},
		'columns': [{
				data: 'id_merchant'
			},
			{
				data: 'merchant_name'
			},
			{
				data: null,
				orderable: false,
				render: function (data, type, full, meta) {
					return data.address + ', ' + data.subdis_name + ', ' + data.dis_name + ',' + data.city_name + ', ' + data.prov_name;
				}
			},
			{
				data: 'phone_number'
			},
			{
				data: null,
				orderable: false,
				render: function (data, type, full, meta) {
					var btn = '<button type="button" class="btn btn-sm bg-gradient-danger delete"><i class="fa fa-trash"></i></button>';
					return btn;
				}
			}
		],
		"columnDefs": [{
			"width": "20%",
			"targets": 2
		}]
	});

	$(".addButton").html('<button type="button" class="btn bg-gradient-primary mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus"></i> Create New</button>');
	$(".filterButton").html('<button type="button" class="btn bg-gradient-primary mt-2" data-bs-toggle="modal" data-bs-target="#filterModal"><i class="fas fa-filter"></i> Filter</button>');
	$('#DataTables_Table_0_wrapper > div > div.col-md-4 > div').addClass('btn-sm');
	$('#DataTables_Table_0_filter > label > input').removeClass('form-control-sm').addClass("w-100").attr('placeholder', 'Search').parent().addClass('w-100');

	$('#createTryOut').click(function () {
		$('#createForm').submit();
	});

	$('#createForm').submit(function (e) {
		e.preventDefault();
		if (check_form('#createForm')) {
			var form = $(this).serialize();
			$.ajax({
				url: url + '/add-merchant',
				type: 'POST',
				data: {
					form: form,
					_token: $('input[name=_token]').val()
				},
				success: function (res) {
					res = JSON.parse(res);
					if (res.status) {
						dt.ajax.reload();
						$('#createForm').trigger('reset');
						$('#exampleModal').modal('toggle');
						toastr.success("Successfully Added Data");
					}
				}
			});
		}
	});

	dt.on('click', '.delete', function () {
		var id = dt.row($(this).parents('tr')).data();
		$('#deleteHidden').val(id.id_merchant);
		$('#deleteModal').modal('toggle');
	});

	$('#delete-submit').click(function () {
		$.ajax({
			url: url + '/delete-merchant',
			type: 'POST',
			data: {
				id: $('#deleteHidden').val(),
				_token: $('input[name=_token]').val()
			},
			success: function (res) {
				res = JSON.parse(res);
				if (res.status) {
					dt.ajax.reload();
					$('#deleteModal').modal('toggle');
					toastr.success("Successfully Deleting Data");
				}
			}
		});
	});

	// CRUD CONTROL END

	// GLOBAL GETTER START
	$('select[name=province]').change(function () {
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
					$('select[name=city]').empty().append('<option value="" selected disabled>Choose City</option>');
					$.each(res, function (k, v) {
						$('select[name=city]').append('<option value="' + v.city_id + '">' + v.city_name + '</option>');
					})

					$('select[name=city]').prop('disabled', false).select2({
						dropdownParent: "#exampleModal"
					});
				}
			});

		}
	});

	$('select[name=city]').change(function () {
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
					$('select[name=district]').empty().append('<option value="" selected disabled>Choose District</option>');
					$.each(res, function (k, v) {
						$('select[name=district]').append('<option value="' + v.dis_id + '">' + v.dis_name + '</option>');
					})

					$('select[name=district]').prop('disabled', false).select2({
						dropdownParent: "#exampleModal"
					});
				}
			});

		}
	});

	$('select[name=district]').change(function () {
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
					$('select[name=subdistrict]').empty().append('<option value="" selected disabled>Choose Subdistrict</option>');
					$.each(res, function (k, v) {
						$('select[name=subdistrict]').append('<option value="' + v.subdis_id + '">' + v.subdis_name + '</option>');
					})

					$('select[name=subdistrict]').prop('disabled', false).select2({
						dropdownParent: "#exampleModal"
					});
				}
			});

		}
	});
	// GLOBAL GETTER END
});
