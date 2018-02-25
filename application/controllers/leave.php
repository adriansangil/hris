<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Leave extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('employee_model');
		$this->load->model('leave_model');
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
	
	function index()
	{
		redirect(base_url().'index.php/leave/pending_leave');
	}

	public function pending_leave()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'leave';
		$data['menu'] = 'Leave';
		$data['count'] = $this->leave_model->pending_count();
		$data['leave_title'] = 'Pending Leave Request';
		$data['empty'] = 'No Pending leave request!';

		$config = array();
        $config['base_url'] = base_url() . 'index.php/leave/pending_leave';
        $config['total_rows'] = $this->leave_model->pending_count();
        $config['per_page'] = 50;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;

		$this->pagination->initialize($config);

		
		$data['all_leave_request'] = $this->leave_model->get_pending_leave_request($config['per_page'], $this->uri->segment(3));
		$data['links'] = $this->pagination->create_links();
		

		$this->form_validation->set_rules('leave_id', 'Leave id', 'required');
		$this->form_validation->set_rules('notes', 'notes', 'required|xss_clean');
		
		if ($this->form_validation->run() === FALSE)
		{ 
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('admin/leave/index', $data);
		$this->load->view('templates/footer');
		}
		else{
		$update = $this->leave_model->assign_leave_duration();
		//$this->leave_model->decide_request();
			if($update === 'deleted'){
				$this->session->set_flashdata('msg2', 'danger');
				$this->session->set_flashdata('msg', 'The Pending leave request does not exist or it may have been deleted by the employee.');
				redirect(base_url().'index.php/leave/pending_leave');	
			}
			elseif($update === 'Approved'){
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Pending Request Approved!');
				redirect(base_url().'index.php/leave/pending_leave');
			}
			else{
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Pending Request Rejected!');
				redirect(base_url().'index.php/leave/pending_leave');
			}
		}
	}

	public function approved_leave()
	{	
		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'leave';
		$data['menu'] = 'Leave';
		$data['count'] = $this->leave_model->approved_count();
		$data['leave_title'] = 'Approved Leave Request';
		$data['empty'] = 'No Approved leave request yet!';
 
		$config = array();
        $config['base_url'] = base_url() . 'index.php/leave/approved_leave';
        $config['total_rows'] = $this->leave_model->approved_count();
        $config['per_page'] = 30;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;

		$this->pagination->initialize($config);

		$data['approved_request'] = $this->leave_model->get_approved_leave_request($config['per_page'], $this->uri->segment(3));
		$data['links'] = $this->pagination->create_links();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('admin/leave/approved_leave', $data);
		$this->load->view('templates/footer');
	}

	public function rejected_leave()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'leave';
		$data['menu'] = 'Leave';
		$data['count'] = $this->leave_model->rejected_count();
		$data['leave_title'] = 'Rejected Leave Request';
		$data['empty'] = 'No Rejected leave request yet!';

		$config = array();
        $config['base_url'] = base_url() . 'index.php/leave/rejected_leave';
        $config['total_rows'] = $this->leave_model->rejected_count();
        $config['per_page'] = 30;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;

		$this->pagination->initialize($config);

		$data['rejected_request'] = $this->leave_model->get_rejected_leave_request($config['per_page'], $this->uri->segment(3));
		$data['links'] = $this->pagination->create_links();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('admin/leave/rejected_leave', $data);
		$this->load->view('templates/footer');
	}

	public function leave_type()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['username'] = $this->session->userdata('username');
		$data['all_leave_types'] = $this->leave_model->get_leave_types();
		$data['type_count'] = $this->leave_model->leave_type_count();
		$data['title'] = 'Leave Type Settings';
		$data['menu'] = 'Leave';
		
		//edit leave type
		if($this->input->post('edit_leave')) {

			$this->form_validation->set_rules('ltype', 'Leave type', 'trim|strtolower|ucwords|required|is_unique[leave_type.type]');
			$this->form_validation->set_rules('desc', 'Description', 'trim|required|callback_alpha_dash_space');

			$this->form_validation->set_message('is_unique', 'Leave type already exist.');	

			if ($this->form_validation->run() !== FALSE)
			{
				$this->leave_model->edit_leave();
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successfully Edited Leave Type!');
				redirect(base_url().'index.php/leave/leave_type');
			}
			else 
			{
				$this->session->set_flashdata('msg2', 'danger');
	            $this->session->set_flashdata('msg', '<p>Editing Leave Type failed:</p>'.validation_errors());
	            redirect(base_url().'index.php/leave/leave_type');
        	}

		}

		//add leave type
		if($this->input->post('add_leave')){

			$this->form_validation->set_rules('ltype', 'leave type', 'trim|required|strtolower|ucwords|callback_alpha_dash_space|is_unique[leave_type.type]');
			$this->form_validation->set_rules('desc', 'description', 'trim|required|callback_alpha_dash_space');

			$this->form_validation->set_message('is_unique', 'Leave type already exist.');
		
			if ($this->form_validation->run() !== FALSE)
			{
				$this->leave_model->set_leave_type();
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'New Leave Type Successfully Added!');
				redirect(base_url().'index.php/leave/leave_type');
			}
			else 
			{
				$this->session->set_flashdata('msg2', 'danger');
	            $this->session->set_flashdata('msg', '<p>Adding of Leave Type failed:</p>'.validation_errors());
	            redirect(base_url().'index.php/leave/leave_type');
        	}
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('admin/leave/leavetype', $data);
		$this->load->view('templates/footer');
	}

	public function delete_leave_type()
	{
		$id = $this->uri->segment(3);
		$this->leave_model->delete_leave_type($id);
		$this->session->set_flashdata('msg2', 'success');
		$this->session->set_flashdata('msg', 'Leave Type Successfully Deleted!');
		redirect(base_url().'index.php/leave/leave_type');
	}

	public function holidays()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['username'] = $this->session->userdata('username');
		$data['all_holidays'] = $this->leave_model->get_holidays();
		$data['all_holiday_type'] = $this->leave_model->get_holiday_type();
		$data['holiday_count'] = $this->leave_model->holiday_count();
		$data['holiday_type'] = $this->leave_model->get_holiday_type();
		$data['title'] = 'Holidays';
		$data['menu'] = 'Leave';
		$data['empty'] = 'No Holidays added just yet!';
		
		//edit holiday
		if($this->input->post('edit_holiday')) {

			$this->form_validation->set_rules('holiday_name', 'Name of Holiday', 'trim|required|callback_alpha_dash_space');
			$this->form_validation->set_rules('date', 'Date', 'required');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->leave_model->edit_holiday();
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successfully Edited Holiday!');
				redirect(base_url().'index.php/leave/holidays');
			}
			else 
			{
				$this->session->set_flashdata('msg2', 'danger');
	            $this->session->set_flashdata('msg', '<p>Editing of Holiday failed:</p>'.validation_errors());
	            redirect(base_url().'index.php/leave/holidays');
        	}

		}

		//add holiday
		if($this->input->post('add_holiday')) {

			$this->form_validation->set_rules('desc', 'Name of Holiday', 'trim|required|callback_alpha_dash_space');
			$this->form_validation->set_rules('date', 'Date', 'required');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->leave_model->set_holiday();
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successfully Added a New Holiday!');
				redirect(base_url().'index.php/leave/holidays');
			}
			else 
			{
				$this->session->set_flashdata('msg2', 'danger');
	            $this->session->set_flashdata('msg', '<p>Adding of Holiday failed:</p>'.validation_errors());
	            redirect(base_url().'index.php/leave/holidays');
        	}

		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('admin/leave/holidays', $data);
		$this->load->view('templates/footer');	
	}
	
	public function delete_holiday()
	{
		$id = $this->uri->segment(3);
		$this->leave_model->delete_holiday($id);
		$this->session->set_flashdata('msg2', 'success');
		$this->session->set_flashdata('msg', 'Holiday Successfully Deleted!');
		redirect(base_url().'index.php/leave/holidays');
	}
	
	//leave settings (base leave,max leave, convertible, etc.)
	public function leave_settings()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['username'] = $this->session->userdata('username');
		$data['vacation_settings_staff'] = $this->leave_model->get_vacation_leave_settings_staff();
		$data['vacation_settings_faculty'] = $this->leave_model->get_vacation_leave_settings_faculty();
		$data['sick_settings_staff'] = $this->leave_model->get_sick_leave_settings_staff();
		$data['sick_settings_faculty'] = $this->leave_model->get_sick_leave_settings_faculty();
		$data['title'] = 'Leave Settings';
		$data['menu'] = 'Leave';

		if ( $this->input->post('edit_base') ) {

			$this->form_validation->set_rules('min_month', 'Minimum Month', 'required|is_natural');
			$this->form_validation->set_rules('max_month', 'Maximum Month', 'required|is_natural');
			$this->form_validation->set_rules('max_leave', 'Max Leave', 'required|is_natural');
			$this->form_validation->set_rules('max_convertible', 'Max Convertible', 'required|is_natural');

			if ($this->form_validation->run() !== FALSE)
			{
				$setting = $this->leave_model->edit_base_leave();
				if($setting === 'denied'){
					$this->session->set_flashdata('msg2', 'danger');
		        	$this->session->set_flashdata('msg', '<p>Editing Base Leave Setting failed:</p> Range input conflict.');
		       		redirect(base_url().'index.php/leave/leave_settings');
				}
				else{
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successful Edited Base Leave Setting');
           		redirect(base_url().'index.php/leave/leave_settings');
          	 	}
			} 
			else 
			{
			$this->session->set_flashdata('msg2', 'danger');
            $this->session->set_flashdata('msg', 'Editing Base Leave failed: '.validation_errors());
            redirect(base_url().'index.php/leave/leave_settings');
        	}
        }
		
		if ( $this->input->post('edit_base_probation') ) {

			$this->form_validation->set_rules('max_leave', 'Max Leave', 'required|is_natural');
			$this->form_validation->set_rules('max_convertible', 'Max Convertible', 'required|is_natural');

			if ($this->form_validation->run() !== FALSE)
			{
				$setting = $this->leave_model->edit_base_leave();
				if($setting === 'denied'){
					$this->session->set_flashdata('msg2', 'danger');
		        	$this->session->set_flashdata('msg', '<p>Editing Base Leave Setting failed:</p> Range input conflict.');
		       		redirect(base_url().'index.php/leave/leave_settings');
				}
				else{
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successful Edited Base Leave Setting');
           		redirect(base_url().'index.php/leave/leave_settings');
          	 	}
			} 
			else 
			{
			$this->session->set_flashdata('msg2', 'danger');
            $this->session->set_flashdata('msg', 'Editing Base Leave failed: '.validation_errors());
            redirect(base_url().'index.php/leave/leave_settings');
        	}
        }

		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu');
		$this->load->view('admin/leave/settings.php',$data);
		$this->load->view('templates/footer');
	}

	//get leave history of employee
	function employee_leave_summary($employee_id = NULL)
	{
		if(is_numeric($employee_id) == FALSE)
		{
			show_404();
		}

		$data['employee'] = $this->employee_model->get_employees($employee_id);
		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'Employee Leave Summary';
		$data['menu'] = 'Leave';
		$data['empty'] = 'No Summary Available just yet!';

		if(empty($data['employee']))
		{
			show_404();
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['year'] = $this->leave_model->get_current_academic_year();
		$year = $this->leave_model->get_current_academic_year();
		$data['employee_type'] =$this->leave_model->get_employee_type($employee_id);
		$data['status'] = $this->leave_model->get_status($employee_id);
		$data['length_of_service'] = $this->employee_model->get_length_of_service($employee_id);
		$data['current_sick_leave_settings'] = $this->leave_model->get_employee_leave_setting($data['employee_type'],$data['status'],$data['length_of_service'],'Sick');
		$data['current_vacation_leave_settings'] = $this->leave_model->get_employee_leave_setting($data['employee_type'],$data['status'],$data['length_of_service'],'Vacation');
		$data['leave_summary'] = $this->leave_model->get_employee_leave_summary($employee_id);
		$data['all_academic_year'] = $this->leave_model->get_all_academic_year_employee($employee_id);

		$data['id'] = $employee_id;

		$this->form_validation->set_rules('search_year_id', 'School Year', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header',$data);
			$this->load->view('templates/menu');
			$this->load->view('admin/leave/employee_leave_summary',$data);
			$this->load->view('templates/footer');
		}
		else{
				if($this->input->post('search_year_id') == $year['academic_year_id'])
				{
					redirect(base_url().'index.php/leave/employee_leave_summary/'.$employee_id);
				}
			$data['year'] = $this->leave_model->get_past_academic_year();
			$data['leave_summary'] = $this->leave_model->get_past_employee_leave_summary($employee_id);
			$data['past_sick_leave_settings'] = $this->leave_model->get_employee_past_sl_leave_setting($employee_id);
			$data['past_vacation_leave_settings'] = $this->leave_model->get_employee_past_vl_leave_setting($employee_id);

			$this->load->view('templates/header',$data);
			$this->load->view('templates/menu');
			$this->load->view('admin/leave/past_employee_leave_summary',$data);
			$this->load->view('templates/footer');
		}
	}

	//get summary leave history of all employees
	function leave_summary()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'Leave Summary';
		$data['menu'] = 'Leave';
		$data['empty'] = 'No Summary Available just yet!';
		$data['year'] = $this->leave_model->get_current_academic_year();
		$data['leave_summary'] = $this->leave_model->get_leave_summary();
		$data['all_academic_year'] = $this->leave_model->get_all_academic_year();

		$data['sick_base_leave'] = $this->leave_model->get_base_leave_sick();
		$data['vacation_base_leave'] = $this->leave_model->get_base_leave_vacation();
		$data['all_base_leave'] = $this->leave_model->get_all_base_leave();
		$year = $this->leave_model->get_current_academic_year();
		
		//$summary = $this->leave_model->get_leave_summary();
		$this->form_validation->set_rules('search_year_id', 'School Year', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{ 
			$this->load->view('templates/header',$data);
			$this->load->view('templates/menu');
			$this->load->view('admin/leave/leave_summary',$data);
			$this->load->view('templates/footer');
		}
		else{
				if($this->input->post('search_year_id') == $year['academic_year_id'])
				{
					redirect(base_url().'index.php/leave/leave_summary');
				}

			$data['leave_summary'] = $this->leave_model->get_search_year_summary();
			$data['year'] = $this->leave_model->get_past_academic_year();
			
			$this->load->view('templates/header',$data);
			$this->load->view('templates/menu');
			$this->load->view('admin/leave/past_leave_summary',$data);
			$this->load->view('templates/footer');
		}
	}
}