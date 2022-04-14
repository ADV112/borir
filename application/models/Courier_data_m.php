<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Courier_data_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] = 'courier_data';
		$this->data['primary_key'] = 'id_courier';
	}
}

/* End of file Branch_m.php */
