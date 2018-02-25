<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>
<div class="row">
<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#337bb8; color: #fff;">
				<div class="row">
					<div class="col-md-3">My Profile Information</div>
					<div class="col-md-5"></div>
				</div>
			</div>
			<div class="panel-body" style="background-color:#f7f7f7">
				<div class="row">
					<div class="col-md-2">
						<div class="row">
							<div class="col-md-12">
								<a href="" data-toggle="modal" data-target="#myModal">
								<img src="<?php echo base_url().'images/uploads/'.$employee['display_picture']; ?>" alt="user-image" class="img-thumbnail" width="165px;" style="min-height:165px;height:165px;">
								</a>
								<!-- modal-->
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
											echo form_open_multipart('my_profile',$attributes) ?>
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title" id="myModalLabel">Change Profile Picture?</h4>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="col-md-offset-3 col-md-8">
														<input type="file" name="userfile" size="20" />
														<span class="help-block"><small><br />
															* image type allowed: jpg,jpeg,png,gif <br />
															&nbsp; favorable dimension: 200 x 200 or anything square<br />
															&nbsp; max dimension: 800 x 800 <br />
															&nbsp; max size limit: 2mb
														</small>
														</span>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
													<button type="submit" name="upload" value="upload" class="btn btn-primary btn-sm">Upload</button>
												</div>
											</form>	
										</div>
									</div>
								</div>
								<!-- end modal-->
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">&nbsp;</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="text-center">
									<a href="" data-toggle="modal" data-target="#myModal" type="button" class="btn btn-default btn-sm"><small><span class="glyphicon glyphicon-pencil"></span> Edit Profile Picture</small></a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-10">
						<div class="row">
							<div class="col-md-12">
								<!-- Alert Message-->
								<?php if($this->session->flashdata('msgpass')){ ?>
								<div class="alert alert-<?php echo $this->session->flashdata('msg2');?> alert-dismissable">
							 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									<div class="text-center"><?php echo $this->session->flashdata('msgpass'); ?></div>
								</div>
								<?php	} ?>
								<div class="panel-group" id="accordion">
									<div class="panel panel-default">
									    <div class="panel-heading" style="background-color:#337bb8; color: #fff;">
									      	<h4 class="panel-title">
									        	<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									          	Personal Information
									        	</a>
									      	</h4>
									    </div>
									   	<div id="collapseOne" class="panel-collapse collapse in">
									      	<div class="panel-body">
									        	<table width="50%">
													<tr>
														<td width="40%" >Name:</td>
														<td><?php echo $employee['first_name'].' '.$employee['middle_name'].' '.$employee['last_name'];?></td>
													</tr>
													<tr>
														<td>Address: </td>
														<td><?php echo $employee['address'];?></td>
													</tr>
													<tr>
														<td>Gender: </td>
														<td><?php echo $employee['gender'];?></td>
													</tr>
													<tr>
														<td>Birthday: </td>
														<td><?php echo date('M d, Y',strtotime($employee['birthdate']));?></td>
													</tr>
													<tr>
														<td>Mobile Number:</td>
														<td><?php echo $employee['mobile_num'];?></td>
													</tr>
													<tr>
														<td>Email address:</td>
														<td><?php echo $employee['work_email'];?></td>
													</tr>
												</table>
      										</div>
									    </div>
									</div>
									<div class="panel panel-default">
									    <div class="panel-heading" style="background-color:#337bb8; color: #fff;">
									      	<h4 class="panel-title">
									        	<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									        	Job Details
									       		</a>
									      	</h4>
									    </div>
									    <div id="collapseTwo" class="panel-collapse collapse">
									      	<div class="panel-body">
        										<table width="50%">
													<tr>
														<td width="40%">Employee Type:</td>
														<td><?php echo $employee['employee_type'];?></td>
													</tr>
													<tr>
														<td>Position:</td>
														<td><?php echo $employee['position'];?></td>
													</tr>
													<tr>
														<td>Status:</td>
														<td><?php echo $employee['employee_status'];?></td>
													</tr>
													<tr>
														<td>Start Date:</td>
														<td><?php echo date('F d, Y', strtotime($employee['start_date']));?></td>
													</tr>
												</table>
										    </div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading" style="background-color:#337bb8; color: #fff;">
										    <h4 class="panel-title">
										        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
										        My Leave
										        </a>
										    </h4>
										</div>
										<div id="collapseFour" class="panel-collapse collapse">
									      	<div class="panel-body">
									      		<div class="row">
									      			<div class="col-md-10">
															* Eligible for <?php echo $current_sick_leave_settings['max_leave']; ?> Sick Leaves w/ pay (<?php echo $current_sick_leave_settings['max_convertible']; ?> max convertible) and <?php echo $current_vacation_leave_settings['max_leave']; ?> Vacation Leaves w/ pay (<?php echo $current_vacation_leave_settings['max_convertible']; ?> Max Convertible).
									      			</div>
									      			<div class="col-md-2">
									      				<div class="text-right"><a href="<?php echo base_url().'index.php/leave/employee_leave_summary/'.$employee['employee_id'] ?>" class="btn btn-default btn-sm" role="button">Leave Summary</a></div>
									      			</div>
									      		</div>
									      	<table width="75%">
													<tr>
														<th>Leave Type</th>
														<th><div class="text-center">Used / Max</div></th>
														<th><div class="text-center">LWOP</div></th>
														<th><div class="text-center">Convertible</div></th>
													</tr>
													<tr>
														<td>Sick</td>
														<td><div class="text-center"><?php echo $employee_record['sl']?> / <?php echo $current_sick_leave_settings['max_leave']; ?></div></td>
														<td><div class="text-center"><?php echo $employee_record['sl_lwop']?></div></td>
														<td><div class="text-center"><?php echo $current_sick_leave_settings['max_convertible']; ?></div></td>
													</tr>
													<tr>
														<td>Vacation</td>
														<td><div class="text-center"><?php echo $employee_record['vl']?>  / <?php echo $current_vacation_leave_settings['max_leave']; ?></div></td>
														<td><div class="text-center"><?php echo $employee_record['vl_lwop']?> </div></td>
														<td><div class="text-center"><?php echo $current_vacation_leave_settings['max_convertible']; ?></div></td>
													</tr>
													<tr>
														<td>Others</td>
														<td><div class="text-center"><?php echo $employee_record['others']?> / --</div></td>
														<td><div class="text-center">--</div></td>
														<td><div class="text-center">--</div></td>
													</tr>
												</table>
	      									</div>
									    </div>
									</div>
									<?php if($employee['employee_status'] == 'Regular'){ ?>
									<div class="panel panel-default">
										<div class="panel-heading" style="background-color:#337bb8; color: #fff;">
										    <h4 class="panel-title">
										        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
										        My Medical Assistance Benefit
										        </a>
										    </h4>
										</div>
										<div id="collapseFive" class="panel-collapse collapse">
									      	<div class="panel-body">
									      		<div class="row">
									      			<div class="col-md-8">
															* Eligible for <?php echo number_format((float)$current_medical_settings['max_benefit'], 2, '.', ','); ?> amount of Medical Assistance Benefit.
									      			</div>
									      			<div class="col-md-4">
									      				<div class="text-right"><a href="<?php echo base_url().'index.php/medical/employee_medical_summary/'.$employee['employee_id'] ?>" class="btn btn-default btn-sm" role="button">Medical Assistance Summary</a></div>
									      			</div>
									      		</div>
									      	<table width="75%">
													<tr>
														<th><div class="text-center">Amount Used</div></th>
														<th><div class="text-center">Amount Entitled</div></th>
														<th><div class="text-center">Amount Left</div></th>
													</tr>
													<tr>
														<td><div class="text-center"><?php echo number_format((float)$employee_medical_record['benefit_consumed'], 2, '.', ',');?></div></td>
														<td><div class="text-center"><?php echo number_format((float)$current_medical_settings['max_benefit'], 2, '.', ','); ?></div></td>
														<td><div class="text-center"><?php $balance = $current_medical_settings['max_benefit'] - $employee_medical_record['benefit_consumed'];
														echo number_format((float)$balance, 2, '.', ',');?></div></td>
													</tr>
											</table>
	      									</div>
									    </div>
									</div>
									<?php }
									else{ ?>
									<div class="panel panel-default">
										<div class="panel-heading" style="background-color:#337bb8; color: #fff;">
										    <h4 class="panel-title"><a> My Medical Assistance Benefit - Not Eligible
										    </a></h4>
										</div>
									</div>
									<?php }?>
									<?php if($employee['employee_status'] == 'Regular' && $employee['employee_type'] == 'Faculty'){ ?>
									<div class="panel panel-default">
										<div class="panel-heading" style="background-color:#337bb8; color: #fff;">
										    <h4 class="panel-title">
										        <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
										        My Ranking
										        </a>
										    </h4>
										</div>
										<div id="collapseSix" class="panel-collapse collapse">
									      	<div class="panel-body">
									      		<div class="row">
									      			<div class="col-md-8">
													* Summary of total points earned and possible rank in next ranking.
									      			</div>
									      			<div class="col-md-4">
									      				<div class="text-right"><a href="<?php echo base_url().'index.php/my_ranking' ?>" class="btn btn-default btn-sm" role="button">Ranking Summary</a></div>
									      			</div>
									      		</div>
									      	<table width="85%">
													<tr>
														<th width="50%">Criteria</th>
														<th width="15%"><div class="text-center">Points</div></th>
														<th width="15%"><div class="text-center">Multiplier</div></th>
														<th width="20%"><div class="text-center">Points Earned</div></th>
													</tr>
													<tr>
														<td><?php echo 'Educational Attainment';?></td>
														<td><div class="text-center"><?php echo $educ_total; ?></div></td>
														<td><div class="text-center"><?php echo number_format((float) $educ_multiplier['weight'], 2, '.', ''); ?></div></td>
														<td><div class="text-center"><?php $educ_points = $educ_total*$educ_multiplier['weight'];
														echo $educ_points;?></div></td>
													</tr>
													<tr>
														<td><?php echo 'Work Experience';?></td>
														<td><div class="text-center"><?php echo $work_total; ?></div></td>
														<td><div class="text-center"><?php echo number_format((float) $work_multiplier['weight'], 2, '.', ''); ?></div></td>
														<td><div class="text-center"><?php $work_points = $work_total*$work_multiplier['weight'];
														echo $work_points;?></div></td>
													</tr>
													<tr>
														<td><?php echo 'Certifications or Board or Government Examination Passed';?></td>
														<td><div class="text-center"><?php echo $cert_total; ?></div></td>
														<td><div class="text-center"><?php echo number_format((float) $cert_multiplier['weight'], 2, '.', ''); ?></div></td>
														<td><div class="text-center"><?php $cert_points = $cert_total*$cert_multiplier['weight'];
														echo $cert_points;?></div></td>
													</tr>
													<tr>
														<td colspan="4">&nbsp;</td>
													</tr>
													<tr>
														<th colspan="3"><?php echo 'Overall Points Earned';?></th>
														<th><div class="text-center"><?php $overall_total = $educ_points + $work_points + $cert_points;
														echo $overall_total; ?></div></th>
													</tr>
													<tr>
														<td colspan="4">&nbsp;</td>
													</tr>
													<tr>
														<th colspan="3">Possible Rank in next ranking:</th>
														<th><div class="text-center"><?php 
														//faculty ranking
														if($employee['employee_type'] == 'Faculty'){
															if(count($highest_education_attained) == 0){
																echo 'No educational attainment: Cannot determine rank';
															}
															else{
																$rank = $lowest_fac_rank['faculty_rank_description'].' '.$lowest_fac_rank['level'];
																$teach_year = $faculty_teach_duration/12;
																foreach($reference as $ref):
																	if($ref['managerial_exp'] == NULL){
																		if($highest_education_attained['education_level_id'] >= $ref['education_requirement_id'] && $overall_total >= $ref['min_point_range_f'] && $teach_year >= $ref['teaching_exp']){
																			$rank = $ref['faculty_rank_description'].' '.$ref['level'];
																		}
																	}
																	else{
																		if($highest_education_attained['education_level_id'] >= $ref['education_requirement_id'] && $overall_total >= $ref['min_point_range_f'] && ($teach_year >= $ref['teaching_exp'] || $employee['managerial_exp'] >= $ref['managerial_exp'])) {
																			$rank = $ref['faculty_rank_description'].' '.$ref['level'];
																		}
																	}
																endforeach;

																echo $rank;
															}
														}
														//staff ranking
														else{
															$rank = $lowest_staff_rank['job_description'].' '.$lowest_staff_rank['level'];
															if($employee['staff_job_grade_id'] == 1 || $employee['staff_job_grade_id'] == 2 || $employee['staff_job_grade_id'] == 7 ||$employee['staff_job_grade_id'] == 8){
																if($employee['staff_job_grade_id'] == 1){
																	echo $unskilled['job_description'];
																}
																if($employee['staff_job_grade_id'] == 2){
																	echo $semiskilled['job_description'];
																}
																if($employee['staff_job_grade_id'] == 7 || $employee['staff_job_grade_id'] == 8){
																	echo $management['job_description'];
																}
															}
															else
															{
															foreach($staff_reference as $ref):
																if($overall_total >= $ref['min_point_range']){
																	$rank = $ref['job_description'].' '.$ref['level'];
																}
															endforeach;

															echo $rank;
															}
														}
														?></div></th>
													</tr>
											</table>
	      									</div>
									    </div>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>