<footer class="footer pt-3  ">
	<div class="container-fluid">
		<div class="row align-items-center justify-content-lg-between">
			<div class="col-lg-6 mb-lg-0 mb-4">
				<div class="copyright text-center text-sm text-muted text-lg-start">
					© <script>
						document.write(new Date().getFullYear())
					</script>,
					made with <i class="fa fa-heart"></i> by
					<a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
					for a better web.
				</div>
			</div>
			<div class="col-lg-6">
				<ul class="nav nav-footer justify-content-center justify-content-lg-end">
					<li class="nav-item">
						<a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
					</li>
					<li class="nav-item">
						<a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
					</li>
					<li class="nav-item">
						<a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
					</li>
					<li class="nav-item">
						<a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</footer>
</div>
</main>
<div class="fixed-plugin">
	<div class="card shadow-lg ">
		<div class="card-header pb-0 pt-3 ">
			<div class="float-start">
				<h5 class="mt-3 mb-0">Soft UI Configurator</h5>
				<p>See our dashboard options.</p>
			</div>
			<div class="float-end mt-4">
				<button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
					<i class="fa fa-close"></i>
				</button>
			</div>
			<!-- End Toggle Button -->
		</div>
		<hr class="horizontal dark my-1">
		<div class="card-body pt-sm-3 pt-0">
			<!-- Sidebar Backgrounds -->
			<div>
				<h6 class="mb-0">Sidebar Colors</h6>
			</div>
			<a href="javascript:void(0)" class="switch-trigger background-color">
				<div class="badge-colors my-2 text-start">
					<span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
					<span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
					<span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
					<span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
					<span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
					<span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
				</div>
			</a>
			<!-- Sidenav Type -->
			<div class="mt-3">
				<h6 class="mb-0">Sidenav Type</h6>
				<p class="text-sm">Choose between 2 different sidenav types.</p>
			</div>
			<div class="d-flex">
				<button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
				<button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
			</div>
			<p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
			<!-- Navbar Fixed -->
			<div class="mt-3">
				<h6 class="mb-0">Navbar Fixed</h6>
			</div>
			<div class="form-check form-switch ps-0">
				<input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url('assets/superadmin/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/superadmin/js/core/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/superadmin/js/core/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/superadmin/js/plugins/perfect-scrollbar.min.js') ?>"></script>
<script src="<?= base_url('assets/superadmin/js/plugins/smooth-scrollbar.min.js') ?>"></script>
<script src="<?= base_url('assets/superadmin/js/plugins/chartjs.min.js') ?>"></script>
<!-- <script src="<?= base_url('/assets/superadmin/select2/select2.min.js') ?>"></script> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="<?= base_url('assets/superadmin/js/button.js') ?>"></script>
<script src="<?= base_url('/assets/superadmin/DataTables/DataTables/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('/assets/superadmin/DataTables/DataTables/js/dataTables.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('/assets/superadmin/DataTables/Buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('/assets/superadmin/DataTables/Buttons/js/buttons.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('/assets/superadmin/DataTables/Buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('/assets/superadmin/DataTables/Buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('/assets/superadmin/DataTables/Responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('/assets/superadmin/DataTables/Responsive/js/responsive.bootstrap5.js') ?>"></script>
<script src="<?= base_url('/assets/cropperjs/cropper.min.js') ?>"></script>
<script src="<?= base_url('/assets/superadmin/toastr/toastr.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/simditor/js') ?>/module.js"></script>
<script type="text/javascript" src="<?= base_url('assets/simditor/js') ?>/hotkeys.js"></script>
<script type="text/javascript" src="<?= base_url('assets/simditor/js') ?>/uploader.js"></script>
<script type="text/javascript" src="<?= base_url('assets/simditor/js') ?>/simditor.js"></script>

<!-- CUSTOM JAVASCRIPT -->
<script src="<?= base_url('assets/superadmin/js/soft-ui-dashboard.min.js?v=1.0.5') ?>"></script>
<script src="<?= base_url('assets/superadmin/js/custom/main.js') ?>"></script>
<script src="<?= base_url('assets/superadmin/js/custom/superadmin/' . $content . '.js') ?>"></script>
<script>

</script>
</body>

</html>
