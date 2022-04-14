<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Province_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] = 'provinces';
		$this->data['primary_key'] = 'prov_id';
	}
}

/* End of file Branch_m.php */
