<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] = 'transaction';
		$this->data['primary_key'] = 'id_transaction';
	}
}

/* End of file Branch_m.php */
