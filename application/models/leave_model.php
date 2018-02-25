<?php
class Leave_model extends CI_Model {

	public function __construct()
	{
	}
	
	function pending_count()
	{
        $this->db->where('status', 'Pending');
		$this->db->from('leave');
		return $this->db->count_all_results();
    }

	public function get_pending_leave_request($limit,$start)
	{
		$this->db->limit($limit, $start);

		$this->db->select('*');
		$this->db->from('leave');
		$this->db->join('employee_information', 'employee_information.employee_id = leave.employee_id','inner');
		$this->db->join('leave_type', 'leave_type.leave_type_id = leave.leave_type_id','inner');
		$this->db->where('leave.status','Pending');
		$this->db->where('employee_information.active','true');
		$this->db->order_by('leave.leave_id','desc'); 
		$query = $this->db->get();
		
		return $query->result_array();
	}

	function approved_count()
	{
        $this->db->where('status', 'Approved');
		$this->db->from('leave');
		return $this->db->count_all_results();
    }

	public function get_approved_leave_request($limit,$start)
	{
		$this->db->limit($limit, $start);

		$this->db->select('*');
		$this->db->from('leave');
		$this->db->join('employee_information', 'employee_information.employee_id = leave.employee_id','inner');
		$this->db->join('leave_type', 'leave_type.leave_type_id = leave.leave_type_id','inner');
		$this->db->where('leave.status','Approved');
		$this->db->where('employee_information.active','true');
		$this->db->order_by('leave.leave_id','desc'); 
		$query = $this->db->get();

		return $query->result_array();
	}

	function rejected_count()
	{
        $this->db->where('status', 'Rejected');
		$this->db->from('leave');
		return $this->db->count_all_results();
    }
		
	public function get_rejected_leave_request($limit,$start)
	{
		$this->db->limit($limit, $start);

		$this->db->select('*');
		$this->db->from('leave');
		$this->db->join('employee_information', 'employee_information.employee_id = leave.employee_id','inner');
		$this->db->join('leave_type', 'leave_type.leave_type_id = leave.leave_type_id','inner');
		$this->db->where('leave.status','Rejected');
		$this->db->where('employee_information.active','true');
		$this->db->order_by('leave.leave_id','desc'); 
		$query = $this->db->get();

		return $query->result_array();
	}
	
	function assign_leave_duration()
	{
		$leave_id = $this->input->post('leave_id');

		$this->db->select('status');
		$this->db->from('leave');	
		$this->db->where('leave.leave_id',$leave_id);
		$query = $this->db->get();

		$record = $query->row_array();

		if(count($record) < 1){
			$update = 'deleted';
			return $update;
		}

		$this->db->trans_start();

		if($this->input->post('decision') == 'Approved')
		{
			$duration = $this->input->post('duration');
			$id = $this->input->post('employee_id');
			$leave_type = $this->input->post('leave_type');
			$base_leave_id = $this->input->post('base_leave_id');
			$academic_year_id = $this->input->post('academic_year_id');

			$leave_record = $this->get_employee_leave_record($id);

			if($base_leave_id != null){
			$base_leave = $this->get_base_leave($base_leave_id);
			}

			if($leave_type == 'Vacation')
			{
				if($leave_record['vl'] > $base_leave['max_leave'])
				{
					$leave = $leave_record['vl'];
					$lwop = $leave_record['vl_lwop']+$duration;
				}
				elseif($leave_record['vl']+$duration > $base_leave['max_leave'])
				{
					$leave = $base_leave['max_leave'];
					$lwop = $leave_record['vl_lwop']+$leave_record['vl']+$duration - $base_leave['max_leave'];
				}
				else
				{
					$leave = $leave_record['vl']+$duration;
					$lwop = $leave_record['vl_lwop'];
				}

				$data = array(
					'vl' => $leave,
					'vl_lwop' => $lwop,
					);

				$this->db->update('employee_record',$data, array('employee_id' => $id,'academic_year_id' => $academic_year_id));
			}

			elseif($leave_type == 'Sick')
			{
				if($leave_record['sl']+$duration > $base_leave['max_leave'])
				{
					$leave = $base_leave['max_leave'];
					$lwop = $leave_record['sl_lwop']+$leave_record['sl']+$duration - $base_leave['max_leave'];
				}
				elseif($leave_record['sl']+$duration > $base_leave['max_leave'])
				{
					$leave = $base_leave['max_leave'];
					$lwop = $leave_record['sl_lwop']+$leave_record['sl']+$duration - $base_leave['max_leave'];
				}
				else
				{
					$leave = $leave_record['sl']+$duration;
					$lwop = $leave_record['sl_lwop'];
				}

				$data = array(
					'sl' => $leave,
					'sl_lwop' => $lwop,
					);

				$this->db->update('employee_record',$data, array('employee_id' => $id,'academic_year_id' => $academic_year_id));
			}

			else
			{
				$others = $duration + $leave_record['others'];
				$data = array(
					'others' => $others
					);
				$this->db->update('employee_record',$data, array('employee_id' => $id,'academic_year_id' => $academic_year_id));
			}
		}

		$leave_id = $this->input->post('leave_id');
		
		$data2 = array(
		'remarks' => $this->input->post('notes'),
		'status' => $this->input->post('decision'),
		'date_decided' => $this->input->post('date_decided'),
		);
		
		$this->db->update('leave',$data2, "leave_id = $leave_id");

		$this->db->trans_complete();

		$update = $this->input->post('decision');

		return $update;
	}

