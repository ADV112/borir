<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] = 'admin_data';
		$this->data['primary_key'] = 'username';
	}
}

/* End of file Branch_m.php */
