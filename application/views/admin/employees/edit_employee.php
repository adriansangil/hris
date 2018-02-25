<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-3">Edit Employee Information</div>
					<div class="col-md-5"></div>
					<div class="col-md-4">
						<div class="text-right">
								<a href="<?php echo base_url().'index.php/employee' ?>" class="btn btn-default btn-sm" role="button"><span class="glyphicon glyphicon-arrow-left"></span> List of Employees</a>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-1"></div>
										<div class="col-md-10">
										<?php echo $error; ?>
									<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
									echo form_open('employee/edit_employee/'.$employee['employee_id'],$attributes) ?>
										<div class="form-group">
												<label class="col-sm-2 control-label" for="FirstName">First Name</label> 
												<div class="col-sm-5">
													<input value="<?php echo $employee['first_name']; ?>" class="form-control" type="input" name="fname"/>
												</div>
												<div class="col-sm-5">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('fname')?></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label" for="MiddleName">Middle Name</label> 
												<div class="col-sm-5">
													<input value="<?php echo $employee['middle_name']; ?>" class="form-control" type="input" name="mname"/>
												</div>
												<div class="col-sm-5">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('mname')?></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label" for="LastName">Last Name</label> 
												<div class="col-sm-5">
													<input value="<?php echo $employee['last_name']; ?>" class="form-control" type="input" name="lname"/>
												</div>
												<div class="col-sm-5">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('lname')?></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label" for="Gender">Gender</label> 
												<div class="col-sm-5">
												<select name="gender" class="form-control">
													<?php if ($employee['gender']=='Male'){	?>
													<option value="<?php $employee['gender']; ?>" selected="selected"><?php echo $employee['gender']; ?></option>
													<option value="<?php echo 'Female'; ?>"><?php echo 'Female' ?></option>
													<?php }
													else{ ?>
													<option value="<?php echo 'Female'; ?>"selected="selected"><?php echo 'Female' ?></option>
													<option value="<?php echo 'Male'; ?>"selected="selected"><?php echo 'Male' ?></option>
													<?php } ?>
												</select>
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-2 control-label" for="Address">Address</label> 
												<div class="col-sm-5">
													<input value="<?php echo $employee['address']; ?>" class="form-control" type="input" name="address"/>
												</div>
												<div class="col-sm-5">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('address')?></span>
												</div>
											</div>
											<div class="form-group">	
												<label class="col-sm-2 control-label" for="MobileNumber">Mobile Number</label> 
												<div class="col-sm-5">
													<input value="<?php echo $employee['mobile_num']; ?>"class="form-control" type="input" name="mobile"/>
												</div>
												<div class="col-sm-5">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('mobile')?></span>
												</div>
											</div>	
											<div class="form-group">	
												<label class="col-sm-2 control-label" for="WorkEmail">Work Email</label> 
												<div class="col-sm-5">
													<input value="<?php echo $employee['mobile_num']; ?>" type="input" name="wemail" class="form-control"/>
												</div>
												<div class="col-sm-5">
													<span class="help-block"><span class="text-danger small"><?php echo form_error('wemail')?></span>
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-2 control-label" for="etype">Employee Type</label> 
												<div class="col-sm-5">
													<select name="etype" class="form-control">
														
													<?php foreach ($all_users as $user): ?>
																		
														<option value="<?php echo $user['employee_type_id']; ?>" name="etype"><?php echo $user['employee_type']; ?></option>
													<?php  endforeach ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-offset-4 col-sm-10">
													<input type="hidden" name="employee_id" value="<?php echo $employee['employee_id'] ?>">
													<button type="submit" name="submit" class="btn btn-default">Edit Employee</button>
												</div>
											</div>
										</form>
										</div>
									</div>	
									<div class="col-md-1"></div>
								</div>
							</div>
						</div>
						<div class="col-md-2"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
