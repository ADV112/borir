<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
	<div class="sidenav-header">
		<i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
		<a class="navbar-brand m-0" href="<?= site_url('superadmin') ?>">
			<img src="<?= base_url('assets/superadmin/img/logo-ct.png') ?>" class="navbar-brand-img h-100" alt="main_logo">
			<span class="ms-1 font-weight-bold">Courier App</span>
		</a>
	</div>
	<hr class="horizontal dark mt-0">
	<div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="<?= site_url('superadmin') ?>">
					<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
						<i class="fas fa-home"></i>
					</div>
					<span class="nav-link-text ms-1">Dashboard</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= site_url('superadmin/branch') ?>">
					<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
						<i class="fa-solid fa-building"></i>
					</div>
					<span class="nav-link-text ms-1">Branch</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= site_url('superadmin/merchant') ?>">
					<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
						<i class="fa-solid fa-user"></i>
					</div>
					<span class="nav-link-text ms-1">Merchant</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= site_url('superadmin/product') ?>">
					<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
						<i class="fa-solid fa-shop"></i>
					</div>
					<span class="nav-link-text ms-1">Product Management</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= site_url('superadmin/transaction') ?>">
					<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
						<i class="fa-solid fa-bank"></i>
					</div>
					<span class="nav-link-text ms-1">Transaction</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= site_url('superadmin/content') ?>">
					<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
						<i class="fa-solid fa-file-circle-exclamation"></i>
					</div>
					<span class="nav-link-text ms-1">Content Management</span>
				</a>
			</li>
		</ul>
	</div>
</aside>
