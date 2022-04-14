var globalurl = window.location.href;
globalurl = globalurl.split('/');
globalurl.pop();
globalurl = globalurl.join('/');

$(document).ready(function () {
	var transaction = $('#transaction').DataTable({
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		'responsive': true,
		'searching': true,
		'ajax': {
			'url': globalurl + '/get-transaction',
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
					var html = '<span class="badge rounded-pill bg-primary">Jasa Antar</span>';
					if (data.service == 2) {
						var html = '<span class="badge rounded-pill bg-success">Jasa Titip</span>';
					} else if (data.service == 3) {
						var html = '<span class="badge rounded-pill bg-warning text-white">Bimart</span>';
					}
					return html;
				}
			},
			{
				data: 'name'
			},
			// {
			// 	data: null,
			// 	render: function (data, type, full, meta) {
			// 		var ret = '<span class="badge rounded-pill bg-danger text-white">Express</span>';
			// 		if (data.service_type == 1) {
			// 			ret = '<span class="badge rounded-pill bg-info text-white">Reguler</span>';
			// 		}

			// 		return ret;
			// 	}
			// },
			{
				data: null,
				render: function (data, type, full, meta) {
					var ret = '<span class="badge rounded-pill bg-secondary text-white">' + data.payment + '</span>';

					return ret;
				}
			},
			{
				data: null,
				render: function (data, type, full, meta) {
					var ret = '<span class="badge rounded-pill bg-warning">unpaid</span>';
					if (data.payment == 1) {
						ret = '<span class="badge rounded-pill bg-success">paid</span>';
					} else if (data.payment == 2) {
						ret = '<span class="badge rounded-pill bg-danger">expired</span>';
					}

					return ret;
				}
			},
			{
				data: 'created_at'
			},
			{
				data: null,
				orderable: false,
				render: function (data, type, full, meta) {
					var btn = '<a href="' + globalurl + '/transaction-detail/' + data.id_transaction + '" class="btn btn-sm bg-gradient-primary">detail</a>';
					return btn;
				}
			}
		]
	});
});
