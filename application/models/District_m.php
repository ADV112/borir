<?php
defined('BASEPATH') or exit('No direct script access allowed');

class District_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] = 'districts';
		$this->data['primary_key'] = 'dis_id';
	}
}

/* End of file Branch_m.php */
