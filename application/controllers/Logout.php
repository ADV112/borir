<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends MY_Controller
{

	public function index()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}

/* End of file Logout.php */
