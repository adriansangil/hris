<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ranking extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ranking_model');
		$this->load->helper('date');
		$this->is_logged_in();
		$this->current_time();

		//disables back button browser
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
	}

	function index()
	{
		redirect(base_url().'index.php/ranking/ranking_summary');
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

	//ranking summary
	function ranking_summary()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'Ranking Summary';
		$data['menu'] = 'Ranking';
		$data['empty'] = 'No Summary Available just yet!';
		$data['faculty_ranking_summary'] = $this->ranking_model->get_faculty_ranking_summary();
		//$data['staff_ranking_summary'] = $this->ranking_model->get_staff_ranking_summary();
		$data['rerank']	= $this->ranking_model->get_last_rerank();
		$data['all_rank'] = $this->ranking_model->get_all_rank_dates();
		$data['rank_date'] = $this->ranking_model->get_current_rank_date();

		$this->form_validation->set_rules('search_rank_date', 'Date', 'required');

		if ($this->form_validation->run() === FALSE)
		{ 
			$this->load->view('templates/header',$data);
			$this->load->view('templates/menu');
			$this->load->view('admin/ranking/ranking_summary',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			if($this->input->post('search_rank_date') == $data['rank_date']['rank_date_id'])
			{
				redirect(base_url().'index.php/ranking/ranking_summary');
			}
			
			$data['faculty_ranking_summary'] = $this->ranking_model->get_search_rank_date_summary_faculty();
			//$data['staff_ranking_summary'] = $this->ranking_model->get_search_rank_date_summary_staff();
			$data['rank_date'] = $this->ranking_model->get_past_rank_date();

			$this->load->view('templates/header',$data);
			$this->load->view('templates/menu');
			$this->load->view('admin/ranking/past_ranking_summary',$data);
			$this->load->view('templates/footer'); 
			
		}
	}

	//edit ranking
	function employee_ranking($employee_id = NULL)
	{	
		if(is_numeric($employee_id) == FALSE)
		{
			show_404();
		}
		$data['employee'] = $this->ranking_model->get_employees($employee_id);
		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'Employee Ranking';
		$data['menu'] = 'Ranking';
		$data['empty'] = 'No Educational Attainment Available just yet!';
		$data['status'] = $this->ranking_model->get_status($employee_id);

		if(empty($data['employee']))
		{
			show_404();
		}

		if($data['employee']['employee_type'] == 'Staff')
		{
			show_404();
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		//criteria
		$educ_criteria = 'Educational Attainment';
		$work_criteria = 'Working Experience';
		$cert_criteria = 'Certifications or Board/Government Examinations Passed';

		//education
		$data['education_setting'] = $this->ranking_model->get_educational_settings();
		$data['education_summary'] = $this->ranking_model->get_employee_education_summary($employee_id);
		$data['highest_education_attained'] = $this->ranking_model->get_educ_high($employee_id);
		//work experience current
		$data['current_work_summary'] = $this->ranking_model->get_work_ici($employee_id);
		//work experience previous
		$data['prev_work_summary'] = $this->ranking_model->get_employee_work_summary($employee_id);
		$data['work_points'] = $this->ranking_model->get_work_points($data['employee']['employee_type_id']);
		$data['work_type'] = $this->ranking_model->get_work_type();
		//certificate
		$data['cert_exam_setting'] = $this->ranking_model->get_cert_exam_settings();
		$data['certification_summary'] = $this->ranking_model->get_employee_certification_summary($employee_id);
		$data['base_certificate'] = $this->ranking_model->get_exam_base_points($data['employee']['employee_type_id']);
		//calculations
		$data['educ_multiplier'] = $this->ranking_model->get_multiplier($educ_criteria,$data['employee']['employee_type_id']);
		$data['work_multiplier'] = $this->ranking_model->get_multiplier($work_criteria,$data['employee']['employee_type_id']);
		$data['cert_multiplier'] = $this->ranking_model->get_multiplier($cert_criteria,$data['employee']['employee_type_id']);
		//faculty reference
		$data['lowest_fac_rank'] = $this->ranking_model->get_lowest_faculty_rank();
		$data['reference'] = $this->ranking_model->get_rank_reference($data['employee']['employee_type_id']);
		//staff reference
		$data['lowest_staff_rank'] = $this->ranking_model->get_lowest_staff_rank($data['employee']['job_position_id']);
		$data['staff_reference'] = $this->ranking_model->get_staff_rank_reference($data['employee']['job_position_id']);
		$data['unskilled'] = $this->ranking_model->get_staff_rank_unskilled();
		$data['semiskilled'] = $this->ranking_model->get_staff_rank_semi_skilled();
		$data['management'] = $this->ranking_model->get_staff_rank_management();
		//ranking history
		$data['rank_history'] = $this->ranking_model->get_ranking_history($employee_id);


		//add education
		if ( $this->input->post('add_educ') ) {

			$this->form_validation->set_rules('course', 'Course', 'required|callback_alpha_dash_space');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->ranking_model->add_educ_attainment($employee_id);
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successful Added Educational Attainment');
           		redirect(base_url().'index.php/ranking/employee_ranking/'.$employee_id);
			} 
			else 
			{
			$this->session->set_flashdata('msg2', 'danger');
            $this->session->set_flashdata('msg', 'Adding Educational attainment failed: '.validation_errors());
            redirect(base_url().'index.php/ranking/employee_ranking/'.$employee_id);
        	}
        }

        //edit education
        if ( $this->input->post('edit_educ') ) {

			$this->form_validation->set_rules('course', 'Course', 'required|callback_alpha_dash_space');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->ranking_model->edit_educ_attainment();
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successful Edited Educational Attainment');
           		redirect(base_url().'index.php/ranking/employee_ranking/'.$employee_id);
			} 
			else 
			{
			$this->session->set_flashdata('msg2', 'danger');
            $this->session->set_flashdata('msg', 'Editing Educational attainment failed: '.validation_errors());
            redirect(base_url().'index.php/ranking/employee_ranking/'.$employee_id);
        	}
        }

        //add work exp
		if ( $this->input->post('add_exp') ) {

			$this->form_validation->set_rules('employer', 'Employer', 'required|callback_alpha_dash_space');
			$this->form_validation->set_rules('duration', 'Work Duration', 'required|is_natural');
			$this->form_validation->set_rules('startdate', 'Start Date', 'required');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->ranking_model->add_work_exp($employee_id);
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successful Added Work Experience');
           		redirect(base_url().'index.php/ranking/employee_ranking/'.$employee_id);
			} 
			else 
			{
			$this->session->set_flashdata('msg2', 'danger');
            $this->session->set_flashdata('msg', 'Adding Work Experience failed: '.validation_errors());
            redirect(base_url().'index.php/ranking/employee_ranking/'.$employee_id);
        	}
        }

        //edit work exp
        if ( $this->input->post('edit_work') ) {

			$this->form_validation->set_rules('employer', 'Employer', 'required|callback_alpha_dash_space');
			$this->form_validation->set_rules('duration', 'Work Duration', 'required|is_natural');
			$this->form_validation->set_rules('startdate', 'Start Date', 'required');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->ranking_model->edit_work_exp();
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successful Edited Work Experience');
           		redirect(base_url().'index.php/ranking/employee_ranking/'.$employee_id);
			} 
			else 
			{
			$this->session->set_flashdata('msg2', 'danger');
            $this->session->set_flashdata('msg', 'Editing Work Experience failed: '.validation_errors());
            redirect(base_url().'index.php/ranking/employee_ranking/'.$employee_id);
        	}
        }

        //add certification or exams passed
        if ( $this->input->post('add_cert') ) {

			$this->form_validation->set_rules('exam', 'Certification / Exam', 'required|callback_alpha_dash_space');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->ranking_model->add_cert_acquired($employee_id);
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successful Added Certification /Examination Passed');
           		redirect(base_url().'index.php/ranking/employee_ranking/'.$employee_id);
			} 
			else 
			{
			$this->session->set_flashdata('msg2', 'danger');
            $this->session->set_flashdata('msg', 'Adding Certification / Examination Passed failed: '.validation_errors());
            redirect(base_url().'index.php/ranking/employee_ranking/'.$employee_id);
        	}
        }

        //edit certification / exam
        if ( $this->input->post('edit_cert') ) {

			$this->form_validation->set_rules('cert_description', 'Certification/Exam', 'required|callback_alpha_dash_space');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->ranking_model->edit_cert_board();
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successful Edited Certification/Exam Passed');
           		redirect(base_url().'index.php/ranking/employee_ranking/'.$employee_id);
			} 
			else 
			{
			$this->session->set_flashdata('msg2', 'danger');
            $this->session->set_flashdata('msg', 'Editing Certification/Exam Passed failed: '.validation_errors());
            redirect(base_url().'index.php/ranking/employee_ranking/'.$employee_id);
        	}
        }

		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu');
		$this->load->view('admin/ranking/employee_ranking',$data);
		$this->load->view('templates/footer');
	}

	//ranking settings----------------------------------------------
	function education_settings()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$staff = 'Staff';
		$faculty = 'Faculty';

		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'Education Settings';
		$data['menu'] = 'Ranking';
		//staff education settings
		//$data['tech_vocational_staff'] = $this->ranking_model->get_ed_technical_vocational_settings($staff);
		//$data['bachelor_staff'] = $this->ranking_model->get_ed_bachelor_settings($staff);
		//$data['masters_other_staff'] = $this->ranking_model->get_ed_masters_other_settings($staff);
		//$data['masters_staff'] = $this->ranking_model->get_ed_masters_settings($staff);
		//$data['doctorate_other_staff'] = $this->ranking_model->get_ed_doc_others_settings($staff);
		//$data['doctorate_staff'] = $this->ranking_model->get_ed_doc_settings($staff);
		//faculty education settings
		$data['tech_vocational_faculty'] = $this->ranking_model->get_ed_technical_vocational_settings($faculty);
		$data['bachelor_faculty'] = $this->ranking_model->get_ed_bachelor_settings($faculty);
		$data['masters_other_faculty'] = $this->ranking_model->get_ed_masters_other_settings($faculty);
		$data['masters_faculty'] = $this->ranking_model->get_ed_masters_settings($faculty);
		$data['doctorate_other_faculty'] = $this->ranking_model->get_ed_doc_others_settings($faculty);
		$data['doctorate_faculty'] = $this->ranking_model->get_ed_doc_settings($faculty);

		$this->form_validation->set_rules('points', 'Point', 'required|is_natural');

		$this->form_validation->set_message('is_natural', '<div class="alert alert-danger alert-dismissable">
			 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div class="text-center">Edit Failed: The point field must only contain natural numbers.</div>
				</div>');
		$this->form_validation->set_message('required', '<div class="alert alert-danger alert-dismissable">
			 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div class="text-center">Edit Failed: The point field is required.</div>
				</div>');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header',$data);
			$this->load->view('templates/menu');
			$this->load->view('admin/ranking/education_settings.php',$data);
			$this->load->view('templates/footer');
		}
		else{
			$this->ranking_model->edit_educ_setting();
			$this->session->set_flashdata('msg', 'Education Setting edit Successful!');
			redirect(base_url().'index.php/ranking/education_settings');
		}
	}

	//delete educ attainment
	function delete_education_attainment()
	{
		$educ_id = $this->uri->segment(3);
		$employee_id = $this->ranking_model->delete_educ_attainment($educ_id);
		$this->session->set_flashdata('msg2', 'success');
		$this->session->set_flashdata('msg', 'Removed Educational Attainment');
		redirect(base_url().'index.php/ranking/employee_ranking/'.$employee_id);
	}

	//delete work exp
	function delete_work_experience()
	{
		$work_id = $this->uri->segment(3);
		$employee_id = $this->ranking_model->delete_work_exp($work_id);
		$this->session->set_flashdata('msg2', 'success');
		$this->session->set_flashdata('msg', 'Removed Work Experience');
		redirect(base_url().'index.php/ranking/employee_ranking/'.$employee_id);
	}

	//delete certification / exam
	function delete_cert_board()
	{
		$cert_id = $this->uri->segment(3);
		$employee_id = $this->ranking_model->delete_cert_board($cert_id);
		$this->session->set_flashdata('msg2', 'success');
		$this->session->set_flashdata('msg', 'Removed Certification/Exam passed');
		redirect(base_url().'index.php/ranking/employee_ranking/'.$employee_id);
	}

	//work experience settings
	function work_experience_settings()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//$staff = 'Staff';
		$faculty = 'Faculty';

		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'Work Experience Settings';
		$data['menu'] = 'Ranking';

		//staff work exp setting
		//$data['work_staff'] = $this->ranking_model->get_work_settings($staff);

		$data['work_faculty'] = $this->ranking_model->get_work_settings($faculty);

		$this->form_validation->set_rules('points', 'Point', 'required|is_natural');
		$this->form_validation->set_rules('min_month', 'Min Month', 'required|is_natural');
		$this->form_validation->set_rules('max_month', 'Max Month', 'required|is_natural');

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header',$data);
			$this->load->view('templates/menu');
			$this->load->view('admin/ranking/work_experience_settings.php',$data);
			$this->load->view('templates/footer');
		}
		else{
			$work_exp = $this->ranking_model->edit_work_settings();

			if($work_exp === 'denied'){
				$this->session->set_flashdata('msg2', 'danger');
	        	$this->session->set_flashdata('msg', '<p>Edit failed:</p> Your input was not accepted as it will mess up the range in the other brackets.');
	       		redirect(base_url().'index.php/ranking/work_experience_settings');
			}
			
			$this->session->set_flashdata('msg2', 'success');
			$this->session->set_flashdata('msg', 'Work Experience Setting edit successful!');
			redirect(base_url().'index.php/ranking/work_experience_settings');
		}		
	}

	//cert board settings
	function certification_board_settings()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//$staff = 'Staff';
		$faculty = 'Faculty';

		$board = "Board/Gov't Examination Passed";
		$industry = "Industry Certifications";

		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'Certification/Board Settings';
		$data['menu'] = 'Ranking';

		//$data['cert_staff_board'] = $this->ranking_model->get_cert_settings($staff,$board);
		//$data['cert_staff_industry'] = $this->ranking_model->get_cert_settings($staff,$industry);
		$data['cert_faculty_board'] = $this->ranking_model->get_cert_settings($faculty,$board);
		$data['cert_faculty_industry'] = $this->ranking_model->get_cert_settings($faculty,$industry);

		$this->form_validation->set_rules('points', 'Point', 'required|is_natural');

		$this->form_validation->set_message('is_natural', '<div class="alert alert-danger alert-dismissable">
			 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div class="text-center">Edit Failed: The point field must only contain natural numbers.</div>
				</div>');
		$this->form_validation->set_message('required', '<div class="alert alert-danger alert-dismissable">
			 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div class="text-center">Edit Failed: The point field is required.</div>
				</div>');

		if ($this->form_validation->run() === FALSE)
		{ 
			$this->load->view('templates/header',$data);
			$this->load->view('templates/menu');
			$this->load->view('admin/ranking/cert_board_settings.php',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			$this->ranking_model->edit_cert_setting();
			$this->session->set_flashdata('msg', 'Certification / Exam Setting edit Successful!');
			redirect(base_url().'index.php/ranking/certification_board_settings');
		}		
	}

	//base points and weight multiplier settings
	function weight_multiplier_settings()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//$staff = 'Staff';
		$faculty = 'Faculty';

		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'Weight Multiplier Settings';
		$data['menu'] = 'Ranking';

		//weight multiplier
		//$data['staff_weight_multiplier'] = $this->ranking_model->get_weight_multiplier($staff);
		$data['faculty_weight_multiplier'] = $this->ranking_model->get_weight_multiplier($faculty);

		//edit weight multiplier
        if ( $this->input->post('edit_weight') ) {

			$this->form_validation->set_rules('multiplier', 'Weight Multiplier', 'required|numeric');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->ranking_model->edit_weight_multiplier_setting();
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successful Edited Weight Multiplier');
           		redirect(base_url().'index.php/ranking/weight_multiplier_settings');
			} 
			else 
			{
			$this->session->set_flashdata('msg2', 'danger');
            $this->session->set_flashdata('msg', 'Editing Weight Multiplier failed: '.validation_errors());
            redirect(base_url().'index.php/ranking/weight_multiplier_settings');
        	}
        }

		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu');
		$this->load->view('admin/ranking/multiplier_settings.php',$data);
		$this->load->view('templates/footer');	
	}

	function base_points_settings()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//$staff = 'Staff';
		$faculty = 'Faculty';

		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'Base Points Settings';
		$data['menu'] = 'Ranking';

		//base points
		//$data['staff_base_points'] = $this->ranking_model->get_base_points($staff);
		$data['faculty_base_points'] = $this->ranking_model->get_base_points($faculty);

		//edit base points
        if ( $this->input->post('edit_base') ) {

			$this->form_validation->set_rules('points', 'Point', 'required|numeric');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->ranking_model->edit_base_points_setting();
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successful Edited Base Points Setting');
           		redirect(base_url().'index.php/ranking/base_points_settings');
			} 
			else 
			{
			$this->session->set_flashdata('msg2', 'danger');
            $this->session->set_flashdata('msg', 'Editing Base Points Setting failed: '.validation_errors());
            redirect(base_url().'index.php/ranking/base_points_settings');
        	}
        }

		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu');
		$this->load->view('admin/ranking/base_points_settings.php',$data);
		$this->load->view('templates/footer');	
	}

	function faculty_ranking_classification(){
		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'Faculty Ranking Classification';
		$data['menu'] = 'Ranking';
		$data['educ_level'] = $this->ranking_model->get_educ_level();

		$data['faculty_classification'] = $this->ranking_model->get_faculty_rank();

		$this->load->helper('form');
		$this->load->library('form_validation');
		//$data['position'] = $this->ranking_model->get_position();

		//edit rank classification
        if ( $this->input->post('edit_classification') ) {

			$this->form_validation->set_rules('salary', 'Salary', 'required|decimal');
			$this->form_validation->set_rules('teaching_exp', 'Teaching Experience', 'required|is_natural');
			$this->form_validation->set_rules('min_points', 'Minimum point', 'required|is_natural');
			$this->form_validation->set_rules('max_points', 'Maximum point', 'required|is_natural');

			if ($this->form_validation->run() !== FALSE)
			{
				$faculty_class = $this->ranking_model->edit_faculty_classification();
				if($faculty_class === 'denied'){
					$this->session->set_flashdata('msg2', 'danger');
		        	$this->session->set_flashdata('msg', '<p>Edit failed:</p> Your input was not accepted as it will mess up the range in the other brackets.');
		       		redirect(base_url().'index.php/ranking/faculty_ranking_classification');
				}
				else
				{
					$this->session->set_flashdata('msg2', 'success');
					$this->session->set_flashdata('msg', 'Successful Edited Faculty Ranking Classification');
	           		redirect(base_url().'index.php/ranking/faculty_ranking_classification');
           		}
			} 
			else 
			{
			$this->session->set_flashdata('msg2', 'danger');
            $this->session->set_flashdata('msg', 'Editing Faculty Ranking Classification failed: '.validation_errors());
            redirect(base_url().'index.php/ranking/faculty_ranking_classification');
        	}
        }

        if ( $this->input->post('edit_classification_full') ) {

			$this->form_validation->set_rules('salary', 'Salary', 'required|decimal');
			$this->form_validation->set_rules('managerial_exp', 'Managerial Experience', 'required|is_natural');
			$this->form_validation->set_rules('teaching_exp', 'Teaching Experience', 'required|is_natural');
			$this->form_validation->set_rules('min_points', 'Minimum point', 'required|is_natural');
			$this->form_validation->set_rules('max_points', 'Maximum point', 'required|is_natural');

			if ($this->form_validation->run() !== FALSE)
			{
				$faculty_class = $this->ranking_model->edit_faculty_classification_full();
				if($faculty_class === 'denied'){
					$this->session->set_flashdata('msg2', 'danger');
		        	$this->session->set_flashdata('msg', '<p>Edit failed:</p> Your input was not accepted as it will mess up the range in the other brackets.');
		       		redirect(base_url().'index.php/ranking/faculty_ranking_classification');
				}
				else
				{
					$this->session->set_flashdata('msg2', 'success');
					$this->session->set_flashdata('msg', 'Successful Edited Faculty Ranking Classification');
	           		redirect(base_url().'index.php/ranking/faculty_ranking_classification');
           		}
			} 
			else 
			{
			$this->session->set_flashdata('msg2', 'danger');
            $this->session->set_flashdata('msg', 'Editing Faculty Ranking Classification failed: '.validation_errors());
            redirect(base_url().'index.php/ranking/faculty_ranking_classification');
        	}
        }

		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu');
		$this->load->view('admin/ranking/faculty_ranking_classification_setting.php',$data);
		$this->load->view('templates/footer');	
	}

	function rerank_employee(){
		$no_educ = $this->ranking_model->check_educ();
		$employee_available = $this->ranking_model->eligible_list();
		$names ='';

		if(count($no_educ) > 0){
			foreach($no_educ as $no):
				$names = $names.' '.$no.'<br/>';
			endforeach;

			$this->session->set_flashdata('msg2', 'danger');
	        $this->session->set_flashdata('msg', 'Reranking Failed: The Following Faculty Member/s: <br />'.$names.' do not have educational attainment that they have graduated yet.');
	        redirect(base_url().'index.php/ranking/ranking_summary');
		}

		if(count($employee_available) == 0){
			$this->session->set_flashdata('msg2', 'danger');
	        $this->session->set_flashdata('msg', 'Reranking Failed: No employee available for reranking.');
	        redirect(base_url().'index.php/ranking/ranking_summary');
		}
		else{
			$rank = $this->ranking_model->rerank_all();
			$this->session->set_flashdata('msg2', 'success');
	        $this->session->set_flashdata('msg', 'Reranking Successful');
	        redirect(base_url().'index.php/ranking/ranking_summary');
   		}
	}

	function eligible_ranking_list(){

		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'Ranking Summary';
		$data['menu'] = 'Ranking';
		$data['empty'] = 'No Summary Available just yet!';
		$data['list_employee'] = $this->ranking_model->eligible_list();
		$data['rerank']	= $this->ranking_model->get_last_rerank();
		$data['all_rank'] = $this->ranking_model->get_all_rank_dates();
		$data['rank_date'] = $this->ranking_model->get_current_rank_date();
 
		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu');
		$this->load->view('admin/ranking/eligible_employees',$data);
		$this->load->view('templates/footer');
	}
}
