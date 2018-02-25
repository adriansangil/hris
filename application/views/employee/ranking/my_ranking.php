<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#f79f1f; color:#fff;">
				<div class="row">
					<div class="col-md-5"><?php echo 'My Ranking Profile'; ?></span>
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-2"><div class="text-right">Status: <?php echo $status ?></div>
					</div>
				</div>
			</div>	
			<div class="panel-body" style="background-color:#f7f7f7;">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color:#f79f1f; color:#fff;">
								<div class="row">
									<div class="col-md-5">Educational Attainment</div>
									<div class="col-md-2"></div>
									<div class="col-md-5">
										<div class="text-right">
										</div>
									</div>
								</div>
							</div>	
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12">
										<table width="100%" class="table table-condensed table-hover">
											<tr>
												<th width="25%" colspan="1">Course</th>
												<th width="30%">Education Level</th>
												<th width="25%">Details</th>
												<th width="20%"><div class="text-center">Points</div></th>
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
											</tr>
										<?php
											$educ_total = $educ_total + $summary['educ_points'];
										 endforeach; ?>
										 	<tr>
												<td colspan="4" style="border-top:0px">&nbsp;</td>
											</tr>
											<tr class="success">
												<th colspan="3">Total Points Earned:</th>
												<th colspan="1"><div class="text-center"><?php echo $educ_total; ?></div></th>
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
										</div>
									</div>
								</div>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12">
										<table width="100%" class="table table-condensed table-hover">
											<tr>
												<th width="25%" colspan="1">Employer</th>
												<th width="30%">Work Type</th>
												<th width="25%">Duration</th>
												<th width="20%"><div class="text-center">Date</div></th>
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
														$staff_work_duration = $staff_work_duration + $length_of_service;
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
											</tr>
										<?php endforeach; ?>
											<tr>
												<td colspan="4" style="border-top:0px">&nbsp;</td>
											</tr>
											<tr>
												<td colspan="4" style="border-top:0px"><!-- TOTAL-->Total Work Experience:  <?php 
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
												<th colspan="3"><!-- TOTAL-->Total Points Earned:  
														
												</th>
												<th colspan="1">
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
												</div>
											</div>
										</div>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<table width="100%" class="table table-condensed table-hover">
													<tr>
														<th width="25%" colspan="1">Certificate / Exam</th>
														<th width="30%">Type</th>
														<th width="25%">Details</th>
														<th width="20%"><div class="text-center">Points</div></th>
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
													</tr>
													
													<?php 
													$certification_total = $certification_total + $summary['cert_points'];
													endforeach; ?>
													<tr>
														<td colspan="4" style="border-top:0px">&nbsp;</td>
													</tr>
													<tr>
														<td colspan="4" style="border-top:0px">Base points: <?php 
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
														<th colspan="3"><!-- TOTAL-->Total Points Earned:  
																
														</th>
														<th colspan="1">
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
													$rank = $employee['position'].' - '.$lowest_staff_rank['job_description'].' '.$lowest_staff_rank['level'];
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
						</div>
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
