<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->data['username'] =  $this->session->userdata('username');
		$this->data['id_role'] =  $this->session->userdata('id_role');
		if (isset($this->data['username'], $this->data['id_role'])) {
			if ($this->data['id_role'] != 4) {
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
		$this->load->model('user_data_m');
		$this->load->model('content_m');
		$this->load->model('province_m');
		$this->load->model('product_m');
		$this->load->model('transaksi_m');
		$this->load->model('transaksi_detail_m');
		$this->load->model('city_m');
		$this->load->model('district_m');
		$this->load->model('subdistrict_m');

		$this->data['user_data'] = $this->user_data_m->get_row(['username' => $this->data['username']]);
	}

	public function index()
	{
		$this->data['product'] = $this->product_m->get_join_all_where(['merchant'], ['merchant.id_merchant = product.merchant'], ['is_deleted' => 0]);
		$this->data['banner'] = $this->content_m->get(['type' => 1]);
		$this->data['title'] = ' | Home';
		$this->data['content'] = 'home';

		$this->load->view('user/template/template', $this->data);
	}

	public function jasa_antar()
	{
		$apiKey = 'DEV-XrtFgNjzXCSgxhak3yIi8abz06uExtsK275y0tdd';

		$payload = ['code' => ''];

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT  => true,
			CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel?' . http_build_query($payload),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER         => false,
			CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
			CURLOPT_FAILONERROR    => false
		));

		$response = curl_exec($curl);
		$error = curl_error($curl);

		curl_close($curl);

		$this->data['payment_channel'] = json_decode($response, true);
		$this->data['province'] = $this->province_m->get(['prov_id' => 6]);
		$this->data['title'] = ' | Jasa Antar';
		$this->data['content'] = 'jasa_antar';

		$this->load->view('user/template/template', $this->data);
	}

	public function create_payment_jantar()
	{
		$alamat = $this->user_data_m->get_row(['username' => $this->data['username']]);
		if ($alamat->province != $this->POST('province_pengirim') || $alamat->city != $this->POST('city_pengirim') || $alamat->district != $this->POST('district_pengirim') || $alamat->subdistrict != $this->POST('subdistrict_pengirim') || $alamat->address != $this->POST('alamat_pengirim')) {
			$alamat_input = [
				'province' => $this->POST('province_pengirim'),
				'city' => $this->POST('city_pengirim'),
				'district' => $this->POST('district_pengirim'),
				'subdistrict' => $this->POST('subdistrict_pengirim'),
				'address' => $this->POST('alamat_pengirim')
			];

			$this->user_data_m->update($this->data['username'], $alamat_input);
		}

		/*
		Service :
		1. Jasa Antar
		2. Jasa Titip
		3. BIMART
		*/
		if ($this->POST('layanan') == 'Reguler') {
			$amount = 10000;
		} else {
			$amount = 15000;
		}

		if (!empty($this->POST('metode')) && $this->POST('metode') != 'COD') {
			$apiKey       = 'DEV-XrtFgNjzXCSgxhak3yIi8abz06uExtsK275y0tdd';
			$privateKey   = 'JDmr7-LaXxM-C7p5I-WKN2G-mTbNw';
			$merchantCode = 'T10916';
			$merchantRef  = '';
			// $amount       = 0;

			$data = [
				'method'         => $this->POST('metode'),
				'merchant_ref'   => $merchantRef,
				'amount'         => $amount,
				'customer_name'  => $this->POST('nama_pengirim'),
				'customer_email' => $this->POST('email'),
				'customer_phone' => $this->POST('phone_number'),
				'order_items'    => [
					[
						'sku'         => 'BA-01',
						'name'        => 'Jasa Antar',
						'price'       => $amount,
						'quantity'    => 1
					]
				],
				'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
				'signature'    => hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey)
			];

			$curl = curl_init();

			curl_setopt_array($curl, [
				CURLOPT_FRESH_CONNECT  => true,
				CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HEADER         => false,
				CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
				CURLOPT_FAILONERROR    => false,
				CURLOPT_POST           => true,
				CURLOPT_POSTFIELDS     => http_build_query($data)
			]);

			$response = curl_exec($curl);
			$error = curl_error($curl);

			curl_close($curl);

			$data = json_decode($response, true);
			$alamat_pengirim = implode(';', [
				'province' => $this->POST('province_pengirim'),
				'city' => $this->POST('city_pengirim'),
				'district' => $this->POST('district_pengirim'),
				'subdistrict' => $this->POST('subdistrict_pengirim'),
				'address' => $this->POST('alamat_pengirim')
			]);

			$data_to_input = [
				'username' => $this->data['username'],
				'reference' => $data['data']['reference'],
				'service' => 1,
				'service_type' => ($this->POST('layanan') == 'Reguler') ? 1 : 2,
				'amount' => $data['data']['amount'],
				'address_detail' => $alamat_pengirim,
				'payment' => $this->POST('metode'),
				'status' => 0
			];

			$this->transaksi_m->insert($data_to_input);
			$insert_id = $this->db->insert_id();

			for ($i = 0; $i < count($this->POST('nama_penerima')); $i++) {
				$trans_detail = implode(';', [
					$this->POST('nama_penerima')[$i],
					$this->POST('kontak_penerima')[$i],
					$this->POST('jenis_barang')[$i],
					$this->POST('alamat')[$i],
				]);

				$this->transaksi_detail_m->insert([
					'id_transaction' => $insert_id,
					'detail' => $trans_detail
				]);
			}

			$base_64 = base64_encode($insert_id);
			$url_param = rtrim($base_64, '=');

			redirect('user/invoice/' . $url_param);
		} else {
			$alamat_pengirim = implode(';', [
				'province' => $this->POST('province_pengirim'),
				'city' => $this->POST('city_pengirim'),
				'district' => $this->POST('district_pengirim'),
				'subdistrict' => $this->POST('subdistrict_pengirim'),
				'address' => $this->POST('alamat_pengirim')
			]);

			$data_to_input = [
				'username' => $this->data['username'],
				'reference' => '',
				'service' => 1,
				'service_type' => ($this->POST('layanan') == 'Reguler') ? 1 : 2,
				'amount' => $amount,
				'address_detail' => $alamat_pengirim,
				'payment' => $this->POST('metode'),
				'status' => 0
			];

			$this->transaksi_m->insert($data_to_input);
			$insert_id = $this->db->insert_id();

			for ($i = 0; $i < count($this->POST('nama_penerima')); $i++) {
				$trans_detail = implode(';', [
					$this->POST('nama_penerima')[$i],
					$this->POST('kontak_penerima')[$i],
					$this->POST('jenis_barang')[$i],
					$this->POST('alamat')[$i],
				]);

				$this->transaksi_detail_m->insert([
					'id_transaction' => $insert_id,
					'detail' => $trans_detail
				]);
			}

			$base_64 = base64_encode($insert_id);
			$url_param = rtrim($base_64, '=');

			redirect('user/invoice/' . $url_param);
		}
	}

	public function invoice()
	{
		$param = $this->uri->segment(3);
		if ($param == '') {
			redirect('user');
			exit;
		}

		$base_64 = $param . str_repeat('=', strlen($param) % 4);
		$id = base64_decode($base_64);

		$this->data['transaction'] = $this->transaksi_m->get_row(['id_transaction' => $id]);
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
		$this->data['transaction_detail'] = $this->transaksi_detail_m->get(['id_transaction' => $id]);

		if ($this->data['transaction']->payment !== 'COD') {

			$apiKey = 'DEV-XrtFgNjzXCSgxhak3yIi8abz06uExtsK275y0tdd';

			$payload = ['reference'	=> $this->data['transaction']->reference];

			$curl = curl_init();

			curl_setopt_array($curl, [
				CURLOPT_FRESH_CONNECT  => true,
				CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/detail?' . http_build_query($payload),
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HEADER         => false,
				CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
				CURLOPT_FAILONERROR    => false,
			]);

			$response = curl_exec($curl);
			$error = curl_error($curl);

			curl_close($curl);

			$this->data['invoice'] = json_decode($response, true);
		} else {
			$this->data['invoice'] = '';
		}
		$this->data['title'] = ' | Invoice';
		$this->data['content'] = 'invoice';

		$this->load->view('user/template/template', $this->data);
	}

	public function riwayat_pesanan()
	{
		$this->data['pesanan'] = $this->transaksi_m->get(['username' => $this->data['username']]);
		$this->data['title'] = ' | Riwayat Pesanan';
		$this->data['content'] = 'riwayat_pesanan';

		$this->load->view('user/template/template', $this->data);
	}

	public function jasa_titip()
	{
		$apiKey = 'DEV-XrtFgNjzXCSgxhak3yIi8abz06uExtsK275y0tdd';

		$payload = ['code' => ''];

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_FRESH_CONNECT  => true,
			CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel?' . http_build_query($payload),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER         => false,
			CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
			CURLOPT_FAILONERROR    => false
		));

		$response = curl_exec($curl);
		$error = curl_error($curl);

		curl_close($curl);

		$this->data['payment_channel'] = json_decode($response, true);
		$this->data['province'] = $this->province_m->get(['prov_id' => 6]);
		$this->data['title'] = ' | Jasa Titip';
		$this->data['content'] = 'jasa_titip';

		$this->load->view('user/template/template', $this->data);
	}

	public function create_payment_jastip()
	{
		echo '<pre>';
		print_r($this->input->post());
		echo '</pre>';
		exit;
		$alamat = $this->user_data_m->get_row(['username' => $this->data['username']]);
		if ($alamat->province != $this->POST('province_pengirim') || $alamat->city != $this->POST('city_pengirim') || $alamat->district != $this->POST('district_pengirim') || $alamat->subdistrict != $this->POST('subdistrict_pengirim') || $alamat->address != $this->POST('alamat_pengirim')) {
			$alamat_input = [
				'province' => $this->POST('province_pengirim'),
				'city' => $this->POST('city_pengirim'),
				'district' => $this->POST('district_pengirim'),
				'subdistrict' => $this->POST('subdistrict_pengirim'),
				'address' => $this->POST('alamat_pengirim')
			];

			$this->user_data_m->update($this->data['username'], $alamat_input);
		}

		/*
		Service :
		1. Jasa Antar
		2. Jasa Titip
		3. BIMART
		*/
		$amount = 0;
		foreach ($this->POST('harga_barang') as $key => $value) {
			$amount += $value;
		}

		if ($this->POST('layanan') == 'Reguler') {
			$amount += 10000;
		} else {
			$amount += 15000;
		}

		if (!empty($this->POST('metode')) && $this->POST('metode') != 'COD') {
			$apiKey       = 'DEV-XrtFgNjzXCSgxhak3yIi8abz06uExtsK275y0tdd';
			$privateKey   = 'JDmr7-LaXxM-C7p5I-WKN2G-mTbNw';
			$merchantCode = 'T10916';
			$merchantRef  = '';

			$data = [
				'method'         => $this->POST('metode'),
				'merchant_ref'   => $merchantRef,
				'amount'         => $amount,
				'customer_name'  => $this->POST('nama_pengirim'),
				'customer_email' => $this->POST('email'),
				'customer_phone' => $this->POST('phone_number'),
				'order_items'    => [
					[
						'sku'         => 'BA-01',
						'name'        => 'Jasa Antar',
						'price'       => $amount,
						'quantity'    => 1
					]
				],
				'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
				'signature'    => hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey)
			];

			$curl = curl_init();

			curl_setopt_array($curl, [
				CURLOPT_FRESH_CONNECT  => true,
				CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HEADER         => false,
				CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
				CURLOPT_FAILONERROR    => false,
				CURLOPT_POST           => true,
				CURLOPT_POSTFIELDS     => http_build_query($data)
			]);

			$response = curl_exec($curl);
			$error = curl_error($curl);

			curl_close($curl);

			$data = json_decode($response, true);
			$alamat_pengirim = implode(';', [
				'province' => $this->POST('province_pengirim'),
				'city' => $this->POST('city_pengirim'),
				'district' => $this->POST('district_pengirim'),
				'subdistrict' => $this->POST('subdistrict_pengirim'),
				'address' => $this->POST('alamat_pengirim')
			]);

			$data_to_input = [
				'username' => $this->data['username'],
				'reference' => $data['data']['reference'],
				'service' => 2,
				'service_type' => ($this->POST('layanan') == 'Reguler') ? 1 : 2,
				'amount' => $data['data']['amount'],
				'address_detail' => $alamat_pengirim,
				'payment' => $this->POST('metode'),
				'status' => 0
			];

			$this->transaksi_m->insert($data_to_input);
			$insert_id = $this->db->insert_id();

			for ($i = 0; $i < count($this->POST('nama_penerima')); $i++) {
				$trans_detail = implode(';', [
					$this->POST('nama_penerima')[$i],
					$this->POST('kontak_penerima')[$i],
					$this->POST('jenis_barang')[$i],
					$this->POST('alamat')[$i],
				]);

				$this->transaksi_detail_m->insert([
					'id_transaction' => $insert_id,
					'detail' => $trans_detail
				]);
			}

			$base_64 = base64_encode($insert_id);
			$url_param = rtrim($base_64, '=');

			redirect('user/invoice/' . $url_param);
		} else {
			$alamat_pengirim = implode(';', [
				'province' => $this->POST('province_pengirim'),
				'city' => $this->POST('city_pengirim'),
				'district' => $this->POST('district_pengirim'),
				'subdistrict' => $this->POST('subdistrict_pengirim'),
				'address' => $this->POST('alamat_pengirim')
			]);

			$data_to_input = [
				'username' => $this->data['username'],
				'reference' => '',
				'service' => 2,
				'service_type' => ($this->POST('layanan') == 'Reguler') ? 1 : 2,
				'amount' => $amount,
				'address_detail' => $alamat_pengirim,
				'payment' => $this->POST('metode'),
				'status' => 0
			];

			$this->transaksi_m->insert($data_to_input);
			$insert_id = $this->db->insert_id();

			for ($i = 0; $i < count($this->POST('nama_penerima')); $i++) {
				$trans_detail = implode(';', [
					$this->POST('nama_penerima')[$i],
					$this->POST('kontak_penerima')[$i],
					$this->POST('jenis_barang')[$i],
					$this->POST('alamat')[$i],
				]);

				$this->transaksi_detail_m->insert([
					'id_transaction' => $insert_id,
					'detail' => $trans_detail
				]);
			}

			$base_64 = base64_encode($insert_id);
			$url_param = rtrim($base_64, '=');

			redirect('user/invoice/' . $url_param);
		}
	}
}

/* End of file User.php */
