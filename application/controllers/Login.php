<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->data['username'] =  $this->session->userdata('username');
		$this->data['id_role'] =  $this->session->userdata('id_role');
		if (isset($this->data['username'], $this->data['id_role'])) {
			switch ($this->data['id_role']) {
				case 1:
					redirect('superadmin');
					break;

				case 4:
					redirect('user');
					break;

				default:
					# code...
					break;
			}

			exit;
		}
	}


	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function process()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() === TRUE) {
			$this->load->model('user_m');
			$user_data = $this->user_m->get_row([
				'username' => $this->POST('username')
			]);

			if (is_null($user_data)) {
				$this->flashmsg('Username tidak ditemukan', 'danger');
			} else {
				$password_check = password_verify($this->POST('password'), $user_data->password);
				if ($password_check) {
					$array = array(
						'username' => $user_data->username,
						'id_role' => $user_data->id_role
					);

					$this->session->set_userdata($array);
				} else {
					$this->flashmsg('Password Salah', 'danger');
				}
			}
		} else {
			$this->flashmsg('Silahkan isi Username dan Password', 'warning');
		}

		redirect('login');
	}
}

/* End of file Controllername.php */
