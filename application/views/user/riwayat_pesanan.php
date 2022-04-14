<div class="uk-container uk-margin-bottom" id="content-wrapper">

	<div class="uk-card uk-card-default">
		<div class="uk-card-body">
			<h4 class="uk-card-title">Riwayat Pesanan</h4>
			<table class="uk-table">
				<?php foreach ($pesanan as $key => $value) { ?>
					<tr>
						<td width="5%">
							<?php
							$src = '';
							switch ($value->service) {
								case 1:
									$src = 'package.png';
									break;

								case 2:
									$src = 'cart.png';
									break;

								case 3:
									$src = 'shopping.png';
									break;
							}
							?>

							<img src="<?= base_url('assets/img/' . $src) ?>" width="35px;" alt="">
						</td>
						<td>
							<?php if ($value->service_type == 1) { ?>
								<span class="uk-label">Reguler</span>
							<?php } else if ($value->service_type == 2) { ?>
								<span class="uk-label uk-label-danger">Express</span>
							<?php } ?>
							<br>
							<?php
							switch ($value->service) {
								case 1:
									echo 'Layanan Jasa Antar Barang';
									break;

								case 2:
									echo 'Layanan Jasa Titip Barang';
									break;

								case 3:
									echo 'Pembelian Produk BIMART';
									break;
							} ?>
						</td>
						<td>
							<p class="uk-text-meta uk-margin-remove-bottom">Tanggal Pesan :</p>
							<small><?= date('d M Y, H:i', strtotime($value->created_at)) ?></small>
						</td>
						<td class="uk-text-middle">
							<?php if ($value->status == 0) { ?>
								<span class="uk-label uk-label-danger"><?= ($value->payment == 'COD') ? 'COD' : 'UNPAID' ?></span>
							<?php } else if ($value->status == 1) { ?>
								<span class="uk-label uk-label-primary">PAID</span>
							<?php } else { ?>
								<span class="uk-label uk-label-secondary">EXPIRED</span>
							<?php } ?>
						</td>
						<td>
							<p class="uk-text-meta uk-margin-remove-bottom">Shipment :</p>
							<span class="uk-label">
								<?php
								switch ($value->shipment_status) {
									case 1:
										echo 'Pick up';
										break;

									case 2:
										echo 'on delivery';
										break;

									case 3:
										echo 'delivered';
										break;

									default:
										echo '-';
								} ?>
							</span>
						</td>
						<td width="10%">
							<a href="<?= site_url('user/invoice/' . rtrim(base64_encode($value->id_transaction), '=')) ?>" class="uk-button uk-button-default">Detail</a>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>

</div>
