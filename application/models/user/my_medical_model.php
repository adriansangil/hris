<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_medical_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
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

	function get_past_length_of_service($employee_id,$status)
	{
		$search_year = $this->input->post('search_year_id');

		$query = $this->db->get_where('status',array('employee_id'=>$employee_id,'employee_status'=> $status));
		$row = $query->row_array();

		$query2 = $this->db->get_where('school_year',array('school_year_id'=>$search_year));
		$row2 = $query2->row_array();

		if($row2['active'] == true){
			$date2 = new DateTime(date('M d Y'));	
		}
		else{
			$date2 = new DateTime($row2['end_date']);
		}

		$date1 = new DateTime($row['start_date']);
		
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

	 //individual employee medical settings
	function get_employee_medical_setting($employee_type_id,$employee_status,$service_length)
	{
		$this->db->select('*');
		$this->db->from('base_benefit');
		$this->db->where('employee_type_id',$employee_type_id);
		$this->db->where('employee_status',$employee_status);
		$this->db->where('base_benefit.active','true');
		$this->db->where('min_months <=',$service_length);
		$this->db->where('max_months >',$service_length);
		$query = $this->db->get();

		return $query->row_array();
	}


	function medical_history_count($employee_id)
	{
        $this->db->where('status', 'Approved');
        $this->db->or_where('status', 'Rejected');
        $this->db->where('employee_id', $employee_id);
		$this->db->from('medical');
		return $this->db->count_all_results();
    }

	function get_employee_medical_summary($employee_id)
	{		
		$this->db->select('*');
		$this->db->from('medical');
		$this->db->join('employee_information', 'employee_information.employee_id = medical.employee_id','inner');
		$this->db->join('base_benefit', 'base_benefit.base_benefit_id = medical.base_benefit_id','left');
		$this->db->join('year', 'year.year_id = medical.year_id','inner');
		$this->db->where('year.active','true');
		$this->db->where('medical.status','Approved');
		$this->db->where('employee_information.employee_id',$employee_id);
		//$this->db->where('base_leave.active','true');
		$this->db->order_by('medical.medical_id','asc'); 
		$query = $this->db->get();
		$result = $query->result_array();

		return $result;
	}

	function get_past_employee_medical_summary($employee_id)
	{
		$this->db->select('*');
		$this->db->from('medical');
		$this->db->join('employee_information', 'employee_information.employee_id = medical.employee_id','inner');
		$this->db->join('base_benefit', 'base_benefit.base_benefit_id = medical.base_benefit_id','left');
		$this->db->join('year', 'year.year_id = medical.year_id','inner');
		$this->db->where('year.year_id',$this->input->post('search_year_id'));
		$this->db->where('medical.status','Approved');
		//$this->db->where('base_leave.active','true');
		$this->db->where('employee_information.employee_id',$employee_id);
		$this->db->order_by('medical.medical_id','asc'); 
		$query = $this->db->get();
		
		return $query->result_array();
	}

	function get_my_medical_summary($employee_id)
	{
		$this->db->select('*,status.start_date as work_start');
		$this->db->from('employee_information');
		$this->db->join('employee_medical_record', 'employee_medical_record.employee_id = employee_information.employee_id','inner');
		$this->db->join('year', 'year.year_id = employee_medical_record.year_id','inner');
		$this->db->join('employee_type', 'employee_type.employee_type_id = employee_information.employee_type_id','inner');
		$this->db->join('status', 'status.employee_id = employee_information.employee_id','inner');
		$this->db->where('employee_information.employee_id',$employee_id);
		$this->db->where('employee_medical_record.active','true');
		$this->db->where('employee_information.active','true');
		$this->db->where('status.active','true');
		$this->db->where('year.active','true');
		$query = $this->db->get();

		return $query->row_array();
	}

	//year settings
	function get_current_year()
	{
		$this->db->select('*');
		$this->db->from('year');
		$this->db->where('active','true');
		$query = $this->db->get();
		return $query->row_array();
	}

	function get_past_year()
	{
		$year = $this->input->post('search_year_id');
		$this->db->select('*');
		$this->db->from('year');
		$this->db->where('year_id',$year);
		$query = $this->db->get();
		return $query->row_array();
	}

	function get_all_year()
	{
		$this->db->select('*');
		$this->db->from('year');
		$this->db->order_by('year_id','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_all_year_employee($employee_id)
	{
		$this->db->select('*');
		$this->db->from('year');
		$this->db->join('employee_medical_record', 'employee_medical_record.year_id = year.year_id','inner');
		$this->db->where('employee_medical_record.employee_id',$employee_id);
		$this->db->order_by('year.year_id','desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	//end of year queries------------------------

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
		$this->db->from('school_year');
		$this->db->where('school_year_id',$this->input->post('search_year_id'));
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

	function get_employee_past_medical_setting($employee_id)
	{
		$this->db->select('*');
		$this->db->from('employee_medical_record');
		$this->db->where('employee_medical_record.employee_id',$employee_id);
		$this->db->where('employee_medical_record.year_id',$this->input->post('search_year_id'));
		$query = $this->db->get();
		$record = $query->row_array();

		$this->db->select('*');
		$this->db->from('base_benefit');
		$this->db->where('base_benefit_id',$record['base_benefit_id']);
		$query = $this->db->get();
		return $query->row_array();
	}

	function apply_medical_assistance($user_id,$amount)
	{
		$this->db->trans_start();

		$year_id = $this->input->post('year_id');

		$data = array(
		'date_submitted' => $this->input->post('date_submitted'),
		'amount' => $amount,
		'status' => $this->input->post('status'),
		'employee_id' => $user_id,
		'remarks' => $this->input->post('reason'),
		'base_benefit_id' => $this->input->post('base_benefit_id'),
		'year_id' => $year_id
		);

		$this->db->insert('medical', $data);

		//get id of last inserted row
		$id = $this->db->insert_id();

		$amount_used = $this->input->post('amount');
		$or_date = $this->input->post('receipt_date');
		$or_number = $this->input->post('receipt_number');

		$length = count($amount_used);

		for($x=0;$x<$length;$x++){
			$data = array(
				'receipt_amount' => $amount_used[$x],
				'receipt_date' => $or_date[$x],
				'receipt_number' => $or_number[$x],
				'medical_id' => $id
			);
			$this->db->insert('medical_receipt', $data);
		}

		$this->db->trans_complete();

	}

	function get_pending_medical($user_id){
		$this->db->select('*');
		$this->db->from('medical');
		$this->db->join('employee_information', 'employee_information.employee_id = medical.employee_id','inner');
		$this->db->where('medical.status','Pending');
		$this->db->where('employee_information.employee_id',$user_id);
		$this->db->order_by('medical.medical_id','desc'); 
		$query = $this->db->get();

		return $query->result_array();
	}

	function pending_medical_count($employee_id)
	{
        $this->db->where('status', 'Pending');
        $this->db->where('employee_id', $employee_id);
		$this->db->from('medical');
		return $this->db->count_all_results();
    }

    function get_pending_medical_request($limit, $start,$employee_id)
	{
		$this->db->limit($limit, $start);

		$this->db->select('*');
		$this->db->from('medical');
		$this->db->join('employee_information', 'employee_information.employee_id = medical.employee_id','inner');
		$this->db->where('medical.employee_id',$employee_id);
		$this->db->where('medical.status','Pending');
		$this->db->order_by('medical.date_submitted','desc'); 
		$query = $this->db->get();
		
		return $query->result_array();
	}

	function get_medical_history($limit, $start,$employee_id)
	{
		$this->db->limit($limit, $start);

		$this->db->select('*');
		$this->db->from('medical');
		$this->db->join('employee_information', 'employee_information.employee_id = medical.employee_id','inner');
		$this->db->where('medical.employee_id',$employee_id);
		$this->db->where('medical.status','Approved');
		$this->db->or_where('medical.employee_id',$employee_id);
		$this->db->where('medical.status','Rejected');
		$this->db->order_by('medical.date_submitted','desc'); 
		$query = $this->db->get();
		
		return $query->result_array();
	}

	function get_receipt($status)
	{
		$this->db->select('*');
		$this->db->from('medical_receipt');
		$this->db->where('medical_receipt.status',$status);
		$query = $this->db->get();
		
		return $query->result_array();
	}


	function get_receipt_history($status)
	{
		$this->db->select('*');
		$this->db->from('medical_receipt');
		$this->db->where('medical_receipt.status !=',$status);
		$query = $this->db->get();
		
		return $query->result_array();
	}

	function delete_request($id){

		$this->db->trans_start();

		$this->db->select('status');
		$this->db->from('medical');
		$this->db->where('medical.medical_id',$id);
		$query = $this->db->get();
		$record = $query->row_array();

		if($record['status'] == 'Pending'){

			$this->db->delete('medical', array('medical_id' => $id));
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

		$this->db->update('medical',$data, array('employee_id' => $id,'status !='=> 'Pending'));

		$this->db->trans_complete();
	}
}