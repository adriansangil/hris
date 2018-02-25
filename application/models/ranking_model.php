<?php
class Ranking_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		$this->current_time();
	}

	function current_time()
	{
		$timezone = 'Asia/Manila';
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set($timezone);
		}
	}

	function eligible_list(){

		$this->db->select('*,employee_information.employee_id as emp_id');
		$this->db->from('employee_information');
		$this->db->join('employee_type', 'employee_type.employee_type_id = employee_information.employee_type_id','inner');
		$this->db->join('status', 'status.employee_id = employee_information.employee_id','inner');
		$this->db->join('job_position', 'job_position.job_position_id = employee_information.job_position_id','inner');
		$this->db->where('employee_information.active','true');
		$this->db->where('status.active','true');
		$this->db->where('status.employee_status','Regular');
		$this->db->where('employee_type.employee_type','Faculty');
		$this->db->order_by('employee_information.first_name','asc');
		$this->db->order_by('employee_type.employee_type');
		$query = $this->db->get();
		
		return $query->result_array();
	}

	function get_employees($employee_id = FALSE)
	{
		if ($employee_id === FALSE)
		{
			$query = $this->db->get_where('employee_information',array('active'=>'true'));
			return $query->result_array();
		}

		$this->db->select('*');
		$this->db->from('employee_information');
		$this->db->join('status', 'status.employee_id = employee_information.employee_id','inner');
		$this->db->join('employee_type', 'employee_type.employee_type_id = employee_information.employee_type_id','inner');
		$this->db->join('job_position', 'job_position.job_position_id = employee_information.job_position_id','inner');
		$this->db->where('employee_information.employee_id',$employee_id);
		$this->db->where('employee_information.active','true');
		$this->db->where('status.employee_status','Regular');
		$this->db->where('status.active','true');
		$query = $this->db->get();
		
		return $query->row_array();
	}

	//get employee status
	function get_status($employee_id)
	{
		$this->db->select('*');
		$this->db->from('status');
		$this->db->join('employee_information', 'employee_information.employee_id = status.employee_id','inner');
		$this->db->where('status.employee_id',$employee_id);
		$this->db->where('status.active','true');
		$query = $this->db->get();
		$result = $query->row_array();
		$status = $result['employee_status'];
		return $status;
	}

	//education settings

	//all educ settings
	function get_educational_settings()
	{
		$this->db->select('*');
		$this->db->from('educational_attainment');
		$this->db->join('employee_type', 'educational_attainment.employee_type_id = employee_type.employee_type_id','inner');
		$this->db->join('education_level', 'education_level.education_level_id = educational_attainment.education_level_id','inner');
		$this->db->join('education_detail', 'education_detail.education_detail_id = educational_attainment.education_detail_id','inner');
		$this->db->order_by('education_level.education_level_id');
		$this->db->order_by('educational_attainment.educ_points'); 
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_ed_technical_vocational_settings($etype)
	{
		$this->db->select('*');
		$this->db->from('educational_attainment');
		$this->db->join('employee_type', 'educational_attainment.employee_type_id = employee_type.employee_type_id','inner');
		$this->db->join('education_level', 'education_level.education_level_id = educational_attainment.education_level_id','inner');
		$this->db->join('education_detail', 'education_detail.education_detail_id = educational_attainment.education_detail_id','inner');
		$this->db->where('employee_type.employee_type',$etype);
		$this->db->where('education_level.level_description','TECHNICAL-VOCATIONAL GRADUATE');
		$this->db->order_by('educational_attainment.educ_points'); 
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_ed_bachelor_settings($etype)
	{
		$this->db->select('*');
		$this->db->from('educational_attainment');
		$this->db->join('employee_type', 'educational_attainment.employee_type_id = employee_type.employee_type_id','inner');
		$this->db->join('education_level', 'education_level.education_level_id = educational_attainment.education_level_id','inner');
		$this->db->join('education_detail', 'education_detail.education_detail_id = educational_attainment.education_detail_id','inner');
		$this->db->where('employee_type.employee_type',$etype);
		$this->db->where('education_level.level_description',"BACHELOR'S DEGREE");
		$this->db->order_by('educational_attainment.educ_points'); 
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_ed_masters_other_settings($etype)
	{
		$this->db->select('*');
		$this->db->from('educational_attainment');
		$this->db->join('employee_type', 'educational_attainment.employee_type_id = employee_type.employee_type_id','inner');
		$this->db->join('education_level', 'education_level.education_level_id = educational_attainment.education_level_id','inner');
		$this->db->join('education_detail', 'education_detail.education_detail_id = educational_attainment.education_detail_id','inner');
		$this->db->where('employee_type.employee_type',$etype);
		$this->db->where('education_level.level_description',"MASTER's DEGREE IN ANOTHER FIELD");
		$this->db->order_by('educational_attainment.educ_points'); 
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_ed_masters_settings($etype)
	{
		$this->db->select('*');
		$this->db->from('educational_attainment');
		$this->db->join('employee_type', 'educational_attainment.employee_type_id = employee_type.employee_type_id','inner');
		$this->db->join('education_level', 'education_level.education_level_id = educational_attainment.education_level_id','inner');
		$this->db->join('education_detail', 'education_detail.education_detail_id = educational_attainment.education_detail_id','inner');
		$this->db->where('employee_type.employee_type',$etype);
		$this->db->where('education_level.level_description',"MASTER's DEGREE IN THE FIELD");
		$this->db->order_by('educational_attainment.educ_points'); 
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_ed_doc_others_settings($etype)
	{
		$this->db->select('*');
		$this->db->from('educational_attainment');
		$this->db->join('employee_type', 'educational_attainment.employee_type_id = employee_type.employee_type_id','inner');
		$this->db->join('education_level', 'education_level.education_level_id = educational_attainment.education_level_id','inner');
		$this->db->join('education_detail', 'education_detail.education_detail_id = educational_attainment.education_detail_id','inner');
		$this->db->where('employee_type.employee_type',$etype);
		$this->db->where('education_level.level_description',"DOCTORAL DEGREE IN ANOTHER FIELD");
		$this->db->order_by('educational_attainment.educ_points'); 
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_ed_doc_settings($etype)
	{
		$this->db->select('*');
		$this->db->from('educational_attainment');
		$this->db->join('employee_type', 'educational_attainment.employee_type_id = employee_type.employee_type_id','inner');
		$this->db->join('education_level', 'education_level.education_level_id = educational_attainment.education_level_id','inner');
		$this->db->join('education_detail', 'education_detail.education_detail_id = educational_attainment.education_detail_id','inner');
		$this->db->where('employee_type.employee_type',$etype);
		$this->db->where('education_level.level_description',"DOCTORAL DEGREE IN THE FIELD");
		$this->db->order_by('educational_attainment.educ_points'); 
		$query = $this->db->get();
		return $query->result_array();
	}

	function edit_educ_setting()
	{
		$educ_id = $this->input->post('education_setting_id');

		$data = array(
			'educ_points' => $this->input->post('points')
		);

		$this->db->update('educational_attainment',$data, "educational_attainment_id = $educ_id");
	}

	//end educ settings

	//get employee educational attainment
	function get_employee_education_summary($employee_id)
	{		
		$this->db->select('*');
		$this->db->from('education');
		$this->db->join('employee_information', 'employee_information.employee_id = education.employee_id','inner');
		$this->db->join('educational_attainment', 'educational_attainment.educational_attainment_id = education.educational_attainment_id','inner');
		$this->db->join('education_level', 'education_level.education_level_id = educational_attainment.education_level_id','inner');
		$this->db->join('education_detail', 'education_detail.education_detail_id = educational_attainment.education_detail_id','inner');
		$this->db->where('employee_information.employee_id',$employee_id);
		//$this->db->where('base_leave.active','true');
		$this->db->order_by('education.educational_attainment_id','asc'); 
		$query = $this->db->get();
		$result = $query->result_array();

		return $result;
	}

	//get faculty list
	function get_faculty_ranking_summary()
	{
		$this->db->select('*,employee_information.employee_id as emp_id');
		$this->db->from('employee_information');
		$this->db->join('employee_type', 'employee_type.employee_type_id = employee_information.employee_type_id','inner');
		$this->db->join('status', 'status.employee_id = employee_information.employee_id','inner');
		$this->db->join('job_position', 'job_position.job_position_id = employee_information.job_position_id','inner');
		$this->db->join('rank', 'rank.employee_id = employee_information.employee_id','inner');
		$this->db->where('employee_information.active','true');
		$this->db->where('status.active','true');
		$this->db->where('rank.rank_active','true');
		$this->db->where('status.employee_status','Regular');
		$this->db->where('employee_type.employee_type','Faculty');
		$this->db->order_by('employee_information.first_name','asc');
		$this->db->order_by('employee_type.employee_type');
		$query = $this->db->get();

		return $query->result_array();

	}

	//get staff list
	function get_staff_ranking_summary()
	{
		$this->db->select('*,employee_information.employee_id as emp_id');
		$this->db->from('employee_information');
		$this->db->join('employee_type', 'employee_type.employee_type_id = employee_information.employee_type_id','inner');
		$this->db->join('status', 'status.employee_id = employee_information.employee_id','inner');
		$this->db->join('job_position', 'job_position.job_position_id = employee_information.job_position_id','inner');
		$this->db->join('rank', 'rank.employee_id = employee_information.employee_id','inner');
		$this->db->where('employee_information.active','true');
		$this->db->where('status.active','true');
		$this->db->where('rank.rank_active','true');
		$this->db->where('status.employee_status','Regular');
		$this->db->where('employee_type.employee_type','Staff');
		$this->db->order_by('employee_information.first_name','asc');
		$this->db->order_by('employee_type.employee_type');
		$query = $this->db->get();

		return $query->result_array();
	}

	function get_ranking_summary()
	{
		$this->db->select('*,employee_information.employee_id as emp_id');
		$this->db->from('employee_information');
		$this->db->join('employee_type', 'employee_type.employee_type_id = employee_information.employee_type_id','inner');
		$this->db->join('status', 'status.employee_id = employee_information.employee_id','inner');
		$this->db->join('job_position', 'job_position.job_position_id = employee_information.job_position_id','inner');
		$this->db->join('rank', 'rank.employee_id = employee_information.employee_id','left');
		$this->db->where('employee_information.active','true');
		$this->db->where('status.active','true');
		$this->db->where('rank.rank_active','true');
		$this->db->where('status.employee_status','Regular');
		$this->db->order_by('employee_information.first_name','asc');
		$this->db->order_by('employee_type.employee_type');
		$query = $this->db->get();

		$result = $query->result_array();

		if(count($result) == 0){
			$this->db->select('*,employee_information.employee_id as emp_id');
			$this->db->from('employee_information');
			$this->db->join('employee_type', 'employee_type.employee_type_id = employee_information.employee_type_id','inner');
			$this->db->join('status', 'status.employee_id = employee_information.employee_id','inner');
			$this->db->join('job_position', 'job_position.job_position_id = employee_information.job_position_id','inner');
			$this->db->join('rank', 'rank.employee_id = employee_information.employee_id','left');
			$this->db->where('employee_information.active','true');
			$this->db->where('status.active','true');
			$this->db->where('status.employee_status','Regular');
			$this->db->order_by('employee_information.first_name','asc');
			$this->db->order_by('employee_type.employee_type');
			$query = $this->db->get();

			return $query->result_array();
		}

		return $result;
	}

	//add educational attainment
	function add_educ_attainment($employee_id)
	{
		$data = array(
			'educational_attainment_id' => $this->input->post('educ_attain'),
			'course_description' => $this->input->post('course'),
			'employee_id' => $employee_id
		);

		$this->db->insert('education',$data);
	}

	//edit educational attainment
	function edit_educ_attainment()
	{
		$educ_id = $this->input->post('educ_id');
		$data = array(
			'educational_attainment_id' => $this->input->post('educ_attain'),
			'course_description' => $this->input->post('course')
		);

		$this->db->update('education',$data, "education_id = $educ_id");
	}

	//delete educational attainment
	function delete_educ_attainment($educ_id)
	{
		$this->db->select('*');
		$this->db->from('education');
		$this->db->where('education_id',$educ_id);
		$query = $this->db->get();
		$result = $query->row_array();

		$employee_id = $result['employee_id'];

		$this->db->delete('education', array('education_id' => $educ_id));

		return $employee_id;
	}

	//work experience settings---------------------------------------
	function get_work_settings($etype)
	{
		$this->db->select('*');
		$this->db->from('work_experience');
		$this->db->join('employee_type', 'employee_type.employee_type_id = work_experience.employee_type_id','inner');
		$this->db->join('work_type_experience', 'work_type_experience.work_type_experience_id = work_experience.work_type_experience_id','inner');
		$this->db->where('employee_type.employee_type',$etype);
		$this->db->order_by('work_type_experience.work_type'); 
		$this->db->order_by('work_experience.work_points'); 
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function edit_work_settings()
	{
		$etype = $this->input->post('etype');
		$work_id = $this->input->post('work_setting_id');
		$min_month = $this->input->post('min_month');
		$max_month = $this->input->post('max_month');
		$denied ='denied';
		$accepted = 'accepted';

		$this->db->select('*');
		$this->db->from('work_experience');
		$this->db->join('employee_type', 'work_experience.employee_type_id = work_experience.employee_type_id','inner');
		$this->db->where('work_experience.work_experience_id',$work_id);
		$query = $this->db->get();
		$result = $query->row_array();

		//check if min is equal to zero
		if($result['work_min_months'] == 0){
			if($min_month != $result['work_min_months'])
			{
				return $denied;
			}

			if($max_month <= $result['work_min_months']){
				return $denied;
			}

			$max = $result['work_max_months'];
			$type = $result['work_type_experience_id'];

			//check next bracket min range
			$this->db->select('*');
			$this->db->from('work_experience');
			$this->db->join('employee_type', 'work_experience.employee_type_id = work_experience.employee_type_id','inner');
			$this->db->where('work_experience.work_min_months',$max);
			$this->db->where('work_experience.employee_type_id',$etype);
			$this->db->where('work_experience.work_type_experience_id',$type);
			$query = $this->db->get();
			$result2 = $query->row_array();

			if($max_month >= $result2['work_max_months']){
				return $denied;
			}

			$work_id2 = $result2['work_experience_id'];

			$data = array(
				'work_points' => $this->input->post('points'),
				'work_min_months' => 0,
				'work_max_months' => $max_month
				);

			$data2 = array(
				'work_min_months' => $max_month
				);

			$this->db->trans_start();

			$this->db->update('work_experience',$data, "work_experience_id = $work_id");
			$this->db->update('work_experience',$data2, "work_experience_id = $work_id2");

			$this->db->trans_complete();

			return $accepted;
		}

		//check if max is equal to max value
		if($result['work_max_months'] == 999){

			if($max_month != $result['work_max_months'])
			{
				return $denied;
			}

			if($min_month >= $result['work_max_months']){
				return $denied;
			}

			$min = $result['work_min_months'];
			$type = $result['work_type_experience_id'];

			//check previous bracket max range
			$this->db->select('*');
			$this->db->from('work_experience');
			$this->db->join('employee_type', 'work_experience.employee_type_id = work_experience.employee_type_id','inner');
			$this->db->where('work_experience.work_max_months',$min);
			$this->db->where('work_experience.employee_type_id',$etype);
			$this->db->where('work_experience.work_type_experience_id',$type);
			$query = $this->db->get();
			$result2 = $query->row_array();

			if($min_month <= $result2['work_min_months']){
				return $denied;
			}

			$work_id2 = $result2['work_experience_id'];

			$data = array(
				'work_points' => $this->input->post('points'),
				'work_max_months' => 999,
				'work_min_months' => $min_month
				);

			$data2 = array(
				'work_max_months' => $min_month
				);

			$this->db->trans_start();

			$this->db->update('work_experience',$data, "work_experience_id = $work_id");
			$this->db->update('work_experience',$data2, "work_experience_id = $work_id2");

			$this->db->trans_complete();

			return $accepted;
		}

		//else in between brackets
		if($max_month <= $result['work_min_months']){
			return $denied;
		}

		if($min_month >= $result['work_max_months']){
			return $denied;
		}

		$max = $result['work_max_months'];
		$type = $result['work_type_experience_id'];

		//check next bracket min range
		$this->db->select('*');
		$this->db->from('work_experience');
		$this->db->join('employee_type', 'work_experience.employee_type_id = work_experience.employee_type_id','inner');
		$this->db->where('work_experience.work_min_months',$max);
		$this->db->where('work_experience.employee_type_id',$etype);
		$this->db->where('work_experience.work_type_experience_id',$type);
		$query = $this->db->get();
		$result2 = $query->row_array();

		if($max_month >= $result2['work_max_months']){
				return $denied;
		}

		$work_id2 = $result2['work_experience_id'];

		$min = $result['work_min_months'];

		//check previous bracket max range
		$this->db->select('*');
		$this->db->from('work_experience');
		$this->db->join('employee_type', 'employee_type.employee_type_id = work_experience.employee_type_id','inner');
		$this->db->where('work_experience.work_max_months',$min);
		$this->db->where('work_experience.employee_type_id',$etype);
		$this->db->where('work_experience.work_type_experience_id',$type);
		$query = $this->db->get();
		$result3 = $query->row_array();

		if($min_month <= $result3['work_min_months']){
			return $denied;
		}

		$work_id3 = $result3['work_experience_id'];

		$data = array(
			'work_points' => $this->input->post('points'),
			'work_max_months' => $max_month,
			'work_min_months' => $min_month
			);

		$data2 = array(
			'work_min_months' => $max_month
			);

		$data3 = array(
			'work_max_months' => $min_month
			);

		$this->db->trans_start();

		//update current bracket range
		$this->db->update('work_experience',$data, "work_experience_id = $work_id");
		//update next bracket range min
		$this->db->update('work_experience',$data2, "work_experience_id = $work_id2");
		//update prev bracket range max
		$this->db->update('work_experience',$data3, "work_experience_id = $work_id3");

		$this->db->trans_complete();

		return $accepted;
	}

	function get_work_ici($employee_id)
	{
		$this->db->select('*');
		$this->db->from('employee_type_history');
		$this->db->join('employee_type', 'employee_type.employee_type_id = employee_type_history.employee_type_id','inner');
		$this->db->where('employee_id',$employee_id);
		$this->db->order_by('type_start_date','desc'); 
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_points_length_of_service($employee_id,$length_of_service)
	{
		//get employee info
		$this->db->select('*');
		$this->db->from('employee_information');
		$this->db->where('employee_id',$employee_id);
		$query = $this->db->get();
		$row = $query->row_array();

		$etype_id = $row['employee_type_id'];

		//get corresponding point
		$this->db->select('*');
		$this->db->from('work_experience');
		$this->db->where('employee_type_id',$etype_id);
		$this->db->where('work_type_experience_id',2);
		$this->db->where('work_min_months <=', $length_of_service);
		$this->db->where('work_max_months >', $length_of_service);
		$query2 = $this->db->get();
		$row2 = $query2->row_array();

		$points = $row2['work_points'];

		return $points;
	}

	function get_employee_work_summary($employee_id)
	{
		$this->db->select('*');
		$this->db->from('work');
		$this->db->join('employee_information', 'employee_information.employee_id = work.employee_id','inner');
		$this->db->join('employee_type', 'employee_information.employee_type_id = employee_type.employee_type_id','inner');
		$this->db->join('work_type_experience', 'work_type_experience.work_type_experience_id = work.work_type_experience_id','inner');
		$this->db->where('work.employee_id',$employee_id);
		$this->db->order_by('work.previous_work_start_date','desc'); 
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_work_points($etype)
	{
		$this->db->select('*');
		$this->db->from('work_experience');
		$this->db->join('work_type_experience', 'work_type_experience.work_type_experience_id = work_experience.work_type_experience_id','inner');
		$this->db->where('work_experience.employee_type_id',$etype);
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_work_type()
	{
		$this->db->select('*');
		$this->db->from('work_type_experience');
		$query = $this->db->get();
		return $query->result_array();
	}

	//add work exp
	function add_work_exp($employee_id)
	{
		$data = array(
			'employer' => $this->input->post('employer'),
			'work_duration' => $this->input->post('duration'),
			'employee_id' => $employee_id,
			'work_type_experience_id' => $this->input->post('work_type'),
			'previous_work_start_date' => $this->input->post('startdate')
		);

		$this->db->insert('work',$data);
	}

	//edit work exp
	function edit_work_exp()
	{
		$work_id = $this->input->post('work_id');
		$data = array(
			'employer' => $this->input->post('employer'),
			'work_duration' => $this->input->post('duration'),
			'work_type_experience_id' => $this->input->post('work_type'),
			'previous_work_start_date' => $this->input->post('startdate')
		);

		$this->db->update('work',$data, "work_id = $work_id");
	}

	//delete work exp
	function delete_work_exp($work_id)
	{
		$this->db->select('*');
		$this->db->from('work');
		$this->db->where('work_id',$work_id);
		$query = $this->db->get();
		$result = $query->row_array();

		$employee_id = $result['employee_id'];

		$this->db->delete('work', array('work_id' => $work_id));

		return $employee_id;
	}

	//cert settings----------------------------------------
	function get_cert_settings($etype,$ctype)
	{
		$this->db->select('*');
		$this->db->from('certification_board');
		$this->db->join('employee_type', 'employee_type.employee_type_id = certification_board.employee_type_id','inner');
		$this->db->join('certification_board_type', 'certification_board_type.certification_board_type_id = certification_board.certification_board_type_id','inner');
		$this->db->join('certification_board_detail', 'certification_board_detail.certification_board_detail_id = certification_board.certification_board_detail_id','inner');
		$this->db->where('employee_type.employee_type',$etype);
		$this->db->where('certification_board_type.cert_type',$ctype);
		$this->db->order_by('certification_board_detail.certification_board_detail_id'); 
		$query = $this->db->get();
		return $query->result_array();
	}

	//edit cert setting
	function edit_cert_setting()
	{
		$cert_id = $this->input->post('cert_board_id');

		$data = array(
			'cert_points' => $this->input->post('points')
		);

		$this->db->update('certification_board',$data, "certification_board_id = $cert_id");
	}

	//get all certification exam settings
	function get_cert_exam_settings()
	{
		$this->db->select('*');
		$this->db->from('certification_board');
		$this->db->join('employee_type', 'employee_type.employee_type_id = certification_board.employee_type_id','inner');
		$this->db->join('certification_board_type', 'certification_board_type.certification_board_type_id = certification_board.certification_board_type_id','inner');
		$this->db->join('certification_board_detail', 'certification_board_detail.certification_board_detail_id = certification_board.certification_board_detail_id','inner');
		$this->db->order_by('certification_board.certification_board_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	//add certification
	function add_cert_acquired($employee_id)
	{
		$data = array(
			'certification_board_id' => $this->input->post('exam_type'),
			'cert_board_description' => $this->input->post('exam'),
			'employee_id' => $employee_id
		);

		$this->db->insert('certification_board_acquired',$data);
	}

	//get employee certifications acquired / exams passed
	function get_employee_certification_summary($employee_id)
	{		
		$this->db->select('*');
		$this->db->from('certification_board_acquired');
		$this->db->join('employee_information', 'employee_information.employee_id = certification_board_acquired.employee_id','inner');
		$this->db->join('certification_board', 'certification_board.certification_board_id = certification_board_acquired.certification_board_id','inner');
		$this->db->join('certification_board_type', 'certification_board_type.certification_board_type_id = certification_board.certification_board_type_id','inner');
		$this->db->join('certification_board_detail', 'certification_board_detail.certification_board_detail_id = certification_board.certification_board_detail_id','inner');
		$this->db->where('employee_information.employee_id',$employee_id);
		//$this->db->where('base_leave.active','true');
		$this->db->order_by('certification_board_acquired.certification_board_id','asc'); 
		$query = $this->db->get();
		$result = $query->result_array();

		return $result;
	}

	//edit certification/exams passed
	function edit_cert_board()
	{
		$cert_id = $this->input->post('cert_id');
		$data = array(
			'certification_board_id' => $this->input->post('cert_type'),
			'cert_board_description' => $this->input->post('cert_description')
		);

		$this->db->update('certification_board_acquired',$data, "certification_board_acquired_id = $cert_id");
	}

	//delete certification/exam acquired
	function delete_cert_board($cert_id)
	{
		$this->db->select('*');
		$this->db->from('certification_board_acquired');
		$this->db->where('certification_board_acquired_id',$cert_id);
		$query = $this->db->get();
		$result = $query->row_array();

		$employee_id = $result['employee_id'];

		$this->db->delete('certification_board_acquired', array('certification_board_acquired_id' => $cert_id));

		return $employee_id;
	}

	//get exam base points
	function get_exam_base_points($etype)
	{
		$this->db->select('*');
		$this->db->from('base_points');
		$this->db->join('employee_type', 'employee_type.employee_type_id = base_points.employee_type_id','inner');
		$this->db->join('criteria', 'criteria.criteria_id = base_points.criteria_id','inner');
		$this->db->where('employee_type.employee_type_id',$etype);
		$this->db->where('criteria.criteria_description','Certifications or Board/Government Examinations Passed');
		$query = $this->db->get();
		return $query->row_array();
	}

	function get_multiplier($criteria,$etype)
	{
		$this->db->select('*');
		$this->db->from('weight_multiplier');
		$this->db->join('employee_type', 'employee_type.employee_type_id = weight_multiplier.employee_type_id','inner');
		$this->db->join('criteria', 'criteria.criteria_id = weight_multiplier.criteria_id','inner');
		$this->db->where('employee_type.employee_type_id',$etype);
		$this->db->where('criteria.criteria_description',$criteria);
		$query = $this->db->get();
		return $query->row_array();
	}

	//base points and weight multiplier settings-----------------------------
	//weight mutliplier
	function get_weight_multiplier($etype)
	{
		$this->db->select('*');
		$this->db->from('weight_multiplier');
		$this->db->join('employee_type', 'employee_type.employee_type_id = weight_multiplier.employee_type_id','inner');
		$this->db->join('criteria', 'criteria.criteria_id = weight_multiplier.criteria_id','inner');
		$this->db->where('employee_type.employee_type',$etype);
		$this->db->order_by('weight_multiplier.weight_multiplier_id'); 
		$query = $this->db->get();
		return $query->result_array();
	}

	//base points
	function get_base_points($etype)
	{
		$this->db->select('*');
		$this->db->from('base_points');
		$this->db->join('employee_type', 'employee_type.employee_type_id = base_points.employee_type_id','inner');
		$this->db->join('criteria', 'criteria.criteria_id = base_points.criteria_id','inner');
		$this->db->where('employee_type.employee_type',$etype);
		$this->db->order_by('base_points.criteria_id'); 
		$query = $this->db->get();
		return $query->result_array();
	}

	//edit base points setting
	function edit_base_points_setting()
	{
		$base_id = $this->input->post('base_id');

		$data = array(
			'base_points' => $this->input->post('points')
		);

		$this->db->update('base_points',$data, "base_points_id = $base_id");
	}

	//edit weight multiplier setting
	function edit_weight_multiplier_setting()
	{
		$weight_id = $this->input->post('weight_id');

		$data = array(
			'weight' => $this->input->post('multiplier')
		);

		$this->db->update('weight_multiplier',$data, "weight_multiplier_id = $weight_id");
	}

	//ranking classification---------------------------------------

	function get_job_grade()
	{

		$this->db->select('*');
		$this->db->from('staff_rank_classification');
		$this->db->join('staff_job_grade', 'staff_job_grade.staff_job_grade_id = staff_rank_classification.staff_job_grade_id','inner');
		$this->db->join('level', 'level.level_id = staff_rank_classification.level_id','left');
		//$this->db->where('staff_job_grade.job_description',$grade);
		$this->db->order_by('staff_rank_classification.staff_rank_classification_id'); 
		$query = $this->db->get();
		
		return $query->result_array();
	}

	function get_position()
	{
		$this->db->select('*');
		$this->db->from('job_position');
		$query = $this->db->get();
		
		return $query->result_array();
	}

	function get_faculty_rank()
	{
		$this->db->select('*');
		$this->db->from('faculty_rank_classification');
		$this->db->join('faculty_rank', 'faculty_rank.faculty_rank_id = faculty_rank_classification.faculty_rank_id','inner');
		$this->db->join('level', 'level.level_id = faculty_rank_classification.level_id','left');
		$this->db->join('education_level', 'education_level.education_level_id = faculty_rank_classification.education_requirement_id','inner');
		$this->db->order_by('faculty_rank_classification.faculty_rank_classification_id'); 
		$query = $this->db->get();
		
		return $query->result_array();
	}

	function get_rank_reference($etype)
	{
		if($etype == "Staff"){
			$this->db->select('*');
			$this->db->from('staff_rank_classification');
			$this->db->join('staff_job_grade', 'staff_job_grade.staff_job_grade_id = staff_rank_classification.staff_job_grade_id','inner');
			$this->db->join('level', 'level.level_id = staff_rank_classification.level_id','left');
			$this->db->order_by('staff_rank_classification.staff_rank_classification_id'); 
			$query = $this->db->get();
		
			return $query->result_array();
		}

		$this->db->select('*');
		$this->db->from('faculty_rank_classification');
		$this->db->join('faculty_rank', 'faculty_rank.faculty_rank_id = faculty_rank_classification.faculty_rank_id','inner');
		$this->db->join('level', 'level.level_id = faculty_rank_classification.level_id','left');
		$this->db->join('education_level', 'education_level.education_level_id = faculty_rank_classification.education_requirement_id','inner');
		$this->db->order_by('faculty_rank_classification.faculty_rank_classification_id');
		$query = $this->db->get();
		
		return $query->result_array();
	}

	//edit faculty classification settings
	function edit_faculty_classification()
	{
		$faculty_id = $this->input->post('faculty_rank_id');
		$min_points = $this->input->post('min_points');
		$max_points = $this->input->post('max_points');
		$denied ='denied';
		$accepted = 'accepted';

		$this->db->select('*');
		$this->db->from('faculty_rank_classification');
		$this->db->where('faculty_rank_classification.faculty_rank_classification_id',$faculty_id);
		$query = $this->db->get();
		$result = $query->row_array();

		//check if min is equal to zero

		
		//else in between brackets
		if($max_points <= $result['min_point_range_f']){
			return $denied;
		}

		if($min_points >= $result['max_point_range_f']){
			return $denied;
		}

		$max = $result['max_point_range_f'] + 1;

		//check next bracket min range
		$this->db->select('*');
		$this->db->from('faculty_rank_classification');
		$this->db->where('faculty_rank_classification.min_point_range_f',$max);
		$query = $this->db->get();
		$result2 = $query->row_array();

		//if there is no next bracket min range
		if(count($result2) == 0){
			//no next min range
			$min = $result['min_point_range_f'] - 1;

			$this->db->select('*');
			$this->db->from('faculty_rank_classification');
			$this->db->where('faculty_rank_classification.max_point_range_f',$min);
			$query = $this->db->get();
			$result_no_next = $query->row_array();

			if($min_points <= $result_no_next['min_point_range_f']+1){
				return $denied;
			}

			$faculty_id_no_next = $result_no_next['faculty_rank_classification_id'];

			$data_current = array(
			'faculty_salary' => $this->input->post('salary'),
			'max_point_range_f' => $max_points,
			'min_point_range_f' => $min_points,
			'teaching_exp' => $this->input->post('teaching_exp'),
			'education_requirement_id' => $this->input->post('educ_level')
			);

			$data_no_next = array(
			'max_point_range_f' => $min_points -1
			);

			$this->db->trans_start();

			//update current bracket range
			$this->db->update('faculty_rank_classification',$data_current, "faculty_rank_classification_id = $faculty_id");
			//update prev bracket range max
			$this->db->update('faculty_rank_classification',$data_no_next, "faculty_rank_classification_id = $faculty_id_no_next");

			$this->db->trans_complete();

			return $accepted;
		}
		//end of no next bracket min range

		if($max_points >= $result2['max_point_range_f']-1){
				return $denied;
		}

		$faculty_id2 = $result2['faculty_rank_classification_id'];

		$min = $result['min_point_range_f'] - 1;

		//check previous bracket max range
		$this->db->select('*');
		$this->db->from('faculty_rank_classification');
		$this->db->where('faculty_rank_classification.max_point_range_f',$min);
		$query = $this->db->get();
		$result3 = $query->row_array();

		//if there is no previous bracket max range
		if(count($result3) == 0){
			//no previous max range

			$this->db->select('*');
			$this->db->from('faculty_rank_classification');
			$this->db->where('faculty_rank_classification.min_point_range_f',$max);
			$query = $this->db->get();
			$result_no_prev = $query->row_array();

			if($max_points >= $result_no_prev['max_point_range_f']-1){
				return $denied;
			}

			$faculty_id_no_prev = $result_no_prev['faculty_rank_classification_id'];

			$data_current = array(
			'faculty_salary' => $this->input->post('salary'),
			'max_point_range_f' => $max_points,
			'min_point_range_f' => $min_points,
			'teaching_exp' => $this->input->post('teaching_exp'),
			'education_requirement_id' => $this->input->post('educ_level')
			);

			$data_no_prev = array(
			'min_point_range_f' => $max_points + 1
			);

			$this->db->trans_start();

			//update current bracket range
			$this->db->update('faculty_rank_classification',$data_current, "faculty_rank_classification_id = $faculty_id");
			//update prev bracket range max
			$this->db->update('faculty_rank_classification',$data_no_prev, "faculty_rank_classification_id = $faculty_id_no_prev");

			$this->db->trans_complete();

			return $accepted;
		}
		//end of no previous bracket max range

		if($min_points <= $result3['min_point_range_f']+1){
			return $denied;
		}

		$faculty_id3 = $result3['faculty_rank_classification_id'];

		$data = array(
			'faculty_salary' => $this->input->post('salary'),
			'max_point_range_f' => $max_points,
			'min_point_range_f' => $min_points,
			'teaching_exp' => $this->input->post('teaching_exp'),
			'education_requirement_id' => $this->input->post('educ_level')
			);

		$data2 = array(
			'min_point_range_f' => $max_points + 1
			);

		$data3 = array(
			'max_point_range_f' => $min_points -1
			);

		$this->db->trans_start();

		//update current bracket range
		$this->db->update('faculty_rank_classification',$data, "faculty_rank_classification_id = $faculty_id");
		//update next bracket range min
		$this->db->update('faculty_rank_classification',$data2, "faculty_rank_classification_id = $faculty_id2");
		//update prev bracket range max
		$this->db->update('faculty_rank_classification',$data3, "faculty_rank_classification_id = $faculty_id3");

		$this->db->trans_complete();

		return $accepted;
	}

	function edit_faculty_classification_full()
	{
		$faculty_id = $this->input->post('faculty_rank_id');
		$min_points = $this->input->post('min_points');
		$max_points = $this->input->post('max_points');
		$accepted = 'accepted';
		$denied ='denied';

		$this->db->select('*');
		$this->db->from('faculty_rank_classification');
		$this->db->where('faculty_rank_classification.faculty_rank_classification_id',$faculty_id);
		$query = $this->db->get();
		$result = $query->row_array();

		//check if min is equal to zero

		
		//else in between brackets
		if($max_points <= $result['min_point_range_f']){
			return $denied;
		}

		if($min_points >= $result['max_point_range_f']){
			return $denied;
		}

		$max = $result['max_point_range_f'] + 1;

		//check next bracket min range
		$this->db->select('*');
		$this->db->from('faculty_rank_classification');
		$this->db->where('faculty_rank_classification.min_point_range_f',$max);
		$query = $this->db->get();
		$result2 = $query->row_array();

		//if there is no next bracket min range
		if(count($result2) == 0){
			//no next min range
			$min = $result['min_point_range_f'] - 1;

			$this->db->select('*');
			$this->db->from('faculty_rank_classification');
			$this->db->where('faculty_rank_classification.max_point_range_f',$min);
			$query = $this->db->get();
			$result_no_next = $query->row_array();

			if($min_points <= $result_no_next['min_point_range_f']+1){
				return $denied;
			}

			$faculty_id_no_next = $result_no_next['faculty_rank_classification_id'];

			$data_current = array(
			'faculty_salary' => $this->input->post('salary'),
			'max_point_range_f' => $max_points,
			'min_point_range_f' => $min_points,
			'teaching_exp' => $this->input->post('teaching_exp'),
			'education_requirement_id' => $this->input->post('educ_level'),
			'managerial_exp' => $this->input->post('managerial_exp')
			);

			$data_no_next = array(
			'max_point_range_f' => $min_points -1
			);

			$this->db->trans_start();

			//update current bracket range
			$this->db->update('faculty_rank_classification',$data_current, "faculty_rank_classification_id = $faculty_id");
			//update prev bracket range max
			$this->db->update('faculty_rank_classification',$data_no_next, "faculty_rank_classification_id = $faculty_id_no_next");

			$this->db->trans_complete();

			return $accepted;
		}
		//end of no next bracket min range

		if($max_points >= $result2['max_point_range_f']-1){
				return $denied;
		}

		$faculty_id2 = $result2['faculty_rank_classification_id'];

		$min = $result['min_point_range_f'] - 1;

		//check previous bracket max range
		$this->db->select('*');
		$this->db->from('faculty_rank_classification');
		$this->db->where('faculty_rank_classification.max_point_range_f',$min);
		$query = $this->db->get();
		$result3 = $query->row_array();

		//if there is no previous bracket max range
		if(count($result3) == 0){
			//no previous max range

			$this->db->select('*');
			$this->db->from('faculty_rank_classification');
			$this->db->where('faculty_rank_classification.min_point_range_f',$max);
			$query = $this->db->get();
			$result_no_prev = $query->row_array();

			if($max_points >= $result_no_prev['max_point_range_f']-1){
				return $denied;
			}

			$faculty_id_no_prev = $result_no_prev['faculty_rank_classification_id'];

			$data_current = array(
			'faculty_salary' => $this->input->post('salary'),
			'max_point_range_f' => $max_points,
			'min_point_range_f' => $min_points,
			'teaching_exp' => $this->input->post('teaching_exp'),
			'education_requirement_id' => $this->input->post('educ_level'),
			'managerial_exp' => $this->input->post('managerial_exp')
			);

			$data_no_prev = array(
			'min_point_range_f' => $max_points + 1
			);

			$this->db->trans_start();

			//update current bracket range
			$this->db->update('faculty_rank_classification',$data_current, "faculty_rank_classification_id = $faculty_id");
			//update prev bracket range max
			$this->db->update('faculty_rank_classification',$data_no_prev, "faculty_rank_classification_id = $faculty_id_no_prev");

			$this->db->trans_complete();

			return $accepted;
		}
		//end of no previous bracket max range

		if($min_points <= $result3['min_point_range_f']+1){
			return $denied;
		}

		$faculty_id3 = $result3['faculty_rank_classification_id'];

		$data = array(
			'faculty_salary' => $this->input->post('salary'),
			'max_point_range_f' => $max_points,
			'min_point_range_f' => $min_points,
			'teaching_exp' => $this->input->post('teaching_exp'),
			'education_requirement_id' => $this->input->post('educ_level'),
			'managerial_exp' => $this->input->post('managerial_exp')
			);

		$data2 = array(
			'min_point_range_f' => $max_points + 1
			);

		$data3 = array(
			'max_point_range_f' => $min_points -1
			);

		$this->db->trans_start();

		//update current bracket range
		$this->db->update('faculty_rank_classification',$data, "faculty_rank_classification_id = $faculty_id");
		//update next bracket range min
		$this->db->update('faculty_rank_classification',$data2, "faculty_rank_classification_id = $faculty_id2");
		//update prev bracket range max
		$this->db->update('faculty_rank_classification',$data3, "faculty_rank_classification_id = $faculty_id3");

		$this->db->trans_complete();

		return $accepted;
	}

	//edit staff classification settings
	function edit_staff_classification()
	{
		$staff_id = $this->input->post('staff_rank_id');
		$min_points = $this->input->post('min_points');
		$max_points = $this->input->post('max_points');
		$denied ='denied';
		$accepted = 'accepted';

		$this->db->select('*');
		$this->db->from('staff_rank_classification');
		$this->db->where('staff_rank_classification.staff_rank_classification_id',$staff_id);
		$query = $this->db->get();
		$result = $query->row_array();

		//check if min is equal to zero

		
		//else in between brackets
		if($max_points <= $result['min_point_range']){
			return $denied;
		}

		if($min_points >= $result['max_point_range']){
			return $denied;
		}

		$max = $result['max_point_range'] + 1;

		//check next bracket min range
		$this->db->select('*');
		$this->db->from('staff_rank_classification');
		$this->db->where('staff_rank_classification.min_point_range',$max);
		$query = $this->db->get();
		$result2 = $query->row_array();

		//if there is no next bracket min range
		if(count($result2) == 0){
			//no next min range
			$min = $result['min_point_range'] - 1;

			$this->db->select('*');
			$this->db->from('staff_rank_classification');
			$this->db->where('staff_rank_classification.max_point_range',$min);
			$query = $this->db->get();
			$result_no_next = $query->row_array();

			if($min_points <= $result_no_next['min_point_range']+1){
				return $denied;
			}

			$staff_id_no_next = $result_no_next['staff_rank_classification_id'];

			$data_current = array(
			'staff_salary' => $this->input->post('salary'),
			'max_point_range' => $max_points,
			'min_point_range' => $min_points
			);

			$data_no_next = array(
			'max_point_range' => $min_points -1
			);

			$this->db->trans_start();

			//update current bracket range
			$this->db->update('staff_rank_classification',$data_current, "staff_rank_classification_id = $staff_id");
			//update prev bracket range max
			$this->db->update('staff_rank_classification',$data_no_next, "staff_rank_classification_id = $staff_id_no_next");

			$this->db->trans_complete();

			return $accepted;
		}
		//end of no next bracket min range

		if($max_points >= $result2['max_point_range']-1){
				return $denied;
		}

		$staff_id2 = $result2['staff_rank_classification_id'];

		$min = $result['min_point_range'] - 1;

		//check previous bracket max range
		$this->db->select('*');
		$this->db->from('staff_rank_classification');
		$this->db->where('staff_rank_classification.max_point_range',$min);
		$query = $this->db->get();
		$result3 = $query->row_array();

		//if there is no previous bracket max range
		if(count($result3) == 0){
			//no previous max range

			$this->db->select('*');
			$this->db->from('staff_rank_classification');
			$this->db->where('staff_rank_classification.min_point_range',$max);
			$query = $this->db->get();
			$result_no_prev = $query->row_array();

			if($max_points >= $result_no_prev['max_point_range']-1){
				return $denied;
			}

			$staff_id_no_prev = $result_no_prev['staff_rank_classification_id'];

			$data_current = array(
			'staff_salary' => $this->input->post('salary'),
			'max_point_range' => $max_points,
			'min_point_range' => $min_points
			);

			$data_no_prev = array(
			'min_point_range' => $max_points + 1
			);

			$this->db->trans_start();

			//update current bracket range
			$this->db->update('staff_rank_classification',$data_current, "staff_rank_classification_id = $staff_id");
			//update prev bracket range max
			$this->db->update('staff_rank_classification',$data_no_prev, "staff_rank_classification_id = $staff_id_no_prev");

			$this->db->trans_complete();

			return $accepted;
		}
		//end of no previous bracket max range

		if($min_points <= $result3['min_point_range']+1){
			return $denied;
		}

		$staff_id3 = $result3['staff_rank_classification_id'];

		$data = array(
			'staff_salary' => $this->input->post('salary'),
			'max_point_range' => $max_points,
			'min_point_range' => $min_points
			);

		$data2 = array(
			'min_point_range' => $max_points + 1
			);

		$data3 = array(
			'max_point_range' => $min_points -1
			);

		$this->db->trans_start();

		//update current bracket range
		$this->db->update('staff_rank_classification',$data, "staff_rank_classification_id = $staff_id");
		//update next bracket range min
		$this->db->update('staff_rank_classification',$data2, "staff_rank_classification_id = $staff_id2");
		//update prev bracket range max
		$this->db->update('staff_rank_classification',$data3, "staff_rank_classification_id = $staff_id3");

		$this->db->trans_complete();

		return $accepted;
	}

	//special classifications with no point requirement
	function edit_staff_classification_special()
	{
		$staff_id = $this->input->post('staff_rank_id');

		$data = array(
			'staff_salary' => $this->input->post('salary')
			);

		$this->db->update('staff_rank_classification',$data, "staff_rank_classification_id = $staff_id");
	}

	function get_educ_high($employee_id)
	{
		$query = $this->db->query("SELECT * FROM education,educational_attainment,education_detail 
			WHERE education.educational_attainment_id = educational_attainment.educational_attainment_id 
			AND education_detail.education_detail_id = educational_attainment.education_detail_id
			AND education.employee_id = '$employee_id' 
			AND (education_detail.detail = 'Graduated' OR education_detail.detail = '1 yr course' OR education_detail.detail = '2 yr course' OR education_detail.detail = '3 yr course') 
			ORDER BY educational_attainment.education_level_id DESC LIMIT 1")->row_array();
		return $query;
	}

	function get_last_rerank()
	{
		$this->db->select('*');
		$this->db->from('rank_date');
		$this->db->where('rank_date.active','true');
		$query = $this->db->get();
		$result = $query->row_array();

		if(count($result) == 0){
			return 'None';
		}
		return $result['rank_date'];
	}

	function get_current_rank_date(){
		$this->db->select('*');
		$this->db->from('rank_date');
		$this->db->where('rank_date.active','true');
		$query = $this->db->get();
		return $query->row_array();
	}

	function get_all_rank_dates()
	{
		$this->db->select('*');
		$this->db->from('rank_date');
		$this->db->order_by('rank_date_id','desc');
		$query = $this->db->get();
		$result = $query->result_array();

		return $result;
	}

	function get_past_rank_date(){
		$this->db->select('*');
		$this->db->from('rank_date');
		$this->db->where('rank_date.rank_date_id',$this->input->post('search_rank_date'));
		$query = $this->db->get();
		return $query->row_array();
	}

	function get_staff_rank_reference($job_position)
	{
		$this->db->select('*');
		$this->db->from('staff_rank_classification');
		$this->db->join('staff_job_grade', 'staff_job_grade.staff_job_grade_id = staff_rank_classification.staff_job_grade_id','inner');
		$this->db->join('level', 'level.level_id = staff_rank_classification.level_id','left');
		$this->db->join('job_position', 'job_position.staff_job_grade_id = staff_job_grade.staff_job_grade_id','inner');
		$this->db->where('staff_rank_classification.min_point_range IS NOT NULL', null);
		$this->db->where('staff_rank_classification.max_point_range IS NOT NULL', null);
		$this->db->where('job_position.job_position_id',$job_position);
		$this->db->order_by('staff_rank_classification.staff_rank_classification_id');
		$query = $this->db->get();
		
		return $query->result_array();
	}

	function get_lowest_faculty_rank()
	{
		$this->db->select('*');
		$this->db->from('faculty_rank_classification');
		$this->db->join('faculty_rank', 'faculty_rank.faculty_rank_id = faculty_rank_classification.faculty_rank_id','inner');
		$this->db->join('level', 'level.level_id = faculty_rank_classification.level_id','left');
		$this->db->join('education_level', 'education_level.education_level_id = faculty_rank_classification.education_requirement_id','inner');
		$this->db->where('faculty_rank.faculty_rank_description','Junior Instructor');
		$this->db->where('level.level','I');
		$query = $this->db->get();
		
		return $query->row_array();
	}

	function get_lowest_staff_rank($job_position)
	{
		$this->db->select('*');
		$this->db->from('staff_rank_classification');
		$this->db->join('staff_job_grade', 'staff_job_grade.staff_job_grade_id = staff_rank_classification.staff_job_grade_id','inner');
		$this->db->join('level', 'level.level_id = staff_rank_classification.level_id','left');
		$this->db->join('job_position', 'job_position.staff_job_grade_id = staff_job_grade.staff_job_grade_id','inner');
		$this->db->where('job_position.job_position_id',$job_position);
		$this->db->where('level.level','I');
		$query = $this->db->get();
		
		return $query->row_array();
	}

	function get_staff_rank_unskilled()
	{
		$this->db->select('*');
		$this->db->from('staff_rank_classification');
		$this->db->join('staff_job_grade', 'staff_job_grade.staff_job_grade_id = staff_rank_classification.staff_job_grade_id','inner');
		$this->db->join('level', 'level.level_id = staff_rank_classification.level_id','left');
		$this->db->where('staff_job_grade.job_description','Unskilled');
		$query = $this->db->get();
		
		return $query->row_array();
	}

	function get_staff_rank_semi_skilled()
	{
		$this->db->select('*');
		$this->db->from('staff_rank_classification');
		$this->db->join('staff_job_grade', 'staff_job_grade.staff_job_grade_id = staff_rank_classification.staff_job_grade_id','inner');
		$this->db->join('level', 'level.level_id = staff_rank_classification.level_id','left');
		$this->db->where('staff_job_grade.job_description','Semi-skilled');
		$query = $this->db->get();
		
		return $query->row_array();
	}

	function get_staff_rank_management()
	{
		$this->db->select('*');
		$this->db->from('staff_rank_classification');
		$this->db->join('staff_job_grade', 'staff_job_grade.staff_job_grade_id = staff_rank_classification.staff_job_grade_id','inner');
		$this->db->join('level', 'level.level_id = staff_rank_classification.level_id','left');
		$this->db->where('staff_job_grade.staff_job_grade_id','8');
		$query = $this->db->get();
		
		return $query->row_array();
	}

	function rerank_all(){

		$this->db->trans_start();

		$rank_date = date('M d Y');
		$this->db->select('*');
		$this->db->from('rank_date');
		$query = $this->db->get();

		$rank_d = $query->result_array();

		$active = 'true';
		//set previous date to false
		
		if(count($rank_d) == 0){

		}
		else{
			$data = array(
				'active' => 'false'
			);
			$this->db->update('rank_date',$data, "active = $active");
		}

		$data = array(
			'rank_date' => $rank_date
			);

		$this->db->insert('rank_date', $data);

		//get all employees for reranking
		$eligible_employees = $this->eligible_list();

		//criteria
		$educ_criteria = 'Educational Attainment';
		$work_criteria = 'Working Experience';
		$cert_criteria = 'Certifications or Board/Government Examinations Passed';

		//faculty reference
		$lowest_fac_rank = $this->get_lowest_faculty_rank();

		//staff reference
		
		
		$unskilled = $this->get_staff_rank_unskilled();
		$semiskilled = $this->get_staff_rank_semi_skilled();
		$management = $this->get_staff_rank_management();

		foreach ($eligible_employees as $employee):
			//inittialize educ total points
			$educ_total = 0;
			//initialize work duration to zero; both faculty and staff (current work)
			$staff_work_duration = 0;
			$faculty_teach_duration = 0;
			$faculty_industry_duration = 0;
			//initiallize certification total points
			$certification_total = 0;
			$lowest_staff_rank = $this->get_lowest_staff_rank($employee['job_position_id']);
			$staff_reference = $this->get_staff_rank_reference($employee['job_position_id']);

			$id = $employee['emp_id'];
			$etype = $employee['employee_type_id'];
			//get educ attainment
			$educ_summary = $this->get_employee_education_summary($id);
			if(count($educ_summary) <1){
				$educ_total = 0;
			}
			else{
				foreach($educ_summary as $summary):
					$educ_total = $educ_total + $summary['educ_points'];
				endforeach;
			}

			$educ_high = $this->get_educ_high($id);

			//get work experience
			$current_work_summary = $this->get_work_ici($id);

			foreach($current_work_summary as $summary):
				$start_date = new DateTime($summary['type_start_date']);
				if($summary['type_end_date'] == null){
					$end_date = new DateTime(date('M d Y'));
				}
				else{
					$end_date = new DateTime($summary['type_end_date']);
				}
				$interval = $start_date->diff($end_date);
				$length_of_service = ($interval->format('%y') * 12) + $interval->format('%m');

				//add work length to staff
				if($employee['employee_type'] == 'Staff'){
					$staff_work_duration = $staff_work_duration + $length_of_service;
				}
				//add work length to faculty
				else{
					if($summary['employee_type'] == 'Staff'){ // faculty industry
						$faculty_industry_duration = $faculty_industry_duration + $length_of_service;
					}
					else{
						$faculty_teach_duration = $faculty_teach_duration + $length_of_service;
					}
				}
			endforeach;

			$previous_work_summary = $this->get_employee_work_summary($id);

			foreach($previous_work_summary as $summary):
				//add work length to staff
				if($employee['employee_type'] == 'Staff'){
					$staff_work_duration = $staff_work_duration + $summary['work_duration'];
				}
				//add work length to faculty
				else{
					if($summary['work_type'] == 'Industry'){ // faculty industry
						$faculty_industry_duration = $faculty_industry_duration + $summary['work_duration'];
					}
					else{	//faculty teaching
						$faculty_teach_duration = $faculty_teach_duration + $summary['work_duration'];
					}
				}
			endforeach;

			$work_points = $this->get_work_points($etype);

			//total work duration
			if($employee['employee_type'] == 'Staff'){
				$total_work_duration = $staff_work_duration;
			}
			else{ 
				$total_work_duration = $faculty_teach_duration + (int) ($faculty_industry_duration/2);
			}

			foreach($work_points as $points):
				if($total_work_duration >= $points['work_min_months'] && $total_work_duration < $points['work_max_months']){
					$work_total = $points['work_points'];
				}
			endforeach;

			//get certificate or exams
			$cert_summary = $this->get_employee_certification_summary($id);

			foreach($cert_summary as $summary):
				$certification_total = $certification_total + $summary['cert_points'];
			endforeach;
			$base_cert_points = $this->get_exam_base_points($etype);

			if(count($cert_summary) > 0){
				$base = $base_cert_points['base_points'];
			}
			else{
				$base = 0;
			}

			$certification_total = $certification_total + $base;

			//overall total in points
			$educ_multiplier = $this->get_multiplier($educ_criteria,$etype);
			$work_multiplier = $this->get_multiplier($work_criteria,$etype);
			$cert_multiplier = $this->get_multiplier($cert_criteria,$etype);

			$earned_educ = $educ_total*$educ_multiplier['weight'];
			$earned_work = $work_total*$work_multiplier['weight'];
			$earned_cert = $certification_total*$cert_multiplier['weight'];

			$overall_total = $earned_educ + $earned_work + $earned_cert;

			//faculty reference
			$reference = $this->get_rank_reference($etype);

			//faculty ranking
			if($employee['employee_type'] == 'Faculty'){
				if(count($educ_high) == 0){
					$rank = 'No educational attainment: Cannot determine rank';
				}
				else{
					$rank = $lowest_fac_rank['faculty_rank_description'].' '.$lowest_fac_rank['level'];
					$salary =  $lowest_fac_rank['faculty_salary'];
					
					$teach_year = $faculty_teach_duration/12;

					foreach($reference as $ref):
						if($ref['managerial_exp'] == NULL){
							if($educ_high['education_level_id'] >= $ref['education_requirement_id'] && $overall_total >= $ref['min_point_range_f'] && $teach_year >= $ref['teaching_exp']){
								$rank = $ref['faculty_rank_description'].' '.$ref['level'];
								$salary =  $ref['faculty_salary'];
							}
						}
						else{
							if($educ_high['education_level_id'] >= $ref['education_requirement_id'] && $overall_total >= $ref['min_point_range_f'] && ($teach_year >= $ref['teaching_exp'] || $employee['managerial_exp'] >= $ref['managerial_exp'])) {
								$rank = $ref['faculty_rank_description'].' '.$ref['level'];
								$salary =  $ref['faculty_salary'];
							}
						}
					endforeach;
				}
			}
			//staff ranking
			else{
				$rank = $lowest_staff_rank['job_description'].' '.$lowest_staff_rank['level'];
				$salary = $lowest_staff_rank['staff_salary'];
				//if no points are required
				if($employee['staff_job_grade_id'] == 1 || $employee['staff_job_grade_id'] == 2 || $employee['staff_job_grade_id'] == 7 || $employee['staff_job_grade_id'] == 8){
					if($employee['staff_job_grade_id'] == 1){
						$rank = $unskilled['job_description'];
						$salary = $lowest_staff_rank['staff_salary'];
					}
					if($employee['staff_job_grade_id'] == 2){
						$rank = $semiskilled['job_description'];
						$salary = $semiskilled['staff_salary'];
					}
					if($employee['staff_job_grade_id'] == 7 || $employee['staff_job_grade_id'] == 8){
						$rank = $management['job_description'];
						$salary = $management['staff_salary'];
					}
				}
				else
				{
					foreach($staff_reference as $ref):
						if($overall_total >= $ref['min_point_range']){
							$rank = $ref['job_description'].' '.$ref['level'];
							$salary = $ref['staff_salary'];
						}
					endforeach;
				}
			}

			//set previous rank to false
			$data = array(
				'rank_active' => 'false'
				);
			$this->db->update('rank',$data, array('rank_active' => 'true', 'employee_id' => $id));

			//get rank date id
			$this->db->select('*');
			$this->db->from('rank_date');
			$this->db->where('rank_date.active','true');
			$query = $this->db->get();
		
			$rank_d = $query->row_array();
			$date_id = $rank_d['rank_date_id'];

			$data = array(
				'employee_id' => $id,
				'total_rank_points' => $overall_total,
				'rank_position' => $rank,
				'rank_date_id'	=> $date_id,
				'rank_salary' => $salary,
				'educ_attain' =>$educ_total,
				'work_exp' =>$work_total,
				'cert_passed' =>$certification_total,
				'educ_multiplier' =>$educ_multiplier['weight'],
				'work_multiplier' =>$work_multiplier['weight'],
				'cert_multiplier' =>$cert_multiplier['weight']
				);

			$this->db->insert('rank', $data);
		endforeach;

		$this->db->trans_complete();
	}

	function check_educ(){
	
		$employees = $this->get_ranking_summary();
		$educ_attainment = 'acquired';
		$no_educ = array();

		foreach($employees as $emp):
			$id = $emp['emp_id'];

			if($emp['employee_type'] == 'Faculty'){
				$educ_high = $this->get_educ_high($id);
				if(count($educ_high) == 0){
					$name = $emp['first_name'].' '.$emp['last_name'];
					array_push($no_educ, $name);
				}
			}
		endforeach;

		return $no_educ;
	}

	function get_ranking_history($employee_id){

		$this->db->select('*');
		$this->db->from('rank');
		$this->db->join('rank_date', 'rank_date.rank_date_id = rank.rank_date_id','inner');
		$this->db->where('employee_id', $employee_id);
		$this->db->order_by('rank_date.rank_date_id','desc');

		$query = $this->db->get();
		
		return $query->result_array();	
	}

	function get_search_rank_date_summary_staff(){

		$search_date = $this->input->post('search_rank_date');

		$this->db->select('*');
		$this->db->from('rank');
		$this->db->join('employee_information', 'employee_information.employee_id = rank.employee_id','inner');
		$this->db->join('employee_type', 'employee_type.employee_type_id = employee_information.employee_type_id','inner');
		$this->db->join('status', 'status.employee_id = employee_information.employee_id','inner');
		$this->db->join('job_position', 'job_position.job_position_id = employee_information.job_position_id','inner');
		$this->db->join('rank_date', 'rank_date.rank_date_id = rank.rank_date_id','inner');
		$this->db->where('rank_date.rank_date_id', $search_date);
		$this->db->where('employee_type.employee_type','Staff');
		$this->db->where('status.active','true');
		$this->db->order_by('employee_information.first_name','asc');

		$query = $this->db->get();
		
		return $query->result_array();
	}

	function get_search_rank_date_summary_faculty(){

		$search_date = $this->input->post('search_rank_date');

		$this->db->select('*');
		$this->db->from('rank');
		$this->db->join('employee_information', 'employee_information.employee_id = rank.employee_id','inner');
		$this->db->join('employee_type', 'employee_type.employee_type_id = employee_information.employee_type_id','inner');
		$this->db->join('status', 'status.employee_id = employee_information.employee_id','inner');
		$this->db->join('job_position', 'job_position.job_position_id = employee_information.job_position_id','inner');
		$this->db->join('rank_date', 'rank_date.rank_date_id = rank.rank_date_id','inner');
		$this->db->where('rank_date.rank_date_id', $search_date);
		$this->db->where('employee_type.employee_type','Faculty');
		$this->db->where('status.active','true');
		$this->db->order_by('employee_information.first_name','asc');

		$query = $this->db->get();
		
		return $query->result_array();
	}

	function get_educ_level(){
		$this->db->select('*');
		$this->db->from('education_level');
		$this->db->where('level_description !=', "DOCTORAL DEGREE IN ANOTHER FIELD");
		$this->db->where('level_description !=', "MASTER's DEGREE IN ANOTHER FIELD");
		$this->db->order_by('education_level_id','asc');

		$query = $this->db->get();
		
		return $query->result_array();
	}
}