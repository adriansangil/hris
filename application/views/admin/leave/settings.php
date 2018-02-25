<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#4eb84e; color:#fff;">
				<div class="row">
					<div class="col-md-3"><?php echo 'Vacation Leave Settings'?></span>
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-4">
					</div>
				</div>
			</div>	
			<div class="panel-body" style="background-color:#f7f7f7">
				<!-- Alert Message! -->
				<?php if($this->session->flashdata('msg')){ ?>	
				<div class="alert alert-<?php echo $this->session->flashdata('msg2'); ?> alert-dismissable">
			 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div class="text-center"><?php echo $this->session->flashdata('msg'); ?></div>
				</div>
				<?php	} ?>
				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color:#4eb84e; color:#fff;">
								<div class="row">
									<div class="col-md-3"><?php echo 'Staff'?></span>
									</div>
									<div class="col-md-5">
									</div>
									<div class="col-md-4">
									</div>
								</div>
							</div>	
							<div class="panel-body">
								<table class="table table-condensed table-hover">
									<thead>
									<tr>
										<th width="15%"> Status</th>
										<th width="30%"> Length of Service</th>
										<th width="20%"> Max Leave Available</th>
										<th width="20%"> Max Leave Convertible</th>
										<th width="15%"><div class="text-center">Action</div></th>
									</tr>
									</thead>
										<?php foreach ($vacation_settings_staff as $vacation_staff): ?>
									<tr>
										<td><?php echo $vacation_staff['employee_status']; ?></td>
										<td><?php 
											if($vacation_staff['employee_status'] == 'Probationary'){
												echo '--';
											}
											else{
												if($vacation_staff['max_months'] == 999)
												{
													echo $vacation_staff['min_months'].' mos. & above';
												}
													elseif($vacation_staff['max_months'] == null && $vacation_staff['min_months'] == null)
												{
													echo '--';
												}
													else 
												{
													echo $vacation_staff['min_months'].' - '.$vacation_staff['max_months'].' mos.';
												}
											} ?></td>
										<td><?php echo $vacation_staff['max_leave']; ?></td>
										<td><?php echo $vacation_staff['max_convertible']; ?></td>
										<td>
											<div class="text-center"><a href="" data-toggle="modal" data-target="#myModaleditvstaff<?php echo $vacation_staff['base_leave_id']?>"><span class="glyphicon glyphicon-edit"></span><small> Edit</small></a></div>
											<div class="modal fade" id="myModaleditvstaff<?php echo $vacation_staff['base_leave_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  		<div class="modal-dialog">
										   			<div class="modal-content">
										   				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('leave/leave_settings',$attributes) ?>
										      			<div class="modal-header" style="">
										      				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										     				<h4 class="modal-title" id="myModalLabel">Edit this Base Leave Setting?</h4>
										      			</div>
										     			<div class="modal-body">
										     				<div class="form-group">
																<label class="col-sm-4 control-label">Status</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $vacation_staff['employee_status']; ?></p>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-4 control-label">Minimum Month</label> 
																<div class="col-sm-5">
																	<div class="input-group">
																		<input placeholder="min month" value="<?php echo $vacation_staff['min_months']; ?>" class="form-control input-sm" type="input" name="min_month" 
																		<?php if($vacation_staff['employee_status'] == 'Probationary'){
																			echo 'disabled';
																		}?> />
																		<span class="input-group-addon">
															  				<small>Month/s</small>
															  			</span>
														  			</div>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label">Maximum Month</label> 
																<div class="col-sm-5">
																	<div class="input-group">
																		<input placeholder="max month" value="<?php echo $vacation_staff['max_months']; ?>" class="form-control input-sm" type="input" name="max_month" 
																		<?php if($vacation_staff['employee_status'] == 'Probationary'){
																			echo 'disabled';
																		}?> />
																		<span class="input-group-addon">
															  				<small>Month/s</small>
															  			</span>
															  		</div>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label">Max Leave</label> 
																<div class="col-sm-5">
																	<input placeholder="max leave" value="<?php echo $vacation_staff['max_leave']; ?>" class="form-control input-sm" type="input" name="max_leave" />
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-4 control-label">Max Convertible</label> 
																<div class="col-sm-5">
																	<input placeholder="max convertible" value="<?php echo $vacation_staff['max_convertible']; ?>" class="form-control input-sm" type="input" name="max_convertible" />
																</div>
															</div>
										      			</div>
										      			<div class="modal-footer">
										      			<input type="hidden" name="status" value="<?php echo $vacation_staff['employee_status']; ?>">
										      			<input type="hidden" name="base_id" value="<?php echo $vacation_staff['base_leave_id']; ?>">
										      			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										      			<?php if($vacation_staff['employee_status'] == 'Probationary'){?>
										      			<button type="submit" name="edit_base_probation" value="edit_base_probation" class="btn btn-primary">Edit</button>	
										      			<?php }
										      			else{?>
										      			<button type="submit" name="edit_base" value="edit_base" class="btn btn-primary">Edit</button>	
										     			<?php } ?>
										     			</div>
										     			</form>
										   			</div><!-- /.modal-content -->
										  		</div><!-- /.modal-dialog -->
											</div><!-- /.modal -->
										</td>
									
									</tr>
										<?php endforeach ?> 
								</table>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color:#4eb84e; color:#fff;">
								<div class="row">
									<div class="col-md-3"><?php echo 'Faculty'?></span>
									</div>
									<div class="col-md-5">
									</div>
									<div class="col-md-4">
									</div>
								</div>
							</div>
							<div class="panel-body">
								<table class="table table-condensed table-hover">
									<thead>
									<tr>
										<th width="15%"> Status</th>
										<th width="30%"> Length of Service</th>
										<th width="20%"> Max Leave Available</th>
										<th width="20%"> Max Leave Convertible</th>
										<th width="15%"><div class="text-center">Action</div></th>
									</tr>
									</thead>
										<?php foreach ($vacation_settings_faculty as $vacation_faculty): ?>
									<tr>
										<td><?php echo $vacation_faculty['employee_status']; ?></td>
										<td><?php 
										if($vacation_faculty['employee_status'] == 'Probationary'){
												echo '--';
											}
										else{
											if($vacation_faculty['max_months'] == 999)
											{
												echo $vacation_faculty['min_months'].' mos. & above';
											}
												elseif($vacation_faculty['max_months'] == null && $vacation_faculty['min_months'] == null)
											{
												echo '--';
											}
												else 
											{
												echo $vacation_faculty['min_months'].' - '.$vacation_faculty['max_months'].' mos.';
											}
										} ?></td>
										<td><?php echo $vacation_faculty['max_leave']; ?></td>
										<td><?php echo $vacation_faculty['max_convertible']; ?></td>
										<td>
											<div class="text-center"><a href="" data-toggle="modal" data-target="#myModaleditvfaculty<?php echo $vacation_faculty['base_leave_id']?>"><span class="glyphicon glyphicon-edit"></span><small> Edit</small></a></div>
											<div class="modal fade" id="myModaleditvfaculty<?php echo $vacation_faculty['base_leave_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  		<div class="modal-dialog">
										   			<div class="modal-content">
										   				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('leave/leave_settings',$attributes) ?>
										      			<div class="modal-header" style="">
										      				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										     				<h4 class="modal-title" id="myModalLabel">Edit this Base Leave Setting?</h4>
										      			</div>
										     			<div class="modal-body">
										     				<div class="form-group">
																<label class="col-sm-4 control-label">Status</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $vacation_faculty['employee_status']; ?></p>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-4 control-label">Minimum Month</label> 
																<div class="col-sm-5">
																	<div class="input-group">
																		<input placeholder="min month" value="<?php echo $vacation_faculty['min_months']; ?>" class="form-control input-sm" type="input" name="min_month" 
																		<?php if($vacation_faculty['employee_status'] == 'Probationary'){
																			echo 'disabled';
																		}?> />
																		<span class="input-group-addon">
															  				<small>Month/s</small>
															  			</span>
														  			</div>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label">Maximum Month</label> 
																<div class="col-sm-5">
																	<div class="input-group">
																		<input placeholder="max month" value="<?php echo $vacation_faculty['max_months']; ?>" class="form-control input-sm" type="input" name="max_month" 
																		<?php if($vacation_faculty['employee_status'] == 'Probationary'){
																			echo 'disabled';
																		}?> />
																		<span class="input-group-addon">
															  				<small>Month/s</small>
															  			</span>
															  		</div>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label">Max Leave</label> 
																<div class="col-sm-5">
																	<input placeholder="max leave" value="<?php echo $vacation_faculty['max_leave']; ?>" class="form-control input-sm" type="input" name="max_leave" />
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-4 control-label">Max Convertible</label> 
																<div class="col-sm-5">
																	<input placeholder="max convertible" value="<?php echo $vacation_faculty['max_convertible']; ?>" class="form-control input-sm" type="input" name="max_convertible" />
																</div>
															</div>
										      			</div>
										      			<div class="modal-footer">
										      			<input type="hidden" name="status" value="<?php echo $vacation_faculty['employee_status']; ?>">
										      			<input type="hidden" name="base_id" value="<?php echo $vacation_faculty['base_leave_id']; ?>">
										      			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										      			<?php if($vacation_faculty['employee_status'] == 'Probationary'){?>
										      			<button type="submit" name="edit_base_probation" value="edit_base_probation" class="btn btn-primary">Edit</button>	
										      			<?php }
										      			else{?>
										      			<button type="submit" name="edit_base" value="edit_base" class="btn btn-primary">Edit</button>	
										     			<?php } ?>
										     			</div>
										     			</form>
										   			</div><!-- /.modal-content -->
										  		</div><!-- /.modal-dialog -->
											</div><!-- /.modal -->
										</td>
									
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

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#4eb84e; color:#fff;">
				<div class="row">
					<div class="col-md-3"><?php echo 'Sick Leave Settings'?></span>
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-4">
					</div>
				</div>
			</div>	
			<div class="panel-body" style="background-color:#f7f7f7">
				<div class="row">
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color:#4eb84e; color:#fff;">
								<div class="row">
									<div class="col-md-3"><?php echo 'Staff'?></span>
									</div>
									<div class="col-md-5">
									</div>
									<div class="col-md-4">
									</div>
								</div>
							</div>	
							<div class="panel-body">
								<table class="table table-condensed table-hover">
									<thead>
									<tr>
										<th width="15%"> Status</th>
										<th width="30%"> Length of Service</th>
										<th width="20%"> Max Leave Available</th>
										<th width="20%"> Max Leave Convertible</th>
										<th width="15%"><div class="text-center">Action</div></th>
									</tr>
									</thead>
										<?php foreach ($sick_settings_staff as $sick_staff): ?>
									<tr>
										<td><?php echo $sick_staff['employee_status']; ?></td>
										<td><?php
										if($sick_staff['employee_status'] == 'Probationary'){
												echo '--';
											}
										else{
										 	if($sick_staff['max_months'] == 999)
											{
												echo $sick_staff['min_months'].' mos. & above';
											}
												elseif($sick_staff['max_months'] == null && $sick_staff['min_months'] == null)
											{
												echo '--';
											}
												else 
											{
												echo $sick_staff['min_months'].' - '.$sick_staff['max_months'].' mos.';
											}
										} ?></td>
										<td><?php echo $sick_staff['max_leave']; ?></td>
										<td><?php echo $sick_staff['max_convertible']; ?></td>
										<td>
											<div class="text-center"><a href="" data-toggle="modal" data-target="#myModaleditsstaff<?php echo $sick_staff['base_leave_id']?>"><span class="glyphicon glyphicon-edit"></span><small> Edit</small></a></div>
											<div class="modal fade" id="myModaleditsstaff<?php echo $sick_staff['base_leave_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  		<div class="modal-dialog">
										   			<div class="modal-content">
										   				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('leave/leave_settings',$attributes) ?>
										      			<div class="modal-header" style="">
										      				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										     				<h4 class="modal-title" id="myModalLabel">Edit this Base Leave Setting?</h4>
										      			</div>
										     			<div class="modal-body">
										     				<div class="form-group">
																<label class="col-sm-4 control-label">Status</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $sick_staff['employee_status']; ?></p>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-4 control-label">Minimum Month</label> 
																<div class="col-sm-5">
																	<div class="input-group">
																		<input placeholder="min month" value="<?php echo $sick_staff['min_months']; ?>" class="form-control input-sm" type="input" name="min_month" 
																		<?php if($sick_staff['employee_status'] == 'Probationary'){
																			echo 'disabled';
																		}?> />
																		<span class="input-group-addon">
															  				<small>Month/s</small>
															  			</span>
														  			</div>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label">Maximum Month</label> 
																<div class="col-sm-5">
																	<div class="input-group">
																		<input placeholder="max month" value="<?php echo $sick_staff['max_months']; ?>" class="form-control input-sm" type="input" name="max_month" 
																		<?php if($sick_staff['employee_status'] == 'Probationary'){
																			echo 'disabled';
																		}?> />
																		<span class="input-group-addon">
															  				<small>Month/s</small>
															  			</span>
															  		</div>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label">Max Leave</label> 
																<div class="col-sm-5">
																	<input placeholder="max leave" value="<?php echo $sick_staff['max_leave']; ?>" class="form-control input-sm" type="input" name="max_leave" />
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-4 control-label">Max Convertible</label> 
																<div class="col-sm-5">
																	<input placeholder="max convertible" value="<?php echo $sick_staff['max_convertible']; ?>" class="form-control input-sm" type="input" name="max_convertible" />
																</div>
															</div>
										      			</div>
										      			<div class="modal-footer">
										      			<input type="hidden" name="status" value="<?php echo $sick_staff['employee_status']; ?>">
										      			<input type="hidden" name="base_id" value="<?php echo $sick_staff['base_leave_id']; ?>">
										      			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										      			<?php if($sick_staff['employee_status'] == 'Probationary'){?>
										      			<button type="submit" name="edit_base_probation" value="edit_base_probation" class="btn btn-primary">Edit</button>	
										      			<?php }
										      			else{?>
										      			<button type="submit" name="edit_base" value="edit_base" class="btn btn-primary">Edit</button>	
										     			<?php } ?>
										     			</div>
										     			</form>
										   			</div><!-- /.modal-content -->
										  		</div><!-- /.modal-dialog -->
											</div><!-- /.modal -->
										</td>
									
									</tr>
										<?php endforeach ?> 
								</table>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color:#4eb84e; color:#fff;">
								<div class="row">
									<div class="col-md-3"><?php echo 'Faculty'?></span>
									</div>
									<div class="col-md-5">
									</div>
									<div class="col-md-4">
									</div>
								</div>
							</div>
							<div class="panel-body">
								<table class="table table-condensed table-hover">
									<thead>
									<tr>
										<th width="15%"> Status</th>
										<th width="30%"> Length of Service</th>
										<th width="20%"> Max Leave Available</th>
										<th width="20%"> Max Leave Convertible</th>
										<th width="15%"><div class="text-center">Action</div></th>
									</tr>
									</thead>
										<?php foreach ($sick_settings_faculty as $sick_faculty): ?>
									<tr>
										<td><?php echo $sick_faculty['employee_status']; ?></td>
										<td><?php
										if($sick_faculty['employee_status'] == 'Probationary'){
												echo '--';
											}
										else{
										 	if($sick_faculty['max_months'] == 999)
											{
												echo $sick_faculty['min_months'].' mos. & above';
											}
												elseif($sick_faculty['max_months'] == null && $sick_faculty['min_months'] == null)
											{
												echo '--';
											}
												else 
											{
												echo $sick_faculty['min_months'].' - '.$sick_faculty['max_months'].' mos.';
											}
										} ?></td>
										<td><?php echo $sick_faculty['max_leave']; ?></td>
										<td><?php echo $sick_faculty['max_convertible']; ?></td>
										<td>
											<div class="text-center"><a href="" data-toggle="modal" data-target="#myModaleditsfaculty<?php echo $sick_faculty['base_leave_id']?>"><span class="glyphicon glyphicon-edit"></span><small> Edit</small></a></div>
											<div class="modal fade" id="myModaleditsfaculty<?php echo $sick_faculty['base_leave_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  		<div class="modal-dialog">
										   			<div class="modal-content">
										   				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('leave/leave_settings',$attributes) ?>
										      			<div class="modal-header" style="">
										      				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										     				<h4 class="modal-title" id="myModalLabel">Edit this Base Leave Setting?</h4>
										      			</div>
										     			<div class="modal-body">
										     				<div class="form-group">
																<label class="col-sm-4 control-label">Status</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $sick_faculty['employee_status']; ?></p>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-4 control-label">Minimum Month</label> 
																<div class="col-sm-5">
																	<div class="input-group">
																		<input placeholder="min month" value="<?php echo $sick_faculty['min_months']; ?>" class="form-control input-sm" type="input" name="min_month" 
																		<?php if($sick_faculty['employee_status'] == 'Probationary'){
																			echo 'disabled';
																		}?> />
																		<span class="input-group-addon">
															  				<small>Month/s</small>
															  			</span>
														  			</div>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label">Maximum Month</label> 
																<div class="col-sm-5">
																	<div class="input-group">
																		<input placeholder="max month" value="<?php echo $sick_faculty['max_months']; ?>" class="form-control input-sm" type="input" name="max_month" 
																		<?php if($sick_faculty['employee_status'] == 'Probationary'){
																			echo 'disabled';
																		}?> />
																		<span class="input-group-addon">
															  				<small>Month/s</small>
															  			</span>
															  		</div>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label">Max Leave</label> 
																<div class="col-sm-5">
																	<input placeholder="max leave" value="<?php echo $sick_faculty['max_leave']; ?>" class="form-control input-sm" type="input" name="max_leave" />
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-4 control-label">Max Convertible</label> 
																<div class="col-sm-5">
																	<input placeholder="max convertible" value="<?php echo $sick_faculty['max_convertible']; ?>" class="form-control input-sm" type="input" name="max_convertible" />
																</div>
															</div>
										      			</div>
										      			<div class="modal-footer">
										      			<input type="hidden" name="status" value="<?php echo $sick_faculty['employee_status']; ?>">
										      			<input type="hidden" name="base_id" value="<?php echo $sick_faculty['base_leave_id']; ?>">
										      			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										      			<?php if($sick_faculty['employee_status'] == 'Probationary'){?>
										      			<button type="submit" name="edit_base_probation" value="edit_base_probation" class="btn btn-primary">Edit</button>	
										      			<?php }
										      			else{?>
										      			<button type="submit" name="edit_base" value="edit_base" class="btn btn-primary">Edit</button>	
										     			<?php } ?>
										     			</div>
										     			</form>
										   			</div><!-- /.modal-content -->
										  		</div><!-- /.modal-dialog -->
											</div><!-- /.modal -->
										</td>
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