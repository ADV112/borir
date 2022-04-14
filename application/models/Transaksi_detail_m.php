<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_detail_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] = 'transaction_detail';
		$this->data['primary_key'] = 'id_detail';
	}
}

/* End of file Branch_m.php */
