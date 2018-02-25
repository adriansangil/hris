<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_profile extends CI_Controller {
	
	function __construct()
	{	
		parent::__construct();
		$this->load->model('user/my_profile_model');
		$this->load->model('user/my_leave_model');
		$this->load->model('user/my_medical_model');
		$this->is_logged_in();
		$this->is_active();

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
	
	function index()
	{

		$this->load->helper('form');

		$user_id = $this->session->userdata('user_id');
		$data['username'] = $this->session->userdata('username');
		$data['title'] ='My Profile';
		$data['menu'] = 'My Profile';
		$data['employee'] = $this->my_profile_model->get_employee();

		
		$this->load->model('user/my_image_model');
		//upload photo
		if($this->input->post('upload')) {
			$data['uploadmsg'] = $this->my_image_model->do_upload($user_id);
		}
		
		$data['employee_type'] =$this->my_leave_model->get_employee_type($user_id);
		$data['status'] = $this->my_leave_model->get_status($user_id);
		$data['length_of_service'] = $this->my_profile_model->get_length_of_service($user_id);
		$data['current_sick_leave_settings'] = $this->my_leave_model->get_employee_leave_setting($data['employee_type'],$data['status'],$data['length_of_service'],'Sick');
		$data['current_vacation_leave_settings'] = $this->my_leave_model->get_employee_leave_setting($data['employee_type'],$data['status'],$data['length_of_service'],'Vacation');
		$data['current_medical_settings'] = $this->my_medical_model->get_employee_medical_setting($data['employee_type'],$data['status'],$data['length_of_service']);
		$data['employee_record'] = $this->my_profile_model->get_employee_record($user_id);
		$data['employee_medical_record'] = $this->my_profile_model->get_employee_medical_record($user_id);

		//employee ranking
		//faculty
		$data['highest_education_attained'] = $this->my_profile_model->get_educ_high($user_id);
		$data['lowest_fac_rank'] = $this->my_profile_model->get_lowest_faculty_rank();
		$data['faculty_teach_duration'] = $this->my_profile_model->total_teach_duration($user_id,$data['employee']['employee_type']);
		$data['reference'] = $this->my_profile_model->get_rank_reference($data['employee']['employee_type_id']);
		//staff
		$data['lowest_staff_rank'] = $this->my_profile_model->get_lowest_staff_rank();
		$data['staff_reference'] = $this->my_profile_model->get_staff_rank_reference();
		$data['unskilled'] = $this->my_profile_model->get_staff_rank_unskilled();
		$data['semiskilled'] = $this->my_profile_model->get_staff_rank_semi_skilled();
		$data['management'] = $this->my_profile_model->get_staff_rank_management();

		$data['educ_total'] = $this->my_profile_model->get_educ_total($user_id);
		$data['work_total'] = $this->my_profile_model->get_work_total($user_id,$data['employee']['employee_type'],$data['employee']['employee_type_id']);
		$data['cert_total'] = $this->my_profile_model->get_cert_total($user_id,$data['employee']['employee_type_id']);

		//criteria
		$educ_criteria = 'Educational Attainment';
		$work_criteria = 'Working Experience';
		$cert_criteria = 'Certifications or Board/Government Examinations Passed';

		$data['educ_multiplier'] = $this->my_profile_model->get_multiplier($educ_criteria,$data['employee']['employee_type_id']);
		$data['work_multiplier'] = $this->my_profile_model->get_multiplier($work_criteria,$data['employee']['employee_type_id']);
		$data['cert_multiplier'] = $this->my_profile_model->get_multiplier($cert_criteria,$data['employee']['employee_type_id']);



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
		$this->load->view('employee/profile/my_profile', $data);
		$this->load->view('templates/footer', $data);
	}
}