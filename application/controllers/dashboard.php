<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('leave_model');
		$this->load->model('medical_model');
		$this->load->model('cal_model');
		$this->current_time();

		//disables back button browser
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
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
		redirect(base_url().'index.php/dashboard/calendar');
	}
	
	function calendar($year = null,$month =null)
	{
		if($year == null){
		$data['username'] = $this->session->userdata('username');
		$data['usertype'] = $this->session->userdata('usertype');
		$data['title'] = 'Dashboard'; // Capitalize the first letter
		$data['menu'] = 'Dashboard';
		
		$data['calendar'] = $this->cal_model->generate($year,$month);

		$data['last_ranking'] = $this->cal_model->last_ranking();
		$data['pending_leave_count'] = $this->leave_model->pending_count();
		$data['pending_leave'] = $this->cal_model->get_pending_leave();
		$data['pending_medical_count'] = $this->medical_model->pending_medical_count();
		$data['pending_medical'] = $this->cal_model->get_pending_medical();
		$data['upcoming_bday'] = $this->cal_model->birthdays();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('templates/footer', $data);
	}
		elseif(is_numeric($year) == FALSE || is_numeric($month) == FALSE || $month > 12)
		{
			show_404();
		}
		else{
		$data['username'] = $this->session->userdata('username');
		$data['usertype'] = $this->session->userdata('usertype');
		$data['title'] = 'Dashboard'; // Capitalize the first letter
		$data['menu'] = 'Dashboard';
		
		$data['calendar'] = $this->cal_model->generate($year,$month);
		$data['last_ranking'] = $this->cal_model->last_ranking();
		$data['year'] = $year;
		$data['pending_leave_count'] = $this->leave_model->pending_count();
		$data['pending_leave'] = $this->cal_model->get_pending_leave();
		$data['pending_medical_count'] = $this->medical_model->pending_medical_count();
		$data['pending_medical'] = $this->cal_model->get_pending_medical();
		$data['upcoming_bday'] = $this->cal_model->birthdays();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('templates/footer', $data);
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
}
