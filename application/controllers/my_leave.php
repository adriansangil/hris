<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_leave extends CI_Controller {
	
	function __construct()
	{	
		parent::__construct();
		$this->load->model('user/my_profile_model');
		$this->load->model('user/my_leave_model');
		$this->current_time();
		$this->is_logged_in();
		$this->is_active();
		$this->load->library("pagination");

		//disables back button browser
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
	}

	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		$usertype = $this->session->userdata('usertype');
		
		if(!isset($is_logged_in) || $is_logged_in != true || $usertype == 'Admin')
		{
			$this->session->set_flashdata('msg', 'You do not have permission to access that page!');
			redirect(base_url(),'refresh');
		}
	}

	function is_active()
	{
		$data['employee'] = $this->my_profile_model->get_employee();
		$active = $data['employee']['active'];
		if($data['employee']['username'] === null){
			$this->session->sess_destroy();
			$this->session->set_flashdata('msg', 'You do not have permission to access that page!');
			redirect(base_url().'index.php/login');	
		}
	}

	function current_time()
	{
		$timezone = 'Asia/Manila';
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set($timezone);
		}
	}

	//my_leave_history
	function my_leave_history()
	{	
		$user_id = $this->session->userdata('user_id');
		
		$this->my_leave_model->clear_notification($user_id);

		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'My Leave History';
		$data['menu'] = 'My Leave';
		$data['count'] = $this->my_leave_model->leave_history_count($user_id);
		$data['status'] = $this->my_leave_model->get_status($user_id);
		$data['leave_title'] = 'My Leave History';
		$data['empty'] = 'No leave history yet';
		$data['employee'] =$this->my_leave_model->get_employee();
 
		$config = array();
        $config['base_url'] = base_url() . 'index.php/my_leave/my_leave_history';
        $config['total_rows'] = $this->my_leave_model->leave_history_count($user_id);
        $config['per_page'] = 30;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;

		$this->pagination->initialize($config);

		$data['leave_history'] = $this->my_leave_model->get_leave_history($config['per_page'], $this->uri->segment(3),$user_id);
		$data['links'] = $this->pagination->create_links();

		$this->load->view('templates/header2', $data);
		if($data['status'] == 'Regular' && $data['employee']['employee_type'] == 'Faculty'){
			$this->load->view('templates/mymenu', $data);
		}
		elseif($data['status'] == 'Regular' && $data['employee']['employee_type'] == 'Staff'){
			$this->load->view('templates/mymenu_without_rank', $data);
		}
		else{
			$this->load->view('templates/mymenu_without_rank_medical', $data);
		}
		$this->load->view('employee/leave/leave_history', $data);
		$this->load->view('templates/footer');
	}

	function my_pending_request()
	{	
		$user_id = $this->session->userdata('user_id');

		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'My Pending Request';
		$data['menu'] = 'My Leave';
		$data['count'] = $this->my_leave_model->pending_request_count($user_id);
		$data['status'] = $this->my_leave_model->get_status($user_id);
		$data['leave_title'] = 'My Pending Request';
		$data['empty'] = 'No Pending Request!';
		$data['employee'] =$this->my_leave_model->get_employee();

 
		$config = array();
        $config['base_url'] = base_url() . 'index.php/my_leave/my_pending_request';
        $config['total_rows'] = $this->my_leave_model->pending_request_count($user_id);
        $config['per_page'] = 50;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;

		$this->pagination->initialize($config);

		$data['leave_history'] = $this->my_leave_model->get_pending_request($config['per_page'], $this->uri->segment(3),$user_id);
		$data['links'] = $this->pagination->create_links();

		$this->load->view('templates/header2', $data);
		if($data['status'] == 'Regular' && $data['employee']['employee_type'] == 'Faculty'){
			$this->load->view('templates/mymenu', $data);
		}
		elseif($data['status'] == 'Regular' && $data['employee']['employee_type'] == 'Staff'){
			$this->load->view('templates/mymenu_without_rank', $data);
		}
		else{
			$this->load->view('templates/mymenu_without_rank_medical', $data);
		}
		$this->load->view('employee/leave/pending_leave', $data);
		$this->load->view('templates/footer');
	}

	function my_leave_summary()
	{	
		$user_id = $this->session->userdata('user_id');
		$data['username'] = $this->session->userdata('username');
		$data['employee'] = $this->my_profile_model->get_employee();
		$data['title'] = 'Employee Leave Summary';
		$data['menu'] = 'Leave';
		$data['empty'] = 'No Summary Available just yet!';
		$data['employee'] =$this->my_leave_model->get_employee();
		

		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['year'] = $this->my_leave_model->get_current_academic_year();
		$year = $this->my_leave_model->get_current_academic_year();
		$data['employee_type'] =$this->my_leave_model->get_employee_type($user_id);
		$data['status'] = $this->my_leave_model->get_status($user_id);
		$data['length_of_service'] = $this->my_leave_model->get_length_of_service($user_id);
		$data['current_sick_leave_settings'] = $this->my_leave_model->get_employee_leave_setting($data['employee_type'],$data['status'],$data['length_of_service'],'Sick');
		$data['current_vacation_leave_settings'] = $this->my_leave_model->get_employee_leave_setting($data['employee_type'],$data['status'],$data['length_of_service'],'Vacation');
		$data['leave_summary'] = $this->my_leave_model->get_employee_leave_summary($user_id);
		$data['all_academic_year'] = $this->my_leave_model->get_all_academic_year_employee($user_id);

		$data['id'] = $user_id;

		$this->form_validation->set_rules('search_year_id', 'School Year', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header2',$data);
			if($data['status'] == 'Regular' && $data['employee']['employee_type'] == 'Faculty'){
			$this->load->view('templates/mymenu', $data);
			}
			elseif($data['status'] == 'Regular' && $data['employee']['employee_type'] == 'Staff'){
				$this->load->view('templates/mymenu_without_rank', $data);
			}
			else{
				$this->load->view('templates/mymenu_without_rank_medical', $data);
			}
			$this->load->view('employee/leave/my_leave_summary',$data);
			$this->load->view('templates/footer');
		}

		else{
				if($this->input->post('search_year_id') == $year['academic_year_id'])
				{
					redirect(base_url().'index.php/my_leave/my_leave_summary');
				}
			$data['year'] = $this->my_leave_model->get_past_academic_year();
			$data['leave_summary'] = $this->my_leave_model->get_past_employee_leave_summary($user_id);
			$data['past_sick_leave_settings'] = $this->my_leave_model->get_employee_past_sl_leave_setting($user_id);
			$data['past_vacation_leave_settings'] = $this->my_leave_model->get_employee_past_vl_leave_setting($user_id);

			$this->load->view('templates/header2',$data);
			if($data['status'] == 'Regular' && $data['employee']['employee_type'] == 'Faculty'){
			$this->load->view('templates/mymenu', $data);
			}
			elseif($data['status'] == 'Regular' && $data['employee']['employee_type'] == 'Staff'){
				$this->load->view('templates/mymenu_without_rank', $data);
			}
			else{
				$this->load->view('templates/mymenu_without_rank_medical', $data);
			}
			$this->load->view('employee/leave/my_past_leave_summary',$data);
			$this->load->view('templates/footer');
		}
	}

	function apply_leave()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$user_id = $this->session->userdata('user_id');
		$data['employee_id'] = $user_id;
		$data['username'] = $this->session->userdata('username');
		$data['employee'] = $this->my_profile_model->get_employee();
		$data['title'] = 'Apply Leave';
		$data['menu'] = 'Leave';
		$data['employee'] =$this->my_leave_model->get_employee();

		$data['year'] = $this->my_leave_model->get_current_academic_year();
		$data['employee_type'] =$this->my_leave_model->get_employee_type($user_id);
		$data['status'] = $this->my_leave_model->get_status($user_id);
		$data['length_of_service'] = $this->my_leave_model->get_length_of_service($user_id);
		$data['current_sick_leave_settings'] = $this->my_leave_model->get_employee_leave_setting($data['employee_type'],$data['status'],$data['length_of_service'],'Sick');
		$data['current_vacation_leave_settings'] = $this->my_leave_model->get_employee_leave_setting($data['employee_type'],$data['status'],$data['length_of_service'],'Vacation');
		$data['leave_summary'] = $this->my_leave_model->get_my_leave_summary($user_id);
		$data['leave_type'] = $this->my_leave_model->get_leave_types();

		//$this->form_validation->set_rules('ltype', 'leave', 'required');
		$this->form_validation->set_rules('start_date', 'Start date', 'required');
		$this->form_validation->set_rules('end_date', 'End date', 'required');
		$this->form_validation->set_rules('reason', 'Reason', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header2',$data);
			if($data['status'] == 'Regular' && $data['employee']['employee_type'] == 'Faculty'){
			$this->load->view('templates/mymenu', $data);
			}
			elseif($data['status'] == 'Regular' && $data['employee']['employee_type'] == 'Staff'){
				$this->load->view('templates/mymenu_without_rank', $data);
			}
			else{
				$this->load->view('templates/mymenu_without_rank_medical', $data);
			}
			$this->load->view('employee/leave/apply_leave',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			$duration = $this->my_leave_model->check_duration();

			if($duration < 0){
			$this->session->set_flashdata('msg','Leave request failed: End date of the leave must not be before start date.');
			redirect(base_url().'index.php/my_leave/apply_leave');
			}
			$halfdays = $this->input->post('start_half') + $this->input->post('end_half');
			$duration = $duration + 1 - $halfdays;
			if($duration <=0)
			{
				$this->session->set_flashdata('msg', 'Leave request failed: The duration of leave = '.$duration.' day/s');
				redirect(base_url().'index.php/my_leave/apply_leave');
			}

			$holidays = $this->my_leave_model->check_on_holiday();
			$duration = $duration - $holidays;
			if($duration <=0)
			{
				$this->session->set_flashdata('msg', 'Leave request failed: Due to your leave falling on a holilday the length of leave was reduced to '.$duration.' day/s.');
				redirect(base_url().'index.php/my_leave/apply_leave');
			}

			$this->my_leave_model->apply_leave($duration);
			$this->session->set_flashdata('msg2', 'success');
			$this->session->set_flashdata('msg','You have successfully submitted a leave request');
			redirect(base_url().'index.php/my_leave/my_pending_request');
		}
	}

	function delete_pending_request()
	{
		$id = $this->uri->segment(3);
		$delete = $this->my_leave_model->delete_request($id);
		if($delete == 'failed'){
			$this->session->set_flashdata('msg2', 'danger');
			$this->session->set_flashdata('msg', 'The pending leave request does not exist or it may have already been approved or rejected.');
			redirect(base_url().'index.php/my_leave/my_pending_request');
		}
		else{
			$this->session->set_flashdata('msg2', 'success');
			$this->session->set_flashdata('msg', 'Pending Leave Request Successfully Deleted!');
			redirect(base_url().'index.php/my_leave/my_pending_request');
		}
	}
}