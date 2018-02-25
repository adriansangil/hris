<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('employee_model');
		$this->load->model('leave_model');
		$this->load->model('medical_model');
		$this->load->model('settings_model');
		$this->load->helper('form');
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
		$this->load->library('form_validation');

		$data['username'] = $this->session->userdata('username');
		$data['all_users'] = $this->employee_model->get_types();
		$data['employee_num'] = $this->employee_model->employee_count();
		$data['title'] = 'Employee List';
		$data['menu'] = 'Employee';
		$data['empty'] = 'No Employees Yet!';

		$config = array();
        $config['base_url'] = base_url() . 'index.php/employee';
        $config['total_rows'] = $this->employee_model->employee_count();
        $config['per_page'] = 30;
		$config['uri_segment'] = 2;
		$config['num_links'] = 3;
 
        $this->pagination->initialize($config);
 
 
        $data['results'] = $this->employee_model->fetch_employees($config["per_page"], $this->uri->segment(2));
        $data['links'] = $this->pagination->create_links();

        //edit employee
        if($this->input->post('edit_employee')){

        	$this->form_validation->set_error_delimiters('', '<br />');
			$this->form_validation->set_rules('fname', 'first name', 'trim|required|callback_alpha_dash_space');
			$this->form_validation->set_rules('mname', 'middle name', 'trim|required|callback_alpha_dash_space');
			$this->form_validation->set_rules('lname', 'last name', 'trim|required|callback_alpha_dash_space');
			$this->form_validation->set_rules('mobile', 'mobile number', 'trim|required|is_natural');
			$this->form_validation->set_rules('address', 'address', 'trim|required|callback_alpha_dash_space');
			$this->form_validation->set_rules('wemail', 'email', 'trim|required|valid_email');
			
			if ($this->form_validation->run() !== FALSE)
			{
				$this->employee_model->edit_employee();
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg', 'Successfully Edited Employee Information!');
				redirect(base_url().'index.php/employee');
			}
			else 
			{
				$this->session->set_flashdata('msg2', 'danger');
	            $this->session->set_flashdata('msg', '<p>Editing of Employee Information failed:</p>'.validation_errors());
	            redirect(base_url().'index.php/employee');
        	}
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('admin/employees/employee_list_header', $data);
		$this->load->view('templates/search');
		$this->load->view('admin/employees/index', $data);
		$this->load->view('templates/footer');
	}

	function search_employee()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('namesearch', 'Search', 'trim|required|callback_alpha_dash_space');

		if ($this->form_validation->run() === FALSE)
		{ 
			$this->index();

		}
		else
		{ 
			$data['results'] = $this->employee_model->search();
			$data['username'] = $this->session->userdata('username');
			$data['employee_num'] = $this->employee_model->employee_count();
			$data['title'] = 'employee';
			$data['menu'] = 'Employee';
			$data['empty'] = 'Your search returned no result';

			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu', $data);
			$this->load->view('admin/employees/employee_list_header', $data);
			$this->load->view('templates/search');
			$this->load->view('admin/employees/search_employee_result', $data);
			$this->load->view('templates/footer');
		}
	}

	public function view($employee_id)
	{
		if(is_numeric($employee_id) == FALSE)
		{
			show_404();
		}

		$data['username'] = $this->session->userdata('username');
		$data['employee'] = $this->employee_model->get_employees($employee_id);
		$data['menu'] = 'Employee';
		
		
		if (empty($data['employee']))
		{
			show_404();
		}

		$data['title'] = $data['employee']['first_name'];
		$data['employee_type'] =$this->leave_model->get_employee_type($employee_id);
		$data['employee_position'] =$this->employee_model->get_employee_position($employee_id);
		$data['status'] = $this->leave_model->get_status($employee_id);
		$data['length_of_service'] = $this->employee_model->get_length_of_service($employee_id);
		$data['current_sick_leave_settings'] = $this->leave_model->get_employee_leave_setting($data['employee_type'],$data['status'],$data['length_of_service'],'Sick');
		$data['current_vacation_leave_settings'] = $this->leave_model->get_employee_leave_setting($data['employee_type'],$data['status'],$data['length_of_service'],'Vacation');
		$data['current_medical_settings'] = $this->medical_model->get_employee_medical_setting($data['employee_type'],$data['status'],$data['length_of_service']);
		$data['employee_medical_record'] = $this->employee_model->get_employee_medical_record($employee_id);
		$data['employee_record'] = $this->employee_model->get_employee_record($employee_id);
		$data['all_type'] = $this->employee_model->get_types();
		$data['all_positions'] = $this->employee_model->get_job_positions();

		//employee ranking
		//faculty
		$data['highest_education_attained'] = $this->employee_model->get_educ_high($employee_id);
		$data['lowest_fac_rank'] = $this->employee_model->get_lowest_faculty_rank();
		$data['faculty_teach_duration'] = $this->employee_model->total_teach_duration($employee_id,$data['employee']['employee_type']);
		$data['reference'] = $this->employee_model->get_rank_reference($data['employee']['employee_type_id']);
		//staff
		$data['lowest_staff_rank'] = $this->employee_model->get_lowest_staff_rank();
		$data['staff_reference'] = $this->employee_model->get_staff_rank_reference();
		$data['unskilled'] = $this->employee_model->get_staff_rank_unskilled();
		$data['semiskilled'] = $this->employee_model->get_staff_rank_semi_skilled();
		$data['management'] = $this->employee_model->get_staff_rank_management();

		$data['educ_total'] = $this->employee_model->get_educ_total($employee_id);
		$data['work_total'] = $this->employee_model->get_work_total($employee_id,$data['employee']['employee_type'],$data['employee']['employee_type_id']);
		$data['cert_total'] = $this->employee_model->get_cert_total($employee_id,$data['employee']['employee_type_id']);

		//criteria
		$educ_criteria = 'Educational Attainment';
		$work_criteria = 'Working Experience';
		$cert_criteria = 'Certifications or Board/Government Examinations Passed';

		$data['educ_multiplier'] = $this->employee_model->get_multiplier($educ_criteria,$data['employee']['employee_type_id']);
		$data['work_multiplier'] = $this->employee_model->get_multiplier($work_criteria,$data['employee']['employee_type_id']);
		$data['cert_multiplier'] = $this->employee_model->get_multiplier($cert_criteria,$data['employee']['employee_type_id']);

		$this->load->model('image_model');

		//upload photo
		if($this->input->post('upload')) {
			$data['uploadmsg'] = $this->image_model->do_upload($employee_id);
		}

		$this->load->library('form_validation');

		if($this->input->post('changepass')) {

			$this->form_validation->set_rules('new', 'new password', 'required|alpha_numeric|min_length[5]');
			$this->form_validation->set_rules('rnew', 're-type Password', 'matches[new]');	

			if ($this->form_validation->run() !== FALSE)
			{
				$this->employee_model->edit_password($employee_id);
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg1', 'Password successfully changed!');
				redirect(base_url().'index.php/employee/view/'.$employee_id);
			}
			else 
			{
				$this->session->set_flashdata('msg2', 'danger');
	            $this->session->set_flashdata('msg1', '<p>Changing of Password Failed:</p>'.validation_errors());
	            redirect(base_url().'index.php/employee/view/'.$employee_id);
        	}
		}

		//edit name
		if($this->input->post('edit_name')) {

			$this->form_validation->set_rules('fname', 'first name', 'trim|required|callback_alpha_dash_space');
			$this->form_validation->set_rules('mname', 'middle name', 'trim|required|callback_alpha_dash_space');
			$this->form_validation->set_rules('lname', 'last name', 'trim|required|callback_alpha_dash_space');
			

			if ($this->form_validation->run() !== FALSE)
			{
				$this->settings_model->edit_name($employee_id);
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg1', 'Successfully Edited Name!');
				redirect(base_url().'index.php/employee/view/'.$employee_id);
			}
			else 
			{
				$this->session->set_flashdata('msg2', 'danger');
	            $this->session->set_flashdata('msg1', '<p>Editing of Name Failed:</p>'.validation_errors());
	            redirect(base_url().'index.php/employee/view/'.$employee_id);
        	}

		}

		//edit address
		if($this->input->post('edit_addr')) {

			$this->form_validation->set_rules('addr', 'address', 'trim|required|callback_alpha_dash_space');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->settings_model->edit_addr($employee_id);
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg1', 'Successfully Edited Address!');
				redirect(base_url().'index.php/employee/view/'.$employee_id);
			}
			else 
			{
				$this->session->set_flashdata('msg2', 'danger');
	            $this->session->set_flashdata('msg1', '<p>Editing of Address Failed:</p>'.validation_errors());
	            redirect(base_url().'index.php/employee/view/'.$employee_id);
        	}
		}

		//edit gender
		if($this->input->post('edit_gender')) {

			$gender = $this->settings_model->edit_gender($employee_id);
			if($gender === FALSE){
				$this->session->set_flashdata('msg2', 'info');
	           	$this->session->set_flashdata('msg1', '<p>Same Gender selected.</p>');
	            redirect(base_url().'index.php/employee/view/'.$employee_id);
			}
			else{
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg1', 'Successfully Edited Employee Gender!');
				redirect(base_url().'index.php/employee/view/'.$employee_id);
			}
		}

		//edit mobile
		if($this->input->post('edit_num')) {

			$this->form_validation->set_rules('mobile_num', 'mobile number', 'trim|required|is_natural');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->settings_model->edit_mobile($employee_id);
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg1', 'Successfully Edited Mobile Number!');
				redirect(base_url().'index.php/employee/view/'.$employee_id);
			}
			else 
			{
				$this->session->set_flashdata('msg2', 'danger');
	            $this->session->set_flashdata('msg1', '<p>Editing of Mobile Number Failed:</p>'.validation_errors());
	            redirect(base_url().'index.php/employee/view/'.$employee_id);
        	}
		}

		//edit bday
		if($this->input->post('edit_bday')) {

			$this->form_validation->set_rules('birthdate', 'Birthday', 'required|date');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->employee_model->edit_bday($employee_id);
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg1', 'Successfully Edited Birthday!');
				redirect(base_url().'index.php/employee/view/'.$employee_id);
			}
			else 
			{
				$this->session->set_flashdata('msg2', 'danger');
	            $this->session->set_flashdata('msg1', '<p>Editing of Birthday Failed:</p>'.validation_errors());
	            redirect(base_url().'index.php/employee/view/'.$employee_id);
        	}
		}

		//edit email
		if($this->input->post('edit_email')) {

			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->settings_model->edit_email($employee_id);
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg1', 'Successfully Edited Work Email Address!');
				redirect(base_url().'index.php/employee/view/'.$employee_id);
			}
			else 
			{
				$this->session->set_flashdata('msg2', 'danger');
	            $this->session->set_flashdata('msg1', '<p>Editing of Work Email Address Failed:</p>'.validation_errors());
	            redirect(base_url().'index.php/employee/view/'.$employee_id);
        	}
		}

		//edit position
		if($this->input->post('edit_position')) {		

			$position = $this->employee_model->edit_position($employee_id);
			if($position === FALSE){
				$this->session->set_flashdata('msg2', 'info');
	           	$this->session->set_flashdata('msg1', '<p>No change: Same Job Title selected.</p>');
	            redirect(base_url().'index.php/employee/view/'.$employee_id);
			}
			else{
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg1', 'Successfully Edited Employee Job Title!');
				redirect(base_url().'index.php/employee/view/'.$employee_id);
			}
		}

		//edit employee type
		if($this->input->post('edit_type')) {

			$type = $this->employee_model->edit_type($employee_id);
			if($type === FALSE){
				$this->session->set_flashdata('msg2', 'info');
	           	$this->session->set_flashdata('msg1', '<p>No change: Same Employee Type selected.</p>');
	            redirect(base_url().'index.php/employee/view/'.$employee_id);
			}
			else{
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg1', 'Successfully Edited Employee Type!');
				redirect(base_url().'index.php/employee/view/'.$employee_id);
			}
		}

		//edit status
		if($this->input->post('edit_status')) {

			$status = $this->employee_model->edit_status($employee_id);
			if($status === FALSE){
				$this->session->set_flashdata('msg2', 'info');
	           	$this->session->set_flashdata('msg1', '<p>Same Employee Status selected.</p>');
	            redirect(base_url().'index.php/employee/view/'.$employee_id);
			}
			else{
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg1', 'Successfully Edited Employee Status!');
				redirect(base_url().'index.php/employee/view/'.$employee_id);
			}
		}

		//edit managerial exp
		if($this->input->post('edit_exp')) {

			$this->form_validation->set_rules('manager_xp', 'Managerial Experience', 'required|is_natural');

			if ($this->form_validation->run() !== FALSE)
			{
				$this->employee_model->edit_managerial_exp($employee_id);
				$this->session->set_flashdata('msg2', 'success');
				$this->session->set_flashdata('msg1', 'Successfully Edited Managerial Experience!');
				redirect(base_url().'index.php/employee/view/'.$employee_id);
			}
			else 
			{
				$this->session->set_flashdata('msg2', 'danger');
	            $this->session->set_flashdata('msg1', '<p>Editing of Managerial Experience Failed:</p>'.validation_errors());
	            redirect(base_url().'index.php/employee/view/'.$employee_id);
        	}
		}

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('admin/employees/view', $data);
		$this->load->view('templates/footer');
	}

	
	public function view_inactive_employee($employee_id)
	{
		if(is_numeric($employee_id) == FALSE)
		{
			show_404();
		}

		$data['username'] = $this->session->userdata('username');
		$data['employee'] = $this->employee_model->get_inactive_employees($employee_id);
		//$data['title'] == 'employee';
		$data['menu'] = 'Employee';
		
		if (empty($data['employee']))
		{
			show_404();
		}

		$data['title'] = $data['employee']['first_name'];

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('admin/employees/view_inactive', $data);
		$this->load->view('templates/footer');
	}

	public function inactive_employee()
	{
		$data['username'] = $this->session->userdata('username');
		$data['employee_num'] = $this->employee_model->inactive_employee_count();
		//$data['all_employees'] = $this->employee_model->get_employees();
		$data['title'] = 'Inactive Employee List';
		$data['menu'] = 'Employee';
		$data['empty'] = 'No Inactive Employees!';

		$config = array();
        $config["base_url"] = base_url() . 'index.php/employee/inactive_employee';
        $config["total_rows"] = $this->employee_model->inactive_employee_count();
        $config["per_page"] = 30;
		$config["uri_segment"] = 3;
		$config['num_links'] = 3;
 
        $this->pagination->initialize($config);
 
 
        $data["results"] = $this->employee_model->fetch_inactive_employees($config["per_page"], $this->uri->segment(3));
        $data["links"] = $this->pagination->create_links();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('admin/employees/inactive_employee', $data);
		$this->load->view('templates/footer');
	}

	public function addemployee()
{
	$data['username'] = $this->session->userdata('username');
	$this->load->helper('form');
	$this->load->library('form_validation');
	
	$data['all_users'] = $this->employee_model->get_types();
	$data['all_positions'] = $this->employee_model->get_job_positions();
	$data['title'] = 'Add Employee';
	$data['menu'] = 'Employee';
	$data['year'] = $this->leave_model->get_current_academic_year();

	if(count($data['year']) <1)
	{
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu');
		$this->load->view('templates/footer');
	}
	
	else
	{
		$this->form_validation->set_rules('manager_xp', 'Managerial exp', 'required|is_natural');
		$this->form_validation->set_rules('fname', 'first name', 'trim|strtolower|ucwords|required|callback_alpha_dash_space');
		$this->form_validation->set_rules('mname', 'middle name', 'trim|strtolower|ucwords|required|callback_alpha_dash_space');
		$this->form_validation->set_rules('lname', 'last name', 'trim|strtolower|ucwords|required|callback_alpha_dash_space');
		$this->form_validation->set_rules('mobile', 'mobile number', 'trim|required|is_natural');
		$this->form_validation->set_rules('address', 'address', 'trim|strtolower|ucwords|required|callback_alpha_dash_space');
		$this->form_validation->set_rules('wemail', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('birthdate', 'birthdate', 'required');
		$this->form_validation->set_rules('startdate', 'date', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|is_unique[employee_information.username]');	
		$this->form_validation->set_rules('password', 'Password', 'required|alpha_numeric|min_length[5]');
		$this->form_validation->set_rules('repassword', 'Re-type Password', 'required|matches[password]');

		$this->form_validation->set_message('is_unique', 'Username already exist.');
		
		if ($this->form_validation->run() === FALSE)
		{ 
			$this->load->view('templates/header', $data);
			$this->load->view('templates/menu');			
			$this->load->view('admin/employees/add_employee',$data);
			$this->load->view('templates/footer');
			
		}
		else
		{ 
			$this->employee_model->set_employee();
			//$this->employee_model->set_employee_status();
			//$this->employee_model->create_employee_record();
			//$this->employee_model->create_employee_medical_record();
			//$this->employee_model->create_employee_type_history();
			$this->session->set_flashdata('msg2', 'success');
			$this->session->set_flashdata('msg', 'New Employee Successfully Added!');
			redirect(base_url().'index.php/employee');
		}
	}
}

	public function delete_employee()
	{
		$id = $this->uri->segment(3);
		$this->employee_model->delete_employee($id);
		$this->session->set_flashdata('msg2', 'success');
		$this->session->set_flashdata('msg', 'Employee Moved to Inactive List');
		redirect(base_url().'index.php/employee');
	}
	
	public function permanent_delete_employee()
	{
		$id = $this->uri->segment(3);
		$this->employee_model->permanent_delete_employee($id);
		$this->session->set_flashdata('msg2', 'success');
		$this->session->set_flashdata('msg', 'Employee Permanently Deleted!');
		redirect(base_url().'index.php/employee/inactive_employee');
	}
}