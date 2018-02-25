<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Medical extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('medical_model');
		$this->load->helper('date');
		$this->is_logged_in();
		$this->current_time();
		$this->load->library("pagination");

		//disables back button browser
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
	}

	function alpha_dash_space($str_in)
	{
		if (! preg_match("/^([-a-z0-9_ ])+$/i", $str_in)) {
			$this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha-numeric characters, spaces, underscores, and dashes.');
			return FALSE;
		} 
		else {
			return TRUE;
		}
	}

	function index()
	{
		redirect(base_url().'index.php/medical/pending_medical_request');
	}

	function current_time()
	{
		$timezone = 'Asia/Manila';
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set($timezone);
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

	//medical requests
	public function approved_medical_request()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'Approved Medical Assistance Request';
		$data['menu'] = 'Medical';
		$data['count'] = $this->medical_model->approved_medical_count();
		$data['medical_title'] = 'Approved Medical Assistance Request';
		$data['empty'] = 'No Medical Assistance Benefit request approved yet!';

		$config = array();
        $config['base_url'] = base_url() . 'index.php/medical/approved_medical_request';
        $config['total_rows'] = $this->medical_model->approved_medical_count();
        $config['per_page'] = 30;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;

		$this->pagination->initialize($config);

		$data['medical_request'] = $this->medical_model->get_approved_medical_request($config['per_page'], $this->uri->segment(3));
		$data['receipt'] = $this->medical_model->get_receipt('Approved');
		$data['links'] = $this->pagination->create_links();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('admin/medical/medical_request', $data);
		$this->load->view('templates/footer');
	}

	public function pending_medical_request()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'Pending Medical Assistance Request';
		$data['menu'] = 'Medical';
		$data['count'] = $this->medical_model->pending_medical_count();
		$data['medical_title'] = 'Pending Medical Request';
		$data['empty'] = 'No Pending Medical Assistance Benefit request yet!';
		$data['receipt'] = $this->medical_model->get_receipt('Pending');

		$config = array();
        $config['base_url'] = base_url() . 'index.php/medical/pending_medical_request';
        $config['total_rows'] = $this->medical_model->pending_medical_count();
        $config['per_page'] = 30;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;

		$this->pagination->initialize($config);

		$data['medical_request'] = $this->medical_model->get_pending_medical_request($config['per_page'], $this->uri->segment(3));
		$data['links'] = $this->pagination->create_links();

		$this->form_validation->set_rules('medical_id', 'Medical id', 'required');

		if ($this->form_validation->run() === FALSE)
		{ 
			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu', $data);
			$this->load->view('admin/medical/index', $data);
			$this->load->view('templates/footer');
		}
		else{
			$update = $this->medical_model->assign_benefit_consumed();
			//$this->medical_model->decide_request();
			
			if($update === 'deleted'){
				$this->session->set_flashdata('msg2', 'danger');
				$this->session->set_flashdata('msg', 'The Pending medical request does not exist or it may have been deleted by the employee.');
				redirect(base_url().'index.php/medical/pending_medical_request');	
			}
			elseif($update === 'Approved'){
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Pending Request Approved!');
				redirect(base_url().'index.php/medical/pending_medical_request');
			}
			else{
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Pending Request Rejected!');
				redirect(base_url().'index.php/medical/pending_medical_request');
			}
		}
	}

	public function rejected_medical_request()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'Rejected Medical Assistance Request';
		$data['menu'] = 'Medical';
		$data['count'] = $this->medical_model->rejected_medical_count();
		$data['medical_title'] = 'Medical Request';
		$data['empty'] = 'No Rejected Medical Assistance Benefit request yet!';

		$config = array();
        $config['base_url'] = base_url() . 'index.php/medical/rejected_medical_request';
        $config['total_rows'] = $this->medical_model->rejected_medical_count();
        $config['per_page'] = 50;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;

		$this->pagination->initialize($config);

		$data['medical_request'] = $this->medical_model->get_rejected_medical_request($config['per_page'], $this->uri->segment(3));
		$data['receipt'] = $this->medical_model->get_receipt('Rejected');
		$data['links'] = $this->pagination->create_links();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('admin/medical/medical_request', $data);
		$this->load->view('templates/footer');
	}

	//base medical settings------------------------------------

	function medical_settings()
	{
		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'Medical Settings';
		$data['menu'] = 'Medical';
		$data['medical_settings_staff'] = $this->medical_model->get_medical_settings_staff();
		$data['medical_settings_faculty'] = $this->medical_model->get_medical_settings_faculty();

		$this->load->helper('form');
		$this->load->library('form_validation');

		if ( $this->input->post('edit_base') ) {

			$this->form_validation->set_rules('min_month', 'Minimum Month', 'required|is_natural');
			$this->form_validation->set_rules('max_month', 'Maximum Month', 'required|is_natural');
			$this->form_validation->set_rules('max_benefit', 'Max Benefit', 'required|decimal');

			if ($this->form_validation->run() !== FALSE)
			{
				$setting = $this->medical_model->edit_base_medical();
				if($setting === 'denied'){
					$this->session->set_flashdata('msg2', 'danger');
		        	$this->session->set_flashdata('msg', '<p>Editing Base Medical Setting failed:</p> Your input was not accepted as it will mess up the range in the other brackets.');
		       		redirect(base_url().'index.php/medical/medical_settings');
				}
				else{
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successful Edited Base Medical Setting');
           		redirect(base_url().'index.php/medical/medical_settings');
          	 	}
			} 
			else 
			{
			$this->session->set_flashdata('msg2', 'danger');
            $this->session->set_flashdata('msg', 'Editing Base Medical failed: '.validation_errors());
            redirect(base_url().'index.php/medical/medical_settings');
        	}
        }
		
		if ( $this->input->post('edit_base_probation') ) {

			$this->form_validation->set_rules('max_benefit', 'Max Benefit', 'required|is_natural');

			if ($this->form_validation->run() !== FALSE)
			{
				$setting = $this->medical_model->edit_base_medical();
				if($setting === 'denied'){
					$this->session->set_flashdata('msg2', 'danger');
		        	$this->session->set_flashdata('msg', '<p>Editing Base Medical Setting failed:</p> Your input was not accepted as it will mess up the range in the other brackets..');
		       		redirect(base_url().'index.php/medical/medical_settings');
				}
				else{
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successful Edited Base Medical Setting');
           		redirect(base_url().'index.php/medical/medical_settings');
          	 	}
			} 
			else 
			{
			$this->session->set_flashdata('msg2', 'danger');
            $this->session->set_flashdata('msg', 'Editing Base Medical failed: '.validation_errors());
            redirect(base_url().'index.php/medical/medical_settings');
        	}
        }
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu');
		$this->load->view('admin/medical/settings.php',$data);
		$this->load->view('templates/footer');
	}

	function medical_summary()
	{
	
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'Medical Summary';
		$data['menu'] = 'Leave';
		$data['empty'] = 'No Summary Available just yet!';
		$data['year'] = $this->medical_model->get_current_year();
		$data['all_year'] = $this->medical_model->get_all_year();
		$data['base_benefit'] = $this->medical_model->get_base_benefit();
		$data['medical_summary'] = $this->medical_model->get_medical_summary();
		$year = $this->medical_model->get_current_year();

		$this->form_validation->set_rules('search_year_id', 'Year', 'required');

		if ($this->form_validation->run() === FALSE)
		{ 
			$this->load->view('templates/header',$data);
			$this->load->view('templates/menu');
			$this->load->view('admin/medical/medical_summary',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			if($this->input->post('search_year_id') == $year['year_id'])
			{
				redirect(base_url().'index.php/medical/medical_summary');
			}
		
		//$data['all_base_leave'] = $this->leave_model->get_all_base_leave();

			$data['medical_summary'] = $this->medical_model->get_search_year_summary();
			$data['year'] = $this->medical_model->get_past_year();

			$this->load->view('templates/header',$data);
			$this->load->view('templates/menu');
			$this->load->view('admin/medical/past_medical_summary',$data);
			$this->load->view('templates/footer');
		}
	}

	function employee_medical_summary($employee_id = NULL)
	{
		if(is_numeric($employee_id) == FALSE)
		{
			show_404();
		}

		$data['employee'] = $this->medical_model->get_employees($employee_id);
		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'Employee Medical Summary';
		$data['menu'] = 'Leave';
		$data['empty'] = 'No Summary Available just yet!';

		if(empty($data['employee']))
		{
			show_404();
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['year'] = $this->medical_model->get_current_year();
		$year = $this->medical_model->get_current_year();
		$data['employee_type'] =$this->medical_model->get_employee_type($employee_id);
		$data['status'] = $this->medical_model->get_status($employee_id);
		$data['length_of_service'] = $this->medical_model->get_length_of_service($employee_id);
		$data['medical_settings'] = $this->medical_model->get_employee_medical_setting($data['employee_type'],$data['status'],$data['length_of_service']);
		$data['medical_summary'] = $this->medical_model->get_employee_medical_summary($employee_id);
		$data['all_year'] = $this->medical_model->get_all_year_employee($employee_id);
		$data['receipt'] = $this->medical_model->get_receipt('Approved');

		$data['id'] = $employee_id;

		$this->form_validation->set_rules('search_year_id', 'Year', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header',$data);
			$this->load->view('templates/menu');
			$this->load->view('admin/medical/employee_medical_summary',$data);
			$this->load->view('templates/footer');
		}
		else{

			if($this->input->post('search_year_id') == $year['year_id'])
			{
				redirect(base_url().'index.php/medical/employee_medical_summary/'.$employee_id);
			}
			$data['year'] = $this->medical_model->get_past_year();
			$data['medical_summary'] = $this->medical_model->get_past_employee_medical_summary($employee_id);
			$data['past_medical_settings'] = $this->medical_model->get_employee_past_medical_setting($employee_id);

			$this->load->view('templates/header',$data);
			$this->load->view('templates/menu');
			$this->load->view('admin/medical/past_employee_medical_summary',$data);
			$this->load->view('templates/footer');
		}
	}

	//add medical benefits to an employee
	/*
	function add_medical_benefit($employee_id = NULL)
	{
		if(is_numeric($employee_id) == FALSE)
		{
			show_404();
		}

		if(empty($employee_id))
		{
			show_404();
		}
		else
		{
			$this->load->helper('form');
			$this->load->library('form_validation');

			$data['employee_id'] = $employee_id;
			$data['username'] = $this->session->userdata('username');
			$data['employee'] = $this->medical_model->get_employees($employee_id);
			$data['title'] = 'Add Med Assistance Benefit';
			$data['menu'] = 'Medical';

			if (empty($data['employee']))
			{
				show_404();
			}

			$data['year'] = $this->medical_model->get_current_year();
			$data['employee_type'] =$this->medical_model->get_employee_type($employee_id);
			$data['status'] = $this->medical_model->get_status($employee_id);
			$data['length_of_service'] = $this->medical_model->get_length_of_service($employee_id);
			$data['current_medical_settings'] = $this->medical_model->get_employee_medical_setting($data['employee_type'],$data['status'],$data['length_of_service']);
			$data['medical_summary'] = $this->medical_model->get_my_medical_summary($employee_id);

			//$this->form_validation->set_rules('ltype', 'leave', 'required');
			$this->form_validation->set_rules('receipt_date[]', 'Date of Receipt', 'required');
			$this->form_validation->set_rules('receipt_number[]', 'OR number', 'required|alpha_numeric');
			$this->form_validation->set_rules('amount[]', 'Reimbursed Amount', 'required|decimal');
			$this->form_validation->set_rules('reason', 'Reason', 'required|callback_alpha_dash_space');

			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/header',$data);
				$this->load->view('templates/menu');
				$this->load->view('admin/medical/add_medical_benefit',$data);
				$this->load->view('templates/footer');
			}
			else
			{
				$amount_left = $this->input->post('amount_left');
				$amount_used = $this->input->post('amount');
				$total_ded = 0;
				foreach($amount_used as $amount):
				
					$total_ded = $total_ded + $amount;
				
				endforeach;

				if($amount_left - $total_ded < 0)
				{
					$this->session->set_flashdata('msg', 'Adding of Medical Assistance Benefit failed: Amount to be reimbursed is greater than the amount left for medical assistance.');
					$this->session->set_flashdata('msg2', 'danger');
					redirect(base_url().'index.php/medical/add_medical_benefit/'.$data['employee_id']);
				}

				if($total_ded == 0)
				{
					$this->session->set_flashdata('msg', 'Adding of Medical Assistance Benefit failed: Amount to be reimbursed is zero.');
					$this->session->set_flashdata('msg2', 'danger');
					redirect(base_url().'index.php/medical/add_medical_benefit/'.$data['employee_id']);
				}

				$this->medical_model->add_assistance($total_ded);
				$this->session->set_flashdata('msg','You have successfully added a Medical Assistance Benefit to an Employee!');
				$this->session->set_flashdata('msg2', 'success');
				redirect(base_url().'index.php/medical/add_medical_benefit/'.$data['employee_id']);
			}
		}
	}
	*/
}
//work in progress
