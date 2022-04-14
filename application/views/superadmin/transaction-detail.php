<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Detail Transaksi</h5>
				<div class="table-responsive">
					<table class="table text-small">
						<thead>
							<tr>
								<th colspan="3">Data Pengirim</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Nama Pengirim</td>
								<td>:</td>
								<td><?= $transaction->name ?></td>
							</tr>
							<tr>
								<td>Email Pengirim</td>
								<td>:</td>
								<td><?= $username ?></td>
							</tr>
							<tr>
								<td>Kontak Pengirim</td>
								<td>:</td>
								<td><?= $transaction->phone_number ?></td>
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
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				<?= form_open('superadmin/pilih-kurir') ?>
				<input type="hidden" name="id_transaction" value="<?= $transaction->id_transaction ?>">
				<h5 class="card-title">Status Transaksi</h5>
				<div class="mb-3">
					<label for="">Metode Pembayaran</label>
					<input type="text" readonly class="form-control" value="<?= $transaction->payment ?>">
				</div>
				<div class="mb-3">
					<label for="">Status Pembayaran</label>
					<select name="" id="" class="form-control" disabled>
						<option value="0" <?php if ($transaction->status == 0) echo "selected"; ?>>Belum Dibayar</option>
						<option value="1" <?php if ($transaction->status == 1) echo "selected"; ?>>Sudah Dibayar</option>
						<option value="2" <?php if ($transaction->status == 2) echo "selected"; ?>>Kadaluarsa</option>
					</select>
				</div>
				<div class="mb-3">
					<?php
					$stat = '-';
					switch ($transaction->shipment_status) {
						case 1:
							$stat = 'Pick Up Barang';
							break;

						case 2:
							$stat = 'On Delivery';
							break;

						case 3:
							$stat = 'Delivered';
							break;

						default:
							# code...
							break;
					}

					?>
					<label for="">Status Pengiriman</label>
					<input type="text" value="<?= $stat ?>" disabled class="form-control">
				</div>
				<div class="mb-3">
					<label for="">Pilih Kurir</label>
					<select name="courier" id="" class="form-control select2">
						<option selected disabled>Pilih Kurir</option>
						<?php foreach ($kurir as $key => $value) { ?>
							<option value="<?= $value->id_courier ?>" <?php if ($transaction->courier == $value->id_courier) echo "selected"; ?>><?= $value->name ?></option>
						<?php } ?>
					</select>
				</div>
				<div>
					<?php if ($transaction->courier != 0) {
						$jasa = 'Jasa Antar';
						if ($transaction->service == 2) {
							$jasa = 'Jasa Titip';
						} else if ($transaction->service == 3) {
							$jasa = 'Bimart';
						}

						$ret = 'Express';
						if ($transaction->service_type == 1) {
							$ret = 'Reguler';
						}
					?>
						<input type="hidden" id="phone" value="<?= preg_replace('/0/', '+62', $courier->phone_number, 1) ?>">
						<textarea hidden id="text-to-send">
							*== Order <?= $jasa . ' ' . $ret ?>  ==*%0a
							Nama Pengirim: <?= $transaction->name ?>%0a
							Kontak Pengirim: <?= 'https://wa.me/' . preg_replace('/0/', '%2b62', $transaction->phone_number, 1) ?>%0a
							Alamat Pengirim:<?= $alamat_pengirim ?>%0a
							<?php

							$no = 0;
							foreach ($transaction_detail as $key => $value) {
								$item = explode(';', $value->detail);
							?>
							%0a
								
							*== Data Penerima <?= ++$no ?> ==* %0a
							Jenis Barang: <?= $item[2] ?> %0a
							Nama Penerima: <?= $item[0] ?> %0a
							Kontak Penerima: <?= 'https://wa.me/' . preg_replace('/0/', '%2b62', $item[1], 1) ?> %0a
							Alamat Penerima: <?= $item[3] ?> %0a%0a

							Link pengiriman <?= base_url('courier/index/' . rtrim(base64_encode($transaction->id_transaction), '=')) ?>
							<?php
							}
							?>
						</textarea>
						<a href="" id="kirim" target="_blank" class="btn bg-gradient-success w-100">Kirim Pesan ke Kurir</a>
					<?php } ?>
					<button type="submit" class="btn bg-gradient-primary w-100">Simpan</button>
				</div>
				<?= form_close() ?>
			</div>
		</div>
	</div>
</div>
