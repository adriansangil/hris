<div class="btn-group">
	<a href="<?php echo base_url().'index.php/dashboard' ?>" class="btn btn-danger <?php 
		if($menu=='Dashboard')
		{
		echo 'active';
		}	
	?> dropdown-toggle" hrispopover="popover" 
        data-content="Dashboard contains easy access to the different modules of HRIS." data-title="About Dashboard">Dashboard</a>
</div>
<div class="btn-group">	  
	<button type="button" class="btn btn-primary <?php 
		if($menu=='Employee')
		{
		echo 'active';
		}
	?> dropdown-toggle" data-toggle="dropdown" hrispopover="popover" 
        data-content="Employee contains the list of employees as well as access to their individual profile." data-title="About Employee">
    Employee <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
    </button>
		<ul class="dropdown-menu" role="menu">
			<li><a href="<?php echo base_url().'index.php/employee' ?>">Employee List</a></li>
			<li><a href="<?php echo base_url().'index.php/employee/addemployee' ?>">Add Employee</a></li>
			<li role="presentation" class="divider"></li>
			<li><a href="<?php echo base_url().'index.php/employee/inactive_employee' ?>">Inactive Employee List</a></li>
		</ul>
</div>
<div class="btn-group">	  
	<button type="button" class="btn btn-success <?php 
		if($menu=='Leave')
		{
		echo 'active';
		}
	?> dropdown-toggle" hrispopover="popover" 
        data-content="Leave contains the employee leave requests, summary and leave settings." data-title="About Leave" data-toggle="dropdown">
    Leave <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
    </button>
		<ul class="dropdown-menu" role="menu">
			<li><a href="<?php echo base_url().'index.php/leave' ?>">Pending Leave Request</a></li>
			<li><a href="<?php echo base_url().'index.php/leave/approved_leave' ?>">Approved Leave Request</a></li>
			<li><a href="<?php echo base_url().'index.php/leave/rejected_leave' ?>">Rejected Leave Request</a></li>
			<li role="presentation" class="divider"></li>
			<li><a href="<?php echo base_url().'index.php/leave/leave_summary' ?>">Leave Summary</a></li>
			<li role="presentation" class="divider"></li>
			<li><a href="<?php echo base_url().'index.php/leave/holidays' ?>">Holiday Settings</a></li>
			<li><a href="<?php echo base_url().'index.php/leave/leave_type' ?>">Leave Type Settings</a></li>
			<li><a href="<?php echo base_url().'index.php/leave/leave_settings' ?>">Base Leave Settings</a></li>

		</ul>
</div>
<div class="btn-group">	  
	<button type="button" class="btn btn-info <?php 
		if($menu=='Medical')
		{
		echo 'active';
		}
	?> dropdown-toggle" hrispopover="popover" 
        data-content="Medical Assistance Benefits contains employee medical assistance request, summary and medical assistance settings." data-title="About Medical Assistance Benefits" data-toggle="dropdown">
    Medical <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
    </button>
    	<ul class="dropdown-menu" role="menu">
    		<li><a href="<?php echo base_url().'index.php/medical/pending_medical_request' ?>">Pending Medical Request</a></li>
    		<li><a href="<?php echo base_url().'index.php/medical/approved_medical_request' ?>">Approved Medical Request</a></li>
    		<li><a href="<?php echo base_url().'index.php/medical/rejected_medical_request' ?>">Rejected Medical Request</a></li>
    		<li role="presentation" class="divider"></li>
    		<li><a href="<?php echo base_url().'index.php/medical/medical_summary' ?>">Medical Assistance Summary</a></li>
    		<li role="presentation" class="divider"></li>
    		<li><a href="<?php echo base_url().'index.php/medical/medical_settings' ?>">Base Medical Assistance Settings</a></li>
    	</ul>
</div>	  
<div class="btn-group">	  
	<button type="button" class="btn btn-warning <?php 
		if($menu=='Ranking')
		{
		echo 'active';
		}
	?> dropdown-toggle" hrispopover="popover" 
        data-content="Ranking contains employee ranking information, achievements and ranking settings." data-title="About Ranking" data-toggle="dropdown">
    Ranking <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
    </button>
    	<ul class="dropdown-menu" role="menu">
    		<li><a href="<?php echo base_url().'index.php/ranking/eligible_ranking_list' ?>">Eligible List for Ranking</a></li>
    		<li><a href="<?php echo base_url().'index.php/ranking/ranking_summary' ?>">Ranking Summary</a></li>
    		<li role="presentation" class="divider"></li>
    		<li><a href="<?php echo base_url().'index.php/ranking/faculty_ranking_classification' ?>">Faculty Ranking Classification Reference</a></li>
    		<li role="presentation" class="divider"></li>
    		<li><a href="<?php echo base_url().'index.php/ranking/education_settings' ?>">Education Settings</a></li>
    		<li><a href="<?php echo base_url().'index.php/ranking/work_experience_settings' ?>">Work Experience Settings</a></li>
    		<li><a href="<?php echo base_url().'index.php/ranking/certification_board_settings' ?>">Certifications/Examinations Settings</a></li>
    		<li><a href="<?php echo base_url().'index.php/ranking/weight_multiplier_settings' ?>">Multiplier Weight Settings</a></li>
    		<li><a href="<?php echo base_url().'index.php/ranking/base_points_settings' ?>">Base Points Settings</a></li>
    	</ul>
</div>	  
<div class="btn-group">	  
	<a href="<?php echo base_url().'index.php/settings' ?>" class="btn btn-default dropdown-toggle" <?php 
		if($menu=='Settings')
		{
			echo 'style="background-color: #222; color: #fff; border-color: #222;"';
		}
		else{
			echo 'style="background-color: #3e3d3d; color: #fff; border-color: #222;"';
		}
	?> hrispopover="popover" 
        data-content="Settings allow admin to change account information and details." data-title="About Settings">Settings</a>
</div>