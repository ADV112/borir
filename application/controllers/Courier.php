<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Courier extends MY_Controller
{


	public function __construct()
	{
		parent::__construct();
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
		$base_64 = $this->uri->segment(3) . str_repeat('=', strlen($this->uri->segment(3)) % 4);
		$id = base64_decode($base_64);

		$this->data['transaction'] = $this->transaksi_m->get_join_where(['user_data'], ['user_data.username = transaction.username'], ['id_transaction' => $id]);
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

		$this->data['id'] = $this->uri->segment(3);
		$this->data['transaction_detail'] = $this->transaksi_detail_m->get(['id_transaction' => $id]);

		$this->load->view('courier', $this->data);
	}

	public function update_order()
	{
		$base_64 = $this->POST('id') . str_repeat('=', strlen($this->POST('id')) % 4);
		$id = base64_decode($base_64);

		$this->transaksi_m->update($id, ['shipment_status' => $this->POST('status')]);
		redirect('courier/index/' . $this->POST('id'));
	}
}

/* End of file Courier.php */
