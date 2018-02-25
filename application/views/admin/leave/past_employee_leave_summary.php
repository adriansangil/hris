<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#4eb84e; color:#fff;">
				<div class="row">
					<div class="col-md-5"><?php echo 'Leave Summary Profile - '.$employee['first_name'].' '.$employee['last_name']; ?></span>
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-2">
					</div>
				</div>
			</div>	
			<div class="panel-body" style="background-color:#f7f7f7">
				<div class="well well-sm">
					* For this school year, Eligible for <?php echo $past_sick_leave_settings['max_leave'];?> Sick Leaves with pay (
					<?php echo $past_sick_leave_settings['max_convertible']; ?> 
					maximum convertible) and 
					<?php echo $past_vacation_leave_settings['max_leave'];?> 
					Vacation Leaves with pay (
					<?php echo $past_vacation_leave_settings['max_convertible'];?> Maximum Convertible).
				</div>	
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color:#4eb84e; color:#fff;">
								<div class="row">
									<div class="col-md-3"><?php echo 'S. Y. '.$year['start_year'].' - '.$year['end_year']; ?></span>
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
										echo form_open(base_url().'index.php/leave/employee_leave_summary/'.$id,$attributes); ?>
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
										<th rowspan="2" width="20%"><div class="text-center">DATE</div></th>
										<th colspan="2" width="20%"><div class="text-center">VACATION LEAVE</div></th>
										<th colspan="2" width="20%"><div class="text-center">SICK LEAVE</div></th>
										<th rowspan="2" width="20%"><div class="text-center">OTHERS</div></th>
										<th rowspan="2" width="20%"><div class="text-center">REMARKS</div></th>

									</tr>
									<tr>
										<th width="10%"><div class="text-center">Incurred Leaves</div></th>
										<th width="10%"><div class="text-center">LWOP</div></th>
										<th width="10%"><div class="text-center">Incurred Leaves</div></th>
										<th width="10%"><div class="text-center">LWOP</div></th>
									</tr>
									
									<?php if(count($leave_summary) < 1){ ?>
									<tr>
										<th colspan="7">
											<div class="alert alert-warning">
												<a class="alert-link"><h5 class="text-center"><?php echo $empty; ?></h5></a>
											</div>
										</th>
									</tr>
									<?php } 
										$total_vacation_leave = 0;
										$lwop_vacation = 0;

										$total_sick_leave = 0;
										$lwop_sick = 0;

										$others = 0;

										foreach ($leave_summary as $summary): ?>
									<tr>
										<td><div class="text-center"><?php echo date('M d, Y', strtotime($summary['leave_start_date'])).' - '.date('M d, Y', strtotime($summary['leave_end_date']));?></div></td>
										<?php if($summary['type'] == 'Vacation')
										{ ?>
										<td><div class="text-center">
											<?php 
											$max_leave_remaining = $summary['max_leave'] - $total_vacation_leave;
											if($max_leave_remaining - $summary['duration'] > 0)
											{
												echo $summary['duration'];

												$total_vacation_leave = $total_vacation_leave +$summary['duration'];?>
											</div></td>
										<td></td>
											<?php }
											else{
													if($max_leave_remaining < 0){
													$total_vacation_leave = $total_vacation_leave;
													$max_leave_remaining = 0;
													}
													elseif($max_leave_remaining == 0){

													}
													else{
												echo $max_leave_remaining;
												$total_vacation_leave = $total_vacation_leave + $max_leave_remaining;
												//echo $total_sick_leave;
											}?>
											</div></td>
										<td><div class="text-center">
											<?php echo $summary['duration']- $max_leave_remaining;
												$lwop_vacation = $lwop_vacation + $summary['duration']- $max_leave_remaining;
											}?>
										</div></td>
										<td></td>
										<td></td>
										<td></td>
										<td><div class="text-center"><?php echo $summary['remarks'];?>
										</div></td>
										<?php } ?>

										<?php if($summary['type'] == 'Sick')
										{ ?>
										<td></td>
										<td></td>
										<td><div class="text-center">
											<?php 
											$max_leave_remaining = $summary['max_leave'] - $total_sick_leave;
											if($max_leave_remaining - $summary['duration'] > 0)
											{
												echo $summary['duration'];

												$total_sick_leave = $total_sick_leave +$summary['duration'];?>
											</div></td>
										<td></td>	
											<?php }
											else{
												if($max_leave_remaining < 0){
													$total_sick_leave = $total_sick_leave;
													$max_leave_remaining = 0;
													}
												elseif($max_leave_remaining == 0){

													}
												else{
													echo $max_leave_remaining;
													$total_sick_leave = $total_sick_leave + $max_leave_remaining;
												//echo $total_sick_leave;
												}?>
											</div></td>
										<td><div class="text-center">
											<?php echo $summary['duration']- $max_leave_remaining;
												$lwop_sick = $lwop_sick + $summary['duration']- $max_leave_remaining;
												}?>
										</div></td>
										<td></td>
										<td><div class="text-center"><?php echo $summary['remarks'];?>
										</div></td>
										<?php } ?>

										<?php if($summary['type'] != 'Sick' && $summary['type'] != 'Vacation')
										{ ?>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td><div class="text-center">
										<?php echo $summary['duration'].', '.$summary['type']; 
										$others = $others +  $summary['duration'];?>
										</div></td>
										<td><div class="text-center"><?php echo $summary['remarks'];?>
										</div></td>
										<?php } ?>
									</tr>
									<?php endforeach ?>
									<tr  class="success">
										<th>TOTAL</th>
										<td><div class="text-center"><?php echo $total_vacation_leave; ?> / <?php echo $past_vacation_leave_settings['max_leave'];?></div></td>
										<td><div class="text-center"><?php echo $lwop_vacation; ?></div></td>
										<td><div class="text-center"><?php echo $total_sick_leave; ?> / <?php echo $past_sick_leave_settings['max_leave'];?></div></td>
										<td><div class="text-center"><?php echo $lwop_sick; ?></div></td>
										<td><div class="text-center"><?php echo $others; ?></div></td>
										<td><div class="text-center"></div></td>
									</tr>
								</table>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	