<div class="uk-container uk-margin-bottom" id="content-wrapper">

	<div class="uk-margin-small-bottom">
		<h5 style="font-weight:500; color: #fefefe;">Halo, <strong><?= ucfirst($user_data->name) ?></strong></h5>
	</div>

	<div class="uk-grid-match uk-grid-small" uk-grid>
		<div class="uk-width-1-1 uk-width-1-3@m">
			<div class="uk-card uk-card-default uk-margin-small-bottom uk-box-shadow-small uk-border-rounded uk-card-small">
				<div class="uk-padding-small">
					<div class="uk-grid-match uk-flex-center uk-child-width-1-3 uk-child-width-1-3@m" uk-grid>
						<div>
							<a href="<?= site_url('user/jasa_antar') ?>" class="uk-link-reset uk-card uk-border-rounded uk-box-shadow-hover-small">
								<div class="uk-card-media-top uk-padding-small uk-text-center">
									<img src="<?= base_url('assets/img/package.png') ?>" class="uk-margin-small-bottom" alt="">
									<small class="uk-text-bold uk-margin-small-top">Jantar</small>
								</div>
							</a>
						</div>
						<div>
							<div class="uk-card uk-border-rounded uk-box-shadow-hover-small">
								<div class="uk-card-media-top uk-padding-small uk-text-center">
									<img src="<?= base_url('assets/img/shopping.png') ?>" class="uk-margin-small-bottom" alt="">
									<small class="uk-text-bold uk-margin-small-top">Jastip</small>
								</div>
							</div>
						</div>
						<div>
							<div class="uk-card uk-border-rounded uk-box-shadow-hover-small">
								<div class="uk-card-media-top uk-padding-small uk-text-center">
									<img src="<?= base_url('assets/img/cart.png') ?>" class="uk-margin-small-bottom" alt="">
									<small class="uk-text-bold uk-margin-small-top">Bimart</small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<a href="<?= site_url('user/riwayat-pesanan') ?>" class="uk-card uk-card-default uk-box-shadow-small uk-card-small uk-border-rounded uk-link-reset">
				<div class="uk-padding-small">
					<div class="uk-grid-small uk-flex-middle uk-flex-center" uk-grid>
						<div class="uk-width-auto">
							<img src="<?= base_url('assets/img/clock.png') ?>" width="20" alt="">
						</div>
						<div class="uk-width-expand">
							<h4 class="uk-text-meta uk-margin-remove-bottom">Riwayat Pesanan</h4>
						</div>
					</div>
				</div>
			</a>
		</div>

		<div class="uk-width-1-1 uk-width-2-3@m">
			<div class="uk-slider-container-offset" uk-slider="finite: true">

				<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">

					<ul class="uk-slider-items uk-child-width-1-1 uk-grid">
						<?php foreach ($banner as $key => $value) { ?>
							<li>
								<div class="uk-card uk-card-default">
									<div class="uk-card-media-top">
										<img style="width:100%" src="<?= base_url($value->image) ?>" alt="">
									</div>
								</div>
							</li>
						<?php } ?>
					</ul>

					<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
					<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

				</div>

				<!-- <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul> -->

			</div>
		</div>

		<div class="uk-width-1-1">
			<div class="uk-margin-small-top">
				<h5 style="font-weight:500;"><strong>Produk Tersedia</strong></h5>
			</div>
			<div class="uk-slider-container-offset" uk-slider="finite: true">

				<div class="uk-position-relative uk-visible-toggle" tabindex="-1">

					<ul class="uk-slider-items uk-child-width-1-6@m uk-child-width-1-2 uk-grid">
						<?php foreach ($product as $key => $value) { ?>
							<li>
								<div style="cursor: pointer" onclick="location.href = '<?= site_url('user/product/' . rtrim(base64_encode($value->id_product), '=')) ?>';" class="uk-card uk-card-default uk-card-small uk-border-rounded">
									<div class="uk-card-badge badge-warning uk-label">Baru</div>
									<div class="uk-card-media-top">
										<img src="<?= $value->image ?>" alt="">
									</div>
									<div style="padding: 10px;">
										<h6 class="uk-margin-remove-bottom"><?= $value->product_name ?></h6>
										<p class="uk-text-bold uk-text-small uk-margin-small uk-margin-remove-top">
											Rp. <?= number_format($value->price, 0, ',', '.') ?>
										</p>
										<small class="uk-text-meta"><?= $value->merchant_name ?></small>
									</div>
								</div>
							</li>
						<?php } ?>
					</ul>

					<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
					<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

				</div>

				<!-- <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul> -->

			</div>
		</div>


		<div class="uk-width-1-1" hidden>
			<div class="uk-slider-container-offset" uk-slider="finite: true">

				<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">

					<ul class="uk-slider-items uk-child-width-1-4@m uk-child-width-1-2 uk-grid">
						<?php foreach ($product as $key => $value) { ?>
							<li>
								<div class="uk-card uk-card-default">
									<div class="uk-card-media-top">
										<img src="https://images.tokopedia.net/img/cache/1208/NsjrJu/2022/4/6/776d1093-700e-4a96-955b-eb22ab6cdc91.jpg.webp?ect=3g" alt="">
									</div>
								</div>
							</li>
						<?php } ?>
					</ul>

					<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
					<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>

				</div>

				<!-- <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul> -->

			</div>
		</div>
	</div>

</div>
