<?php
class Login_model extends CI_Model {

	function validate()
	{
		$this->db->where('username',$this->input->post('username'));
		$this->db->where('password',md5($this->input->post('password')));
		$query = $this->db->get('employee_information');
	
		if($query->num_rows==1)
		{
			return true;
		}
	}
	
	function get_usertype()
	{
		$username = $this->input->post('username');
		$query = $this->db->query("SELECT info.employee_id,emp.employee_type, user_type.type 
									FROM employee_information AS info ,employee_type AS emp, user_type
									WHERE info.username = '$username'
									AND info.user_type_id = user_type.user_id");
		
		return $query->row();
	}

	function update_academic_year()
	{
		$this->db->select('*');
		$this->db->from('academic_year');
		$this->db->where('active','true');
		$query = $this->db->get();
		$result = $query->row_array();

		$current_date = new DateTime(date('M d Y'));
		$end_date =  new DateTime($result['end_date']);
		
		while($current_date > $end_date)
		{
			$this->db->select('*');
			$this->db->from('academic_year');
			$this->db->where('active','true');
			$query = $this->db->get();
			$result = $query->row_array();

			$year_id = $result['academic_year_id'];
			$start_date =  new DateTime($result['start_date']);
			$end_date =  new DateTime($result['end_date']);

			//get list of active employees
			$this->db->select('*');
			$this->db->from('employee_information');
			$this->db->join('employee_type','employee_type.employee_type_id = employee_information.employee_type_id','inner');
			$this->db->join('status','status.employee_id = employee_information.employee_id','inner');
			$this->db->where('employee_information.active','true');
			$this->db->where('status.active','true');
			$query = $this->db->get();
			$employee_record = $query->result_array();

			foreach($employee_record as $record):
				//get length of service up to end of year
				$start_work = new DateTime($record['start_date']);
				$interval = $start_work->diff($end_date);
				$length_of_service = ($interval->format('%y') * 12) + $interval->format('%m');

				//get vacation id
				$this->db->select('*');
				$this->db->from('base_leave');
				$this->db->join('leave_type', 'leave_type.leave_type_id = base_leave.leave_type_id','inner');
				$this->db->where('employee_type_id',$record['employee_type_id']);
				$this->db->where('employee_status',$record['employee_status']);
				$this->db->where('base_leave.active','true');
				$this->db->where('leave_type.type','Vacation');
				$this->db->where('min_months <=',$length_of_service);
				$this->db->where('max_months >',$length_of_service);
				$query = $this->db->get();
				$vacation = $query->row_array();
				$vacation_id = $vacation['base_leave_id'];

				//get sick id
				$this->db->select('*');
				$this->db->from('base_leave');
				$this->db->join('leave_type', 'leave_type.leave_type_id = base_leave.leave_type_id','inner');
				$this->db->where('employee_type_id',$record['employee_type_id']);
				$this->db->where('employee_status',$record['employee_status']);
				$this->db->where('base_leave.active','true');
				$this->db->where('leave_type.type','Sick');
				$this->db->where('min_months <=',$length_of_service);
				$this->db->where('max_months >',$length_of_service);
				$query = $this->db->get();
				$sick = $query->row_array();
				$sick_id = $sick['base_leave_id'];

				$data = array (
				'vl_base_id' => $vacation_id,
				'sl_base_id' => $sick_id,
				'employee_type_id' => $record['employee_type_id'],
				'status_id' => $record['status_id']
				);

				$this->db->update('employee_record', $data,array('academic_year_id'=>$year_id,'employee_id'=>$record['employee_id']));

			endforeach;

			$data = array (
				'active' => 'false');
		
			$this->db->update('academic_year', $data,"academic_year_id = $year_id");
			$this->db->update('employee_record', $data,"academic_year_id = $year_id");

			$start =  $start_date->modify('+ 1 year');
			$end = $end_date->modify('+ 1 year');
			$new_start_date =  $start->format('Y-m-d');
			$new_end_date = $end->format('Y-m-d');
			$new_start_year = $result['start_year'] +1;
			$new_end_year = $result['end_year'] +1;

			$data2 = array (
				'start_date' => $new_start_date,
				'end_date' => $new_end_date,
				'start_year' => $new_start_year,
				'end_year' => $new_end_year
				);
			$this->db->insert('academic_year', $data2);
			
			$this->db->select('*');
			$this->db->from('employee_information');
			$this->db->where('active','true');
			$query = $this->db->get();
			$result2 = $query->result_array();

			foreach($result2 as $employee):

				$this->db->select('academic_year_id');
				$this->db->from('academic_year');
				$this->db->where('active','true');
				$query = $this->db->get();
				$result3 = $query->row_array();

				$data3 = array(
				'employee_id' => $employee['employee_id'],
				'vl' => 0,
				'vl_lwop' => 0,
				'sl' => 0,
				'sl_lwop' => 0,
				'others' => 0,
				'academic_year_id' => $result3['academic_year_id']
				);

				$this->db->insert('employee_record', $data3);
			endforeach;

			$end_date = new DateTime($new_end_date);
		}
	}

	function update_year()
	{
		$this->db->select('*');
		$this->db->from('year');
		$this->db->where('active','true');
		$query = $this->db->get();
		$result = $query->row_array();

		$current_date = new DateTime(date('M d Y'));
		$end_date =  new DateTime($result['end_date']);
		
		while($current_date > $end_date)
		{
			$this->db->select('*');
			$this->db->from('year');
			$this->db->where('active','true');
			$query = $this->db->get();
			$result = $query->row_array();

			$year_id = $result['year_id'];
			$start_date =  new DateTime($result['start_date']);
			$end_date =  new DateTime($result['end_date']);

			//get list of active employees
			$this->db->select('*');
			$this->db->from('employee_information');
			$this->db->join('employee_type','employee_type.employee_type_id = employee_information.employee_type_id','inner');
			$this->db->join('status','status.employee_id = employee_information.employee_id','inner');
			$this->db->where('employee_information.active','true');
			$this->db->where('status.active','true');
			$query = $this->db->get();
			$employee_medical_record = $query->result_array();

			foreach($employee_medical_record as $record):
				//get length of service up to end of year
				$start_work = new DateTime($record['start_date']);
				$interval = $start_work->diff($end_date);
				$length_of_service = ($interval->format('%y') * 12) + $interval->format('%m');

				//get base benefit id
				$this->db->select('*');
				$this->db->from('base_benefit');
				$this->db->where('employee_type_id',$record['employee_type_id']);
				$this->db->where('employee_status',$record['employee_status']);
				$this->db->where('base_benefit.active','true');
				$this->db->where('min_months <=',$length_of_service);
				$this->db->where('max_months >',$length_of_service);
				$query = $this->db->get();
				$benefit = $query->row_array();
				$base_benefit_id = $benefit['base_benefit_id'];

				$data = array (
				'base_benefit_id' => $base_benefit_id,
				'employee_type_id' => $record['employee_type_id'],
				'status_id' => $record['status_id']
				);

				$this->db->update('employee_medical_record', $data,array('year_id'=>$year_id,'employee_id'=>$record['employee_id']));

			endforeach;

			$data = array (
				'active' => 'false');
		
			$this->db->update('year', $data,"year_id = $year_id");
			$this->db->update('employee_medical_record', $data,"year_id = $year_id");

			$start =  $start_date->modify('+ 1 year');
			$end = $end_date->modify('+ 1 year');
			$new_start_date =  $start->format('Y-m-d');
			$new_end_date = $end->format('Y-m-d');
			$new_start_year = $result['current_year'] +1;

			$data2 = array (
				'start_date' => $new_start_date,
				'end_date' => $new_end_date,
				'current_year' => $new_start_year
				);
			$this->db->insert('year', $data2);
			
			$this->db->select('*');
			$this->db->from('employee_information');
			$this->db->where('active','true');
			$query = $this->db->get();
			$result2 = $query->result_array();

			foreach($result2 as $employee):

				$this->db->select('year_id');
				$this->db->from('year');
				$this->db->where('active','true');
				$query = $this->db->get();
				$result3 = $query->row_array();

				$data3 = array(
				'employee_id' => $employee['employee_id'],
				'benefit_consumed' => 0,
				'year_id' => $result3['year_id']
				);

				$this->db->insert('employee_medical_record', $data3);
			endforeach;

			$end_date = new DateTime($new_end_date);
		}
	}
}