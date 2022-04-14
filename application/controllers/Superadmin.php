<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Superadmin extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->data['username'] =  $this->session->userdata('username');
		$this->data['id_role'] =  $this->session->userdata('id_role');
		if (isset($this->data['username'], $this->data['id_role'])) {
			if ($this->data['id_role'] != 1) {
				$this->session->sess_destroy();
				$this->flashmsg('Silahkan Login terlebih dahulu', 'warning');

				redirect('login');
				exit;
			}
		} else {
			$this->session->sess_destroy();
			$this->flashmsg('Silahkan Login terlebih dahulu', 'warning');

			redirect('login');
			exit;
		}

		$this->load->model('user_m');
		$this->load->model('branch_m');
		$this->load->model('province_m');
		$this->load->model('product_m');
		$this->load->model('admin_m');
		$this->load->model('content_m');
		$this->load->model('merchant_m');
		$this->load->model('courier_data_m');
		$this->load->model('transaksi_m');
		$this->load->model('transaksi_detail_m');
		$this->load->model('courier_data_m');
	}


	public function index()
	{
		$this->data['title'] = ' | Dashboard';
		$this->data['content'] = 'dashboard';

		$this->load->view('superadmin/template/template', $this->data);
	}

	public function branch()
	{
		$this->data['provinces'] = $this->province_m->get();
		$this->data['title'] = ' | Branch';
		$this->data['content'] = 'branch';

		$this->load->view('superadmin/template/template', $this->data);
	}

	public function get_branch()
	{
		$this->load->library('datatables');
		$this->datatables->select('branch_code, branch_name, address, phone_number')
			->from('branch')
			->join('provinces', 'branch.province = provinces.prov_id')
			->select('provinces.prov_id, prov_name')
			->join('cities', 'branch.city = cities.city_id')
			->select('cities.city_id, city_name')
			->join('districts', 'branch.district = districts.dis_id')
			->select('districts.dis_id, dis_name')
			->join('subdistricts', 'branch.sub_district = subdistricts.subdis_id')
			->select('subdistricts.subdis_id, subdis_name');

		if ($this->POST('search')['value'] != '') {
			$srch = $this->POST('search')['value'];
			$where = " branch_code LIKE '%" . $srch . "%' "
				. " OR branch_name LIKE '%" . $srch . "%' "
				. " OR prov_name LIKE '%" . $srch . "%' "
				. " OR city_name LIKE '%" . $srch . "%' "
				. " OR dis_name LIKE '%" . $srch . "%' "
				. " OR subdis_name LIKE '%" . $srch . "%' "
				. " OR address LIKE '%" . $srch . "%' "
				. " OR phone_number LIKE '%" . $srch . "%' ";
			$this->datatables->where($where);
		}

		echo $this->datatables->generate('json', 'ISO-8859-1');
	}

	public function create_branch()
	{
		$this->form_validation->set_rules('form', 'Form', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$input = $this->POST('form');
			$form = [];
			parse_str($input, $form);

			$code = '';
			$stat = true;
			do {
				$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
				$code = strtoupper(substr(str_shuffle($permitted_chars), 0, 10));

				if ($this->branch_m->get_num_row(['branch_code' => $code]) == 0) {
					$stat = false;
				}
			} while ($stat);

			$data_input = [
				'branch_code' => $code,
				'branch_name' => $form['branch_name'],
				'province' => $form['province'],
				'city' => $form['city'],
				'district' => $form['district'],
				'sub_district' => $form['subdistrict'],
				'address' => $form['address'],
				'phone_number' => $form['phone']
			];

			if ($this->branch_m->insert($data_input)) {
				echo json_encode(['status' => true]);
			} else {
				echo json_encode(['status' => false]);
			}
		} else {
			echo json_encode(['status' => false]);
		}
	}

	public function delete_branch()
	{
		if ($this->POST('id')) {
			$this->branch_m->delete($this->POST('id'));

			echo json_encode(['status' => true]);
		}
	}

	public function branch_detail($code = NULL)
	{
		$table = [
			'provinces',
			'cities',
			'districts',
			'subdistricts'
		];

		$jcond = [
			'branch.province = provinces.prov_id',
			'branch.city = cities.city_id',
			'branch.district = districts.dis_id',
			'branch.sub_district = subdistricts.subdis_id'
		];

		$this->data['branch'] = $this->branch_m->get_join_where($table, $jcond, ['branch_code' => $code]);
		$this->data['title'] = ' | Branch Detail';
		$this->data['content'] = 'branch-detail';

		$this->load->view('superadmin/template/template', $this->data);
	}

	public function create_admin()
	{
		$this->form_validation->set_rules('form', 'Form', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$input = $this->POST('form');
			$form = [];
			parse_str($input, $form);

			$password = bin2hex(openssl_random_pseudo_bytes(4));

			$data_input = [
				'username' => $form['email'],
				'password' => password_hash($password, PASSWORD_BCRYPT),
				'id_role' => 2
			];

			if ($this->user_m->insert($data_input)) {
				$data_input = [
					'branch' => $form['branch'],
					'username' => $form['email'],
					'name' => $form['admin_name'],
					'phone_number' => $form['phone_number']
				];
				if ($this->admin_m->insert($data_input)) {
					echo json_encode(['status' => true]);
				} else {
					echo json_encode(['status' => false]);
				}
			} else {
				echo json_encode(['status' => false]);
			}
		} else {
			echo json_encode(['status' => false]);
		}
	}

	public function get_admin()
	{
		$this->load->library('datatables');
		$this->datatables->select('username, name, phone_number')
			->from('admin_data')
			->where(['branch' => $this->POST('branch_code')]);

		if ($this->POST('search')['value'] != '') {
			$srch = $this->POST('search')['value'];
			$where = " name LIKE '%" . $srch . "%' "
				. " OR username LIKE '%" . $srch . "%' "
				. " OR phone_number LIKE '%" . $srch . "%' ";
			$this->datatables->where($where);
		}

		echo $this->datatables->generate('json', 'ISO-8859-1');
	}

	public function delete_admin()
	{
		if ($this->POST('username')) {
			$this->user_m->delete($this->POST('username'));

			echo json_encode(['status' => true]);
		}
	}

	public function get_courier()
	{
		$this->load->library('datatables');
		$this->datatables->select('id_courier, name, email, phone_number, jenis_kelamin')
			->from('courier_data')
			->where(['branch' => $this->POST('branch_code')]);

		if ($this->POST('search')['value'] != '') {
			$srch = $this->POST('search')['value'];
			$where = " name LIKE '%" . $srch . "%' "
				. " OR email LIKE '%" . $srch . "%' "
				. " OR phone_number LIKE '%" . $srch . "%' ";
			$this->datatables->where($where);
		}

		echo $this->datatables->generate('json', 'ISO-8859-1');
	}

	public function create_courier()
	{
		$this->form_validation->set_rules('form', 'Form', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$input = $this->POST('form');
			$form = [];
			parse_str($input, $form);

			$data_input = [
				'branch' => $form['branch'],
				'email' => $form['email'],
				'name' => $form['admin_name'],
				'phone_number' => $form['phone_number'],
				'jenis_kelamin' => $form['jenis_kelamin'],
			];
			if ($this->courier_data_m->insert($data_input)) {
				echo json_encode(['status' => true]);
			} else {
				echo json_encode(['status' => false]);
			}
		} else {
			echo json_encode(['status' => false]);
		}
	}

	public function delete_courier()
	{
		if ($this->POST('username')) {
			$this->courier_data_m->delete($this->POST('username'));

			echo json_encode(['status' => true]);
		}
	}

	public function content()
	{
		$this->data['title'] = ' | Content Management';
		$this->data['content'] = 'content-management';

		$this->load->view('superadmin/template/template', $this->data);
	}

	public function get_content()
	{
		$this->load->library('datatables');
		$this->datatables->select('id_content, description, image')
			->from('content')
			->where(['type' => 1]);

		if ($this->POST('search')['value'] != '') {
			$srch = $this->POST('search')['value'];
			$where = " description LIKE '%" . $srch . "%' ";
			$this->datatables->where($where);
		}

		echo $this->datatables->generate('json', 'ISO-8859-1');
	}

	public function add_banner()
	{
		$data_input = [
			'description' => $this->POST('description'),
			'image' => $this->POST('file_path'),
			'type' => 1
		];

		$this->content_m->insert($data_input);
		echo json_encode(['status' => true]);
	}

	public function delete_banner()
	{
		if ($this->POST('id')) {
			$img = $this->content_m->get_row(['id_content' => $this->POST('id')]);
			unlink($img->image);
			$this->content_m->delete($this->POST('id'));

			echo json_encode(['status' => true]);
		}
	}

	public function upload_banner()
	{
		if (isset($_POST['image'])) {
			$data = $_POST['image'];
			$image_array_1 = explode(";", $data);
			$image_array_2 = explode(",", $image_array_1[1]);
			$data = base64_decode($image_array_2[1]);
			$image_name = 'uploads/' . uniqid() . '.png';
			file_put_contents($image_name, $data);
			echo $image_name;
		}
	}

	public function merchant()
	{
		$this->data['provinces'] = $this->province_m->get();
		$this->data['title'] = ' | Merchant';
		$this->data['content'] = 'merchant';

		$this->load->view('superadmin/template/template', $this->data);
	}

	public function get_merchant()
	{
		$this->load->library('datatables');
		$this->datatables->select('id_merchant, merchant_name, address, phone_number')
			->from('merchant')
			->join('provinces', 'merchant.province = provinces.prov_id')
			->select('provinces.prov_id, prov_name')
			->join('cities', 'merchant.city = cities.city_id')
			->select('cities.city_id, city_name')
			->join('districts', 'merchant.district = districts.dis_id')
			->select('districts.dis_id, dis_name')
			->join('subdistricts', 'merchant.subdistrict = subdistricts.subdis_id')
			->select('subdistricts.subdis_id, subdis_name');

		if ($this->POST('search')['value'] != '') {
			$srch = $this->POST('search')['value'];
			$where = " id_merchant LIKE '%" . $srch . "%' "
				. " OR merchant_name LIKE '%" . $srch . "%' "
				. " OR prov_name LIKE '%" . $srch . "%' "
				. " OR city_name LIKE '%" . $srch . "%' "
				. " OR dis_name LIKE '%" . $srch . "%' "
				. " OR subdis_name LIKE '%" . $srch . "%' "
				. " OR address LIKE '%" . $srch . "%' "
				. " OR phone_number LIKE '%" . $srch . "%' ";
			$this->datatables->where($where);
		}

		echo $this->datatables->generate('json', 'ISO-8859-1');
	}

	public function add_merchant()
	{
		$this->form_validation->set_rules('form', 'Form', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$input = $this->POST('form');
			$form = [];
			parse_str($input, $form);

			$data_input = [
				'merchant_name' => $form['merchant_name'],
				'province' => $form['province'],
				'city' => $form['city'],
				'district' => $form['district'],
				'subdistrict' => $form['subdistrict'],
				'address' => $form['address'],
				'phone_number' => $form['phone']
			];

			if ($this->merchant_m->insert($data_input)) {
				echo json_encode(['status' => true]);
			} else {
				echo json_encode(['status' => false]);
			}
		} else {
			echo json_encode(['status' => false]);
		}
	}

	public function delete_merchant()
	{
		if ($this->POST('id')) {
			$this->merchant_m->delete($this->POST('id'));

			echo json_encode(['status' => true]);
		}
	}

	public function product()
	{
		$this->data['merchant'] = $this->merchant_m->get();
		$this->data['title'] = ' | Product';
		$this->data['content'] = 'product-management';

		$this->load->view('superadmin/template/template', $this->data);
	}

	public function get_product()
	{
		$this->load->library('datatables');
		$this->datatables->select('id_product, product_name, description, image, merchant, price')
			->from('product')
			->join('merchant', 'merchant.id_merchant = product.merchant')
			->select('id_merchant, merchant_name');

		if ($this->POST('search')['value'] != '') {
			$srch = $this->POST('search')['value'];
			$where = " name LIKE '%" . $srch . "%' OR description LIKE '%" . $srch . "%' ";
			$this->datatables->where($where);
		}

		echo $this->datatables->generate('json', 'ISO-8859-1');
	}

	public function add_product()
	{
		$this->form_validation->set_rules('form', 'Form', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$input = $this->POST('form');
			$form = [];
			parse_str($input, $form);

			$data_input = [
				'product_name' => $form['product_name'],
				'description' => $form['description'],
				'price' => $form['price'],
				'image' => $this->POST('file_path'),
				'merchant' => $form['merchant'],
			];

			if ($this->product_m->insert($data_input)) {
				echo json_encode(['status' => true]);
			} else {
				echo json_encode(['status' => false]);
			}
		} else {
			echo json_encode(['status' => false]);
		}
	}

	public function upload_product()
	{
		if (isset($_POST['image'])) {
			$data = $_POST['image'];
			$image_array_1 = explode(";", $data);
			$image_array_2 = explode(",", $image_array_1[1]);
			$data = base64_decode($image_array_2[1]);
			$image_name = 'product/' . time() . '.png';
			file_put_contents($image_name, $data);
			echo $image_name;
		}
	}

	public function transaction()
	{
		$this->data['title'] = ' | Transaction';
		$this->data['content'] = 'transaction';

		$this->load->view('superadmin/template/template', $this->data);
	}

	public function get_transaction()
	{
		$this->load->library('datatables');
		$this->datatables->select('id_transaction, transaction.username, service, service_type, address_detail, amount, payment, transaction.created_at, status')
			->from('transaction')
			->join('user_data', 'user_data.username = transaction.username')
			->select('name');

		if ($this->POST('search')['value'] != '') {
			$srch = $this->POST('search')['value'];
			$where = " name LIKE '%" . $srch . "%' OR created_at LIKE '%" . $srch . "%' ";
			$this->datatables->where($where);
		}

		echo $this->datatables->generate('json', 'ISO-8859-1');
	}

	public function transaction_detail()
	{
		$this->data['transaction'] = $this->transaksi_m->get_join_where(['user_data'], ['user_data.username = transaction.username'], ['id_transaction' => $this->uri->segment(3)]);
		$address_detail = explode(';', $this->data['transaction']->address_detail);

		$provinsi = $this->province_m->get_row(['prov_id' => $address_detail[0]]);
		$city = $this->city_m->get_row(['city_id' => $address_detail[1]]);
		$district = $this->district_m->get_row(['dis_id' => $address_detail[2]]);
		$subdis = $this->subdistrict_m->get_row(['subdis_id' => $address_detail[3]]);

		$this->data['alamat_pengirim'] = $address_detail[4]
			. ', '
			. ucwords(strtolower($subdis->subdis_name)) . ', '
			. ucwords(strtolower($district->dis_name)) . ', '
			. ucwords(strtolower($city->city_name)) . ', '
			. ucwords(strtolower($provinsi->prov_name)) . ', ';

		$this->data['courier'] = $this->courier_data_m->get_row(['id_courier' => $this->data['transaction']->courier]);
		$this->data['kurir'] = $this->courier_data_m->get();
		$this->data['transaction_detail'] = $this->transaksi_detail_m->get(['id_transaction' => $this->uri->segment(3)]);
		$this->data['title'] = ' | Transaction Detail';
		$this->data['content'] = 'transaction-detail';

		$this->load->view('superadmin/template/template', $this->data);
	}

	public function pilih_kurir()
	{
		if ($this->POST('courier')) {
			$this->transaksi_m->update($this->POST('id_transaction'), ['courier' => $this->POST('courier')]);
		}

		redirect('superadmin/transaction-detail/' . $this->POST('id_transaction'));
	}
}

/* End of file Superadmin.php */
