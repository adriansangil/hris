<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#56b4d0; color: #fff;">
				<div class="row">
					<div class="col-md-3"><?php echo 'Medical Assistance Benefit Settings'?></span>
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-4">
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-md-12">
					<p style="color:red;"><small> &nbsp; &nbsp;* Editing the length of service range here will also change the range on the previous and next brackets accordingly.</small></p>
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
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color:#56b4d0; color: #fff;">
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
										<th width="25%"> Length of Service</th>
										<th width="25%"> Max Benefit Available</th>
										<th width="15%"><div class="text-center">Action</div></th>
									</tr>
									</thead>
										<?php foreach ($medical_settings_staff as $medical_staff): ?>
									<tr>
										<td><?php echo $medical_staff['employee_status']; ?></td>
										<td><?php if($medical_staff['max_months'] == 999)
											{
												echo $medical_staff['min_months'].' mos. & above';
											}
												elseif($medical_staff['max_months'] == null && $medical_staff['min_months'] == null)
											{
												echo '--';
											}
												else 
											{
												echo $medical_staff['min_months'].' - '.$medical_staff['max_months'].' mos.';
											} ?></td>
										<td><?php echo number_format((float)$medical_staff['max_benefit'], 2, '.', ','); ?></td>
										<td>
											<div class="text-center"><a href="" data-toggle="modal" data-target="#myModaleditstaff<?php echo $medical_staff['base_benefit_id']?>"><span class="glyphicon glyphicon-edit"></span><small> Edit</small></a></div>
											<div class="modal fade" id="myModaleditstaff<?php echo $medical_staff['base_benefit_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  		<div class="modal-dialog">
										   			<div class="modal-content">
										   				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('medical/medical_settings',$attributes) ?>
										      			<div class="modal-header" style="">
										      				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										     				<h4 class="modal-title" id="myModalLabel">Edit this Base Medical Benefit Setting?</h4>
										      			</div>
										     			<div class="modal-body">
										     				<div class="form-group">
																<label class="col-sm-4 control-label">Status</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $medical_staff['employee_status']; ?></p>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-4 control-label">Minimum Month</label> 
																<div class="col-sm-5">
																	<div class="input-group">
																		<input placeholder="min month" value="<?php echo $medical_staff['min_months']; ?>" class="form-control input-sm" type="input" name="min_month" 
																		<?php if($medical_staff['employee_status'] == 'Probationary'){
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
																		<input placeholder="max month" value="<?php echo $medical_staff['max_months']; ?>" class="form-control input-sm" type="input" name="max_month" 
																		<?php if($medical_staff['employee_status'] == 'Probationary'){
																			echo 'disabled';
																		}?> />
																		<span class="input-group-addon">
															  				<small>Month/s</small>
															  			</span>
															  		</div>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label">Max Benefit</label> 
																<div class="col-sm-5">
																	<input placeholder="max benefit" value="<?php echo number_format((float)$medical_staff['max_benefit'], 2, '.', ''); ?>" class="form-control input-sm" type="input" name="max_benefit" />
																</div>
															</div>
										      			</div>
										      			<div class="modal-footer">
											      			<input type="hidden" name="status" value="<?php echo $medical_staff['employee_status']; ?>">
											      			<input type="hidden" name="base_id" value="<?php echo $medical_staff['base_benefit_id']; ?>">
											      			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											      			<?php if($medical_staff['employee_status'] == 'Probationary'){?>
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
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color:#56b4d0; color: #fff;">
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
										<th width="25%"> Length of Service</th>
										<th width="25%"> Max Benefit Available</th>
										<th width="15%"><div class="text-center">Action</div></th>
									</tr>
									</thead>
										<?php foreach ($medical_settings_faculty as $medical_faculty): ?>
									<tr>
										<td><?php echo $medical_faculty['employee_status']; ?></td>
										<td><?php if($medical_faculty['max_months'] == 999)
											{
												echo $medical_faculty['min_months'].' mos. & above';
											}
												elseif($medical_faculty['max_months'] == null && $medical_faculty['min_months'] == null)
											{
												echo '--';
											}
												else 
											{
												echo $medical_faculty['min_months'].' - '.$medical_faculty['max_months'].' mos.';
											} ?></td>
										<td><?php echo number_format((float)$medical_faculty['max_benefit'], 2, '.', ','); ?></td>
										<td>
											<div class="text-center"><a href="" data-toggle="modal" data-target="#myModaleditfaculty<?php echo $medical_faculty['base_benefit_id']?>"><span class="glyphicon glyphicon-edit"></span><small> Edit</small></a></div>
											<div class="modal fade" id="myModaleditfaculty<?php echo $medical_faculty['base_benefit_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										  		<div class="modal-dialog">
										   			<div class="modal-content">
										   				<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('medical/medical_settings',$attributes) ?>
										      			<div class="modal-header" style="">
										      				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										     				<h4 class="modal-title" id="myModalLabel">Edit this Base Medical Benefit Setting?</h4>
										      			</div>
										     			<div class="modal-body">
										     				<div class="form-group">
																<label class="col-sm-4 control-label">Status</label> 
																<div class="col-sm-7">
																	<p class="form-control-static"><?php echo $medical_faculty['employee_status']; ?></p>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-4 control-label">Minimum Month</label> 
																<div class="col-sm-5">
																	<div class="input-group">
																		<input placeholder="min month" value="<?php echo $medical_faculty['min_months']; ?>" class="form-control input-sm" type="input" name="min_month" 
																		<?php if($medical_faculty['employee_status'] == 'Probationary'){
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
																		<input placeholder="max month" value="<?php echo $medical_faculty['max_months']; ?>" class="form-control input-sm" type="input" name="max_month" 
																		<?php if($medical_faculty['employee_status'] == 'Probationary'){
																			echo 'disabled';
																		}?> />
																		<span class="input-group-addon">
															  				<small>Month/s</small>
															  			</span>
															  		</div>
																</div>
															</div>
										        			<div class="form-group">
																<label class="col-sm-4 control-label">Max Benefit</label> 
																<div class="col-sm-5">
																	<input placeholder="max benefit" value="<?php echo number_format((float)$medical_faculty['max_benefit'], 2, '.', ''); ?>" class="form-control input-sm" type="input" name="max_benefit" />
																</div>
															</div>
										      			</div>
										      			<div class="modal-footer">
											      			<input type="hidden" name="status" value="<?php echo $medical_faculty['employee_status']; ?>">
											      			<input type="hidden" name="base_id" value="<?php echo $medical_faculty['base_benefit_id']; ?>">
											      			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											      			<?php if($medical_faculty['employee_status'] == 'Probationary'){?>
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