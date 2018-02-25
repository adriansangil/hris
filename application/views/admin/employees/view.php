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
											echo form_open_multipart('employee/view/'.$employee['employee_id'],$attributes) ?>
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
							<?php if($this->session->flashdata('msg1')){ ?>
							<div class="alert alert-<?php echo $this->session->flashdata('msg2');?> alert-dismissable">
						 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<div class="text-center"><?php echo $this->session->flashdata('msg1'); ?></div>
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
									      		<div class="row">
									      			<div class="col-md-9">
									      			</div>
									      			<div class="col-md-3">
									      				<div class="text-right"><a href="" data-toggle="modal" data-target="#ModalPassword" class="btn btn-default btn-sm" role="button">Assign new Password</a></div>
									      			</div>
									      		</div>
									        	<table width="50%">
													<tr>
														<td width="40%" >Name:</td>
														<td><?php echo $employee['first_name'].' '.$employee['middle_name'].' '.$employee['last_name'];?></td>
														<td width="10%"><div class="text-center"> <a href="" data-toggle="modal" data-target="#myModaledit1"><small><span class="glyphicon glyphicon-edit"></span> Edit</small></a></div>
															<div class="modal fade" id="myModaledit1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																<div class="modal-dialog">
																	<div class="modal-content">
																	<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
																	echo form_open(base_url().'index.php/employee/view/'.$employee['employee_id'],$attributes) ?>
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																			<h4 class="modal-title" id="myModalLabel">Edit Name</h4>
																		</div>
																		<div class="modal-body">
																				<div class="form-group">
																					<label class="col-sm-4 control-label">First Name</label> 
																					<div class="col-sm-7">
																						<input placeholder="First Name" value="<?php echo $employee['first_name']; ?>" class="form-control input-sm" type="input" name="fname" />
																					</div>
																				</div>
																				<div class="form-group">
																					<label class="col-sm-4 control-label">Middle Name</label> 
																					<div class="col-sm-7">
																						<input placeholder="Middle Name" value="<?php echo $employee['middle_name']; ?>" class="form-control input-sm" type="input" name="mname" />
																					</div>
																				</div>
																				<div class="form-group">
																					<label class="col-sm-4 control-label">Last Name</label>
																					<div class="col-sm-7">
																						<input placeholder="Last Name" value="<?php echo $employee['last_name']; ?>" class="form-control input-sm" type="input" name="lname" />
																					</div>
																				</div>
																				
																			<!--<button type="submit" class="btn btn-default" name="submit">Add Employee</button>-->
																		</div>
																		<div class="modal-footer">
																			<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
																			<button type="submit" name="edit_name" value="edit_name" class="btn btn-primary btn-sm">Edit</button>
																		</div>
																		</form>	
																	</div>
																</div>
															</div>
														</td>
													</tr>
													<tr>
														<td>Address: </td>
														<td><?php echo $employee['address'];?></td>
														<td width="10%"><div class="text-center"> <a href="" data-toggle="modal" data-target="#myModaledit2"><small><span class="glyphicon glyphicon-edit"></span> Edit</small></a></div>
															<div class="modal fade" id="myModaledit2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																<div class="modal-dialog">
																	<div class="modal-content">
																		<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
																		echo form_open(base_url().'index.php/employee/view/'.$employee['employee_id'],$attributes) ?>
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																			<h4 class="modal-title" id="myModalLabel">Edit Address</h4>
																		</div>
																		<div class="modal-body">
																				<div class="form-group">
																					<label class="col-sm-4 control-label">Address</label> 
																					<div class="col-sm-7">
																						<input placeholder="Address" value="<?php echo $employee['address']; ?>" class="form-control input-sm" type="input" name="addr" />
																					</div>
																				</div>
																		</div>
																		<div class="modal-footer">
																			<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
																			<button type="submit" name="edit_addr" value="edit_addr" class="btn btn-primary btn-sm">Edit</button>
																		</div>
																		</form>	
																	</div>
																</div>
															</div>
														</td>
													</tr>
													<tr>
														<td>Gender: </td>
														<td><?php echo $employee['gender'];?></td>
														<td width="10%"><div class="text-center"> <a href="" data-toggle="modal" data-target="#myModaledit3"><small><span class="glyphicon glyphicon-edit"></span> Edit</small></a></div>
															<div class="modal fade" id="myModaledit3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																<div class="modal-dialog">
																	<div class="modal-content">
																		<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
																		echo form_open(base_url().'index.php/employee/view/'.$employee['employee_id'],$attributes) ?>
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																			<h4 class="modal-title" id="myModalLabel">Edit Gender</h4>
																		</div>
																		<div class="modal-body">
																				<div class="form-group">
																					<label class="col-sm-4 control-label">Gender</label> 
																					<div class="col-sm-7">
																						<select name="gender" class="form-control">				
																							<option value="Male" name="gender">Male</option>
																							<option value="Female" name="gender">Female</option>
																						</select>
																					</div>
																				</div>
																			<!--<button type="submit" class="btn btn-default" name="submit">Add Employee</button>-->
																		</div>
																		<div class="modal-footer">
																			<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
																			<button type="submit" name="edit_gender" value="edit_gender" class="btn btn-primary btn-sm">Edit</button>
																		</div>
																		</form>	
																	</div>
																</div>
															</div>
														</td>
													</tr>
													<tr>
														<td>Birthday:</td>
														<td><?php echo date('M d, Y',strtotime($employee['birthdate'])); ?></td>
														<td width="10%"><div class="text-center"> <a href="" data-toggle="modal" data-target="#myModaleditbday"><small><span class="glyphicon glyphicon-edit"></span> Edit</small></a></div>
															<div class="modal fade" id="myModaleditbday" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																<div class="modal-dialog">
																	<div class="modal-content">
																		<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
																		echo form_open(base_url().'index.php/employee/view/'.$employee['employee_id'],$attributes) ?>
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																			<h4 class="modal-title" id="myModalLabel">Edit Birthdate</h4>
																		</div>
																		<div class="modal-body">
																			<div class="form-group">
																				<label class="col-sm-4 control-label">Birthdate</label>
																				<div class="col-sm-7">
																					<div class="input-group datetimepickeredit">
					 																	<input data-format="MM/dd/yyyy" type="text" class="form-control input-sm" placeholder="mm/dd/yyyy" name="birthdate" value="" />
					  																	<span class="input-group-addon">
					  																		<span class="glyphicon glyphicon-calendar"></span>
					  																	</span>
																					</div>
																				</div>
																			</div>
																		</div>	
																		<div class="modal-footer">
																			<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
																			<button type="submit" name="edit_bday" value="edit_bday" class="btn btn-primary btn-sm">Edit</button>
																		</div>
																		</form>	
																	</div>
																</div>
															</div>
														</td>					
													</tr>
													<tr>
														<td>Mobile Number:</td>
														<td><?php echo $employee['mobile_num'];?></td>
														<td width="10%"><div class="text-center"> <a href="" data-toggle="modal" data-target="#myModaledit5"><small><span class="glyphicon glyphicon-edit"></span> Edit</small></a></div>
															<div class="modal fade" id="myModaledit5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																<div class="modal-dialog">
																	<div class="modal-content">
																		<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
																		echo form_open(base_url().'index.php/employee/view/'.$employee['employee_id'],$attributes) ?>
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																			<h4 class="modal-title" id="myModalLabel">Edit Mobile Number</h4>
																		</div>
																		<div class="modal-body">
																				<div class="form-group">
																					<label class="col-sm-4 control-label">Mobile Number</label> 
																					<div class="col-sm-7">
																						<input placeholder="Mobile Number" value="<?php echo $employee['mobile_num']; ?>" class="form-control input-sm" type="input" name="mobile_num" />
																					</div>
																				</div>
																		</div>
																		<div class="modal-footer">
																			<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
																			<button type="submit" name="edit_num" value="edit_num" class="btn btn-primary btn-sm">Edit</button>
																		</div>
																		</form>	
																	</div>
																</div>
															</div>
														</td>					
													</tr>
													<tr>
														<td>Email address:</td>
														<td><?php echo $employee['work_email'];?></td>
														<td width="10%"><div class="text-center"> <a href="" data-toggle="modal" data-target="#myModaledit6"><small><span class="glyphicon glyphicon-edit"></span> Edit</small></a></div>
															<div class="modal fade" id="myModaledit6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																<div class="modal-dialog">
																	<div class="modal-content">
																		<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
																		echo form_open(base_url().'index.php/employee/view/'.$employee['employee_id'],$attributes) ?>
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																			<h4 class="modal-title" id="myModalLabel">Edit Work Email Address</h4>
																		</div>
																		<div class="modal-body">
																				<div class="form-group">
																					<label class="col-sm-4 control-label">Email Address</label> 
																					<div class="col-sm-7">
																						<input placeholder="Email Address" value="<?php echo $employee['work_email']; ?>" class="form-control input-sm" type="input" name="email" />
																					</div>
																				</div>
																		</div>
																		<div class="modal-footer">
																			<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
																			<button type="submit" name="edit_email" value="edit_email" class="btn btn-primary btn-sm">Edit</button>
																		</div>
																		</form>	
																	</div>
																</div>
															</div>
														</td>
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
									      		<p style="color:red"><small>* Editing the fields here do not merely change the employee type or status, but as well give them new start date regarding the change in employee type or status.</small></p>
        										<table width="50%">
        											<tr>
        												<td width="40%">Job Title:</td>
        												<td><?php echo $employee_position['position'];?></td>
        												<?php if ($employee['employee_type'] == 'Faculty'){
        													echo '<td></td>';
        													}
        													else{
        														?>
        												<td width="10%"><div class="text-center"> <a href="" data-toggle="modal" data-target="#myModaledittitle"><small><span class="glyphicon glyphicon-edit"></span> Edit</small></a></div>
        													<div class="modal fade" id="myModaledittitle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																<div class="modal-dialog">
																	<div class="modal-content">
																		<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
																		echo form_open(base_url().'index.php/employee/view/'.$employee['employee_id'],$attributes) ?>
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																			<h4 class="modal-title" id="myModalLabel">Change current job title to a new one?</h4>
																		</div>
																		<div class="modal-body">
																				<div class="form-group">
																					<label class="col-sm-4 control-label">Job Title</label> 
																					<div class="col-sm-7">
																						<select name="eposition" class="form-control">
																							<?php foreach ($all_positions as $position):
																								if($employee_position['job_position_id'] == $position['job_position_id']){ ?>			
																								<option value="<?php echo $position['job_position_id']; ?>" selected><small><?php echo $position['position']; ?></small></option>
																								<?php }
																								else{ ?>
																								<option value="<?php echo $position['job_position_id']; ?>"><small><?php echo $position['position']; ?></small></option>
																							<?php } endforeach ?>
																						</select>
																					</div>
																				</div>
																		</div>
																		<div class="modal-footer">
																			<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
																			<button type="submit" name="edit_position" value="edit_position" class="btn btn-primary btn-sm">Edit</button>
																		</div>
																		</form>	
																	</div>
																</div>
															</div>
        												</td>
        												<?php } ?>
        											</tr>
													<tr>
														<td width="40%">Employee Type:</td>
														<td><?php echo $employee['employee_type'];?></td>
														<td width="10%"><div class="text-center"> <a href="" data-toggle="modal" data-target="#myModaledit7"><small><span class="glyphicon glyphicon-edit"></span> Edit</small></a></div>
															<div class="modal fade" id="myModaledit7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																<div class="modal-dialog">
																	<div class="modal-content">
																		<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
																		echo form_open(base_url().'index.php/employee/view/'.$employee['employee_id'],$attributes) ?>
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																			<h4 class="modal-title" id="myModalLabel">Change current employee type to a new one</h4>
																		</div>
																		<div class="modal-body">
																			<p style="color:red"><small>* Change current employee type and start a new one.</small></p>
																				<div class="form-group">
																					<label class="col-sm-4 control-label">Employee Type</label> 
																					<div class="col-sm-7">
																						<select name="etype" class="form-control">
																							<?php foreach ($all_type as $type): 
																								if($employee['employee_type_id'] == $type['employee_type_id']){ ?>
																									<option value="<?php echo $type['employee_type_id']; ?>" name="etype" selected><?php echo $type['employee_type']; ?></option>
																								<?php }
																								else{ ?>			
																								<option value="<?php echo $type['employee_type_id']; ?>" name="etype"><?php echo $type['employee_type']; ?></option>
																								
																							<?php } endforeach ?>
																						</select>
																					</div>
																				</div>
																				<div class="form-group">
																					<label class="col-sm-4 control-label">Job Title</label> 
																					<div class="col-sm-7">
																						<select name="eposition_new" class="form-control">
																							<?php foreach ($all_positions as $position):
																								if($employee_position['job_position_id'] == $position['job_position_id']){ ?>			
																								<option value="<?php echo $position['job_position_id']; ?>" selected><small><?php echo $position['position']; ?></small></option>
																								<?php }
																								else{ ?>
																								<option value="<?php echo $position['job_position_id']; ?>"><small><?php echo $position['position']; ?></small></option>
																							<?php } endforeach ?>
																						</select>
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
																			<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
																			<button type="submit" name="edit_type" value="edit_type" class="btn btn-primary btn-sm">Edit</button>
																		</div>
																		</form>	
																	</div>
																</div>
															</div>
														</td>
													</tr>
													<tr>
														<td>Status:</td>
														<td><?php echo $employee['employee_status'];?></td>
														<td width="10%"><div class="text-center"> <a href="" data-toggle="modal" data-target="#myModaleditstatus"><small><span class="glyphicon glyphicon-edit"></span> Edit</small></a></div>
															<div class="modal fade" id="myModaleditstatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																<div class="modal-dialog">
																	<div class="modal-content">
																		<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
																		echo form_open(base_url().'index.php/employee/view/'.$employee['employee_id'],$attributes) ?>
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																			<h4 class="modal-title" id="myModalLabel">Change current employee status to a new one</h4>
																		</div>
																		<div class="modal-body">
																				<div class="form-group">
																					<label class="col-sm-4 control-label">Employee Status</label> 
																					<div class="col-sm-7">
																						<select name="estatus" class="form-control">
																							<option value="Probationary" <?php if($employee['employee_status']=='Probationary'){
																								echo 'selected';
																							}?>
																							>Probationary</option>
																							<option value="Regular" <?php if($employee['employee_status']=='Regular'){
																								echo 'selected';
																							}?>
																							>Regular</option> 
																						</select>
																					</div>
																				</div>
																		</div>
																		<div class="modal-footer">
																			<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
																			<button type="submit" name="edit_status" value="edit_status" class="btn btn-primary btn-sm">Edit</button>
																		</div>
																		</form>	
																	</div>
																</div>
															</div>
														</td>
													</tr>
													<tr>
														<td>Start Date:</td>
														<td><?php echo date('F d, Y', strtotime($employee['start_date']));?></td>
														<td></td>
													</tr>
													<tr>
														<td colspan="3">&nbsp;</td>
													</tr>
													<tr>
														<td>Managerial Experience:</td>
														<td><?php echo $employee['managerial_exp'].' year/s';?></td>
														<td width="10%"><div class="text-center"> <a href="" data-toggle="modal" data-target="#myModaleditexp"><small><span class="glyphicon glyphicon-edit"></span> Edit</small></a></div>
															<div class="modal fade" id="myModaleditexp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																<div class="modal-dialog">
																	<div class="modal-content">
																		<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
																		echo form_open(base_url().'index.php/employee/view/'.$employee['employee_id'],$attributes) ?>
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																			<h4 class="modal-title" id="myModalLabel">Edit Managerial Experience</h4>
																		</div>
																		<div class="modal-body">
																				<div class="form-group">
																					<label class="col-sm-4 control-label">Managerial Exp.</label> 
																					<div class="col-sm-7">
																						<div class="input-group">
																							<input placeholder="mngr exp" value="<?php echo $employee['managerial_exp']; ?>" type="input" name="manager_xp" class="form-control input-sm"/>
																							<span class="input-group-addon">
									  															<span><small>year/s</small></span>
									  														</span>
									  													</div>
																					</div>
																				</div>
																		</div>
																		<div class="modal-footer">
																			<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
																			<button type="submit" name="edit_exp" value="edit_exp" class="btn btn-primary btn-sm">Edit</button>
																		</div>
																		</form>	
																	</div>
																</div>
															</div>
														</td>
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
															* Eligible for <?php echo number_format((float)$current_medical_settings['max_benefit'], 2, '.', ',') ?> amount of Medical Assistance Benefit.
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
									      				<div class="text-right"><a href="<?php echo base_url().'index.php/ranking/employee_ranking/'.$employee['employee_id'] ?>" class="btn btn-default btn-sm" role="button">Ranking Summary</a></div>
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
									<?php }?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- modal-->
<div class="modal fade" id="ModalPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
			echo form_open('employee/view/'.$employee['employee_id'],$attributes) ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Assign New Password</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-sm-4 control-label">New Password</label> 
					<div class="col-sm-7">
						<input placeholder="Enter new password" value="" class="form-control input-sm" type="password" name="new" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label"></label> 
					<div class="col-sm-7">
						<input placeholder="Re-enter new password" value="" class="form-control input-sm" type="password" name="rnew" />
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
				<button type="submit" name="changepass" value="changepass" class="btn btn-primary btn-sm">Assign</button>
			</div>
			</form>	
		</div>
	</div>
</div>
<!-- end modal-->