<?php

$this->load->view('user/template/head.php', $title);
$this->load->view('user/template/navbar.php');
$this->load->view('user/' . $content);
$this->load->view('user/template/footer.php');
