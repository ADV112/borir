<div class="modal fade" id="exampleModal" role="document" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-fullscreen-sm-down modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add New Merchant</h5>
				<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?= form_open('url', ['id' => 'createForm']); ?>
				<div class="form-group">
					<label for="">Merchant Name:</label>
					<input type="text" name="merchant_name" placeholder="Merchant Name" class="form-control" required>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label for="">Province:</label>
							<select name="province" class="select2" id="select2">
								<option value="" selected disabled>Choose Province</option>
								<?php foreach ($provinces as $province) { ?>
									<option value="<?= $province->prov_id ?>"><?= ucfirst(strtolower($province->prov_name)) ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group">
							<label for="">City:</label>
							<select name="city" class="form-control" disabled>
								<option value="" selected disabled>Choose City</option>
							</select>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group">
							<label for="">District:</label>
							<select name="district" class="form-control" disabled>
								<option value="" selected disabled>Choose District</option>
							</select>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="form-group">
							<label for="">Sub District:</label>
							<select name="subdistrict" class="form-control" disabled>
								<option value="" selected disabled>Choose Sub District</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="">Address:</label>
					<textarea name="address" id="" cols="30" rows="5" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<label for="">Phone Number:</label>
					<input type="text" name="phone" class="form-control">
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

<div class="card rounded-0 shadow-sm">
	<div class="card-body px-0 pt-0 pb-2">
		<div class="p-0">
			<table class="table align-items-center">
				<thead>
					<tr>
						<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
						<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Merchant Name</th>
						<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Address</th>
						<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone Number</th>
						<th class="text-secondary opacity-7"></th>
					</tr>
				</thead>
				<tbody class="text-xs"></tbody>
			</table>
		</div>
	</div>
</div>
