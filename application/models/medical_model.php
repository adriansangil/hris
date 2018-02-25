<?php
class Medical_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	//medical request count
	function approved_medical_count()
	{
        $this->db->where('status', 'Approved');
		$this->db->from('medical');
		return $this->db->count_all_results();
    }

    function pending_medical_count()
	{
        $this->db->where('status', 'Pending');
		$this->db->from('medical');
		return $this->db->count_all_results();
    }

    function rejected_medical_count()
	{
        $this->db->where('status', 'Rejected');
		$this->db->from('medical');
		return $this->db->count_all_results();
    }

    //get employee medical request
	function get_approved_medical_request($limit,$start)
	{
		$this->db->limit($limit, $start);

		$this->db->select('*');
		$this->db->from('medical');
		$this->db->join('employee_information', 'employee_information.employee_id = medical.employee_id','inner');
		$this->db->where('medical.status','Approved');
		$this->db->where('employee_information.active','true');
		$this->db->order_by('medical.medical_id','desc'); 
		$query = $this->db->get();

		return $query->result_array();
	}

	function get_rejected_medical_request($limit,$start)
	{
		$this->db->limit($limit, $start);

		$this->db->select('*');
		$this->db->from('medical');
		$this->db->join('employee_information', 'employee_information.employee_id = medical.employee_id','inner');
		$this->db->where('medical.status','Rejected');
		$this->db->where('employee_information.active','true');
		$this->db->order_by('medical.medical_id','desc'); 
		$query = $this->db->get();

		return $query->result_array();
	}

	function get_pending_medical_request($limit,$start)
	{
		$this->db->limit($limit, $start);

		$this->db->select('*');
		$this->db->from('medical');
		$this->db->join('employee_information', 'employee_information.employee_id = medical.employee_id','inner');
		$this->db->join('base_benefit', 'base_benefit.base_benefit_id = medical.base_benefit_id','inner');
		$this->db->join('employee_medical_record', 'employee_medical_record.employee_id = medical.employee_id','inner');
		$this->db->where('medical.status','Pending');
		$this->db->where('employee_information.active','true');
		$this->db->where('employee_medical_record.year_id = medical.year_id');
		$this->db->order_by('medical.medical_id','desc'); 
		$query = $this->db->get();

		return $query->result_array();
	}
	// employee information----------------------------
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
		$this->db->where('employee_information.employee_id',$employee_id);
		$this->db->where('employee_information.active','true');
		$this->db->where('status.active','true');
		$query = $this->db->get();
		
		return $query->row_array();
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

	//end of employee information-----------------------------

	//base medical settings-----------------------------------
	function get_medical_settings_staff()
	{
		$this->db->select('*');
		$this->db->from('base_benefit');
		$this->db->join('employee_type', 'base_benefit.employee_type_id = employee_type.employee_type_id','inner');
		$this->db->where('employee_type.employee_type','Staff');
		$this->db->where('base_benefit.employee_status !=','Probationary');
		$this->db->where('base_benefit.active','true');
		$this->db->order_by('employee_status'); 
		$this->db->order_by('min_months'); 
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_medical_settings_faculty()
	{
		$this->db->select('*');
		$this->db->from('base_benefit');
		$this->db->join('employee_type', 'base_benefit.employee_type_id = employee_type.employee_type_id','inner');
		$this->db->where('employee_type.employee_type','Faculty');
		$this->db->where('base_benefit.employee_status !=','Probationary');
		$this->db->where('base_benefit.active','true');
		$this->db->order_by('employee_status'); 
		$this->db->order_by('min_months'); 
		$query = $this->db->get();
		return $query->result_array();
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
	//end of medical settings-------------------------------

	//individual employee medical summary
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
	//end of employee medical summary----------------------------------

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
		$this->db->select('*');
		$this->db->from('year');
		$this->db->where('year_id',$this->input->post('search_year_id'));
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

	//get base benefit
	function get_base_benefit()
	{
		$this->db->select('*');
		$this->db->from('base_benefit');
		$this->db->where('active','true');
		$query = $this->db->get();

		return $query->result_array();
	}

	//get medical summary (for the summary page)
	function get_medical_summary()
	{
		$this->db->select('*,status.start_date as work_start');
		$this->db->from('employee_information');
		$this->db->join('employee_medical_record', 'employee_medical_record.employee_id = employee_information.employee_id','inner');
		$this->db->join('year', 'year.year_id = employee_medical_record.year_id','inner');
		$this->db->join('employee_type', 'employee_type.employee_type_id = employee_information.employee_type_id','inner');
		$this->db->join('status', 'status.employee_id = employee_information.employee_id','inner');
		$this->db->where('employee_medical_record.active','true');
		$this->db->where('employee_information.active','true');
		$this->db->where('status.employee_status','Regular');
		$this->db->where('status.active','true');
		$this->db->where('year.active','true');
		$this->db->order_by('employee_information.first_name','asc'); 
		$query = $this->db->get();

		return $query->result_array();
	}

	function get_search_year_summary()
	{
		$search_year = $this->input->post('search_year_id');

		$this->db->select('*');
		$this->db->from('employee_information');
		$this->db->join('employee_medical_record', 'employee_medical_record.employee_id = employee_information.employee_id','inner');
		$this->db->join('year', 'year.year_id = employee_medical_record.year_id','inner');
		$this->db->join('employee_type', 'employee_type.employee_type_id = employee_medical_record.employee_type_id','inner');
		$this->db->join('status', 'status.status_id = employee_medical_record.status_id','inner');
		$this->db->where('employee_medical_record.year_id',$search_year);
		$this->db->where('status.employee_status','Regular');
		$this->db->where('employee_information.active','true');
		$this->db->where('year.year_id',$search_year);
		$this->db->order_by('employee_information.first_name','asc'); 
		$query = $this->db->get();

		return $query->result_array();
	}	

	//add medical assistance
	/*
	function add_assistance($amount)
	{
		$emp_id = $this->input->post('employee_id');
		$year_id = $this->input->post('year_id');

		$data = array(
		'date_submitted' => $this->input->post('date_submitted'),
		'amount' => $amount,
		'date_decided' => $this->input->post('date_submitted'),
		'status' => $this->input->post('status'),
		'employee_id' => $emp_id,
		'remarks' => $this->input->post('reason'),
		'base_benefit_id' => $this->input->post('base_benefit_id'),
		'year_id' => $year_id
		);

		$this->db->insert('medical', $data);

		$medical_record = $this->get_employee_medical_record($emp_id);

		$new_amount = $medical_record['benefit_consumed'] + $this->input->post('amount');

		$data2 = array(
			'benefit_consumed' => $new_amount
		);

		$this->db->update('employee_medical_record',$data2, array('employee_id' => $emp_id, 'year_id' => $year_id));
	}
	*/

	function get_employee_medical_record($id)
	{
		$this->db->select('*');
		$this->db->from('employee_medical_record');
		$this->db->where('employee_id',$id);
		$this->db->where('active','true');
		$query = $this->db->get();

		return $query->row_array();
	}

	function assign_benefit_consumed()
	{
		$medical_id = $this->input->post('medical_id');

		$this->db->select('status');
		$this->db->from('medical');	
		$this->db->where('medical.medical_id',$medical_id);
		$query = $this->db->get();

		$record = $query->row_array();

		if(count($record) < 1){
			$update = 'deleted';
			return $update;
		}

		$this->db->trans_start();

		if($this->input->post('decision') == 'Approved')
		{
			$emp_id = $this->input->post('employee_id');
			$year_id = $this->input->post('year_id');
			$amount = $this->input->post('amount');

			$medical_record = $this->get_employee_medical_record($emp_id);

			$new_amount = $medical_record['benefit_consumed'] + $amount;

			$data = array(
			'benefit_consumed' => $new_amount
			);

			$this->db->update('employee_medical_record',$data, array('employee_id' => $emp_id, 'year_id' => $year_id));
		}

		$id = $this->input->post('medical_id');
		
		$data2 = array(
		'remarks' => $this->input->post('notes'),
		'status' => $this->input->post('decision'),
		'date_decided' => $this->input->post('date_decided'),
		);

		$data3 = array(
			'status' => $this->input->post('decision')
			);

		$this->db->update('medical_receipt',$data3, "medical_id = $id");
		$this->db->update('medical',$data2, "medical_id = $id");

		$this->db->trans_complete();

		$update = $this->input->post('decision');

		return $update;
	}

	//edit base medical
	function edit_base_medical()
	{
		$base_id = $this->input->post('base_id');
		$max_benefit = $this->input->post('max_benefit');
		$status = $this->input->post('status');
		$denied ='denied';
		$accepted = 'accepted';
		$probationary = 'Probationary';

		if($status =='Probationary'){

			$this->db->select('*');
			$this->db->from('base_benefit');
			$this->db->where('base_benefit.base_benefit_id',$base_id);
			$this->db->where('base_benefit.active','true');
			$query = $this->db->get();
			$result = $query->row_array();

			$p_max = $result['max_months'];
			$p_min = $result['min_months'];
			$p_etype = $result['employee_type_id'];

			$active = array('active' => 'false');

			$this->db->update('base_benefit',$active, "base_benefit_id = $base_id"); //old Probationary bracket setting set to false

			$data = array(
				'max_benefit' => $max_benefit,
				'min_months' => $p_min,
				'max_months' => $p_max,
				'employee_type_id' => $p_etype,
				'employee_status' => $probationary,
				'max_convertible' => 0
				);

			$this->db->insert('base_benefit', $data); // new Probationary bracket setting

			return $accepted;
		}
		else{
			$min_month = $this->input->post('min_month');
			$max_month = $this->input->post('max_month');

			$this->db->select('*');
			$this->db->from('base_benefit');
			$this->db->where('base_benefit.base_benefit_id',$base_id);
			$this->db->where('base_benefit.employee_status !=',$probationary);
			$this->db->where('base_benefit.active','true');
			$query = $this->db->get();
			$result = $query->row_array();

			//check if min is equal to zero
			if($result['min_months'] == 0){
				if($min_month != $result['min_months'])
				{
					return $denied;
				}

				if($max_month <= $result['min_months']){
					return $denied;
				}

				$max = $result['max_months'];
				$etype = $result['employee_type_id'];
				$status = $result['employee_status'];

				//check next bracket min range
				$this->db->select('*');
				$this->db->from('base_benefit');
				$this->db->where('base_benefit.min_months',$max);
				$this->db->where('base_benefit.employee_type_id',$etype);
				$this->db->where('base_benefit.employee_status !=',$probationary);
				$this->db->where('base_benefit.active','true');
				$query = $this->db->get();
				$result2 = $query->row_array();

				if($max_month >= $result2['max_months']){
					return $denied;
				}

				$base_id2 = $result2['base_benefit_id'];

				//data for updating previous base_leave to false
				$active = array( 'active' => 'false');

				$data = array(
					'max_benefit' => $max_benefit,
					'min_months' => 0,
					'max_months' => $max_month,
					'employee_type_id' => $etype,
					'employee_status' => $status,
					'max_convertible' => 0
					);

				$max2 = $result2['max_months'];
				$max_benefit2 = $result2['max_benefit'];
				$etype2 = $result2['employee_type_id'];
				$status2 = $result2['employee_status'];

				$data2 = array(
					'min_months' => $max_month, // max from previous bracket
					'max_benefit' => $max_benefit2,
					'max_months' => $max2,
					'employee_type_id' => $etype2,
					'employee_status' => $status2,
					'max_convertible' => 0
					);

				$this->db->trans_start();

				$this->db->update('base_benefit',$active, "base_benefit_id = $base_id"); //old current bracket setting set to false
				$this->db->update('base_benefit',$active, "base_benefit_id = $base_id2"); //old next bracket setting set to false
				//insert new base settings
				$this->db->insert('base_benefit', $data); //new current bracket setting
				$this->db->insert('base_benefit', $data2); // new next bracket setting

				$this->db->trans_complete();

				return $accepted;
			}

			//check if max is equal to max value
			if($result['max_months'] == 999){

				if($max_month != $result['max_months'])
				{
					return $denied;
				}

				if($min_month >= $result['max_months']){
					return $denied;
				}

				$min = $result['min_months'];
				$etype = $result['employee_type_id'];
				$status = $result['employee_status'];

				//check previous bracket max range
				$this->db->select('*');
				$this->db->from('base_benefit');
				$this->db->where('base_benefit.max_months',$min);
				$this->db->where('base_benefit.employee_type_id',$etype);
				$this->db->where('base_benefit.employee_status !=',$probationary);
				$this->db->where('base_benefit.active','true');
				$query = $this->db->get();
				$result2 = $query->row_array();

				if($min_month <= $result2['min_months']){
					return $denied;
				}

				$base_id2 = $result2['base_benefit_id'];

				//data for updating previous base_leave to false
				$active = array( 'active' => 'false');

				$data = array(
					'max_benefit' => $max_benefit,
					'max_months' => 999,
					'min_months' => $min_month,
					'employee_type_id' => $etype,
					'employee_status' => $status,
					'max_convertible' => 0
					);

				$min2 = $result2['min_months'];
				$max_benefit2 = $result2['max_benefit'];
				$etype2 = $result2['employee_type_id'];
				$status2 = $result2['employee_status'];

				$data2 = array(
					'max_months' => $min_month, //min from next bracket
					'max_benefit' => $max_benefit2,
					'min_months' => $min2,
					'employee_type_id' => $etype2,
					'employee_status' => $status2,
					'max_convertible' => 0
					);

				$this->db->trans_start();

				$this->db->update('base_benefit',$active, "base_benefit_id = $base_id"); //old current bracket setting set to false
				$this->db->update('base_benefit',$active, "base_benefit_id = $base_id2"); //old previous bracket setting set to false
				//insert new base settings
				$this->db->insert('base_benefit', $data); //new current bracket setting
				$this->db->insert('base_benefit', $data2); // new next bracket setting

				$this->db->trans_complete();

				return $accepted;
			}

			//else in between brackets
			if($max_month <= $result['min_months']){
				return $denied;
			}

			if($min_month >= $result['max_months']){
				return $denied;
			}

			
			$max = $result['max_months'];
			//data for current bracket
			$etype = $result['employee_type_id'];
			$status = $result['employee_status'];

			//check next bracket min range
			$this->db->select('*');
			$this->db->from('base_benefit');
			$this->db->where('base_benefit.min_months',$max);
			$this->db->where('base_benefit.employee_type_id',$etype);
			$this->db->where('base_benefit.employee_status !=',$probationary);
			$this->db->where('base_benefit.active','true');
			$query = $this->db->get();
			$result2 = $query->row_array();

			if($max_month >= $result2['max_months']){
				return $denied;
			}

			$base_id2 = $result2['base_benefit_id'];

			$min = $result['min_months'];

			//check previous bracket max range
			$this->db->select('*');
			$this->db->from('base_benefit');
			$this->db->where('base_benefit.max_months',$min);
			$this->db->where('base_benefit.employee_type_id',$etype);
			$this->db->where('base_benefit.employee_status !=',$probationary);
			$this->db->where('base_benefit.active','true');
			$query = $this->db->get();
			$result3 = $query->row_array();

			if($min_month <= $result3['min_months']){
				return $denied;
			}

			$base_id3 = $result3['base_benefit_id'];

			//current bracket
			$data = array(
				'max_benefit' => $max_benefit,
				'max_months' => $max_month,
				'min_months' => $min_month,
				'employee_type_id' => $etype,
				'employee_status' => $status,
				'max_convertible' => 0
				);

			//data for next bracket
			$next_max = $result2['max_months'];
			$max_benefit2 = $result2['max_benefit'];
			$etype2 = $result2['employee_type_id'];
			$status2 = $result2['employee_status'];

			//next bracket
			$data2 = array(
				'max_benefit' => $max_benefit2,
				'max_months' => $next_max,
				'min_months' => $max_month,
				'employee_type_id' => $etype2,
				'employee_status' => $status2,
				'max_convertible' => 0
				);

			//data for previous bracket
			$prev_min = $result3['min_months'];
			$max_benefit3 = $result3['max_benefit'];
			$etype3 = $result3['employee_type_id'];
			$status3 = $result3['employee_status'];
			//previous bracket
			$data3 = array(
				'max_benefit' => $max_benefit3,
				'max_months' => $min_month,
				'min_months' => $prev_min,
				'employee_type_id' => $etype3,
				'employee_status' => $status3,
				'max_convertible' => 0
				);

			$active = array('active' => 'false');

			$this->db->trans_start();

			$this->db->update('base_benefit',$active, "base_benefit_id = $base_id"); //old current bracket setting set to false
			$this->db->update('base_benefit',$active, "base_benefit_id = $base_id2"); //old next bracket setting set to false
			$this->db->update('base_benefit',$active, "base_benefit_id = $base_id3"); //old previous bracket setting set to false
			//insert new base settings
			$this->db->insert('base_benefit', $data); //new current bracket setting
			$this->db->insert('base_benefit', $data2); // new next bracket setting
			$this->db->insert('base_benefit', $data3); // new previous bracket setting

			$this->db->trans_complete();

			return $accepted;
		}
	}

	function get_receipt($status)
	{
		$this->db->select('*');
		$this->db->from('medical_receipt');
		$this->db->where('medical_receipt.status',$status);
		$query = $this->db->get();
		
		return $query->result_array();
	}
}