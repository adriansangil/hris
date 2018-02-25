<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_leave_model extends CI_Model {

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
	
	function get_length_of_service($employee_id)
	{
		$query = $this->db->get_where('status',array('employee_id'=>$employee_id,'active'=>'true'));
		$row = $query->row_array();

		$date1 = new DateTime($row['start_date']);
		$date2 = new DateTime(date('M d Y'));
		$interval = $date1->diff($date2);
		$months = ($interval->format('%y') * 12) + $interval->format('%m');
		return $months;
	}

	function get_employee_type($employee_id)
	{
		$this->db->select('*');
		$this->db->from('employee_information');
		$this->db->where('employee_id',$employee_id);
		$query = $this->db->get();
		$result = $query->row_array();
		$type = $result['employee_type_id'];
		return $type;
	}

	 function get_employee_leave_setting($employee_type_id,$employee_status,$service_length,$leave_type)
	{
		$this->db->select('*');
		$this->db->from('base_leave');
		$this->db->join('leave_type', 'leave_type.leave_type_id = base_leave.leave_type_id','inner');
		$this->db->where('base_leave.active','true');
		$this->db->where('employee_type_id',$employee_type_id);
		$this->db->where('employee_status',$employee_status);
		$this->db->where('leave_type.type',$leave_type);
		$this->db->where('min_months <=',$service_length);
		$this->db->where('max_months >',$service_length);
		$query = $this->db->get();

		return $query->row_array();
	}

	function leave_history_count($employee_id)
	{
        $this->db->where('status', 'Approved');
        $this->db->or_where('status', 'Rejected');
        $this->db->where('employee_id', $employee_id);
		$this->db->from('leave');
		return $this->db->count_all_results();
    }

    function get_leave_history($limit, $start,$employee_id)
	{
		$this->db->limit($limit, $start);

		$this->db->select('*');
		$this->db->from('leave');
		$this->db->join('employee_information', 'employee_information.employee_id = leave.employee_id','inner');
		$this->db->join('leave_type', 'leave_type.leave_type_id = leave.leave_type_id','inner');
		$this->db->where('leave.employee_id',$employee_id);
		$this->db->where('leave.status','Approved');
		$this->db->or_where('leave.employee_id',$employee_id);
		$this->db->where('leave.status','Rejected');
		$this->db->order_by('leave.leave_id','desc'); 
		$query = $this->db->get();
		
		return $query->result_array();
	}

	function pending_request_count($employee_id)
	{
        $this->db->where('status', 'Pending');
        $this->db->where('employee_id', $employee_id);
		$this->db->from('leave');
		return $this->db->count_all_results();
    }

    function get_pending_request($limit, $start,$employee_id)
	{
		$this->db->limit($limit, $start);

		$this->db->select('*');
		$this->db->from('leave');
		$this->db->join('employee_information', 'employee_information.employee_id = leave.employee_id','inner');
		$this->db->join('leave_type', 'leave_type.leave_type_id = leave.leave_type_id','inner');
		$this->db->where('leave.employee_id',$employee_id);
		$this->db->where('leave.status','Pending');
		$this->db->order_by('leave.leave_id','desc'); 
		$query = $this->db->get();
		
		return $query->result_array();
	}

	public function get_employee_leave_summary($employee_id)
	{
		$this->db->select('*');
		$this->db->from('leave');
		$this->db->join('employee_information', 'employee_information.employee_id = leave.employee_id','inner');
		$this->db->join('leave_type', 'leave_type.leave_type_id = leave.leave_type_id','inner');
		$this->db->join('base_leave', 'base_leave.base_leave_id = leave.base_leave_id','left');
		$this->db->join('academic_year', 'academic_year.academic_year_id = leave.academic_year_id','inner');
		$this->db->where('academic_year.active','true');
		$this->db->where('leave.status','Approved');
		$this->db->where('employee_information.employee_id',$employee_id);
		//$this->db->where('base_leave.active','true');
		$this->db->order_by('leave.leave_id','asc'); 
		$query = $this->db->get();
		
		return $query->result_array();
	}

	function get_past_employee_leave_summary($employee_id)
	{
		$this->db->select('*');
		$this->db->from('leave');
		$this->db->join('employee_information', 'employee_information.employee_id = leave.employee_id','inner');
		$this->db->join('leave_type', 'leave_type.leave_type_id = leave.leave_type_id','inner');
		$this->db->join('base_leave', 'base_leave.base_leave_id = leave.base_leave_id','left');
		$this->db->join('academic_year', 'academic_year.academic_year_id = leave.academic_year_id','inner');
		$this->db->where('academic_year.active',$this->input->post('search_year_id'));
		$this->db->where('leave.status','Approved');
		//$this->db->where('base_leave.active','true');
		$this->db->where('employee_information.employee_id',$employee_id);
		$this->db->order_by('leave.leave_id','asc'); 
		$query = $this->db->get();
		
		return $query->result_array();
	}

	function get_my_leave_summary($employee_id)
	{
		$this->db->select('*,status.start_date as work_start');
		$this->db->from('employee_information');
		$this->db->join('employee_record', 'employee_record.employee_id = employee_information.employee_id','inner');
		$this->db->join('academic_year', 'academic_year.academic_year_id = employee_record.academic_year_id','inner');
		$this->db->join('employee_type', 'employee_type.employee_type_id = employee_information.employee_type_id','inner');
		$this->db->join('status', 'status.employee_id = employee_information.employee_id','inner');
		$this->db->where('employee_information.employee_id',$employee_id);
		$this->db->where('employee_record.active','true');
		$this->db->where('employee_information.active','true');
		$this->db->where('status.active','true');
		$this->db->where('academic_year.active','true');
		$query = $this->db->get();

		return $query->row_array();
	}

	function get_current_academic_year()
	{
		$this->db->select('*');
		$this->db->from('academic_year');
		$this->db->where('active','true');
		$query = $this->db->get();
		return $query->row_array();
	}

	function get_past_academic_year()
	{
		$this->db->select('*');
		$this->db->from('academic_year');
		$this->db->where('academic_year_id',$this->input->post('search_year_id'));
		$query = $this->db->get();
		return $query->row_array();
	}

	function get_all_academic_year()
	{
		$this->db->select('*');
		$this->db->from('academic_year');
		$this->db->order_by('academic_year_id','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_all_academic_year_employee($employee_id)
	{
		$this->db->select('*');
		$this->db->from('academic_year');
		$this->db->join('employee_record', 'employee_record.academic_year_id = academic_year.academic_year_id','inner');
		$this->db->where('employee_record.employee_id',$employee_id);
		$this->db->order_by('academic_year.academic_year_id','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

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

	function get_past_status($employee_id)
	{
		$this->db->select('*');
		$this->db->from('status');
		$this->db->where('status.active','true');
		$this->db->where('status.employee_id',$employee_id);
		$query = $this->db->get();
		$result = $query->row_array();
		
		$status_start_date =  new DateTime($result['start_date']);
		
		$this->db->select('*');
		$this->db->from('academic_year');
		$this->db->where('academic_year_id',$this->input->post('search_year_id'));
		$query2 = $this->db->get();
		$result2 = $query2->row_array();

		$year_end_date = new DateTime($result2['end_date']);

		if($status_start_date < $year_end_date){
			$status = $result['employee_status'];
		}
		else{
			$status = 'Probationary';
		}
		return $status;
	}

	function get_employee_past_vl_leave_setting($employee_id)
	{
		$this->db->select('*');
		$this->db->from('employee_record');
		$this->db->where('employee_record.employee_id',$employee_id);
		$this->db->where('employee_record.academic_year_id',$this->input->post('search_year_id'));
		$query = $this->db->get();
		$record = $query->row_array();

		$this->db->select('*');
		$this->db->from('base_leave');
		$this->db->where('base_leave_id',$record['vl_base_id']);
		$query = $this->db->get();
		return $query->row_array();
	}

	//get employee's past base sl leave setting
	function get_employee_past_sl_leave_setting($employee_id)
	{
		$this->db->select('*');
		$this->db->from('employee_record');
		$this->db->where('employee_record.employee_id',$employee_id);
		$this->db->where('employee_record.academic_year_id',$this->input->post('search_year_id'));
		$query = $this->db->get();
		$record = $query->row_array();

		$this->db->select('*');
		$this->db->from('base_leave');
		$this->db->where('base_leave_id',$record['sl_base_id']);
		$query = $this->db->get();
		return $query->row_array();
	}

	function check_duration()
	{
		$date1 = strtotime($this->input->post('start_date'));
		$date2 = strtotime($this->input->post('end_date'));
		$dateDiff = $date2 - $date1;
		$duration = floor($dateDiff/(60*60*24));
		return $duration;
	}

	function check_on_holiday()
	{
		$date1 = new DateTime($this->input->post('start_date'));
		$date2 = new DateTime($this->input->post('end_date'));
		$dayminus = 0;
		$current_year = date('Y');

		$datequery = "SELECT DISTINCT EXTRACT(month FROM holiday.date)||'-'|| EXTRACT(day FROM holiday.date) as holidate, holiday_type.description  from holiday, holiday_type
where holiday.holiday_type_id = holiday_type.holiday_type_id";
		$query = $this->db->query($datequery);
		$result = $query->result_array();

		foreach ($result as $date):
			$holiday = new DateTime($current_year.'-'.$date['holidate']);
			$holiday_type = $date['description'];
			if($date1 <= $holiday && $date2 >= $holiday && ($holiday_type == 'Regular' || $holiday_type == 'Non-working'))
			{
				$dayminus = $dayminus + 1;
			}
		endforeach;

		return $dayminus;
	}

	function get_leave_types()
	{
		$query = $this->db->get_where('leave_type',array('active'=> 'true'));
		return $query->result_array();
	}

	function apply_leave($duration)
	{
		$ltype_id = $this->input->post('leavetype');
		$query = $this->db->get_where('leave_type',array('leave_type_id'=> $ltype_id));
		$ltype = $query->row_array();

		$etype_id = $this->input->post('employee_type_id');
		$status_id = $this->input->post('employee_status_id');
		$service_length = $this->input->post('length_of_service');

		if($ltype['type']=='Sick'){
			$sl_setting = $this->get_employee_leave_setting($etype_id,$status_id,$service_length,$ltype['type']);
			$base_leave_id = $sl_setting['base_leave_id'];
		}
		elseif($ltype['type']=='Vacation'){
			$vl_setting = $this->get_employee_leave_setting($etype_id,$status_id,$service_length,$ltype['type']);
			$base_leave_id = $vl_setting['base_leave_id'];
		}
		else{
			$base_leave_id = NULL;
		}

		$data = array(
		'leave_type_id' => $this->input->post('leavetype'),
		'leave_start_date' => $this->input->post('start_date'),
		'leave_end_date' => $this->input->post('end_date'),
		'date_submitted' => $this->input->post('date_submitted'),
		'status' => $this->input->post('status'),
		'remarks' => $this->input->post('reason'),
		'employee_id' => $this->input->post('employee_id'),
		'duration' => $duration,
		'base_leave_id' => $base_leave_id,
		'academic_year_id' => $this->input->post('year_id')
		);
	
	return $this->db->insert('leave', $data);
	}

	function delete_request($id){

		$this->db->trans_start();

		$this->db->select('status');
		$this->db->from('leave');
		$this->db->where('leave.leave_id',$id);
		$query = $this->db->get();
		$record = $query->row_array();

		if($record['status'] == 'Pending'){

			$this->db->delete('leave', array('leave_id' => $id));
			$delete_status = 'success'; 

			$this->db->trans_complete();

			return $delete_status;
		}
		else{
			$delete_status = 'failed';
			return $delete_status;
		}
	}

	function clear_notification($id){
		$this->db->trans_start();

		$data = array(
			'notification' => 0);

		$this->db->update('leave',$data, array('employee_id' => $id,'status !='=> 'Pending'));

		$this->db->trans_complete();
	}
}