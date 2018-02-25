<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_dashboard_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_employee()
	{
		$user_id = $this->session->userdata('user_id');
		$this->db->select('*');
		$this->db->from('employee_information');
		$this->db->join('employee_type', 'employee_type.employee_type_id = employee_information.employee_type_id','inner');
		$this->db->where('employee_information.employee_id',$user_id);
		$query = $this->db->get();

		return $query->row_array();
	}

	function pending_count($employee_id)
	{
		$this->db->where('employee_id', $employee_id);
        $this->db->where('status', 'Pending');
		$this->db->from('leave');
		return $this->db->count_all_results();
    }

    function pending_medical_count($employee_id)
	{
		$this->db->where('employee_id', $employee_id);
        $this->db->where('status', 'Pending');
		$this->db->from('medical');
		return $this->db->count_all_results();
    }
}