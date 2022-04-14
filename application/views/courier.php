<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Brorir</title>
	<link rel="stylesheet" href="<?= base_url('assets/css/uikit.min.css') ?>">
	<style>
		html,
		body {
			background: url('https://getuikit.com/images/section-background.svg') 50% 17vh no-repeat, linear-gradient(to left top, #28a5f5, #1e87f0) 0 0 no-repeat;
			background-size: contain;
			min-height: 695px;
		}

		.uk-card {
			background-color: #EEEEEE;
			position: absolute;
			bottom: 0;
			/* justify-content: center; */
			/* min-height: 65%; */
			border-radius: 2rem 2rem 0 0;
		}

		/* .uk-card-body {
			padding: 15px 30px;
		} */

		.uk-button-light {
			background-color: #FAFAFA;
		}
	</style>
</head>

<body>
	<div class="uk-flex uk-flex-center">
		<img src="<?= base_url('assets/img/logo.png') ?>" width="150" alt="">

		<div class="uk-card uk-card-default uk-card-small uk-width-1-1 uk-width-1-3@s">
			<div class="uk-card-body">
				<?= form_open('courier/update-order') ?>
				<input type="hidden" name="id" value="<?= $id ?>">
				<h3 class="uk-card-title uk-text-center">
					<?php
					switch ($transaction->service) {
						case 1:
							echo 'Layanan Jasa Antar Barang';
							break;

						case 2:
							echo 'Layanan Jasa Titip Barang';
							break;

						case 3:
							echo 'Pembelian Produk BIMART';
							break;
					} ?><br>
					<?php if ($transaction->service_type == 1) { ?>
						<span class="uk-label uk-label-warning">Reguler</span>
					<?php } else { ?>
						<span class="uk-label uk-label-danger">Express</span>
					<?php } ?>
				</h3>
				<table class="uk-table">
					<tr>
						<td>Pengirim
						</td>
						<td>:
						</td>
						<td><?= $transaction->name ?>
						</td>
					</tr>
					<tr>
						<td>Kontak
						</td>
						<td>:</td>
						<td><?= $transaction->phone_number ?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><?= $alamat_pengirim ?></td>
					</tr>
				</table>

				<div class="uk-margin-top uk-margin-large-bottom uk-text-center">
					<?php if ($transaction->shipment_status == 0) { ?>
						<input type="hidden" name="status" value="1">
						<button type="submit" class="uk-button uk-button-primary uk-width-expand">Ambil Barang</button>
					<?php } else if ($transaction->shipment_status == 1) { ?>
						<input type="hidden" name="status" value="2">
						<button type="submit" class="uk-button uk-button-primary uk-width-expand">Mulai Pengantaran</button>
					<?php } else { ?>

					<?php } ?>
				</div>

				<?= form_close() ?>
			</div>
		</div>
	</div>

	<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/uikit.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/uikit-icons.min.js') ?>"></script>

</html>
