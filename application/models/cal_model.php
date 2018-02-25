<?php
class Cal_model extends CI_Model{

	var $conf;

	public function __construct()
	{
		$this->conf = array(
			'show_next_prev' =>true,
			'next_prev_url' => base_url().'index.php/dashboard/calendar',
			'day_type' => 'short'
			);

		$this->conf['template'] = '
 		{table_open}<table class="table table-bordered"  style="background-color: #fff;color: black; width:100%;">{/table_open}

	    {heading_row_start}<tr>{/heading_row_start}

	    {heading_previous_cell}<th style="border-color: black;"><div class="text-center" hristooltip="tooltip" data-original-title="previous month"><a href="{previous_url}#calendar"><span class="glyphicon glyphicon-arrow-left"></a></div></th>{/heading_previous_cell}
	    {heading_title_cell}<th colspan="{colspan}" style="background-color: #d9544f; border-color: black; color:#fff;"><div class="text-center">{heading}</div></th>{/heading_title_cell}
	    {heading_next_cell}<th style="border-color: black;"><div class="text-center" hristooltip="tooltip" data-original-title="next month"><a href="{next_url}#calendar"><span class="glyphicon glyphicon-arrow-right"></a></div></th>{/heading_next_cell}

	    {heading_row_end}</tr>{/heading_row_end}

	    {week_row_start}<tr>{/week_row_start}
	    {week_day_cell}<th style="border-color: black;"><div class="text-center"><h5><strong>{week_day}</strong></h5></div></th>{/week_day_cell}
	    {week_row_end}</tr>{/week_row_end}

	    {cal_row_start}<tr>{/cal_row_start}
	    {cal_cell_start}<td style="width:14.2%; height:52px; padding:4px; vertical-align:top;background-color: #f4edcc;border-color: black;">{/cal_cell_start}

	    {cal_cell_content}
		    <div style="color:#d9544f;color:#2a6496;"><a href="" data-toggle="modal" data-target="#myModalday{day}"><strong>{day}</strong></a></div>
		    <div style="font-size: 10px; color:#2a6496; font-weight: bold;"></div>
		    <div class="modal fade" id="myModalday{day}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">Events for this day</h4>
						</div>
						<div class="modal-body">
							{content}
						</div>
						<div class="modal-footer">
							<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
						</div>
					</div>
				</div>
			</div>
	    {/cal_cell_content}
	    {cal_cell_content_today}
	    	<div class="highlight" style="font-weight: bold; color:#d9544f;"><a href="" data-toggle="modal" data-target="#myModalday{day}" style="color:#d9544f;"><strong>{day}</strong></a></div>
	    	<div style="font-size: 10px; color:#d9544f; font-weight: bold;"></div>
	    	<div class="modal fade" id="myModalday{day}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">Events for Today</h4>
						</div>
						<div class="modal-body">
							{content}
						</div>
						<div class="modal-footer">
							<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
						</div>
					</div>
				</div>
			</div>
	    {/cal_cell_content_today}

	    {cal_cell_no_content}
	    	<div style="">{day}</div>
	    {/cal_cell_no_content}
	    {cal_cell_no_content_today}
	 		<div class="highlight"  style="color:#d9544f;">{day}</div>
	    {/cal_cell_no_content_today}

	    {cal_cell_blank}&nbsp;{/cal_cell_blank}

	    {cal_cell_end}</td>{/cal_cell_end}
	    {cal_row_end}</tr>{/cal_row_end}

	    {table_close}</table>{/table_close}
	    ';
	}
	
	function get_calendar_data($month)
	{
		if ($month == null){
			$month = date('m');
		}
		$date_query = "SELECT * FROM holiday WHERE cast(date as text) LIKE '%-$month-%' ESCAPE '!'";
		$query = $this->db->query($date_query);
		$result = $query->result();
		$event_data = array();

		foreach($result as $row) {
			if(substr($row->date,8,1)== '0'){
				if(isset($event_data[substr($row->date,-1)]) == true){
					$existing_content = $event_data[substr($row->date,-1)];
					$event_data[substr($row->date,-1)] = $existing_content.', <br />'.($row->description);
				}
				else {
					$event_data[substr($row->date,-1)] = $row->description;
				}
			}
			else
			{
				if(isset($event_data[substr($row->date,-2)]) == true){
					$existing_content = $event_data[substr($row->date,-2)];
					$event_data[substr($row->date,-2)] = $existing_content.', <br />'.($row->description);
				}
				else{
					$event_data[substr($row->date,-2)] = $row->description;
				}
			}
		}

		$birthdate = "SELECT * FROM employee_information WHERE cast(birthdate as text) LIKE '%-$month-%' ESCAPE '!'";
		$query = $this->db->query($birthdate);
		$result2 = $query->result();

		foreach($result2 as $row) {
			if(substr($row->birthdate,8,1)== '0'){
				if(isset($event_data[substr($row->birthdate,-1)]) == true){
					$existing_content = $event_data[substr($row->birthdate,-1)];
					$event_data[substr($row->birthdate,-1)] = $existing_content.', <br />'.($row->first_name).' '.($row->last_name)."'s Birthday";
				}
				else {
					$event_data[substr($row->birthdate,-1)] = $row->first_name.' '.($row->last_name)."'s Birthday";
				}
			}
			else
			{
				if(isset($event_data[substr($row->birthdate,-2)]) == true){
					$existing_content = $event_data[substr($row->birthdate,-2)];
					$event_data[substr($row->birthdate,-2)] = $existing_content.', <br />'.($row->first_name).' '.($row->last_name)."'s Birthday";
				}
				else{
					$event_data[substr($row->birthdate,-2)] = $row->first_name.' '.($row->last_name)."'s Birthday";
				}
			}
		}

		return $event_data;
	}

	function generate($year,$month)
	{
		$this->load->library('calendar',$this->conf);

		$cal_data = $this->get_calendar_data($month);
		
		return $this->calendar->generate($year,$month,$cal_data);
	}	

	function last_ranking(){
		$this->db->select('*');
		$this->db->from('rank_date');
		$this->db->where('rank_date.active','true');
		$query = $this->db->get();
		
		return $query->row_array();
	}

	function birthdays(){

		$datequery = "SELECT DISTINCT EXTRACT(month FROM employee_information.birthdate)||'-'||EXTRACT(day FROM employee_information.birthdate) as birthdate, employee_information.first_name,employee_information.last_name  from employee_information
		ORDER BY birthdate";
		$query = $this->db->query($datequery);
		$result = $query->result_array();

		return $result;
	}

	function get_pending_leave(){
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

	function get_pending_medical(){
		$this->db->select('*');
		$this->db->from('medical');
		$this->db->join('employee_information', 'employee_information.employee_id = medical.employee_id','inner');
		$this->db->where('medical.status','Pending');
		$this->db->where('employee_information.active','true');
		$this->db->order_by('medical.medical_id','desc'); 
		$query = $this->db->get();

		return $query->result_array();
	}
}