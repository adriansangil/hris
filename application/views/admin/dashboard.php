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
					<div class="text-center">Welcome back, Admin</div>
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
											 <th width="20%"><h6 class="text-center"><a href="<?php echo base_url().'index.php/employee/addemployee' ?>" style="border-style:none;"><img src="<?php echo base_url().'images/adduser.jpg'?>" class="img-rounded" width="60px" label="Add Employee" hristooltip="tooltip" data-original-title="Add a new employee"></a></h6></th>
											 <th width="20%"><h6 class="text-center"><a href="<?php echo base_url().'index.php/leave' ?>" style="border-style:none;"><img src="<?php echo base_url().'images/manageleave.png'?>" class="img-rounded" width="60px" hristooltip="tooltip" data-original-title="Check leave request."></a></h6></th>
											 <th width="20%"><h6 class="text-center"><a href="<?php echo base_url().'index.php/medical' ?>" style="border-style:none;"><img src="<?php echo base_url().'images/medicabenefit.png'?>" class="img-rounded" width="60px" hristooltip="tooltip" data-original-title="Check med assistance request."></a></h6></th>
											 <th width="20%"><h6 class="text-center"><a href="<?php echo base_url().'index.php/ranking' ?>" style="border-style:none;"><img src="<?php echo base_url().'images/ranking.png'?>" class="img-rounded" width="60px" hristooltip="tooltip" data-original-title="Check employee ranking."></a></h6></th>
											 <th width="20%"><h6 class="text-center"><a href="<?php echo base_url().'index.php/settings' ?>" style="border-style:none;"><img src="<?php echo base_url().'images/setting.png'?>" class="img-rounded" width="60px" hristooltip="tooltip" data-original-title="Check admin settings."></a></h6></td>
											</tr>
											<tr>
											<td width="20%"><h6 class="text-center">Add Employee<h6></td>
											<td width="20%"><h6 class="text-center">Manage Leave</h6></td>
											<td width="20%"><h6 class="text-center">Manage Meds</h6></td>
											<td width="20%"><h6 class="text-center">Manage Ranking</h6></td>
											<td width="20%"><h6 class="text-center">Settings</h6></td>
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
									<div class="panel-body">
										<div class="row">
											<div class="col-md-7">
												Pending Leave Requests (<a href="<?php echo base_url().'index.php/leave/pending_leave'?>"><?php echo $pending_leave_count; ?></a>):
												<ul>
													<?php 
													if(count($pending_leave) !=0){
														foreach($pending_leave as $leave): ?>
															<li><a href="<?php echo base_url().'index.php/leave/pending_leave#request'.$leave['leave_id']; ?>" hristooltip="tooltip" data-original-title="<?php echo $leave['first_name'].' '.$leave['last_name'].' - '.$leave['duration'].' day/s ('.$leave['type'].')';?>">
																<?php echo date("M d, Y",strtotime($leave['date_submitted'])).' - '.$leave['type']; ?></a></li>
													<?php	endforeach;
													}
													else{
														echo '<li>None</li>';
													}?>
												</ul>

												Pending Medical Requests (<a href="<?php echo base_url().'index.php/medical/pending_medical_request'?>"><?php echo $pending_medical_count; ?></a>): 
												<ul>
													<?php 
													if(count($pending_medical) !=0){
														foreach($pending_medical as $medical): ?>
															<li><a href="<?php echo base_url().'index.php/medical/pending_medical_request#request'.$medical['medical_id']; ?>" hristooltip="tooltip" data-original-title="<?php echo $medical['first_name'].' '.$medical['last_name'].' - '.number_format((float)$medical['amount'], 2, '.', ',');?>">
																<?php echo date("M d, Y",strtotime($medical['date_submitted'])).' - '.number_format((float)$medical['amount'], 2, '.', ','); ?></a></li>
													<?php	endforeach;
													}else{
														echo '<li>None</li>';
													}?>
												</ul>

												Last Ranking:
												<ul>
													<li><a href="<?php echo base_url().'index.php/ranking/ranking_summary'?>"><?php
													if(count($last_ranking) == 0){
														echo 'None';
													}
													else{
													 echo date('F d, Y', strtotime($last_ranking['rank_date']));
													} ?></a></li>
												</ul>
											</div>
											<div class="col-md-5">
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
							<div class="panel-heading" style="background-color:#d9544f; color: #fff;" hristooltip="tooltip" data-original-title="The calendar also contains the holidays listed on the holiday settings." id="calendar">Calendar</div>
							<div class="panel-body">
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