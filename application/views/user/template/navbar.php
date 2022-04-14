<div class="wrapper">
	<!-- <div id="offcanvas-usage" uk-offcanvas="overlay: true">
		<div class="uk-offcanvas-bar uk-flex uk-flex-column">

			<ul class="uk-nav uk-nav-primary uk-nav-center uk-margin-auto-vertical">
				<li class="uk-active"><a href="#">Active</a></li>
				<li class="uk-parent">
					<a href="#">Parent</a>
					<ul class="uk-nav-sub">
						<li><a href="#">Sub item</a></li>
						<li><a href="#">Sub item</a></li>
					</ul>
				</li>
				<li class="uk-nav-header">Header</li>
				<li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: table"></span> Item</a></li>
				<li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Item</a></li>
				<li class="uk-nav-divider"></li>
				<li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: trash"></span> Item</a></li>
			</ul>

		</div>
	</div> -->

	<div class="header">
		<div class="header-start uk-flex uk-flex-center">
			<img src="<?= base_url('assets/img/logo.png') ?>" width="75px" alt="">
		</div>
		<nav class="uk-navbar-container" uk-navbar>
			<div class="uk-navbar-left">
				<div class="uk-navbar-item">
					<form action="javascript:void(0)">
						<div class="uk-inline">
							<span class="uk-form-icon" uk-icon="icon: search"></span>
							<input class="uk-input uk-form-small uk-form-width-custom uk-border-pill" type="text">
						</div>
					</form>
				</div>
			</div>

			<div class="uk-navbar-right">
				<div class="uk-navbar-item">
					<ul class="uk-iconnav">
						<li>
							<a href="<?= site_url('user') ?>" uk-icon="icon: home"></a>
						</li>
						<li>
							<span class="uk-badge notif-badge" style="display:none">2</span>
							<a href="javascript:void(0);" uk-icon="icon: bell"></a>
							<div class="uk-border-rounded" uk-dropdown="pos: bottom-left; mode: click">
								<ul class="uk-nav uk-dropdown-nav">
									<li>
										<a href="<?= site_url('user') ?>" class="uk-justify-content-between"><span uk-icon="icon: user"></span> Profile</a>
									</li>
								</ul>
							</div>
						</li>
						<li>
							<span class="uk-badge cart-badge" style="display:none">1</span>
							<a uk-icon="icon: cart"></a>
						</li>
						<li>
							<a href="javascript:void(0);" uk-icon="icon: user"></a>
							<div uk-dropdown="pos: bottom-justify; mode: click">
								<ul class="uk-nav uk-dropdown-nav">
									<li>
										<a href="<?= site_url('user') ?>" class="uk-justify-content-between"><span uk-icon="icon: user"></span> Profile</a>
									</li>
									<li class="uk-nav-divider"></li>
									<li><a href="<?= site_url('logout') ?>"><span uk-icon="icon: sign-out"></span> Sign Out</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
