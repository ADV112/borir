<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] = 'product';
		$this->data['primary_key'] = 'id_product';
	}
}

/* End of file Branch_m.php */