	function get_employee_leave_record($id)
	{
		$this->db->select('*');
		$this->db->from('employee_record');
		$this->db->where('employee_id',$id);
		$this->db->where('active','true');
		$query = $this->db->get();

		return $query->row_array();
	}
	//base leave functions------------------------------------------
	//select specific base leave setting by id
	function get_base_leave($base_leave_id)
	{
		$this->db->select('*');
		$this->db->from('base_leave');
		$this->db->where('base_leave_id',$base_leave_id);
		$this->db->where('active','true');
		$query = $this->db->get();

		return $query->row_array();
	}

	function get_base_leave_sick()
	{
		$this->db->select('*');
		$this->db->from('base_leave');
		$this->db->join('leave_type','leave_type.leave_type_id = base_leave.leave_type_id','inner');
		$this->db->where('leave_type.type','Sick');
		$this->db->where('base_leave.active','true');
		$query = $this->db->get();

		return $query->result_array();
	}

	function get_base_leave_vacation()
	{
		$this->db->select('*');
		$this->db->from('base_leave');
		$this->db->join('leave_type','leave_type.leave_type_id = base_leave.leave_type_id','inner');
		$this->db->where('leave_type.type','Vacation');
		$this->db->where('base_leave.active','true');
		$query = $this->db->get();

		return $query->result_array();
	}

	//select all base leave setting
	function get_all_base_leave()
	{
		$this->db->select('*');
		$this->db->from('base_leave');
		$this->db->where('active','true');
		$query = $this->db->get();

		return $query->result_array();
	}
	
