<div class="modal fade" id="exampleModal" role="document" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-fullscreen-sm-down modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
				<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?= form_open('', ['id' => 'addProduct']) ?>
				<input type="hidden" name="file_path">
				<div class="form-group">
					<label for="">Merchant</label>
					<select name="merchant" class="select2">
						<option value="">Choose Merchant</option>
						<?php foreach ($merchant as $key => $value) { ?>
							<option value="<?= $value->id_merchant ?>"><?= $value->merchant_name ?></option>
						<?php } ?>
					</select>
				</div>

				<div class="form-group">
					<label for="">Product Name</label>
					<input type="text" name="product_name" class="form-control">
				</div>

				<div class="form-group">
					<label for="">Price</label>
					<input type="number" name="price" class="form-control">
				</div>

				<div class="form-group">
					<label for="">Description</label>
					<textarea name="description" id="desc" cols="30" rows="10"></textarea>
				</div>

				<div class="image_area">
					<label id="upload_label" class="w-100" for="upload_image">
						<img src="<?= base_url('assets/img/img.png') ?>" id="uploaded_image" style="max-height: 150px; margin: auto" class="img-fluid" />
						<div class="overlay">
							<div class="text">Product Image</div>
						</div>
						<input type="file" name="image" class="image" id="upload_image" style="display:none" />
					</label>
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

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Crop Image Before Upload</h5>
				<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="img-container">
					<img src="" id="sample_image" />
					<div class="preview"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="crop" class="btn btn-primary">Crop</button>
				<button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
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

<div class="container" align="center">

	<div class="card rounded-0">
		<div class="card-body">
			<table class="table align-items-center w-100" id="product">
				<thead>
					<tr>
						<th width="10%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
						<th width="30%" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
						<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product Name</th>
						<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
						<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Merchant</th>
						<th class="text-secondary opacity-7"></th>
					</tr>
				</thead>
				<tbody class="text-xs text-center"></tbody>
			</table>
		</div>
	</div>
