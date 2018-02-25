<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('settings_model');
		$this->load->helper('url');
		$this->is_logged_in();
		$this->current_time();
        $this->load->library('pagination');
        $this->load->helper('date');

        //disables back button browser
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
	}

	function alpha_dash_space($str_in)
	{
		if (! preg_match("/^([-a-z0-9_ ])+$/i", $str_in)) 
		{
			$this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha-numeric characters, spaces, underscores, and dashes.');
			return FALSE;
		}
		else 
		{
			return TRUE;
		}
	}
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		$usertype = $this->session->userdata('usertype');
		
		if(!isset($is_logged_in) || $is_logged_in != true || $usertype != 'Admin')
		{
			$this->session->set_flashdata('msg', 'You do not have permission to access that page!');
			redirect(base_url(),'refresh');
		}
	}

	function current_time()
	{
		$timezone = 'Asia/Manila';
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set($timezone);
		}
	}

	function index()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');


		$data['username'] = $this->session->userdata('username');
		$userid = $this->session->userdata('user_id');
		$data['title'] = 'Settings';
		$data['menu'] = 'Settings';
		$data['admin_details'] = $this->settings_model->get_admin_details($userid);
		$data['admin_status'] = $this->settings_model->get_admin_status($userid);
		$data['all_users'] = $this->settings_model->get_etype();

		//edit name
		if($this->input->post('edit_name')) {

			$this->form_validation->set_rules('fname', 'first name', 'trim|required|callback_alpha_dash_space');
			$this->form_validation->set_rules('mname', 'middle name', 'trim|required|callback_alpha_dash_space');
			$this->form_validation->set_rules('lname', 'last name', 'trim|required|callback_alpha_dash_space');
			

			if ($this->form_validation->run() !== FALSE)
			{
				$this->settings_model->edit_name($userid);
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successfully Edited Name!');
				redirect(base_url().'index.php/settings');
			}
			else 
			{
				$this->session->set_flashdata('msg2', 'danger');
	            $this->session->set_flashdata('msg', '<p>Editing of Name Failed:</p>'.validation_errors());
	            redirect(base_url().'index.php/settings');
        	}

		}

		//edit username
		if($this->input->post('edit_uname')) {

			$this->form_validation->set_rules('uname', 'username', 'required|alpha_numeric|is_unique[employee_information.username]');	

			if ($this->form_validation->run() !== FALSE)
			{
				$this->settings_model->edit_uname($userid);
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successfully Edited Username!');
				redirect(base_url().'index.php/settings');
			}
			else 
			{
				$this->session->set_flashdata('msg2', 'danger');
	            $this->session->set_flashdata('msg', '<p>Editing of Username Failed:</p>'.validation_errors());
	            redirect(base_url().'index.php/settings');
        	}
		}

		//edit pass
		if($this->input->post('edit_pass')) {

			$this->form_validation->set_rules('current', 'old password', 'required|alpha_numeric|min_length[5]');
			$this->form_validation->set_rules('new', 'new password', 'required|alpha_numeric|min_length[5]');
			$this->form_validation->set_rules('rnew', 're-type Password', 'matches[new]');	

			if ($this->form_validation->run() !== FALSE)
			{
				$check = $this->settings_model->check_password($userid);

				if($check === FALSE){
					$this->session->set_flashdata('msg2', 'danger');
	           		$this->session->set_flashdata('msg', '<p>Changing of Password Failed: </p> Wrong old password.');
	            	redirect(base_url().'index.php/settings');
				}

				$this->settings_model->edit_password($userid);
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Password successfully changed!');
				redirect(base_url().'index.php/settings');
			}
			else 
			{
				$this->session->set_flashdata('msg2', 'danger');
	            $this->session->set_flashdata('msg', '<p>Changing of Password Failed:</p>'.validation_errors());
	            redirect(base_url().'index.php/settings');
        	}
		}

		if($this->input->post('edit_type')) {

			$type = $this->settings_model->edit_type($userid);
			if($type === FALSE){
				$this->session->set_flashdata('msg2', 'info');
	           	$this->session->set_flashdata('msg', '<p>Same Employee Type selected.</p>');
	            redirect(base_url().'index.php/settings');
			}
			else{
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successfully Edited Employee Type!');
				redirect(base_url().'index.php/settings');
			}
		}

		//edit bday
		if($this->input->post('edit_bday')) {

			$this->form_validation->set_rules('birthdate', 'birthdate', 'required|date');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->settings_model->edit_bday($userid);
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successfully Edited Birthdate!');
				redirect(base_url().'index.php/settings');
			}
			else 
			{
				$this->session->set_flashdata('msg2', 'danger');
	            $this->session->set_flashdata('msg', '<p>Editing of Birthdate Failed:</p>'.validation_errors());
	            redirect(base_url().'index.php/settings');
        	}
		}

		//edit address
		if($this->input->post('edit_addr')) {

			$this->form_validation->set_rules('addr', 'address', 'trim|required|callback_alpha_dash_space');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->settings_model->edit_addr($userid);
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successfully Edited Address!');
				redirect(base_url().'index.php/settings');
			}
			else 
			{
				$this->session->set_flashdata('msg2', 'danger');
	            $this->session->set_flashdata('msg', '<p>Editing of Address Failed:</p>'.validation_errors());
	            redirect(base_url().'index.php/settings');
        	}
		}

		//edit mobile
		if($this->input->post('edit_num')) {

			$this->form_validation->set_rules('mobile_num', 'mobile number', 'trim|required|is_natural');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->settings_model->edit_mobile($userid);
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successfully Edited Mobile Number!');
				redirect(base_url().'index.php/settings');
			}
			else 
			{
				$this->session->set_flashdata('msg2', 'danger');
	            $this->session->set_flashdata('msg', '<p>Editing of Mobile Number Failed:</p>'.validation_errors());
	            redirect(base_url().'index.php/settings');
        	}
		}

		//edit email
		if($this->input->post('edit_email')) {

			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->settings_model->edit_email($userid);
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successfully Edited Work Email Address!');
				redirect(base_url().'index.php/settings');
			}
			else 
			{
				$this->session->set_flashdata('msg2', 'danger');
	            $this->session->set_flashdata('msg', '<p>Editing of Work Email Address Failed:</p>'.validation_errors());
	            redirect(base_url().'index.php/settings');
        	}
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('admin/settings.php', $data);
		$this->load->view('templates/footer');
	}
}