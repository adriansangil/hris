<?php
class my_ranking_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
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

	//get highest educ attained
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

	//employee work summary
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

	function get_staff_rank_reference()
	{
		$this->db->select('*');
		$this->db->from('staff_rank_classification');
		$this->db->join('staff_job_grade', 'staff_job_grade.staff_job_grade_id = staff_rank_classification.staff_job_grade_id','inner');
		$this->db->join('level', 'level.level_id = staff_rank_classification.level_id','left');
		$this->db->order_by('staff_rank_classification.staff_rank_classification_id');
		$this->db->where('staff_rank_classification.min_point_range IS NOT NULL', null);
		$this->db->where('staff_rank_classification.max_point_range IS NOT NULL', null);
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

	function get_lowest_staff_rank()
	{
		$this->db->select('*');
		$this->db->from('staff_rank_classification');
		$this->db->join('staff_job_grade', 'staff_job_grade.staff_job_grade_id = staff_rank_classification.staff_job_grade_id','inner');
		$this->db->join('level', 'level.level_id = staff_rank_classification.level_id','left');
		$this->db->where('staff_job_grade.job_description','Skilled');
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

	function get_ranking_history($employee_id){
		$this->db->select('*');
		$this->db->from('rank');
		$this->db->join('rank_date', 'rank_date.rank_date_id = rank.rank_date_id','inner');
		$this->db->where('employee_id', $employee_id);
		$this->db->order_by('rank_date.rank_date_id','desc');

		$query = $this->db->get();
		
		return $query->result_array();	
	}
}