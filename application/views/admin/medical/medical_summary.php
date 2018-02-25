<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#56b4d0; color: #fff;">
				<div class="row">
					<div class="col-md-5"><span><?php echo 'Medical Assistance Benefits Summary for All Employees'?></span>
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
							<div class="panel-heading" style="background-color:#56b4d0; color: #fff;">
								<div class="row">
									<div class="col-md-3"><?php if(count($year)<1){echo 'No school year was setup yet!';} else{echo 'Year: '.$year['current_year'];} ?></span>
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
										echo form_open(base_url().'index.php/medical/medical_summary',$attributes); ?>
										<div class="form-group">
											<div class="col-sm-offset-4 col-sm-4">
												<div class="input-group">
														<select class="form-control input-sm" name="search_year_id">				
															<?php foreach ($all_year as $year): ?>
															<option value="<?php echo $year['year_id'];?>"><?php echo $year['current_year'];?></option>
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
								<table class="table table-striped table-bordered table-condensed table-hover">
									<tr>
										<th rowspan="2" width="25%"><div class="text-center">EMPLOYEE NAME</div></th>
										<th rowspan="2" width="15%"><div class="text-center">TYPE</div></th>
										<th rowspan="2" width="15%"><div class="text-center">STATUS</div></th>
										<th colspan="2" width="30%"><div class="text-center">MEDICAL ASSISTANCE BENEFIT</div></th>
									</tr>
									<tr>
										<th width="15%"><div class="text-center">Availed / Max</div></th>
										<th width="15%"><div class="text-center">Balance</div></th>

									</tr>

									<?php if(count($medical_summary) < 1){ ?>
									<tr>
										<th colspan="8">
											<div class="alert alert-warning">
												<a class="alert-link"><h5 class="text-center"><?php echo $empty; ?></h5></a>
											</div>
										</th>
									</tr>
									<?php } foreach ($medical_summary as $summary):?>
									<tr>
										<td><div class="text-center"><a href="<?php echo base_url().'index.php/medical/employee_medical_summary/'.$summary['employee_id'];?>"><?php echo $summary['first_name'].' '.$summary['last_name']; ?></a></div></td>
										<td><div class="text-center"><?php echo $summary['employee_type'];?></div></td>
										<td><div class="text-center"><?php echo $summary['employee_status'];?></div></td>
										<td><div class="text-center"><?php echo number_format((float)$summary['benefit_consumed'], 2, '.', ',');?> / 
											<?php
											foreach($base_benefit as $benefit): 

												$date1 = new DateTime($summary['work_start']);
												$current_date = new DateTime(date('M d Y'));

												$interval = $date1->diff($current_date);
												$months = ($interval->format('%y') * 12) + $interval->format('%m');

												if($summary['employee_status'] == $benefit['employee_status'] && $summary['employee_type_id'] == $benefit['employee_type_id'] && $benefit['min_months'] <= $months && $benefit['max_months'] > $months)
												{
													echo number_format((float)$benefit['max_benefit'], 2, '.', ',');
												}
												endforeach; ?>

										</div></td>
										<td><div class="text-center">
												<?php
											foreach($base_benefit as $benefit): 

												$date1 = new DateTime($summary['work_start']);
												$current_date = new DateTime(date('M d Y'));

												$interval = $date1->diff($current_date);
												$months = ($interval->format('%y') * 12) + $interval->format('%m');

												if($summary['employee_status'] == $benefit['employee_status'] && $summary['employee_type_id'] == $benefit['employee_type_id'] && $benefit['min_months'] <= $months && $benefit['max_months'] > $months)
												{
													$balance = $benefit['max_benefit']-$summary['benefit_consumed'];
													echo number_format((float)$balance, 2, '.', ',');
												}
												endforeach; ?>

										</div></td>
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