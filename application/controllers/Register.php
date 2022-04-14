<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_m');
		$this->load->model('user_data_m');
	}


	public function index()
	{
		$this->load->view('register');
	}

	public function process()
	{
		if ($this->input->post()) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('phone', 'Phone Number', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				redirect('register');
				exit;
			} else {
				$data_check = $this->user_m->get_num_row(['username' => $this->POST('username')]);
				if ($data_check < 1) {

					if ($this->user_m->insert([
						'username' => $this->POST('username'),
						'password' => password_hash($this->POST('password'), PASSWORD_BCRYPT),
						'id_role' => 4
					])) {
						$user_data = [
							'username' => $this->POST('username'),
							'name' => $this->POST('name'),
							'phone_number' => $this->POST('phone'),
						];

						$this->user_data_m->insert($user_data);

						$array = array(
							'username' => $this->POST('username'),
							'id_role' => 4
						);

						$this->session->set_userdata($array);
						redirect('login');
						exit;
					}
				} else {
					$this->session->set_flashdata('msg', '<div class="uk-alert-warning" uk-alert><a class="uk-alert-close" uk-close></a><p>Email is already used.</p></div>');
					redirect('register');
					exit;
				}
			}
		} else {
			redirect('register');
			exit;
		}
	}
}

/* End of file Register.php */
