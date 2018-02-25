<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_ranking extends CI_Controller {
	
	function __construct()
	{	
		parent::__construct();
		$this->load->model('user/my_profile_model');
		$this->load->model('user/my_ranking_model');
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
			redirect(base_url().'index.php/my_dashboard');	
		}
	}
	
	function index()
	{
		$data['username'] = $this->session->userdata('username');
		$data['title'] ='My Ranking';
		$data['menu'] = 'My Ranking';
		$employee_id = $this->session->userdata('user_id');
		$data['status'] = $this->my_ranking_model->get_status($employee_id);
		$data['employee'] = $this->my_profile_model->get_employee();
		$data['empty'] = 'No Educational Attainment Added!';

		if($data['status'] =='Probationary' || $data['employee']['employee_type'] == 'Staff'){
			$this->session->set_flashdata('msg', 'You do not have permission to access that page!');
			redirect(base_url().'index.php/login');	
		}
		
		
		//criteria
		$educ_criteria = 'Educational Attainment';
		$work_criteria = 'Working Experience';
		$cert_criteria = 'Certifications or Board/Government Examinations Passed';

		//education
		$data['education_setting'] = $this->my_ranking_model->get_educational_settings();
		$data['education_summary'] = $this->my_ranking_model->get_employee_education_summary($employee_id);
		$data['highest_education_attained'] = $this->my_ranking_model->get_educ_high($employee_id);
		//work experience current
		$data['current_work_summary'] = $this->my_ranking_model->get_work_ici($employee_id);
		//work experience previous
		$data['prev_work_summary'] = $this->my_ranking_model->get_employee_work_summary($employee_id);
		$data['work_points'] = $this->my_ranking_model->get_work_points($data['employee']['employee_type_id']);
		$data['work_type'] = $this->my_ranking_model->get_work_type();
		//certificate
		$data['cert_exam_setting'] = $this->my_ranking_model->get_cert_exam_settings();
		$data['certification_summary'] = $this->my_ranking_model->get_employee_certification_summary($employee_id);
		$data['base_certificate'] = $this->my_ranking_model->get_exam_base_points($data['employee']['employee_type_id']);
		//calculations
		$data['educ_multiplier'] = $this->my_ranking_model->get_multiplier($educ_criteria,$data['employee']['employee_type_id']);
		$data['work_multiplier'] = $this->my_ranking_model->get_multiplier($work_criteria,$data['employee']['employee_type_id']);
		$data['cert_multiplier'] = $this->my_ranking_model->get_multiplier($cert_criteria,$data['employee']['employee_type_id']);
		$data['reference'] = $this->my_ranking_model->get_rank_reference($data['employee']['employee_type_id']);
		//faculty reference
		$data['lowest_fac_rank'] = $this->my_ranking_model->get_lowest_faculty_rank();
		$data['reference'] = $this->my_ranking_model->get_rank_reference($data['employee']['employee_type_id']);
		//staff reference
		$data['lowest_staff_rank'] = $this->my_ranking_model->get_lowest_staff_rank();
		$data['staff_reference'] = $this->my_ranking_model->get_staff_rank_reference();
		$data['unskilled'] = $this->my_ranking_model->get_staff_rank_unskilled();
		$data['semiskilled'] = $this->my_ranking_model->get_staff_rank_semi_skilled();
		$data['management'] = $this->my_ranking_model->get_staff_rank_management();
		//ranking history
		$data['rank_history'] = $this->my_ranking_model->get_ranking_history($employee_id);


		$this->load->view('templates/header2', $data);
		if($data['status'] == 'Regular'){
			$this->load->view('templates/mymenu', $data);
		}
		else{
			$this->load->view('templates/mymenu_without_rank', $data);
		}
		$this->load->view('employee/ranking/my_ranking', $data);
		$this->load->view('templates/footer', $data);
	}
}