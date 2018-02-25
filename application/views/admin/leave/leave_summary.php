<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#4eb84e; color:#fff;">
				<div class="row">
					<div class="col-md-5"><span><?php echo 'Leave Summary for All Employees'?></span>
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-2"></div>
				</div>
			</div>	
			<div class="panel-body" style="background-color:#f7f7f7">	
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color:#4eb84e; color:#fff;">
								<div class="row">
									<div class="col-md-3"><?php if(count($year)<1){echo 'No school year was setup yet!';} else{echo 'S. Y. '.$year['start_year'].' - '.$year['end_year'];} ?></span>
									</div>
									<div class="col-md-5">
									</div>
									<div class="col-md-4">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">&nbsp;</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="text-center">
										<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
										echo form_open(base_url().'index.php/leave/leave_summary',$attributes); ?>
										<div class="form-group">
											<div class="col-sm-offset-4 col-sm-4">
												<div class="input-group">
														<select class="form-control input-sm" name="search_year_id">				
															<?php foreach ($all_academic_year as $all_year): ?>
															<option value="<?php echo $all_year['academic_year_id'];?>"><?php echo 'S. Y. '.$all_year['start_year'].' - '.$all_year['end_year'];?></option>
															<?php endforeach ?>
														</select>
													<span class="input-group-btn"><button type="submit" name="submit" class="btn btn-sm btn-default">Search</button></span>
												</div>
											</div>
										</div>
										</form>
									</div>
								</div>
							</div>	
							<div class="panel-body">
								<table class="table table-bordered table-condensed table-hover">
									<tr>
										<th rowspan="2" width="20%"><div class="text-center">EMPLOYEE NAME</div></th>
										<th rowspan="2" width="15%"><div class="text-center">TYPE</div></th>
										<th rowspan="2" width="15%"><div class="text-center">STATUS</div></th>
										<th colspan="2" width="20%"><div class="text-center">VACATION LEAVE</div></th>
										<th colspan="2" width="20%"><div class="text-center">SICK LEAVE</div></th>
										<th rowspan="2" width="10%"><div class="text-center">OTHERS</div></th>
									</tr>
									<tr>
										<th width="10%"><div class="text-center">Incurred Leaves</div></th>
										<th width="10%"><div class="text-center">Leave without Pay</div></th>
										<th width="10%"><div class="text-center">Incurred Leaves</div></th>
										<th width="10%"><div class="text-center">Leave without Pay</div></th>
									</tr>
									
									<?php if(count($leave_summary) < 1){ ?>
									<tr>
										<th colspan="8">
											<div class="alert alert-warning">
												<a class="alert-link"><h5 class="text-center"><?php echo $empty; ?></h5></a>
											</div>
										</th>
									</tr>
									<?php } foreach ($leave_summary as $summary):?>
									<tr>
										<td><div class="text-center"><a href="<?php echo base_url().'index.php/leave/employee_leave_summary/'.$summary['employee_id'];?>"><?php echo $summary['first_name'].' '.$summary['last_name']; ?></a></div></td>
										<td><div class="text-center"><?php echo $summary['employee_type'];?></div></td>
										<td><div class="text-center"><?php echo $summary['employee_status'];?></div></td>
										<td><div class="text-center"><?php echo $summary['vl'];?> / 
											<?php
											foreach($vacation_base_leave as $vacation_leave): 

												$date1 = new DateTime($summary['work_start']);
												$current_date = new DateTime(date('M d Y'));

												$interval = $date1->diff($current_date);
												$months = ($interval->format('%y') * 12) + $interval->format('%m');

												if($summary['employee_status'] == $vacation_leave['employee_status'] && $summary['employee_type_id'] == $vacation_leave['employee_type_id'] && $vacation_leave['min_months'] <= $months && $vacation_leave['max_months'] > $months)
												{
													echo $vacation_leave['max_leave'];
												}
												endforeach; ?></div></td>
										<td><div class="text-center"><?php echo $summary['vl_lwop'];?></div></td>
										<td><div class="text-center"><?php echo $summary['sl'];?> / 
											<?php
											foreach($sick_base_leave as $sick_leave): 

												$date1 = new DateTime($summary['work_start']);
												$current_date = new DateTime(date('M d Y'));

												$interval = $date1->diff($current_date);
												$months = ($interval->format('%y') * 12) + $interval->format('%m');

												if($summary['employee_status'] == $sick_leave['employee_status'] && $summary['employee_type_id'] == $sick_leave['employee_type_id'] && $sick_leave['min_months'] <= $months && $sick_leave['max_months'] > $months)
												{
													echo $sick_leave['max_leave'];
												}
												endforeach; ?></div></td>
										<td><div class="text-center"><?php echo $summary['sl_lwop'];?></div></td>
										<td><div class="text-center"><?php echo $summary['others'];?></div></td>
									</tr>
									<?php endforeach ?>
								</table>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	