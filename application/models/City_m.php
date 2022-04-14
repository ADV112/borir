<?php
defined('BASEPATH') or exit('No direct script access allowed');

class City_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] = 'cities';
		$this->data['primary_key'] = 'city_id';
	}
}

/* End of file Branch_m.php */
