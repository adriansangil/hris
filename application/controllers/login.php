<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{	
		parent::__construct();
		$this->check_login();

		//disables back button browser
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
	}

	function index()
	{
		$this->load->model('login_model');
		$this->login_model->update_academic_year();
		$this->login_model->update_year();
	
		$data['admin_user'] = $this->login_model->get_usertype();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->view('templates/login',$data);
		
	}
	
	function validate_credentials()
	{
		$this->load->model('login_model');
		$query = $this->login_model->validate();
		$data['error_message'] = 'sample';
		
		if($query)
		{
			$row = $this->login_model->get_usertype();

			
			
			$data = array(
				'user_id' => $row->employee_id,
				'usertype' => $row->type,
				'employeetype'=> $row->employee_type,
				'username'=> $this->input->post('username'),
				'is_logged_in'=> true
			);
			
			
			if($row->type == 'Admin'){
				$this->session->set_userdata($data);
				redirect(base_url().'index.php/dashboard');	
			}
			else{
				$this->session->set_userdata($data);
				redirect(base_url().'index.php/my_dashboard');
			}
		}
		else
		{
			$this->session->set_flashdata('msg', 'Wrong Username and password combination.');
			redirect(base_url());
		}
	}

	function check_login()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		$usertype = $this->session->userdata('usertype');
		
		if($is_logged_in == true && $usertype == 'Admin')
		{
			redirect(base_url().'index.php/dashboard','refresh');	
		}
		if($is_logged_in == true && $usertype == 'Normal')
		{
			redirect(base_url().'index.php/my_dashboard','refresh');	
		}
	}

}