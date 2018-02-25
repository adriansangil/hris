<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#f79f1f; color:#fff;">
				<div class="row">
					<div class="col-md-5"><?php echo 'Ranking Profile - '.$employee['first_name'].' '.$employee['last_name']; ?></span>
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-2"><div class="text-right">Status: <?php echo $status ?></div>
					</div>
				</div>
			</div>	
			<div class="panel-body" style="background-color:#f7f7f7;">
				<?php if($this->session->flashdata('msg')){ ?>
				<div class="alert alert-<?php echo $this->session->flashdata('msg2');?> alert-dismissable">
			 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div class="text-center"><?php echo $this->session->flashdata('msg'); ?></div>
				</div>
				<?php	} ?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color:#f79f1f; color:#fff;">
								<div class="row">
									<div class="col-md-5">Educational Attainment</div>
									<div class="col-md-2"></div>
									<div class="col-md-5">
										<div class="text-right">
											<a href="" data-toggle="modal" data-target="#myModalAddEducation" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-plus"></span></a>
										</div>
									</div>
								</div>
							</div>	
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12">
										<table width="100%" class="table table-condensed table-hover">
											<tr>
												<th width="20%" colspan="1">Course</th>
												<th width="30%">Education Level</th>
												<th width="20%">Details</th>
												<th width="19%"><div class="text-center">Points</div></th>
												<th width="11%" colspan="2"><div class="text-center">Action</div></th>
											</tr>
											<?php  if(count($education_summary) < 1){ ?>
											<tr>
												<th colspan="7">
													<div class="alert alert-warning">
														<a class="alert-link"><h5 class="text-center"><?php echo $empty; ?></h5></a>
													</div>
												</th>
											</tr> 
											<?php } 

											$educ_total = 0;

											foreach($education_summary as $summary):?>
											<tr>
												<td><small><?php echo $summary['course_description'];?><small></td>
												<td><small><?php echo $summary['level_description'];?><small></td>
												<td><small><?php echo $summary['detail'];?><small></td>
												<td><small><div class="text-center"><?php echo $summary['educ_points'];?></div><small></td>
												<td width="5%"><a href="" data-toggle="modal" data-target="#myModaledit<?php echo $summary['education_id'];?>"><div><small><span class="glyphicon glyphicon-edit"></span> edit</small></a>
													<div class="modal fade" id="myModaledit<?php echo $summary['education_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												  		<div class="modal-dialog">
												   			<div class="modal-content">
												   				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
																echo form_open('ranking/employee_ranking/'.$summary['employee_id'],$attributes) ?>
												      			<div class="modal-header" style="">
												      				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												     				<h4 class="modal-title" id="myModalLabel">Edit this Educational Attainment?</h4>
												      			</div>
												     			<div class="modal-body">
												     				<div class="form-group">
																		<label class="col-sm-4 control-label">Course</label> 
																		<div class="col-sm-7">
																			<input placeholder="description" value="<?php echo $summary['course_description'];?>" class="form-control input-sm" type="input" name="course" />
																		</div>
																	</div>
												     				<div class="form-group">
																		<label class="col-sm-4 control-label">Education Level</label> 
																		<div class="col-sm-7">

																			<select class="form-control input-sm" name="educ_attain">
																				<option value="<?php echo $summary['educational_attainment_id'];?>" selected="selected"><?php echo $summary['level_description'].' - '.$summary['detail'];?></option>				
																				<?php foreach ($education_setting as $setting): ?>
																					<?php if($employee['employee_type'] == $setting['employee_type']){ 
																						if($summary['educational_attainment_id']==$setting['educational_attainment_id']){
																						}
																						else
																						{ ?>
																						<option value="<?php echo $setting['educational_attainment_id'];?>"><?php echo $setting['level_description'].' - '.$setting['detail'];?></option>
																					<?php }
																					 }?>
																				<?php endforeach ?>
																			</select>
																		</div>
																	</div>
												      			</div>
												      			<div class="modal-footer">
												      			<input type="hidden" name="educ_id" value="<?php echo $summary['education_id'];?>">
												      			<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
												      			<button type="submit" name="edit_educ" class="btn btn-primary btn-sm" value="edit_educ" >Edit</button>	
												     			</div>
										     					</form>
													   		</div><!-- /.modal-content -->
													  	</div><!-- /.modal-dialog -->
													</div><!-- /.modal -->
												<small></td>
												<td width="6%"><a href="" data-toggle="modal" data-target="#myModaldelete<?php echo $summary['education_id'];?>"><small><span class="glyphicon glyphicon-trash"></span> delete</small></a>
													<div class="modal fade" id="myModaldelete<?php echo $summary['education_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																	<h4 class="modal-title" id="myModalLabel">Delete this Educational Attainment?</h4>
																</div>
																<div class="modal-body">
																	<table width="100%">
																		<tr>
																			<td><small>Course:</small></td>
																			<td><small><?php echo  $summary['course_description'];?></small></td>
																		</tr>
																		<tr>
																			<td><small>Education Level:</small></td>
																			<td><small><?php echo $summary['level_description'];?></small></td>
																		</tr>
																		<tr>
																			<td><small>Details:</small></td>
																			<td><small><?php echo $summary['detail'];?></small></td>
																		</tr>
																	</table>	
																</div>
																<div class="modal-footer">
																	<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
																	<a href="<?php echo base_url().'index.php/ranking/delete_education_attainment/'.$summary['education_id'];?>" class="btn btn-danger btn-sm" role="button">Delete</a>
																</div>
															</div>
														</div>
													</div>
												</td>		
											</tr>
										<?php
											$educ_total = $educ_total + $summary['educ_points'];
										 endforeach; ?>
										 	<tr>
												<td colspan="6" style="border-top:0px">&nbsp;</td>
											</tr>
											<tr class="success">
												<th colspan="4">Total Points Earned:</th>
												<th colspan="2"><div class="text-center"><?php echo $educ_total; ?></div></th>
											</tr>
										</table>
									</div>
								</div>	
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color:#f79f1f; color:#fff;">
								<div class="row">
									<div class="col-md-5">Work Experience</div>
									<div class="col-md-2"></div>
									<div class="col-md-5">
										<div class="text-right">
											<a href="" data-toggle="modal" data-target="#myModalAddExperience" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-plus"></span></a>
										</div>
									</div>
								</div>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12">
										<table width="100%" class="table table-condensed table-hover">
											<tr>
												<th width="20%" colspan="1">Employer</th>
												<th width="30%">Work Type</th>
												<th width="20%">Duration</th>
												<th width="19%"><div class="text-center">Date</div></th>
												<th width="11%" colspan="2"><div class="text-center">Action</div></th>
											</tr>
											<!-- current work-->
											<?php 
											//initialize work duration to zero; both faculty and staff
											$staff_work_duration = 0;
											$faculty_teach_duration = 0;
											$faculty_industry_duration = 0;

											foreach($current_work_summary as $summary): ?>
											<tr>
												<td><small>Iligan Computer Institute</small></td>
												<td><small><?php if($summary['employee_type'] == 'Staff'){
													echo 'Industry ('.$summary['employee_type'].')';
													}else{
														echo 'Teaching ('.$summary['employee_type'].')'; 
												} ?>
												<small></td>
												<td><small>
												<?php 
													$start_date = new DateTime($summary['type_start_date']);
													if($summary['type_end_date'] == null){
														$end_date = new DateTime(date('M d Y'));
													}
													else{
														$end_date = new DateTime($summary['type_end_date']);
													}
													$interval = $start_date->diff($end_date);
													$length_of_service = ($interval->format('%y') * 12) + $interval->format('%m');

													//convert length of service
													if($length_of_service < 12){
														if($length_of_service <= 1){
															echo $length_of_service.' month';
														}
														else{
														echo $length_of_service.' months';
														}
													}
													else{
														$years =(int) ($length_of_service / 12);
														$months = $length_of_service % 12;

														if($years > 1){
															$end_year = 'years';
														}
														else{
															$end_year = 'year';
														}

														if($months > 1){
															$end_month = 'months';
														}
														else{
															$end_month = 'month';
														}

														if($months == 0){
															echo $years.' '.$end_year;
														}
														else{
															echo $years.' '.$end_year.', '.$months.' '.$end_month;
														}
													}
													//add work length to staff
													if($employee['employee_type'] == 'Staff'){
														$staff_work_duration = $staff_work_duration + $length_of_service;
													}
													//add work length to faculty
													else{
														if($summary['employee_type'] == 'Staff'){ // faculty industry
															$faculty_industry_duration = $faculty_industry_duration + $length_of_service;
														}
														else{
															$faculty_teach_duration = $faculty_teach_duration + $length_of_service;
														}
													}
												?>
												<small></td>
												<td><small><div class="text-center"><?php echo date('M d, Y', strtotime($summary['type_start_date'])); ?><small></div></td>
												<td colspan="2"><div class="text-center"></div><small></td>
											</tr>
											<?php endforeach; ?>

											<!-- previous work --> 
											<?php  foreach($prev_work_summary as $summary):?>
											<tr>
												<td><small><?php echo $summary['employer'];?></small></td>
												<td><small><?php echo $summary['work_type'];?></small></td>
												<td><small>
													<?php 
													if($summary['work_duration'] < 12){
														if($summary['work_duration'] <= 1){
															echo $summary['work_duration'].' month';
														}
														else{
														echo $summary['work_duration'].' months';
														}
													}
													else{
														$years =(int) ($summary['work_duration'] / 12);
														$months = $summary['work_duration'] % 12;

														if($years > 1){
															$end_year = 'years';
														}
														else{
															$end_year = 'year';
														}

														if($months > 1){
															$end_month = 'months';
														}
														else{
															$end_month = 'month';
														}

														if($months == 0){
															echo $years.' '.$end_year;
														}
														else{
															echo $years.' '.$end_year.', '.$months.' '.$end_month;
														}
													}
													//add work length to staff
													if($employee['employee_type'] == 'Staff'){
														$staff_work_duration = $staff_work_duration + $summary['work_duration'];
													}
													//add work length to faculty
													else{
														if($summary['work_type'] == 'Industry'){ // faculty industry
															$faculty_industry_duration = $faculty_industry_duration + $summary['work_duration'];
														}
														else{	//faculty teaching
															$faculty_teach_duration = $faculty_teach_duration + $summary['work_duration'];
														}
													}
													 ?>
												</small></td>
												<td><small><div class="text-center"><?php echo date('M d, Y', strtotime($summary['previous_work_start_date'])); ?></small></div></td>
												<td width="5%"><a href="" data-toggle="modal" data-target="#myModaleditwork<?php echo $summary['work_id'];?>"><div><small><span class="glyphicon glyphicon-edit"></span> edit</small></a>
													<div class="modal fade" id="myModaleditwork<?php echo $summary['work_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												  		<div class="modal-dialog">
												   			<div class="modal-content">
												   				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
																echo form_open('ranking/employee_ranking/'.$summary['employee_id'],$attributes) ?>
												      			<div class="modal-header" style="">
												      				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												     				<h4 class="modal-title" id="myModalLabel">Edit this Work Experience?</h4>
												      			</div>
												     			<div class="modal-body">
												     				<div class="form-group">
																		<label class="col-sm-4 control-label">Employer</label> 
																		<div class="col-sm-7">
																			<input placeholder="employer" value="<?php echo $summary['employer'];?>" class="form-control input-sm" type="input" name="employer" />
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Work Type</label> 
																		<div class="col-sm-7">
																			<select class="form-control input-sm" name="work_type">
																				<option value="<?php echo $summary['work_type_experience_id'];?>" selected="selected"><?php echo $summary['work_type'];?></option>				
																				<?php foreach ($work_type as $type): 
																					if($summary['work_type'] == $type['work_type']){
																					}else
																					{?>
																					<option value="<?php echo $type['work_type_experience_id'];?>"><?php echo $type['work_type'];?></option>
																					<?php } ?>
																				<?php endforeach ?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Work Duration</label> 
																		<div class="col-sm-7">
																			<div class="input-group">
																				<input placeholder="duration" value="<?php echo $summary['work_duration'];?>" class="form-control input-sm" type="input" name="duration" />
																				<span class="input-group-addon">
														  							<small>Month/s</small>
														  						</span>
																			</div>
																			<span class="help-block"><small>* Input are in months: ex. 12 = 12mos.</small></span>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Start Date</label>
																		<div class="col-sm-7">
																			<div class="input-group datetimepickeredit">
														 						<input data-format="MM/dd/yyyy" type="text" class="form-control input-sm" placeholder="mm/dd/yyyy" name="startdate" value="<?php echo $summary['previous_work_start_date'];?>">
														  						<span class="input-group-addon">
														  							<span class="glyphicon glyphicon-calendar"></span>
														  						</span>
																			</div>
																		</div>
																	</div>
												      			</div>
												      			<div class="modal-footer">
												      			<input type="hidden" name="work_id" value="<?php echo $summary['work_id'];?>">
												      			<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
												      			<button type="submit" name="edit_work" class="btn btn-primary btn-sm" value="edit_work" >Edit</button>	
												     			</div>
										     					</form>
													   		</div><!-- /.modal-content -->
													  	</div><!-- /.modal-dialog -->
													</div><!-- /.modal -->
												</td>
												<td width="6%"><a href="" data-toggle="modal" data-target="#myModaldeletework<?php echo $summary['work_id'];?>"><div><small><span class="glyphicon glyphicon-trash"></span> delete</small></a>
													<div class="modal fade" id="myModaldeletework<?php echo $summary['work_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																	<h4 class="modal-title" id="myModalLabel">Delete this Work Experience?</h4>
																</div>
																<div class="modal-body">
																	<table width="100%">
																		<tr>
																			<td><small>Employer:</small></td>
																			<td><small><?php echo  $summary['employer'];?></small></td>
																		</tr>
																		<tr>
																			<td><small>Work Type:</small></td>
																			<td><small><?php echo $summary['work_type'];?></small></td>
																		</tr>
																		<tr>
																			<td><small>Duration:</small></td>
																			<td><small><?php echo $summary['work_duration'];?></small></td>
																		</tr>
																		<tr>
																			<td><small>Start Date:</small></td>
																			<td><small><?php echo date('M d, Y', strtotime($summary['previous_work_start_date']));?></small></td>
																		</tr>
																	</table>	
																</div>
																<div class="modal-footer">
																	<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
																	<a href="<?php echo base_url().'index.php/ranking/delete_work_experience/'.$summary['work_id'];?>" class="btn btn-danger btn-sm" role="button">Delete</a>
																</div>
															</div>
														</div>
													</div>
												</td>
											</tr>
										<?php endforeach; ?>
											<tr>
												<td colspan="6" style="border-top:0px">&nbsp;</td>
											</tr>
											<tr>
												<td colspan="6" style="border-top:0px"><!-- TOTAL-->Total Work Experience:  <?php 
													if($employee['employee_type'] == 'Staff'){
														$total = $staff_work_duration;
														echo $total.' months';
													}
													else{ 
														$total = $faculty_teach_duration + (int) ($faculty_industry_duration/2);
														echo $total.' months ('.$faculty_teach_duration.' months <small> Total Teaching Experience</small> + ('.$faculty_industry_duration.' months <small>Total Industry Experience</small> / 2 ))';
													}?>
												<small></td>
											</tr>
											<tr class="success">
												<th colspan="4"><!-- TOTAL-->Total Points Earned:  
														
												</th>
												<th colspan="2">
													<div class="text-center">
													<?php foreach($work_points as $points):
														if($total >= $points['work_min_months'] && $total < $points['work_max_months']){
															$work_total = $points['work_points'];
															echo $work_total;
														}
														endforeach; ?>
													</div>
												</th>
											</tr>
										</table>
									</div>
								</div>		
							</div>	
						</div><!-- end panel -->
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading" style="background-color:#f79f1f; color:#fff;">
										<div class="row">
											<div class="col-md-5">Certifications or Board or Government Examination Passed</div>
											<div class="col-md-2"></div>
											<div class="col-md-5">
												<div class="text-right">
													<a href="" data-toggle="modal" data-target="#myModalAddCertificate" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-plus"></span></a>
												</div>
											</div>
										</div>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<table width="100%" class="table table-condensed table-hover">
													<tr>
														<th width="20%" colspan="1">Certificate / Exam</th>
														<th width="30%">Type</th>
														<th width="20%">Details</th>
														<th width="19%"><div class="text-center">Points</div></th>
														<th width="11%" colspan="2"><div class="text-center">Action</div></th>
													</tr>
													<?php  if(count($certification_summary) < 1){ ?>
														<tr>
															<th colspan="7">
																<div class="alert alert-warning">
																	<a class="alert-link"><h5 class="text-center"><?php echo 'No Certification or Examination Passed Added.'; ?></h5></a>
																</div>
															</th>
														</tr> 
													<?php } 

													$certification_total = 0;

													foreach($certification_summary as $summary):?>
													<tr>
														<td><?php echo $summary['cert_board_description']; ?></td>
														<td><?php echo $summary['cert_type']; ?></td>
														<td><?php echo $summary['cert_detail']; ?></td>
														<td><div class="text-center"><?php echo $summary['cert_points']; ?></div></td>
														<td width="5%"><a href="" data-toggle="modal" data-target="#myModaleditcertification<?php echo $summary['certification_board_acquired_id'];?>"><div><small><span class="glyphicon glyphicon-edit"></span> edit</small></a>
															<div class="modal fade" id="myModaleditcertification<?php echo $summary['certification_board_acquired_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
														  		<div class="modal-dialog">
														   			<div class="modal-content">
														   				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
																		echo form_open('ranking/employee_ranking/'.$summary['employee_id'],$attributes) ?>
														      			<div class="modal-header" style="">
														      				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														     				<h4 class="modal-title" id="myModalLabel">Edit this Certification/Exam passed?</h4>
														      			</div>
														     			<div class="modal-body">
														     				<div class="form-group">
																				<label class="col-sm-4 control-label">Certification/Exam</label> 
																				<div class="col-sm-7">
																					<input placeholder="certification/exam" value="<?php echo $summary['cert_board_description'];?>" class="form-control input-sm" type="input" name="cert_description" />
																				</div>
																			</div>
																			<div class="form-group">
																				<label class="col-sm-4 control-label">Type</label> 
																				<div class="col-sm-7">				
																					<select class="form-control input-sm" name="cert_type">
																						<option value="<?php echo $summary['certification_board_id'];?>" selected><?php echo $summary['cert_type'].' - '.$summary['cert_detail'];?></option>				
																						<?php foreach ($cert_exam_setting as $setting): ?>
																							<?php if($employee['employee_type'] == $setting['employee_type']){ 
																								if($summary['certification_board_id'] == $setting['certification_board_id']){

																								}
																								else{?>
																								<option value="<?php echo $setting['certification_board_id'];?>"><?php echo $setting['cert_type'].' - '.$setting['cert_detail'];?></option>
																							<?php }
																						}?>
																						<?php endforeach ?>
																					</select>
																				</div>
																			</div>
														      			</div>
														      			<div class="modal-footer">
														      			<input type="hidden" name="cert_id" value="<?php echo $summary['certification_board_acquired_id'];?>">
														      			<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
														      			<button type="submit" name="edit_cert" class="btn btn-primary btn-sm" value="edit_cert" >Edit</button>	
														     			</div>
												     					</form>
															   		</div><!-- /.modal-content -->
															  	</div><!-- /.modal-dialog -->
															</div><!-- /.modal -->
														</td>
														<td width="6%"><a href="" data-toggle="modal" data-target="#myModaldeletecertification<?php echo $summary['certification_board_acquired_id'];?>"><div><small><span class="glyphicon glyphicon-trash"></span> delete</small></a>
															<div class="modal fade" id="myModaldeletecertification<?php echo $summary['certification_board_acquired_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																<div class="modal-dialog">
																	<div class="modal-content">
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																			<h4 class="modal-title" id="myModalLabel">Delete this Certification/Exam passed?</h4>
																		</div>
																		<div class="modal-body">
																			<table width="100%">
																				<tr>
																					<td><small>Certificate/Exam:</small></td>
																					<td><small><?php echo  $summary['cert_board_description'];?></small></td>
																				</tr>
																				<tr>
																					<td><small>Type:</small></td>
																					<td><small><?php echo $summary['cert_type'];?></small></td>
																				</tr>
																				<tr>
																					<td><small>Details:</small></td>
																					<td><small><?php echo $summary['cert_detail'];?></small></td>
																				</tr>
																				<tr>
																					<td><small>Points:</small></td>
																					<td><small><?php echo $summary['cert_points'];?></small></td>
																				</tr>
																			</table>	
																		</div>
																		<div class="modal-footer">
																			<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
																			<a href="<?php echo base_url().'index.php/ranking/delete_cert_board/'.$summary['certification_board_acquired_id'];?>" class="btn btn-danger btn-sm" role="button">Delete</a>
																		</div>
																	</div>
																</div>
															</div>
														</td>
													</tr>
													
													<?php 
													$certification_total = $certification_total + $summary['cert_points'];
													endforeach; ?>
													<tr>
														<td colspan="6" style="border-top:0px">&nbsp;</td>
													</tr>
													<tr>
														<td colspan="6" style="border-top:0px">Base points: <?php 
														if(count($certification_summary) > 0){
															$base = $base_certificate['base_points'];
															echo $base_certificate['base_points'];
															}
															else{
															$base = 0;
															}
															?> (acquired with at least 1 certification or examination passed.)</td>
													</tr>
													<tr class="success">
														<th colspan="4"><!-- TOTAL-->Total Points Earned:  
																
														</th>
														<th colspan="2">
															<div class="text-center">
															<?php $certification_total = $certification_total + $base; //sample base points 
																echo $certification_total; ?>
															</div>
														</th>
													</tr>
												</table>
											</div>
										<div>
									</div>
								</div>
							</div>	
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading" style="background-color:#f79f1f; color:#fff;">
										<div class="row">
											<div class="col-md-5">Point Calculation</div>
											<div class="col-md-2"></div>
											<div class="col-md-5">
											</div>
										</div>
									</div>	
									<div class="panel-body">
										<table width="100%" class="table table-condensed table-hover">
											<tr>
												<th width="40%">Criteria</th>
												<th width="20%"><div class="text-center">Points</div></th>
												<th width="20%"><div class="text-center">Multiplier</div></th>
												<th width="20%"><div class="text-center">Points Earned</div></th>
											</tr>
											<tr>
												<td>Educational Attainment</td>
												<td><div class="text-center"><?php echo $educ_total; ?></div></td>
												<td><div class="text-center"><?php echo number_format((float) $educ_multiplier['weight'], 2, '.', ''); ?></div></td>
												<td><div class="text-center"><?php 
													$earned_educ = $educ_total*$educ_multiplier['weight'];
													echo $earned_educ;
												?></td>
											</tr>
											<tr>
												<td>Work Experience</td>
												<td><div class="text-center"><?php echo $work_total; ?></div></td>
												<td><div class="text-center"><?php echo number_format((float)$work_multiplier['weight'], 2, '.', ''); ?></div></td>
												<td><div class="text-center"><?php 
													$earned_work = $work_total*$work_multiplier['weight'];
													echo $earned_work;
												?></td>
											</tr>
											<tr>
												<td>Certifications or Board or Government Examination Passed</td>
												<td><div class="text-center"><?php echo $certification_total; ?></div></td>
												<td><div class="text-center"><?php echo number_format((float)$cert_multiplier['weight'], 2, '.', ''); ?></div></td>
												<td><div class="text-center"><?php 
													$earned_cert = $certification_total*$cert_multiplier['weight'];
													echo $earned_cert;
												?></td>
											</tr>
											<tr>
												<td colspan="4" style="border-top:0px">&nbsp;</td>
											</tr>
											<tr class="success">
												<th colspan="3">Overall Points Earned:</th>
												<th colspan="1"><div class="text-center"><?php 
												$overall_total = $earned_educ + $earned_work + $earned_cert;
												echo $overall_total; ?></div></th>
											</tr>
											<tr class="success">
												<th colspan="1">Possible Rank in next ranking:</th>
												<th colspan="3"><?php 
												//faculty ranking
												if($employee['employee_type'] == 'Faculty'){
													if(count($highest_education_attained) == 0){
														echo 'No educational attainment graduated yet: Cannot determine rank';
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
												?></th>
											</tr>
										</table>											
									</div>
								</div>
							</div>
						</div><!--end panel -->
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading" style="background-color:#f79f1f; color:#fff;">
										<div class="row">
											<div class="col-md-5">Ranking History</div>
											<div class="col-md-2"></div>
											<div class="col-md-5">
											</div>
										</div>
									</div>	
									<div class="panel-body">
										<table width="100%" class="table table-condensed table-hover table-bordered">
											<tr>
												<th width="20%"><div class="text-center">Date</div></th>
												<th colspan="2" width="15%"><div class="text-center">Educational Attainment</div></th>
												<th colspan="2" width="15%"><div class="text-center">Work Experience</div></th>
												<th colspan="2" width="15%"><div class="text-center">Certifications/Exams Passed</div></th>
												<th width="10%"><div class="text-center">Total Points</div></th>
												<th width="15%"><div class="text-center">Ranking</div></th>
												<th width="10%"><div class="text-center">Salary</div></th>
											</tr>
											<?php
											if(count($rank_history) <1){ ?>
											<tr>
												<td colspan="10">
													<div class="alert alert-warning">
														<a class="alert-link"><h5 class="text-center"><?php echo 'No Rank History Yet!'; ?></h5></a>
													</div>
												</td>
											</tr> 
											<?php }
											else{
											 foreach($rank_history as $history):?>
											<tr>
												<td><div class="text-center"><?php echo date('F d, Y', strtotime($history['rank_date']));?></div></td>
												<td><div class="text-center"><?php echo $history['educ_attain'];?></div></td>
												<td class="success"><div class="text-center"><?php echo $history['educ_attain']*$history['educ_multiplier'];?></div></td>
												<td><div class="text-center"><?php echo $history['work_exp'];?></div></td>
												<td class="success"><div class="text-center"><?php echo $history['work_exp']*$history['work_multiplier'];?></div></td>
												<td><div class="text-center"><?php echo $history['cert_passed'];?></div></td>
												<td class="success"><div class="text-center"><?php echo $history['cert_passed']*$history['cert_multiplier'];?></div></td>
												<td><div class="text-center"><?php echo $history['total_rank_points'];?></div></td>
												<td><div class="text-center"><?php echo $history['rank_position'];?></div></td>
												<td><div class="text-center"><?php echo number_format((float)$history['rank_salary'], 2, '.', ',');?></div></td>
											</tr>
											<?php endforeach;
											} ?>
										</table>											
									</div>
								</div>
							</div>
						</div><!--end panel -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	

<!-- Modals-->
<!-- Add educ -->
<div class="modal fade" id="myModalAddEducation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
			echo form_open('ranking/employee_ranking/'.$employee['employee_id'],$attributes) ?>
			<div class="modal-header" style="">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Add Educational Attainment?</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-sm-4 control-label">Course</label> 
					<div class="col-sm-7">
						<input placeholder="course" value="" class="form-control input-sm" type="input" name="course" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Education Level</label> 
					<div class="col-sm-7">
						<select class="form-control input-sm" name="educ_attain">				
							<?php foreach ($education_setting as $setting): ?>
								<?php if($employee['employee_type'] == $setting['employee_type']){ ?>
									<option value="<?php echo $setting['educational_attainment_id'];?>"><?php echo $setting['level_description'].' - '.$setting['detail'];?></option>
								<?php }?>
							<?php endforeach ?>
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
				<button type="submit" name="add_educ" class="btn btn-primary btn-sm" value="add_educ" >Add</button>	
			</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- add work exp -->
<div class="modal fade" id="myModalAddExperience" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
			echo form_open('ranking/employee_ranking/'.$employee['employee_id'],$attributes) ?>
			<div class="modal-header" style="">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Add Work Experience?</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-sm-4 control-label">Employer</label> 
					<div class="col-sm-7">
						<input placeholder="employer" value="" class="form-control input-sm" type="input" name="employer" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Work Type</label> 
					<div class="col-sm-7">
						<select class="form-control input-sm" name="work_type">				
							<?php foreach ($work_type as $type): ?>
								<option value="<?php echo $type['work_type_experience_id'];?>"><?php echo $type['work_type'];?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Work Duration</label> 
					<div class="col-sm-7">
						<div class="input-group">
							<input placeholder="duration" value="" class="form-control input-sm" type="input" name="duration" />
							<span class="input-group-addon">
	  							<small>Month/s</small>
	  						</span>
						</div>
						<span class="help-block"><small>* Input are in months: ex. 12 = 12mos.</small></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Start Date</label>
					<div class="col-sm-7">
						<div class="input-group datetimepickeredit">
	 						<input data-format="MM/dd/yyyy" type="text" class="form-control input-sm" placeholder="mm/dd/yyyy" name="startdate" value="">
	  						<span class="input-group-addon">
	  							<span class="glyphicon glyphicon-calendar"></span>
	  						</span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
				<button type="submit" name="add_exp" class="btn btn-primary btn-sm" value="add_exp" >Add</button>	
			</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Add certificate -->
<div class="modal fade" id="myModalAddCertificate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
			echo form_open('ranking/employee_ranking/'.$employee['employee_id'],$attributes) ?>
			<div class="modal-header" style="">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Add Certification or Examination Passed?</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-sm-4 control-label">Certificate/Exam</label> 
					<div class="col-sm-7">
						<input placeholder="certification/exam" value="" class="form-control input-sm" type="input" name="exam" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Type</label> 
					<div class="col-sm-7">
						<select class="form-control input-sm" name="exam_type">				
							<?php foreach ($cert_exam_setting as $setting): ?>
								<?php if($employee['employee_type'] == $setting['employee_type']){ ?>
									<option value="<?php echo $setting['certification_board_id'];?>"><?php echo $setting['cert_type'].' - '.$setting['cert_detail'];?></option>
								<?php }?>
							<?php endforeach ?>
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
				<button type="submit" name="add_cert" class="btn btn-primary btn-sm" value="add_cert" >Add</button>	
			</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->