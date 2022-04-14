<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Content_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] = 'content';
		$this->data['primary_key'] = 'id_content';
	}
}

/* End of file Branch_m.php */
