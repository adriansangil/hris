<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_dashboard extends CI_Controller {

	function __construct()
	{	
		parent::__construct();
		$this->load->model('user/my_profile_model');
		$this->load->model('user/my_dashboard_model');		
		$this->load->model('user/my_leave_model');
		$this->is_logged_in();
		$this->is_active();
		$this->load->model('user/my_cal_model');
		$this->current_time();

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
	
	function index()
	{
		redirect(base_url().'index.php/my_dashboard/my_calendar');
	}
	
	function my_calendar($year = null,$month = null)
	{
		if($year == null){
		$user_id = $this->session->userdata('user_id');
	
		$data['username'] = $this->session->userdata('username');
		$data['status'] = $this->my_leave_model->get_status($user_id);
		$data['title'] = 'My Dashboard';
		$data['menu'] = 'Dashboard';
		$data['employee'] = $this->my_dashboard_model->get_employee();

		$data['calendar'] = $this->my_cal_model->generate($year,$month);

		$data['last_ranking'] = $this->my_cal_model->last_ranking();
		$data['pending_leave_count'] = $this->my_dashboard_model->pending_count($user_id);
		$data['pending_leave'] = $this->my_cal_model->get_pending_leave($user_id);
		$data['pending_medical_count'] = $this->my_dashboard_model->pending_medical_count($user_id);
		$data['pending_medical'] = $this->my_cal_model->get_pending_medical($user_id);
		$data['upcoming_bday'] = $this->my_cal_model->birthdays();
		$data['recent_leave'] = $this->my_cal_model->get_recent_leave($user_id);
		$data['recent_medical'] = $this->my_cal_model->get_recent_medical($user_id);
	
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
		$this->load->view('employee/mydashboard',$data);
		$this->load->view('templates/footer', $data);
		}
		elseif(is_numeric($year) == FALSE || is_numeric($month) == FALSE || $month > 12)
		{
			show_404();
		}
		else{
		$user_id = $this->session->userdata('user_id');
		$data['status'] = $this->my_leave_model->get_status($user_id);
		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'My Dashboard';
		$data['menu'] = 'Dashboard';
		$data['employee'] = $this->my_dashboard_model->get_employee();

		$data['calendar'] = $this->my_cal_model->generate($year,$month);

		$data['last_ranking'] = $this->my_cal_model->last_ranking();
		$data['pending_leave_count'] = $this->my_dashboard_model->pending_count($user_id);
		$data['pending_leave'] = $this->my_cal_model->get_pending_leave($user_id);
		$data['pending_medical_count'] = $this->my_dashboard_model->pending_medical_count($user_id);
		$data['pending_medical'] = $this->my_cal_model->get_pending_medical($user_id);
		$data['upcoming_bday'] = $this->my_cal_model->birthdays();
		$data['recent_leave'] = $this->my_cal_model->get_recent_leave($user_id);
		$data['recent_medical'] = $this->my_cal_model->get_recent_medical($user_id);
	
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
		$this->load->view('employee/mydashboard',$data);
		$this->load->view('templates/footer', $data);
		}
	}
}