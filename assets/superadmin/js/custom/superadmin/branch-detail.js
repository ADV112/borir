var url = window.location.href;
url = url.split('/');
url.pop();
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
	var dt = $('table#admin').DataTable({
		dom: '<"row"<"col-md-4 mt-3"B><"col-md-4 mt-3"f><"col-md-4 addButton"><"col-12 mb-3"rt><"col-md-4"i><"col-md-8 d-flex justify-content-end"p>>',
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
		'responsive': false,
		'searching': true,
		'ajax': {
			'url': url + '/get-admin',
			'data': function (d) {
				d._token = $('input[name=_token]').val();
				d.branch_code = $('input[name=branch]').val();
			}
		},
		'columns': [{
				data: null,
				render: function (data, type, full, meta) {
					return meta.row + 1;
				}
			},
			{
				data: 'name'
			},
			{
				data: 'username'
			},
			{
				data: 'phone_number'
			},
			{
				data: null,
				render: function (data, type, full, meta) {
					var html =
						'<button type="button" class="btn bg-gradient-danger btn-sm px-3 px-2 delete">' +
						'<i class="fa fa-trash"></i>' +
						'</button>';

					return html;
				}
			}
		],
	});

	var cr = $('table#courier').DataTable({
		dom: '<"row"<"col-md-4 mt-3"B><"col-md-4 mt-3"f><"col-md-4 addCourierButton"><"col-12 mb-3"rt><"col-md-4"i><"col-md-8 d-flex justify-content-end"p>>',
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
		'responsive': false,
		'searching': true,
		'ajax': {
			'url': url + '/get-courier',
			'data': function (d) {
				d._token = $('input[name=_token]').val();
				d.branch_code = $('input[name=branch]').val();
			}
		},
		'columns': [{
				data: null,
				render: function (data, type, full, meta) {
					return meta.row + 1;
				}
			},
			{
				data: 'name'
			},
			{
				data: 'email'
			},
			{
				data: 'phone_number'
			},
			{
				data: null,
				render: function (data, type, full, meta) {
					var html =
						'<button type="button" class="btn bg-gradient-danger btn-sm px-3 px-2 deleteAdmin">' +
						'<i class="fa fa-trash"></i>' +
						'</button>';

					return html;
				}
			}
		],
	});

	$('.addButton').append('<a href="#exampleModal" data-bs-toggle="modal" class="btn btn-sm mt-3 float-end bg-gradient-primary"><i class="fas fa-plus"></i> Add New</a>');
	$('.moving-tab .nav-link.active').addClass("bg-gradient-primary text-white")

	$('.addCourierButton').append('<a href="#exampleCourierModal" data-bs-toggle="modal" class="btn btn-sm mt-3 float-end bg-gradient-primary"><i class="fas fa-plus"></i> Add New</a>');


	$('#createTryOut').click(function () {
		$('#createForm').submit();
	});

	$('#createForm').submit(function (e) {
		e.preventDefault();
		if (check_form('#createForm')) {
			var form = $(this).serialize();
			$.ajax({
				url: url + '/create-admin',
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

	$('#createCourier').click(function () {
		$('#createCourierForm').submit();
	});

	$('#createCourierForm').submit(function (e) {
		e.preventDefault();
		if (check_form('#createCourierForm')) {
			var form = $(this).serialize();
			$.ajax({
				url: url + '/create-courier',
				type: 'POST',
				data: {
					form: form,
					_token: $('input[name=_token]').val()
				},
				success: function (res) {
					res = JSON.parse(res);
					if (res.status) {
						dt.ajax.reload();
						$('#createCourierForm').trigger('reset');
						$('#exampleCourierModal').modal('toggle');
						toastr.success("Successfully Added Data");
					}
				}
			});
		}
	});

	cr.on('click', '.deleteAdmin', function () {
		var id = cr.row($(this).parents('tr')).data();
		$('#deleteAdminHidden').val(id.id_courier);
		$('#deleteAdminModal').modal('toggle');
	});

	$('#deleteAdmin-submit').click(function () {
		$.ajax({
			url: url + '/delete-courier',
			type: 'POST',
			data: {
				username: $('#deleteAdminHidden').val(),
				_token: $('input[name=_token]').val()
			},
			success: function (res) {
				res = JSON.parse(res);
				if (res.status) {
					cr.ajax.reload();
					$('#deleteAdminModal').modal('toggle');
					toastr.success("Successfully Deleting Data");
				}
			}
		});
	});
});
