<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#d9544f; color: #fff;">
				<div class="row">
					<div class="col-md-3">
					</div>
					<div class="col-md-6">
					<div class="text-center">Welcome back, <?php echo $employee['first_name'].' '.$employee['last_name'] ?></div>
					</div>
					<div class="col-md-3">
					</div>
				</div>
			</div>	
			<div class="panel-body" style="background-color:#f7f7f7">
				<div class="row">
					<div class="col-md-7">
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading" style="background-color:#d9544f; color: #fff;">Quick Links</div>							
									<div class="panel-body">
										<table width="100%">
											<tr>
												<th width="25%"><h6 class="text-center"><a href="<?php echo base_url().'index.php/my_leave/apply_leave' ?>" style="border-style:none;"><img src="<?php echo base_url().'images/manageleave.png'?>" class="img-rounded" width="60px" hristooltip="tooltip" data-original-title="Request a leave."></a></h6></th>
												<?php if($status == 'Probationary'){

												}
												else {?>
												<th width="25%"><h6 class="text-center"><a a href="<?php echo base_url().'index.php/my_medical/apply_medical_assistance' ?>" style="border-style:none;"><img src="<?php echo base_url().'images/medicabenefit.png'?>" class="img-rounded" width="60px" hristooltip="tooltip" data-original-title="Request Medical Assistance."></a></h6></th>
												<?php } ?>
												<?php if($status == 'Probationary' || $employee['employee_type'] == 'Staff'){

												}
												else {?>
												<th width="25%"><h6 class="text-center"><a href="<?php echo base_url().'index.php/my_ranking' ?>" style="border-style:none;"><img src="<?php echo base_url().'images/ranking.png'?>" class="img-rounded" width="60px" hristooltip="tooltip" data-original-title="Check ranking points."></a></h6></th>
												<?php } ?>
												<th width="25%"><h6 class="text-center"><a href="<?php echo base_url().'index.php/my_settings' ?>" style="border-style:none;"><img src="<?php echo base_url().'images/setting.png'?>" class="img-rounded" width="60px" hristooltip="tooltip" data-original-title="Edit my information."></a></h6></th>
											</tr>
											<tr>
												<td width="25%"><h6 class="text-center">Request Leave</h6></td>
												<?php if($status == 'Probationary'){

												}
												else {?>
												<td width="25%"><h6 class="text-center">Request Medical Assistance</h6></td>
												<?php } ?>
												<?php if($status == 'Probationary' || $employee['employee_type'] == 'Staff'){

												}
												else {?>
												<td width="25%"><h6 class="text-center">My Ranking</h6></td>
												<?php } ?>
												<td width="25%"><h6 class="text-center">Settings</h6></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading" style="background-color:#d9544f; color: #fff;">Notifications</div>							
									<div class="panel-body" >
										<div class="row">
											<div class="col-md-6">
												Recent Leave Requests:
												<ul>
													<?php
													if(count($recent_leave) !=0){
														foreach($recent_leave as $r_leave): ?>
															<li><a href="<?php echo base_url().'index.php/my_leave/my_leave_history#request'.$r_leave['leave_id']; ?>" hristooltip="tooltip" data-original-title="<?php echo $r_leave['first_name'].' '.$r_leave['last_name'].' - '.$r_leave['duration'].' day/s ('.$r_leave['type'].')';?>">
																<?php echo date("M d, Y",strtotime($r_leave['date_submitted'])).' - '.$r_leave['type'].' - '.$r_leave['status']; ?></a></li>
													<?php	endforeach;
													}else{
														echo '<li>none</li>';
													}?>
												</ul>
											</div>
											<div class="col-md-6">
												<?php if($status == 'Regular'){?>
												Recent Medical Requests: 
												<ul>
													<?php 
													if(count($recent_medical) !=0){
														foreach($recent_medical as $r_medical): ?>
															<li><a href="<?php echo base_url().'index.php/my_medical/my_medical_history#request'.$r_medical['medical_id']; ?>" hristooltip="tooltip" data-original-title="<?php echo $r_medical['first_name'].' '.$r_medical['last_name'].' - '.number_format((float)$r_medical['amount'], 2, '.', ',');?>">
																<?php echo date("M d, Y",strtotime($r_medical['date_submitted'])).' - '.number_format((float)$r_medical['amount'], 2, '.', ',').' - '.$r_medical['status']; ?></a></li>
													<?php	endforeach;
													}else{
														echo '<li>None</li>';
													}?>
												</ul>
												<?php } ?>
											</div>
										</div>
										<div class="row">
											<hr>
										</div>
										<div class="row">
											<div class="col-md-6">	
												Pending Leave Requests:
												<ul>
													<?php	
													if(count($pending_leave) !=0){
														foreach($pending_leave as $leave): ?>
															<li><a href="<?php echo base_url().'index.php/my_leave/my_pending_request#request'.$leave['leave_id']; ?>" hristooltip="tooltip" data-original-title="<?php echo $leave['first_name'].' '.$leave['last_name'].' - '.$leave['duration'].' day/s ('.$leave['type'].')';?>">
																<?php echo date("M d, Y",strtotime($leave['date_submitted'])).' - '.$leave['type']; ?></a></li>
													<?php	endforeach;
													}else{
														echo '<li>none</li>';
													}
													?>
												</ul>
											</div>
											<div class="col-md-6">
												<?php if($status == 'Regular'){?>
												Pending Medical Requests: 
												<ul>
													<?php 
													if(count($pending_medical) !=0){
														foreach($pending_medical as $medical): ?>
															<li><a href="<?php echo base_url().'index.php/my_medical/my_pending_request#request'.$medical['medical_id']; ?>" hristooltip="tooltip" data-original-title="<?php echo $medical['first_name'].' '.$medical['last_name'].' - '.number_format((float)$medical['amount'], 2, '.', ',');?>">
																<?php echo date("M d, Y",strtotime($medical['date_submitted'])).' - '.number_format((float)$medical['amount'], 2, '.', ','); ?></a></li>
													<?php	endforeach;
													}else{
														echo '<li>None</li>';
													}?>
												</ul>
												<?php }?>
											</div>
										</div>
										<div class="row">
											<hr>
										</div>
										<div class="row">
											<div class="col-md-6">
												<?php if($status == 'Probationary' || $employee['employee_type'] == 'Staff'){

												} 
												else{?>
												Last Ranking:
												<ul>
													<li><?php
													if(count($last_ranking) == 0){
														echo 'None';
													}
													else{
													 echo date('F d, Y', strtotime($last_ranking['rank_date']));
													} ?></li>
												</ul>
												<?php } ?>
											</div>
											<div class="col-md-6">
												<span class="glyphicon glyphicon-gift"></span> Upcoming Birthdays:
												<ul> 
												<?php 
													$year = date('Y');
													$date1 = new DateTime(date('M d Y'));
													$weekfromnow = date("Y-m-d",strtotime("+1 week"));
													$date2 = new DateTime($weekfromnow);
												foreach($upcoming_bday as $bday):
													
													$celebrant = $bday['first_name'].' '.$bday['last_name'];
													if($bday['birthdate'] != null && $bday['first_name'] != null){
														$birthday = new DateTime($year.'-'.$bday['birthdate']);
														$day = $year.'-'.$bday['birthdate'];
														if($date1 <= $birthday && $date2 >= $birthday)
														{
															if($date1 == $birthday){
																echo '<li>Today - '.$celebrant.'</li>';
															}
															else{
															echo '<li>'.date('M d',strtotime($day)).' - '.$celebrant.'</li>';
															}
														}
													}
												endforeach;
												?>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color:#d9544f; color: #fff;" id="calendar">Calendar</div>
							<div class="panel-body" >
								<?php echo $calendar; ?>
							</div>
						</div>
					</div>
					<div class="col-md-5"></div>
				</div>
			</div>
		</div>
	</div>
</div>	