<div class="uk-container uk-margin-bottom" id="content-wrapper">
	<div uk-grid>
		<div class="uk-width-expand">
			<div class="uk-card uk-card-default uk-card-small">
				<div class="uk-card-body">
					<?php

					$status = 'uk-label-danger';
					if ($transaction->payment != 'COD') {
						if ($invoice['data']['status'] == 'paid') {
							$status = 'uk-label-success';
						} else {
							$status = 'uk-label-warning';
						}
					} else {
						$stat = 'UNPAID';
						if ($transaction->status == 1) {
							$stat = 'PAID';
							$status = 'uk-label-success';
						} else if ($transaction->status == 2) {
							$stat = 'EXPIRED';
							$status = 'uk-label-danger';
						}
					}
					?>
					<div class="uk-card-badge uk-label uk-label-large <?= $status ?>"><?= ($transaction->payment != 'COD') ? $invoice['data']['status'] : $stat ?></div>
					<h4 class="uk-card-title">Detail Transaksi</h4>
					<table class="uk-table uk-table-divider uk-table-middle uk-text-small">
						<thead>
							<tr>
								<th colspan="3">Data Pengirim</th>
							</tr>
						</thead>
						<tbody>
							<?php $amount = 0;
							if ($transaction->service == 1) { ?>
								<tr>
									<td>Nama Pengirim</td>
									<td>:</td>
									<td><?= $user_data->name ?></td>
								</tr>
								<tr>
									<td>Email Pengirim</td>
									<td>:</td>
									<td><?= $username ?></td>
								</tr>
								<tr>
									<td>Kontak Pengirim</td>
									<td>:</td>
									<td><?= $user_data->phone_number ?></td>
								</tr>
								<tr>
									<td>Alamat Pengirim</td>
									<td>:</td>
									<td><?= $alamat_pengirim ?></td>
								</tr>
								<?php

								$no = 0;
								foreach ($transaction_detail as $key => $value) {
									$item = explode(';', $value->detail);
								?>
									<tr>
										<td colspan="3" class="uk-background-muted"></td>
									</tr>
									<tr>
										<th colspan="3">Data Penerima <?= ++$no ?></th>
									</tr>
									<tr>
										<td>Jenis Barang</td>
										<td>:</td>
										<td>
											<?= $item[2] ?>
										</td>
									</tr>
									<tr>
										<td>Nama Penerima</td>
										<td>:</td>
										<td><?= $item[0] ?></td>
									</tr>
									<tr>
										<td>Kontak Penerima</td>
										<td>:</td>
										<td><?= $item[1] ?></td>
									</tr>
									<tr>
										<td>Alamat Penerima</td>
										<td>:</td>
										<td><?= $item[3] ?></td>
									</tr>
								<?php }
							} else if ($transaction->service == 2) { ?>
								<tr>
									<td>Nama Pengirim</td>
									<td>:</td>
									<td colspan="3"><?= $user_data->name ?></td>
								</tr>
								<tr>
									<td>Email Pengirim</td>
									<td>:</td>
									<td colspan="3"><?= $username ?></td>
								</tr>
								<tr>
									<td>Kontak Pengirim</td>
									<td>:</td>
									<td colspan="3"><?= $user_data->phone_number ?></td>
								</tr>
								<tr>
									<td>Alamat Pengirim</td>
									<td>:</td>
									<td colspan="3"><?= $alamat_pengirim ?></td>
								</tr>
								<tr>
									<td colspan="5" class="uk-background-muted"></td>
								</tr>
								<tr>
									<th colspan="5">Data Pembelian Barang</th>
								</tr>
								<tr>
									<td>#</td>
									<td>Jenis Barang</td>
									<td>Jumlah Barang</td>
									<td>Harga per Barang</td>
									<td>Total Barang</td>
								</tr>
								<?php

								// $no = 0;
								foreach ($transaction_detail as $key => $value) {
									$item = explode(';', $value->detail);
									$amount += $item[1] * $item[2];
								?>
									<tr>
										<td><?= $key + 1 ?></td>
										<td><?= $item[0] ?></td>
										<td><?= $item[2] ?></td>
										<td>Rp. <?= number_format($item[1], 0, ',', '.') ?></td>
										<td>Rp. <?= number_format($item[1] * $item[2], 0, ',', '.') ?></td>
									</tr>
							<?php }
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="uk-width-1-3@m">
			<div class="uk-card uk-card-default uk-card-small">
				<div class="uk-card-body">
					<h4 class="uk-card-title">Detail Tagihan</h4>
					<table class="uk-table uk-table-striped uk-text-small">
						<thead>
							<tr class="uk-text-center">
								<th>deskripsi</th>
								<th>harga</th>
							</tr>
						</thead>
						<tbody>
							<?php  ?>

							<?php ?>
							<tr>
								<td>Jasa Antar <strong><?= ($transaction->service_type == 1) ? 'Reguler' : 'Express' ?></strong></td>
								<td class="uk-text-right">Rp. <?= ($transaction->service_type == 1) ? number_format(10000, 0, ',', '.') : number_format(15000, 0, ',', '.') ?></td>
							</tr>
							<tr>
								<td>Biaya Layanan</td>
								<td class="uk-text-right">
									Rp. <?= number_format($invoice['data']['total_fee'], 0, ',', '.') ?>
								</td>
							</tr>
							<tr>
								<td class="uk-text-bold">Total</td>
								<td class="uk-text-right uk-text-bold">
									Rp. <?= ($transaction->service_type == 1) ? number_format(10000 + $amount + $invoice['data']['total_fee'], 0, ',', '.') : number_format(15000 + $amount + $invoice['data']['total_fee'], 0, ',', '.') ?>
								</td>
							</tr>
							<tr>
								<td>Metode Bayar</td>
								<td class="uk-text-right"><?= $transaction->payment ?></td>
							</tr>
						</tbody>
					</table>
					<div>
						<?php
						if ($transaction->payment != 'COD') {
						?>
							<a href="<?= $invoice['data']['checkout_url'] ?>" target="_blank" class="uk-button uk-button-primary uk-width-expand">Bayar Di sini</a>
						<?php } else { ?>
							<div class="uk-alert-warning uk-text-center" uk-alert>
								<p>
									Silahkan Bayar setelah kurir sampai ke tempat tujuan
								</p>
							</div>

						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
