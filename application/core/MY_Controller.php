<?php

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('city_m');
		$this->load->model('district_m');
		$this->load->model('subdistrict_m');
	}

	public function POST($name)
	{
		return $this->input->post($name);
	}

	public function flashmsg($msg, $type = 'success', $name = 'msg')
	{
		return $this->session->set_flashdata($name, '<div class="alert alert-' . $type . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $msg . '</div>');
	}

	public function upload($id, $directory, $tag_name = 'userfile')
	{
		if ($_FILES[$tag_name]) {
			$upload_path = realpath(APPPATH . '../assets/img/' . $directory . '/');
			@unlink($upload_path . '/' . $id . '.jpg');
			$config = [
				'file_name' 		=> $id . '.jpg',
				'allowed_types'		=> 'jpg|png|bmp|jpeg',
				'upload_path'		=> $upload_path
			];
			$this->load->library('upload');
			$this->upload->initialize($config);
			return $this->upload->do_upload($tag_name);
		}
		return FALSE;
	}

	public function dump($var)
	{
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}

	public function baseEncode($uri)
	{
		$url = base64_encode($uri);
		return rtrim($url, '=');
	}

	public function baseDecode($uri)
	{
		$real_uri = $uri . str_repeat('=', strlen($uri) % 4);
		return base64_decode($real_uri);
	}

	public function getCity()
	{
		if ($this->POST('prov_id')) {
			$cities = $this->city_m->get_by_order('cities.city_name', 'ASC', ['prov_id' => $this->POST('prov_id')]);
			$city = [];
			foreach ($cities as $value) {
				$city[] = [
					'city_id' => $value->city_id,
					'city_name' => ucfirst(strtolower($value->city_name)),
				];
			}

			echo json_encode($city);
		} else {
			echo json_encode(false);
		}
	}

	public function getDistrict()
	{
		if ($this->POST('city_id')) {
			$cities = $this->district_m->get_by_order('districts.dis_name', 'ASC', ['city_id' => $this->POST('city_id')]);
			$city = [];
			foreach ($cities as $value) {
				$city[] = [
					'dis_id' => $value->dis_id,
					'dis_name' => ucfirst(strtolower($value->dis_name)),
				];
			}

			echo json_encode($city);
		} else {
			echo json_encode(false);
		}
	}

	public function getSubdistrict()
	{
		if ($this->POST('dis_id')) {
			$cities = $this->subdistrict_m->get_by_order('subdistricts.subdis_name', 'ASC', ['dis_id' => $this->POST('dis_id')]);
			$city = [];
			foreach ($cities as $value) {
				$city[] = [
					'subdis_id' => $value->subdis_id,
					'subdis_name' => ucfirst(strtolower($value->subdis_name)),
				];
			}

			echo json_encode($city);
		} else {
			echo json_encode(false);
		}
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
