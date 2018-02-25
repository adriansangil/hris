<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_medical extends CI_Controller {
	
	function __construct()
	{	
		parent::__construct();
		$this->load->model('user/my_profile_model');
		$this->load->model('user/my_medical_model');
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

	function my_medical_summary()
	{	
		$user_id = $this->session->userdata('user_id');
		$data['status'] = $this->my_medical_model->get_status($user_id);
		$data['username'] = $this->session->userdata('username');
		$data['employee'] = $this->my_profile_model->get_employee();
		$data['title'] = 'Employee Medical Summary';
		$data['menu'] = 'My Medical Benefits';
		$data['empty'] = 'No Summary Available just yet!';

		if($data['status'] =='Probationary'){
			$this->session->set_flashdata('msg', 'You do not have permission to access that page!');
			redirect(base_url().'index.php/login');	
		}

		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['year'] = $this->my_medical_model->get_current_year();
		$year = $this->my_medical_model->get_current_year();
		$data['employee_type'] =$this->my_medical_model->get_employee_type($user_id);
		$data['status'] = $this->my_medical_model->get_status($user_id);
		$data['length_of_service'] = $this->my_medical_model->get_length_of_service($user_id);
		$data['current_medical_settings'] = $this->my_medical_model->get_employee_medical_setting($data['employee_type'],$data['status'],$data['length_of_service']);
		$data['medical_summary'] = $this->my_medical_model->get_employee_medical_summary($user_id);
		$data['all_year'] = $this->my_medical_model->get_all_year_employee($user_id);
		$data['receipt'] = $this->my_medical_model->get_receipt('Approved');

		$data['id'] = $user_id;

		$this->form_validation->set_rules('search_year_id', 'Year', 'required');

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
			$this->load->view('employee/medical/my_medical_summary',$data);
			$this->load->view('templates/footer');
		}

		else{
			if($this->input->post('search_year_id') == $year['year_id'])
			{
				redirect(base_url().'index.php/my_medical/my_medical_summary');
			}
				
			$data['year'] = $this->my_medical_model->get_past_year();
			$data['status'] = $this->my_medical_model->get_past_status($user_id);
			$data['length_of_service'] = $this->my_medical_model->get_past_length_of_service($user_id,$data['status']);
			$data['current_medical_settings'] = $this->my_medical_model->get_employee_medical_setting($data['employee_type'],$data['status'],$data['length_of_service']);
			$data['medical_summary'] = $this->my_medical_model->get_past_employee_medical_summary($user_id);
			$data['past_medical_settings'] = $this->my_medical_model->get_employee_past_medical_setting($user_id);

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
			$this->load->view('employee/medical/my_past_medical_summary',$data);
			$this->load->view('templates/footer');
		}
	}

	function apply_medical_assistance()
	{
		$user_id = $this->session->userdata('user_id');
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['employee_id'] = $user_id;
		$data['username'] = $this->session->userdata('username');
		$data['employee'] = $this->my_profile_model->get_employee();
		$data['title'] = 'Apply Med Assistance';
		$data['menu'] = 'My Medical Benefits';
		$data['status'] = $this->my_medical_model->get_status($user_id);

		if($data['status'] =='Probationary'){
			$this->session->set_flashdata('msg', 'You do not have permission to access that page!');
			redirect(base_url().'index.php/login');	
		}

		$data['year'] = $this->my_medical_model->get_current_year();
		$data['employee_type'] =$this->my_medical_model->get_employee_type($user_id);
		$data['length_of_service'] = $this->my_medical_model->get_length_of_service($user_id);
		$data['current_medical_settings'] = $this->my_medical_model->get_employee_medical_setting($data['employee_type'],$data['status'],$data['length_of_service']);
		$data['medical_summary'] = $this->my_medical_model->get_my_medical_summary($user_id);
		$pending_medical = $this->my_medical_model->get_pending_medical($user_id);

		//$this->form_validation->set_rules('ltype', 'leave', 'required');
		$this->form_validation->set_rules('receipt_date[]', 'Date of Receipt', 'required');
		$this->form_validation->set_rules('receipt_number[]', 'OR number', 'required|alpha_numeric');
		$this->form_validation->set_rules('amount[]', 'Reimbursed Amount', 'required|decimal');
		$this->form_validation->set_rules('reason', 'Reason', 'required|callback_alpha_dash_space');

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
			$this->load->view('employee/medical/apply_medical_assistance',$data);
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

			$pending_amount = 0;

			if(count($pending_medical) >0){
				foreach($pending_medical as $pending):
					$pending_amount = $pending_amount + $pending['amount'];
				endforeach;
				if($amount_left - ($total_ded + $pending_amount) < 0){
					$this->session->set_flashdata('msg', 'Medical Assistance Request failed: You have pending medical request/s with the addition of this request with amount to be reimbursed greater than the amount left for medical assistance. '.number_format((float)$total_ded + $pending_amount), 2, '.', ',');
					$this->session->set_flashdata('msg2', 'danger');
					redirect(base_url().'index.php/my_medical/apply_medical_assistance');
				}
			}	
			if($amount_left == 0)
			{
				$this->session->set_flashdata('msg', 'Medical Assistance Request failed: You do not have any medical assistance benefit remaining.');
				$this->session->set_flashdata('msg2', 'danger');
				redirect(base_url().'index.php/my_medical/apply_medical_assistance');
			}

			if($total_ded == 0)
			{
				$this->session->set_flashdata('msg', 'Medical Assistance Request failed: Amount to be reimbursed is zero.');
				$this->session->set_flashdata('msg2', 'danger');
				redirect(base_url().'index.php/my_medical/apply_medical_assistance');
			}

			$this->my_medical_model->apply_medical_assistance($user_id,$total_ded);
			$this->session->set_flashdata('msg','You have successfully submitted a medical assistance request!');
			$this->session->set_flashdata('msg2', 'success');
			redirect(base_url().'index.php/my_medical/my_pending_request');
		}
	}

	public function my_pending_request()
	{
		$user_id = $this->session->userdata('user_id');

		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'Pending Medical Assistance Request';
		$data['menu'] = 'Medical';
		$data['status'] = $this->my_medical_model->get_status($user_id);
		$data['employee'] = $this->my_profile_model->get_employee();
		

		if($data['status'] =='Probationary'){
			$this->session->set_flashdata('msg', 'You do not have permission to access that page!');
			redirect(base_url().'index.php/login');	
		}

		$data['count'] = $this->my_medical_model->pending_medical_count($user_id);
		$data['medical_title'] = 'My Pending Medical Assistance Request';
		$data['empty'] = 'No Pending Medical Assistance request!';

		$config = array();
        $config['base_url'] = base_url() . 'index.php/my_medical/my_pending_request';
        $config['total_rows'] = $this->my_medical_model->pending_medical_count($user_id);
        $config['per_page'] = 50;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;

		$this->pagination->initialize($config);

		$data['medical_request'] = $this->my_medical_model->get_pending_medical_request($config['per_page'], $this->uri->segment(3),$user_id);
		$data['links'] = $this->pagination->create_links();
		$data['receipt'] = $this->my_medical_model->get_receipt('Pending');

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
		$this->load->view('employee/medical/pending_medical', $data);
		$this->load->view('templates/footer');
	}

	function my_medical_history()
	{	
		$user_id = $this->session->userdata('user_id');

		$this->my_medical_model->clear_notification($user_id);

		$data['username'] = $this->session->userdata('username');
		$data['title'] = 'My Medical History';
		$data['menu'] = 'My Medical Benefits';
		$data['status'] = $this->my_medical_model->get_status($user_id);
		$data['employee'] = $this->my_profile_model->get_employee();

		if($data['status'] =='Probationary'){
			$this->session->set_flashdata('msg', 'You do not have permission to access that page!');
			redirect(base_url().'index.php/login');	
		}
		
		$data['count'] = $this->my_medical_model->medical_history_count($user_id);
		$data['medical_title'] = 'My Medical History';
		$data['empty'] = 'No leave history yet';
 
		$config = array();
        $config['base_url'] = base_url() . 'index.php/my_medical/my_medical_history';
        $config['total_rows'] = $this->my_medical_model->medical_history_count($user_id);
        $config['per_page'] = 30;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;

		$this->pagination->initialize($config);

		$data['medical_history'] = $this->my_medical_model->get_medical_history($config['per_page'], $this->uri->segment(3),$user_id);
		$data['receipt'] = $this->my_medical_model->get_receipt_history('Pending');
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
		$this->load->view('employee/medical/medical_history', $data);
		$this->load->view('templates/footer');
	}

	function delete_pending_request()
	{
		$id = $this->uri->segment(3);
		$delete = $this->my_medical_model->delete_request($id);
		if($delete == 'failed'){
			$this->session->set_flashdata('msg2', 'danger');
			$this->session->set_flashdata('msg', 'The pending medical assistance request does not exist or it may have already been approved or rejected.');
			redirect(base_url().'index.php/my_medical/my_pending_request');
		}
		else{
			$this->session->set_flashdata('msg2', 'success');
			$this->session->set_flashdata('msg', 'Pending Medical Assistance Request Successfully Deleted!');
			redirect(base_url().'index.php/my_medical/my_pending_request');
		}
	}
}