<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_data_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] = 'user_data';
		$this->data['primary_key'] = 'username';
	}
}

/* End of file User_data_m.php */
