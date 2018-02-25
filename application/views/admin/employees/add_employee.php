<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color: #337bb8; color: #fff;">
				<div class="row">
					<div class="col-md-3">Add Employee</div>
					<div class="col-md-5"></div>
					<div class="col-md-4"></div>
				</div>
			</div>
			<div class="panel-body" style="background-color:#f7f7f7">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						
						<?php $attributes = array('class' => 'form-horizontal');
						echo form_open('employee/addemployee',$attributes) ?>
						<div class="panel panel-default">
							<div class="panel-heading" style="background-color: #337bb8; color: #fff;">Employee Information</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-md-1"></div>
										<div class="col-md-10">
											<div class="form-group">
												<label class="col-sm-3 control-label" for="FirstName">First Name</label> 
												<div class="col-sm-4">
													<input placeholder="First Name" value="<?php echo set_value('fname'); ?>" class="form-control input-sm" type="input" name="fname"/>
												</div>
												<div class="col-sm-5">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('fname')?></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="MiddleName">Middle Name</label> 
												<div class="col-sm-4">
													<input placeholder="Middle Name" value="<?php echo set_value('mname'); ?>" class="form-control input-sm" type="input" name="mname"/>
												</div>
												<div class="col-sm-5">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('mname')?></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="LastName">Last Name</label> 
												<div class="col-sm-4">
													<input placeholder="Last Name" value="<?php echo set_value('lname'); ?>" class="form-control input-sm" type="input" name="lname"/>
												</div>
												<div class="col-sm-5">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('lname')?></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="Gender">Gender</label> 
												<div class="col-sm-4">
												<select name="gender" class="form-control input-sm">				
													<option value="<?php echo 'Male'; ?>"><?php echo 'Male' ?></option>
													<option value="<?php echo 'Female'; ?>"><?php echo 'Female' ?></option>
												</select>
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-3 control-label" for="startdate">Birthdate</label> 
												<div class="col-sm-4">
													<div class="input-group datetimepickeredit">
														<input name="birthdate"  data-format="MM/dd/yyyy" type="text" class="form-control input-sm" placeholder="mm/dd/yyyy" value="<?php echo set_value('birthdate'); ?>">
														<span class="input-group-addon">
  															<span class="glyphicon glyphicon-calendar"></span>
  														</span>
													</div>
												</div>
												<div class="col-sm-5">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('birthdate')?></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="Address">Address</label> 
												<div class="col-sm-4">
													<input placeholder="Address" value="<?php echo set_value('address'); ?>" class="form-control input-sm" type="input" name="address"/>
												</div>
												<div class="col-sm-5">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('address')?></span>
												</div>
											</div>
											<div class="form-group">	
												<label class="col-sm-3 control-label" for="MobileNumber">Mobile Number</label> 
												<div class="col-sm-4">
													<input placeholder="Mobile Number" value="<?php echo set_value('mobile'); ?>"class="form-control input-sm" type="input" name="mobile"/>
												</div>
												<div class="col-sm-5">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('mobile')?></span>
												</div>
											</div>	
											<div class="form-group">	
												<label class="col-sm-3 control-label" for="WorkEmail">Work Email</label> 
												<div class="col-sm-4">
													<input placeholder="Email Address" value="<?php echo set_value('wemail'); ?>" type="input" name="wemail" class="form-control input-sm"/>
												</div>
												<div class="col-sm-5">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('wemail')?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="panel-heading" style="background-color: #337bb8; color: #fff; border-radius: 0px;">Job Information</div>
									<div class="row">
										<div class="col-md-12"><p style="color:red"><small> &nbsp; &nbsp;* Double check the fields here. Once they are saved, changing them later will also affect the employee's work history.</small></p></div>
									</div>
									<div class="row">
									<div class="col-md-1"></div>
										<div class="col-md-10">
											<div class="form-group">
												<label class="col-sm-3 control-label" for="etype">Employee Type</label> 
												<div class="col-sm-4">
													<select name="etype" class="form-control input-sm">
													<?php foreach ($all_users as $user): ?>					
														<option value="<?php echo $user['employee_type_id']; ?>" name="etype" selected><?php echo $user['employee_type']; ?></option>
													<?php endforeach ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="etype">Job Title</label> 
												<div class="col-sm-4">
													<select name="etitle" class="form-control input-sm">
													<?php foreach ($all_positions as $position): ?>					
														<option value="<?php echo $position['job_position_id']; ?>" name="etitle"><small><?php echo $position['position']; ?></small></option>
													<?php endforeach ?>
													</select>
												<span class="help-block"><small>* If employee type is Faculty, Job title will automatically be set to teacher regardless of your choice.</small></span>	
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="estatus">Employee Status</label> 
												<div class="col-sm-4">
													<select name="estatus" class="form-control input-sm">
														<option value="Probationary">Probationary</option>
														<option value="Regular">Regular</option> 
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="startdate">Start Date</label> 
												<div class="col-sm-4">
													<div class="input-group datetimepickeredit">
														<input name="startdate"  data-format="MM/dd/yyyy" type="text" class="form-control input-sm" placeholder="mm/dd/yyyy" value="<?php echo set_value('startdate'); ?>">
														<span class="input-group-addon">
  															<span class="glyphicon glyphicon-calendar"></span>
  														</span>
													</div>
													<span class="help-block"><small>* Double check start date, once this is entered in the system it can never be changed.</small></span>
												</div>
												<div class="col-sm-5">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('startdate')?></span>
												</div>
											</div>
										</div>
									<div class="col-md-1"></div>
								</div>
								<div class="panel-heading" style="background-color: #337bb8; color: #fff; border-radius: 0px;">Managerial Experience</div>
									<div class="row">
										<div class="col-md-12"><p style="color:red"><small> &nbsp; &nbsp;* Have managerial experience? Indicate here the length in years regarding the employee's experience.</small></p></div>
									</div>
									<div class="row">
										<div class="col-md-1"></div>
											<div class="col-md-10">
												<div class="form-group">
													<label class="col-sm-3 control-label">Managerial Exp.</label> 
													<div class="col-sm-4">
														<div class="input-group">
															<input placeholder="mngr exp" value="<?php echo set_value('manager_xp'); ?>" type="input" name="manager_xp" class="form-control input-sm"/>
															<span class="input-group-addon">
	  															<span><small>year/s</small></span>
	  														</span>
	  													</div>
	  													<span class="help-block"><small>* Set this to zero if there is no managerial experience.</small></span>	
													</div>
													<div class="col-sm-5">
														<span class="help-block"><span class="text-danger small"><?php echo form_error('manager_xp')?></span>
													</div>
												</div>
											</div>
										<div class="col-md-1"></div>
									</div>
								<div class="panel-heading" style="background-color: #337bb8; color: #fff; border-radius: 0px;">Login Credentials</div>
									<div class="row">
										<div class="col-md-12">&nbsp;</div>
									</div>
									<div class="row">
										<div class="col-md-1"></div>
										<div class="col-md-10">
											<div class="form-group">
												<label class="col-sm-3 control-label" for="etype">Username</label> 
												<div class="col-sm-4">
													<input placeholder="Username" value="" class="form-control input-sm" type="input" name="username"/>
												</div>
												<div class="col-sm-5">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('username')?></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="estatus">Password</label> 
												<div class="col-sm-4">
													<input placeholder="Password" value="" class="form-control input-sm" type="password" name="password"/>
												</div>
												<div class="col-sm-5">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('password')?></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="startdate">Re-type Password</label> 
												<div class="col-sm-4">
													<input placeholder="Re-type Password" value="" class="form-control input-sm" type="password" name="repassword"/>
												</div>
												<div class="col-sm-5">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('repassword')?></span>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-10">
													<a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-primary" role="button">Add Employee</a>
													<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header" style="">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																	<h4 class="modal-title" id="myModalLabel">Are you sure you want to add this employee?</h4>
																</div>
																<div class="modal-body">
																	* Make sure all details of the employee information are correct before clicking the submit request button below.
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
																	<button type="submit" name="submit" class="btn btn-primary btn-sm">Add Employee</button>
																</div>
															</div><!-- /.modal-content -->
														</div><!-- /.modal-dialog -->
													</div><!-- /.modal -->
												</div>
											</div>	
										</div>
									</div>
								</form>			
							</div>
						</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div>
	</div>
</div>