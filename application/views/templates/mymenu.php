<div class="btn-group">
	<a href="<?php echo base_url().'index.php/my_dashboard'?>" class="btn btn-danger <?php 
		if($menu=='Dashboard')
		{
		echo 'active';
		}	
	?>">Dashboard</a>
</div>
<div class="btn-group">  
	<a href="<?php echo base_url().'index.php/my_profile'?>" class="btn btn-primary <?php
		if($menu=='My Profile')
		{
		echo 'active';
		}	
	?>">My Profile</a>
</div>
<div class="btn-group">
	<button type="button" class="btn btn-success <?php 
		if($menu=='My Leave')
		{
		echo 'active';
		}
	?> dropdown-toggle" data-toggle="dropdown">
    My Leave <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
    </button>
		<ul class="dropdown-menu" role="menu">
			<li><a href="<?php echo base_url().'index.php/my_leave/apply_leave' ?>">Request a Leave</a></li>
			<li><a href="<?php echo base_url().'index.php/my_leave/my_pending_request' ?>">My Pending Request</a></li>
			<li role="presentation" class="divider"></li>	
			<li><a href="<?php echo base_url().'index.php/my_leave/my_leave_summary' ?>">My Leave Summary</a></li>
			<li><a href="<?php echo base_url().'index.php/my_leave/my_leave_history' ?>">My Leave History</a></li>				
		</ul>
</div>
<div class="btn-group">
	<button type="button" class="btn btn-info <?php 
		if($menu=='My Medical Benefits')
		{
		echo 'active';
		}
	?> dropdown-toggle" data-toggle="dropdown">
    My Medical Benefits <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
    </button>
    	<ul class="dropdown-menu" role="menu">
			<li><a href="<?php echo base_url().'index.php/my_medical/apply_medical_assistance' ?>">Request Medical Assistance</a></li>
			<li><a href="<?php echo base_url().'index.php/my_medical/my_pending_request' ?>">My Pending Request</a></li>
			<li role="presentation" class="divider"></li>	
			<li><a href="<?php echo base_url().'index.php/my_medical/my_medical_summary'?>">My Medical Summary</a></li>
			<li><a href="<?php echo base_url().'index.php/my_medical/my_medical_history' ?>">My Medical History</a></li>				
		</ul>
</div>
<div class="btn-group">
	<a href="<?php echo base_url().'index.php/my_ranking' ?>" class="btn btn-warning <?php 
		if($menu=='My Ranking')
		{
		echo 'active';
		}	
	?>">My Ranking</a>
</div>
<div class="btn-group">	  
	<a href="<?php echo base_url().'index.php/my_settings' ?>" class="btn btn-default dropdown-toggle" <?php 
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