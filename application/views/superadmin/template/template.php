<?php

$this->load->view('superadmin/template/head.php', $title);
$this->load->view('superadmin/template/sidebar.php');
$this->load->view('superadmin/template/navbar.php');
$this->load->view('superadmin/' . $content);
$this->load->view('superadmin/template/footer.php');
