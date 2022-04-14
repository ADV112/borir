<div class="uk-container uk-margin-bottom" id="content-wrapper">
	<div class="uk-margin-small-bottom">
		<h4 style="font-weight:500; color: #fefefe;">Jasa Pengiriman Barang</h4>
	</div>
	<div class="uk-grid-small" uk-grid>
		<div class="uk-width-expand">
			<div class="uk-card uk-card-default uk-card-small uk-border-rounded uk-box-shadow-small">
				<div class="uk-card-body">
					<?= form_open('') ?>
					<ul class="uk-subnav uk-subnav-pill" id="swicther" uk-switcher="animation: uk-animation-fade">
						<li><a href="#">Data Pengirim</a></li>
						<li><a href="#">Data Penerima</a></li>
					</ul>

					<ul class="uk-switcher uk-margin">
						<li>
							<div class="uk-alert-danger" uk-alert>
								<strong>NB:</strong> Pengantaran minimal 2 Alamat
							</div>
							<div class="uk-grid-small" uk-grid>
								<div class="uk-width-1-1 uk-width-1-2@m">
									<label for="">Nama Pengirim</label>
									<input type="text" value="<?= $user_data->name ?>" class="uk-input" readonly>
								</div>
								<div class="uk-width-1-1 uk-width-1-2@m">
									<label for="">Email</label>
									<input type="text" value="<?= $user_data->username ?>" class="uk-input" readonly>
								</div>
								<div class="uk-width-1-1 uk-width-1-2@m">
									<label for="">Nomor HP</label>
									<input type="text" id="phone_number" value="<?= $user_data->phone_number ?>" class="uk-input">
								</div>
							</div>
							<hr>
							<div class="uk-grid-small" id="alamat-pengirim" uk-grid>
								<div class="uk-width-1-1 uk-width-1-2@m">
									<label for="">Provinsi</label>
									<select id="province" class="uk-select">
										<option value="">Pilih Provinsi</option>
										<?php foreach ($province as $key => $value) { ?>
											<option value="<?= $value->prov_id ?>"><?= ucwords(strtolower($value->prov_name)) ?></option>
										<?php } ?>
									</select>
								</div>

								<div class="uk-width-1-1 uk-width-1-2@m">
									<label for="">Kabupaten / Kota</label>
									<select id="city" class="uk-select" disabled>
										<option value="">Pilih Kabupaten / Kota</option>
									</select>
								</div>

								<div class="uk-width-1-1 uk-width-1-2@m">
									<label for="">Kecamatan</label>
									<select id="district" class="uk-select" disabled>
										<option value="">Pilih Kecamatan</option>
									</select>
								</div>

								<div class="uk-width-1-1 uk-width-1-2@m">
									<label for="">Kelurahan</label>
									<select id="subdistrict" class="uk-select" disabled>
										<option value="">Pilih kelurahan</option>
									</select>
								</div>

								<div class="uk-width-1-1">
									<label for="">Alamat</label>
									<textarea id="alamat" placeholder="Alamat" id="" cols="30" rows="10" class="uk-textarea"></textarea>
								</div>
							</div>
							<div class="uk-text-right uk-margin-small-top">
								<button type="button" onclick="UIkit.switcher('#swicther').show(1);" class="uk-button uk-button-primary" id="nextPengirim">Selanjutnya</button>
							</div>
						</li>
						<li>
							<div class="uk-alert-danger" uk-alert>
								<strong>NB:</strong> Pengantaran minimal 2 Alamat
							</div>
							<div class="uk-margin-bottom" id="penerima-container">

							</div>
							<button type="button" class="uk-button uk-button-primary uk-width-expand uk-text-bolder" uk-toggle="target: #modal-example"> Tambah Penerima</button>
							<div class="uk-text-right uk-margin-small-top">
								<button type="button" onclick="UIkit.switcher('#swicther').show(0);" class="uk-button uk-button-default" id="nextPengirim">Sebelumnya</button>
							</div>
						</li>
					</ul>
					<?= form_close() ?>
				</div>
			</div>
		</div>

		<div class="uk-width-1-1 uk-width-1-3@m">
			<div class="uk-card uk-card-small uk-card-default">
				<div class="uk-card-body">
					<legend class="uk-legend">Detail Tagihan</legend>
					<?= form_open('user/create-payment-jantar', ['id' => 'tagihan-form']) ?>
					<input type="hidden" name="order_count" value="0">
					<input type="hidden" value="<?= $user_data->name ?>" name="nama_pengirim">
					<input type="hidden" value="<?= $user_data->username ?>" name="email">
					<input type="hidden" value="<?= $user_data->phone_number ?>" name="phone_number">
					<div class="uk-margin">
						<label for="">Layanan</label>
						<select name="layanan" class="uk-select">
							<option>Pilih Layanan</option>
							<option value="Reguler">Reguler</option>
							<option value="Express">Express</option>
						</select>
					</div>
					<div class="uk-margin">
						<label for="">Metode Pembayaran</label>
						<select name="metode" id="metode" class="uk-select">
							<option value="">Plih Metode Pembayaran</option>
							<option value="COD">COD</option>
							<?php foreach ($payment_channel['data'] as $key => $value) { ?>
								<option value="<?= $value['code'] ?>"><?= $value['name'] ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="uk-margin">
						<button type="button" id="bayar" class="uk-button uk-button-primary uk-width-expand">lakukan pembayaran</button>
					</div>
					<?= form_close('') ?>
					<button class="uk-button uk-button-default demo uk-hidden" id="warning" type="button" onclick="UIkit.notification({message: 'Minimal 2 Alamat Pengantaran', status: 'danger'})">Danger</button>
				</div>
			</div>

			<div class="uk-alert-warning" uk-alert>
				<h4>Catatan:</h4>
				<ul>
					<li>Pengiriman dilakukan pada hari pemesanan jika pemesanan dilakukan di bawah pukul 20.00 WIB</li>
					<li>Untuk layanan Reguler akan dikenakan biaya Rp 10.000,- (belum termasuk pajak)</li>
					<li>Untuk layanan Express akan dikenakan biaya Rp 15.000,- (belum termasuk pajak)</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div id="modal-example" uk-modal>
	<div class="uk-modal-dialog uk-modal-body">
		<h2 class="uk-modal-title">Tambah Penerima</h2>
		<form id="penerima-form">
			<div class="uk-margin">
				<label for="">Jenis Barang</label>
				<input type="text" name="jenis_barang" class="uk-input" placeholder="Jenis Barang">
			</div>
			<div class="uk-margin">
				<label for="">Nama Penerima</label>
				<input type="text" name="nama_penerima" class="uk-input" placeholder="Nama Penerima">
			</div>

			<div class="uk-margin">
				<label for="">Kontak Penerima</label>
				<input type="text" name="kontak_penerima" class="uk-input" placeholder="Kontak Penerima">
			</div>

			<div class="uk-margin">
				<label for="">Alamat Penerima</label>
				<textarea name="alamat_penerima" id="" cols="30" rows="10" class="uk-textarea" placeholder="Alamat Penerima"></textarea>
			</div>
		</form>

		<p class="uk-text-right">
			<button class="uk-button uk-button-default uk-modal-close" type="button">Batal</button>
			<button class="uk-button uk-button-primary uk-modal-close" id="tambah-penerima" type="button">Tambah</button>
		</p>
	</div>
</div>
