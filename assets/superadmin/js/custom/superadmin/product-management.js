var globalurl = window.location.href;
globalurl = globalurl.split('/');
globalurl.pop();
globalurl = globalurl.join('/');

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
	$('.select2').select2({
		dropdownParent: "#exampleModal",
	})

	var product = $('#product').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		'responsive': true,
		'searching': true,
		'ajax': {
			'url': globalurl + '/get-product',
			'data': function (d) {
				d._token = $('input[name=_token]').val();
			}
		},
		dom: '<"row"<"col-md-4 mt-3"B><"col-md-6 mt-3"f><"col-md-2 mt-3 addButton"><"col-12 mb-3"rt><"col-md-4"i><"col-md-8 d-flex justify-content-end"p>>',
		language: {
			"paginate": {
				"next": '<i class="fa fa-angle-right">',
				"previous": '<i class="fa fa-angle-left">',
			},
			"search": ""
		},
		'columns': [{
				data: null,
				render: function (data, type, full, meta) {
					return meta.row + 1;
				}
			},
			{
				data: null,
				orderable: false,
				render: function (data, type, full, meta) {
					var mainUrl = globalurl.split('/');
					mainUrl.pop();
					mainUrl = mainUrl.join('/');
					return '<img src="' + mainUrl + '/' + data.image + '" class="img-fluid w-50">';
				}
			},
			{
				data: 'product_name'
			},
			{
				data: null,
				render: function (data, type, full, meta) {
					return 'Rp. ' + data.price;
				}
			},
			{
				data: 'merchant_name'
			},
			{
				data: null,
				orderable: false,
				render: function (data, type, full, meta) {
					var btn = '<button type="button" class="btn px-3 py-2 btn-sm bg-gradient-danger delete"><i class="fa fa-trash"></i></button>';
					return btn;
				}
			}
		]
	});

	$(".addButton").html('<button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus"></i> Create New</button>');
	$('#product_filter > label > input').removeClass('form-control-sm').addClass("w-100").attr('placeholder', 'Search').parent().addClass('w-100');

	$('#createTryOut').click(function () {
		$('#addProduct').submit();
	});

	$('#addProduct').submit(function (e) {
		e.preventDefault();
		if (check_form('#addProduct')) {
			var form = $(this).serialize();
			$.ajax({
				url: globalurl + '/add-product',
				type: 'POST',
				data: {
					form: form,
					file_path: $('input[name=file_path]').val(),
					_token: $('input[name=_token]').val()
				},
				success: function (res) {
					res = JSON.parse(res);
					if (res.status) {
						product.ajax.reload();
						$('#addProduct').trigger('reset');
						$('#exampleModal').modal('toggle');
						toastr.success("Successfully Added Data");
					}
				}
			});
		}
	});

	product.on('click', '.delete', function () {
		var id = product.row($(this).parents('tr')).data();
		$('#deleteHidden').val(id.id_product);
		$('#deleteModal').modal('toggle');
	});

	$('#delete-submit').click(function () {
		$.ajax({
			url: globalurl + '/delete-product',
			type: 'POST',
			data: {
				id: $('#deleteHidden').val(),
				_token: $('input[name=_token]').val()
			},
			success: function (res) {
				res = JSON.parse(res);
				if (res.status) {
					product.ajax.reload();
					$('#deleteModal').modal('toggle');
					toastr.success("Successfully Deleting Data");
				}
			}
		});
	});


	Simditor.locale = 'en-US';
	var editor = new Simditor({
		textarea: $('#desc'),
	});

	// CROPPER START
	var $modal = $('#modal');
	var image = document.getElementById('sample_image');
	var cropper;

	$('#upload_image').click(function () {
		$(this).val('');
	});

	$('#upload_image').change(function (event) {
		var files = event.target.files;
		var done = function (url) {
			image.src = url;
			$modal.modal('show');
		};

		if (files && files.length > 0) {
			reader = new FileReader();
			reader.onload = function (event) {
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
		}
	});

	$modal.on('shown.bs.modal', function () {
		cropper = new Cropper(image, {
			aspectRatio: 1,
			viewMode: 1,
			preview: '.preview'
		});
	}).on('hidden.bs.modal', function () {
		cropper.destroy();
		cropper = null;
	});

	$('#crop').click(function () {
		canvas = cropper.getCroppedCanvas({
			width: 800,
			height: 200
		});

		canvas.toBlob(function (blob) {
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function () {
				var base64data = reader.result;
				$.ajax({
					url: globalurl + '/upload-product',
					method: 'POST',
					data: {
						image: base64data,
						_token: $('input[name=_token]').val(),
						file_path: $('input[name=file_path').val()
					},
					success: function (data) {
						$modal.modal('hide');
						var mainUrl = globalurl.split('/');
						mainUrl.pop();
						mainUrl = mainUrl.join('/');
						$('input[name=file_path]').val(data);
						$('#uploaded_image').attr('src', mainUrl + '/' + data);
					}
				});
			};
		});
	});
});
