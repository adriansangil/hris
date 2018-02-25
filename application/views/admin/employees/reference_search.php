<?php 
$data['all_employees'] = $this->employee_model->get_employees();

$var = strtolower($var);

$pattern = '[a-z]*.$var.[a-z]*';
$theresults = array();
$i = 0;

$match = false;

foreach ($all_employees as $employee): 
if (preg_match($pattern,strtolower($employee['first_name'])) >0){
	$theresults[i++]= $employee;
	
	$match = true;
	}
if (!$match){

if (preg_match($pattern,strtolower($employee['last_name'])) >0){
	$theresults[i++]= $employee;
	
	$match = false;
	}
}	

endforeach;

$all_employees = $theresults;

