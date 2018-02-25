<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_profile extends CI_Controller {
	
	function __construct()
	{	
		parent::__construct();
		$this->load->model('user/my_profile_model');
		$this->is_logged_in();
	}
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		$usertype = $this->session->userdata('usertype');
		
		if(!isset($is_logged_in) || $is_logged_in != true || $usertype == 'Admin')
		{
		echo 'You do not have permission to access this page!';
		die();
		}
	}
	
	function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['title'] ='My Profile';
		$data['menu'] = 'My Profile';
		$data['employee'] = $this->my_profile_model->get_employee();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/mymenu', $data);
		$this->load->view('employee/profile/my_profile', $data);
		$this->load->view('templates/footer', $data);
	}
}