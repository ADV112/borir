<div class="modal fade" id="exampleModal" role="document" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Admin</h5>
				<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?= form_open('url', ['id' => 'createForm']); ?>
				<input type="hidden" name="branch" value="<?= $branch->branch_code ?>">
				<div class="form-group">
					<label for="">Email</label>
					<input type="email" name="email" class="form-control">
				</div>
				<div class="form-group">
					<label for="">Admin Name</label>
					<input type="text" name="admin_name" class="form-control">
				</div>

				<div class="form-group">
					<label for="">Phone Number</label>
					<input type="text" name="phone_number" class="form-control">
				</div>
				<?= form_close() ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" id="createTryOut" class="btn bg-gradient-primary">Submit</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleCourierModal" role="document" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Courier</h5>
				<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?= form_open('url', ['id' => 'createCourierForm']); ?>
				<input type="hidden" name="branch" value="<?= $branch->branch_code ?>">
				<div class="form-group">
					<label for="">Email</label>
					<input type="email" name="email" class="form-control">
				</div>
				<div class="form-group">
					<label for="">Courier Name</label>
					<input type="text" name="admin_name" class="form-control">
				</div>

				<div class="form-group">
					<label for="">Phone Number</label>
					<input type="text" name="phone_number" class="form-control">
				</div>

				<div class="form-group">
					<label for="">Jenis Kelamin</label>
					<select name="jenis_kelamin" id="" class="form-control">
						<option selected disabled>Pilih Jenis Kelamin</option>
						<option value="1">Laki - laki</option>
						<option value="2">Perempuan </option>
					</select>
				</div>
				<?= form_close() ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" id="createCourier" class="btn bg-gradient-primary">Submit</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body text-center">
				<input type="hidden" id="deleteHidden">
				<h3>Are You Sure?</h3>
				<p class="mb-4">You can't recover data if you delete this</p>
				<button type="button" data-bs-dismiss="modal" class="btn bg-gradient-default">No</button>
				<button type="button" id="delete-submit" class="btn bg-gradient-danger">Yes</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="deleteAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body text-center">
				<input type="hidden" id="deleteAdminHidden">
				<h3>Are You Sure?</h3>
				<p class="mb-4">You can't recover data if you delete this</p>
				<button type="button" data-bs-dismiss="modal" class="btn bg-gradient-default">No</button>
				<button type="button" id="deleteAdmin-submit" class="btn bg-gradient-danger">Yes</button>
			</div>
		</div>
	</div>
</div>

<div class="card rounded-0">
	<div class="card-body">
		<ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link active" id="pills-branch-tab" data-bs-toggle="pill" data-bs-target="#pills-branch" type="button" role="tab" aria-controls="pills-branch" aria-selected="false">Branch Detail</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Admin List</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Courier List</button>
			</li>
		</ul>
		<div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade show active" id="pills-branch" role="tabpanel" aria-labelledby="pills-branch-tab">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Branch Name</label>
							<input type="text" name="branch_name" readonly value="<?= $branch->branch_name ?>" class="form-control">
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
				<table class="table text-xs align-items-center w-100" id="admin">
					<thead>
						<tr>
							<th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone Number</th>
							<th class="text-secondary opacity-7">

							</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
				<table class="table text-xs align-items-center w-100" id="courier">
					<thead>
						<tr>
							<th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
							<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone Number</th>
							<th class="text-secondary opacity-7"></th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
