<?php

class Pages extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}
	
	function view($page = 'dashboard')
	{
		$data['username'] = $this->session->userdata('username');
		$data['usertype'] = $this->session->userdata('usertype');
		$data['title'] = ucfirst($page); // Capitalize the first letter
		$data['menu'] = 'Dashboard';
		
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);
	}

	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		$usertype = $this->session->userdata('usertype');
		
		if(!isset($is_logged_in) || $is_logged_in != true || $usertype != 'Admin')
		{
		echo 'You do not have permission to access this page!';
		die();
		}
	}
}