	// base leave
	public function get_vacation_leave_settings_staff()
	{
		$this->db->select('*');
		$this->db->from('base_leave');
		$this->db->join('leave_type', 'base_leave.leave_type_id = leave_type.leave_type_id','inner');
		$this->db->join('employee_type', 'base_leave.employee_type_id = employee_type.employee_type_id','inner');
		$this->db->where('leave_type.type','Vacation');
		$this->db->where('employee_type.employee_type','Staff');
		$this->db->where('base_leave.active','true');
		$this->db->order_by('employee_status'); 
		$this->db->order_by('min_months'); 
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_vacation_leave_settings_faculty()
	{
		$this->db->select('*');
		$this->db->from('base_leave');
		$this->db->join('leave_type', 'base_leave.leave_type_id = leave_type.leave_type_id','inner');
		$this->db->join('employee_type', 'base_leave.employee_type_id = employee_type.employee_type_id','inner');
		$this->db->where('leave_type.type','Vacation');
		$this->db->where('employee_type.employee_type','Faculty');
		$this->db->where('base_leave.active','true');
		$this->db->order_by('employee_status'); 
		$this->db->order_by('min_months'); 
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_sick_leave_settings_staff()
	{
		$this->db->select('*');
		$this->db->from('base_leave');
		$this->db->join('leave_type', 'base_leave.leave_type_id = leave_type.leave_type_id','inner');
		$this->db->join('employee_type', 'base_leave.employee_type_id = employee_type.employee_type_id','inner');
		$this->db->where('leave_type.type','Sick');
		$this->db->where('employee_type.employee_type','Staff');
		$this->db->where('base_leave.active','true');
		$this->db->order_by('employee_status'); 
		$this->db->order_by('min_months'); 
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_sick_leave_settings_faculty()
	{
		$this->db->select('*');
		$this->db->from('base_leave');
		$this->db->join('leave_type', 'base_leave.leave_type_id = leave_type.leave_type_id','inner');
		$this->db->join('employee_type', 'base_leave.employee_type_id = employee_type.employee_type_id','inner');
		$this->db->where('leave_type.type','Sick');
		$this->db->where('employee_type.employee_type','Faculty');
		$this->db->where('base_leave.active','true');
		$this->db->order_by('employee_status'); 
		$this->db->order_by('min_months'); 
		$query = $this->db->get();
		return $query->result_array();
	}

	// leave types
	public function get_leave_types($leave_type_id = FALSE)
	{
		if ($leave_type_id === FALSE)
		{
		$this->db->select('*');
		$this->db->from('leave_type');
		$this->db->where('active', 'true');
		$this->db->order_by('leave_type_id');
		$query = $this->db->get();
		return $query->result_array();
		}
		$query = $this->db->get_where('leave_type', array('leave_type_id' =>$leave_type_id));
		return $query->row_array();
	}

	public function leave_type_count() 
	{
        return $this->db->count_all("leave_type");
    }
	
	public function edit_leave()
	{
		$id = $this->input->post('type_id');
		
		$data = array(
		'type' => $this->input->post('ltype'),
		'description' => $this->input->post('desc'),
		);
		
		return $this->db->update('leave_type',$data, "leave_type_id = $id");
	}

	function get_leave_summary()
	{
		$this->db->select('*,status.start_date as work_start');
		$this->db->from('employee_information');
		$this->db->join('employee_record', 'employee_record.employee_id = employee_information.employee_id','inner');
		$this->db->join('academic_year', 'academic_year.academic_year_id = employee_record.academic_year_id','inner');
		$this->db->join('employee_type', 'employee_type.employee_type_id = employee_information.employee_type_id','inner');
		$this->db->join('status', 'status.employee_id = employee_information.employee_id','inner');
		$this->db->where('employee_record.active','true');
		$this->db->where('employee_information.active','true');
		$this->db->where('status.active','true');
		$this->db->where('academic_year.active','true');
		$this->db->order_by('employee_information.first_name','asc'); 
		$query = $this->db->get();

		return $query->result_array();
	}

	//leave summary for a specific employee
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
		$result = $query->result_array();

		return $result;
	}
	//specific year leave summary for an employee
	function get_past_employee_leave_summary($employee_id)
	{
		$this->db->select('*');
		$this->db->from('leave');
		$this->db->join('employee_information', 'employee_information.employee_id = leave.employee_id','inner');
		$this->db->join('leave_type', 'leave_type.leave_type_id = leave.leave_type_id','inner');
		$this->db->join('base_leave', 'base_leave.base_leave_id = leave.base_leave_id','left');
		$this->db->join('academic_year', 'academic_year.academic_year_id = leave.academic_year_id','inner');
		$this->db->where('academic_year.academic_year_id',$this->input->post('search_year_id'));
		$this->db->where('leave.status','Approved');
		//$this->db->where('base_leave.active','true');
		$this->db->where('employee_information.employee_id',$employee_id);
		$this->db->order_by('leave.leave_id','asc'); 
		$query = $this->db->get();
		
		return $query->result_array();
	}

	//employee leave profile base leave settings
	function get_employee_leave_setting($employee_type_id,$employee_status,$service_length,$leave_type)
	{
		$this->db->select('*');
		$this->db->from('base_leave');
		$this->db->join('leave_type', 'leave_type.leave_type_id = base_leave.leave_type_id','inner');
		$this->db->where('employee_type_id',$employee_type_id);
		$this->db->where('employee_status',$employee_status);
		$this->db->where('base_leave.active','true');
		$this->db->where('leave_type.type',$leave_type);
		$this->db->where('min_months <=',$service_length);
		$this->db->where('max_months >',$service_length);
		$query = $this->db->get();

		return $query->row_array();
	}

	//get employee's past base vl leave setting 
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

	//base leave settings used for summary of all profiles
	function get_all_employee_history_leave_setting()
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
	//leave type------------------------------------
	
	public function set_leave_type()
	{	
	$data = array(
		'type' => $this->input->post('ltype'),
		'description' => $this->input->post('desc')
		);
	
	return $this->db->insert('leave_type', $data);
	}
	
	public function delete_leave_type($id)
	{
		$data = array (
		'active' => 'false');
		
		return $this->db->update('leave_type', $data,"leave_type_id = $id");
	}

	//leave type end-------------------------------

	//get status-----------------------------------

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

	//status end-----------------------------------
	
	//get employee type for summary----------------
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
	//employee_type_end

	//holiday
	public function get_holidays($holiday_id = FALSE)
	{
		if ($holiday_id === FALSE)
		{
		$sql = "SELECT h.holiday_id,h.description AS holiday,ht.holiday_type_id,ht.description AS description, to_char(to_timestamp(to_char(EXTRACT (MONTH FROM h.date),'999'),'MM'), 'Month') AS month,EXTRACT (DAY FROM date) AS day 
		FROM holiday as h,holiday_type as ht 
		WHERE h.holiday_type_id = ht.holiday_type_id
		ORDER BY EXTRACT (MONTH FROM date),EXTRACT (DAY FROM date)";
		$query = $this->db->query($sql);
		return $query->result_array();
		}
		$sql2 = "SELECT holiday_id,description, date FROM holiday WHERE holiday_id = $holiday_id";
		$query = $this->db->query($sql2);
		return $query->row_array();
	}
	
	public function get_holiday_type()
	{
		$query = $this->db->get('holiday_type');
		return $query->result_array();
	}
	
	public function holiday_count() 
	{
        return $this->db->count_all("holiday");
    }
	
	public function edit_holiday()
	{
		$id = $this->input->post('holiday_id');
		
		$data = array(
		'description' => $this->input->post('holiday_name'),
		'holiday_type_id' => $this->input->post('type_id'),
		'date' =>$this->input->post('date')
		);
		
		return $this->db->update('holiday',$data, "holiday_id = $id");
	}
	
	public function set_holiday()
	{	
		$data = array(
		'description' => $this->input->post('desc'),
		'holiday_type_id' => $this->input->post('type_id'),
		'date' => $this->input->post('date')
		);
	
	return $this->db->insert('holiday', $data);
	} 
	
	public function delete_holiday($id)
	{
		$this->db->delete('holiday', array('holiday_id' => $id));
	}

	//holiday end---------------------------------

	//school year---------------------------------

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

	//for individual past employee summary
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

	function get_search_year_summary()
	{
		$search_year = $this->input->post('search_year_id');

		$this->db->select('*');
		$this->db->from('employee_information');
		$this->db->join('employee_record', 'employee_record.employee_id = employee_information.employee_id','inner');
		$this->db->join('academic_year', 'academic_year.academic_year_id = employee_record.academic_year_id','inner');
		$this->db->join('employee_type', 'employee_type.employee_type_id = employee_record.employee_type_id','inner');
		$this->db->join('status', 'status.status_id = employee_record.status_id','inner');
		$this->db->where('employee_record.academic_year_id',$search_year);
		$this->db->where('employee_information.active','true');
		$this->db->where('academic_year.academic_year_id',$search_year);
		$this->db->order_by('employee_information.first_name','asc'); 
		$query = $this->db->get();

		return $query->result_array();
	}

	//edit base leave
	function edit_base_leave()
	{
		$base_id = $this->input->post('base_id');
		$max_leave = $this->input->post('max_leave');
		$max_convertible = $this->input->post('max_convertible');
		$status = $this->input->post('status');
		$denied ='denied';
		$accepted = 'accepted';
		$probationary = 'Probationary';

		if($status =='Probationary'){

			$this->db->select('*');
			$this->db->from('base_leave');
			$this->db->where('base_leave.base_leave_id',$base_id);
			$this->db->where('base_leave.active','true');
			$query = $this->db->get();
			$result = $query->row_array();

			$p_max = $result['max_months'];
			$p_min = $result['min_months'];
			$p_ltype = $result['leave_type_id'];
			$p_etype = $result['employee_type_id'];

			$active = array('active' => 'false');

			$this->db->update('base_leave',$active, "base_leave_id = $base_id"); //old probationary bracket setting set to false

			$data = array(
				'max_leave' => $max_leave,
				'max_convertible' => $max_convertible,
				'min_months' => $p_min,
				'max_months' => $p_max,
				'leave_type_id' => $p_ltype,
				'employee_type_id' => $p_etype,
				'employee_status' => $probationary
				);

			$this->db->insert('base_leave', $data); // new probationary bracket setting
			
			return $accepted;
		}
		else{
			$min_month = $this->input->post('min_month');
			$max_month = $this->input->post('max_month');

			$this->db->select('*');
			$this->db->from('base_leave');
			$this->db->where('base_leave.base_leave_id',$base_id);
			$this->db->where('base_leave.employee_status !=',$probationary);
			$this->db->where('base_leave.active','true');
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
				$ltype = $result['leave_type_id'];
				$etype = $result['employee_type_id'];
				$status = $result['employee_status'];

				//check next bracket min range
				$this->db->select('*');
				$this->db->from('base_leave');
				$this->db->where('base_leave.min_months',$max);
				$this->db->where('base_leave.employee_type_id',$etype);
				$this->db->where('base_leave.leave_type_id',$ltype);
				$this->db->where('base_leave.employee_status !=',$probationary);
				$this->db->where('base_leave.active','true');
				$query = $this->db->get();
				$result2 = $query->row_array();

				if($max_month >= $result2['max_months']){
					return $denied;
				}

				$base_id2 = $result2['base_leave_id'];

				//data for updating previous base_leave to false
				$active = array( 'active' => 'false');

				$data = array(
					'max_leave' => $max_leave,
					'max_convertible' => $max_convertible,
					'min_months' => 0,
					'max_months' => $max_month,
					'leave_type_id' => $ltype,
					'employee_type_id' => $etype,
					'employee_status' => $status
					);

				$max2 = $result2['max_months'];
				$max_leave2 = $result2['max_leave'];
				$max_convertible2 = $result2['max_convertible'];
				$ltype2 = $result2['leave_type_id'];
				$etype2 = $result2['employee_type_id'];
				$status2 = $result2['employee_status'];

				$data2 = array(
					'min_months' => $max_month, // max from previous bracket
					'max_leave' => $max_leave2,
					'max_convertible' => $max_convertible2,
					'max_months' => $max2,
					'leave_type_id' => $ltype2,
					'employee_type_id' => $etype2,
					'employee_status' => $status2
					);

				$this->db->trans_start();

				$this->db->update('base_leave',$active, "base_leave_id = $base_id"); //old current bracket setting set to false
				$this->db->update('base_leave',$active, "base_leave_id = $base_id2"); //old next bracket setting set to false
				//insert new base settings
				$this->db->insert('base_leave', $data); //new current bracket setting
				$this->db->insert('base_leave', $data2); // new next bracket setting

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
				$ltype = $result['leave_type_id'];
				$etype = $result['employee_type_id'];
				$status = $result['employee_status'];

				//check previous bracket max range
				$this->db->select('*');
				$this->db->from('base_leave');
				$this->db->where('base_leave.max_months',$min);
				$this->db->where('base_leave.employee_type_id',$etype);
				$this->db->where('base_leave.leave_type_id',$ltype);
				$this->db->where('base_leave.employee_status !=',$probationary);
				$this->db->where('base_leave.active','true');
				$query = $this->db->get();
				$result2 = $query->row_array();

				if($min_month <= $result2['min_months']){
					return $denied;
				}

				$base_id2 = $result2['base_leave_id'];

				//data for updating previous base_leave to false
				$active = array( 'active' => 'false');

				$data = array(
					'max_leave' => $max_leave,
					'max_convertible' => $max_convertible,
					'max_months' => 999,
					'min_months' => $min_month,
					'leave_type_id' => $ltype,
					'employee_type_id' => $etype,
					'employee_status' => $status
					);

				$min2 = $result2['min_months'];
				$max_leave2 = $result2['max_leave'];
				$max_convertible2 = $result2['max_convertible'];
				$ltype2 = $result2['leave_type_id'];
				$etype2 = $result2['employee_type_id'];
				$status2 = $result2['employee_status'];

				$data2 = array(
					'max_months' => $min_month, //min from next bracket
					'max_leave' => $max_leave2,
					'max_convertible' => $max_convertible2,
					'min_months' => $min2,
					'leave_type_id' => $ltype2,
					'employee_type_id' => $etype2,
					'employee_status' => $status2
					);

				$this->db->trans_start();

				$this->db->update('base_leave',$active, "base_leave_id = $base_id"); //old current bracket setting set to false
				$this->db->update('base_leave',$active, "base_leave_id = $base_id2"); //old previous bracket setting set to false
				//insert new base settings
				$this->db->insert('base_leave', $data); //new current bracket setting
				$this->db->insert('base_leave', $data2); // new next bracket setting

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
			$ltype = $result['leave_type_id'];
			$etype = $result['employee_type_id'];
			$status = $result['employee_status'];

			//check next bracket min range
			$this->db->select('*');
			$this->db->from('base_leave');
			$this->db->where('base_leave.min_months',$max);
			$this->db->where('base_leave.employee_type_id',$etype);
			$this->db->where('base_leave.leave_type_id',$ltype);
			$this->db->where('base_leave.employee_status !=',$probationary);
			$this->db->where('base_leave.active','true');
			$query = $this->db->get();
			$result2 = $query->row_array();

			if($max_month >= $result2['max_months']){
				return $denied;
			}

			$base_id2 = $result2['base_leave_id'];

			$min = $result['min_months'];

			//check previous bracket max range
			$this->db->select('*');
			$this->db->from('base_leave');
			$this->db->where('base_leave.max_months',$min);
			$this->db->where('base_leave.employee_type_id',$etype);
			$this->db->where('base_leave.leave_type_id',$ltype);
			$this->db->where('base_leave.employee_status !=',$probationary);
			$this->db->where('base_leave.active','true');
			$query = $this->db->get();
			$result3 = $query->row_array();

			if($min_month <= $result3['min_months']){
				return $denied;
			}

			$base_id3 = $result3['base_leave_id'];

			//current bracket
			$data = array(
				'max_leave' => $max_leave,
				'max_convertible' => $max_convertible,
				'max_months' => $max_month,
				'min_months' => $min_month,
				'leave_type_id' => $ltype,
				'employee_type_id' => $etype,
				'employee_status' => $status
				);

			//data for next bracket
			$next_max = $result2['max_months'];
			$max_leave2 = $result2['max_leave'];
			$max_convertible2 = $result2['max_convertible'];
			$ltype2 = $result2['leave_type_id'];
			$etype2 = $result2['employee_type_id'];
			$status2 = $result2['employee_status'];
			//next bracket
			$data2 = array(
				'max_leave' => $max_leave2,
				'max_convertible' => $max_convertible2,
				'max_months' => $next_max,
				'min_months' => $max_month,
				'leave_type_id' => $ltype2,
				'employee_type_id' => $etype2,
				'employee_status' => $status2

				);

			//data for previous bracket
			$prev_min = $result3['min_months'];
			$max_leave3 = $result3['max_leave'];
			$max_convertible3 = $result3['max_convertible'];
			$ltype3 = $result3['leave_type_id'];
			$etype3 = $result3['employee_type_id'];
			$status3 = $result3['employee_status'];
			//previous bracket
			$data3 = array(
				'max_leave' => $max_leave3,
				'max_convertible' => $max_convertible3,
				'max_months' => $min_month,
				'min_months' => $prev_min,
				'leave_type_id' => $ltype3,
				'employee_type_id' => $etype3,
				'employee_status' => $status3
				);

			$active = array('active' => 'false');

			$this->db->trans_start();

			$this->db->update('base_leave',$active, "base_leave_id = $base_id"); //old current bracket setting set to false
			$this->db->update('base_leave',$active, "base_leave_id = $base_id2"); //old next bracket setting set to false
			$this->db->update('base_leave',$active, "base_leave_id = $base_id3"); //old previous bracket setting set to false
			//insert new base settings
			$this->db->insert('base_leave', $data); //new current bracket setting
			$this->db->insert('base_leave', $data2); // new next bracket setting
			$this->db->insert('base_leave', $data3); // new previous bracket setting

			$this->db->trans_complete();

			return $accepted;
		}
	}
}