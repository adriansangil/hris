<?php
class My_settings_model extends CI_Model {
	
	public function get_user_details($userid) {
		
        $this->db->select('*');
		$this->db->from('employee_information');
		$this->db->join('employee_type', 'employee_type.employee_type_id = employee_information.employee_type_id','left');
		$this->db->where('employee_information.employee_id',$userid);
		$query = $this->db->get();

		return $query->row_array();
   	}

   	function edit_name($userid){
		
		$data = array(
			'first_name' => ucwords($this->input->post('fname')),
			'middle_name' => ucwords($this->input->post('mname')),
			'last_name' => ucwords($this->input->post('lname')),
			);

		$this->db->update('employee_information',$data, "employee_id = $userid");
   	}

   	//edit username
   	function edit_uname($userid){
		
		$data = array(
			'username' => $this->input->post('uname')
			);
		
		$this->db->update('employee_information',$data, "employee_id = $userid");
   	}

   	//check password
   	function check_password($userid){
   		$current_pass = md5($this->input->post('current'));
   		
   		$this->db->select('*');
		$this->db->from('employee_information');
		$this->db->where('employee_information.employee_id',$userid);
		$query = $this->db->get();
		$result = $query->row_array();

		if($result['password'] == $current_pass){
			return $current_pass;
		}
		else{
			return FALSE;
		}
   	}

   	function edit_password($userid){
		$new_pass = md5($this->input->post('new'));
		$data = array(
			'password' => $new_pass
			);
		
		$this->db->update('employee_information',$data, "employee_id = $userid");
   	}

   	function edit_bday($userid){

		$data = array(
			'birthdate' => $this->input->post('birthdate')
			);	

		$this->db->update('employee_information',$data, "employee_id = $userid");
   	}

   	//edit address
   	function edit_addr($userid){
		$new_addr = ucwords($this->input->post('addr'));
		$data = array(
			'address' => $new_addr
			);
		
		$this->db->update('employee_information',$data, "employee_id = $userid");
   	}

   	//edit mobile
   	function edit_mobile($userid){
		$data = array(
			'mobile_num' => $this->input->post('mobile_num')
			);
		
		$this->db->update('employee_information',$data, "employee_id = $userid");
   	}

   	//edit email
   	function edit_email($userid){
		$data = array(
			'work_email' => $this->input->post('email')
			);
		
		$this->db->update('employee_information',$data, "employee_id = $userid");
   	}
}