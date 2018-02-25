<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#333; color:#fff;">
				<div class="row">
					<div class="col-md-3">Account Settings
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-4">
					</div>
				</div>
			</div>	
			<div class="panel-body" style="background-color:#f7f7f7">
				<!-- Alert Message-->
				<?php if($this->session->flashdata('msg')){ ?>
				<div class="alert alert-<?php echo $this->session->flashdata('msg2');?> alert-dismissable">
			 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div class="text-center"><?php echo $this->session->flashdata('msg'); ?></div>
				</div>
				<?php	} ?>
				<div class="row">
					<div class="col-md-12">&nbsp;</div>
				</div>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-body">
								<table class="table table-condensed table-hover">
								<thead>
									<tr>
										<th width="25%"> Field</th>
										<th width="65%"> Attribute</th>
										<th width="10%"><div class="text-center"> Action</div></th>
									</tr>
								</thead>
									
									<tr>
										<td width="20%"> Username</td>
										<td style="color: #88919a"> <?php echo $admin_details['username']; ?></td>
										<td width="10%"><div class="text-center"> <a href="" data-toggle="modal" data-target="#myModaledit2"><small><span class="glyphicon glyphicon-edit"></span> Edit</small></a></div>
											<div class="modal fade" id="myModaledit2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('my_settings',$attributes) ?>
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Edit Username</h4>
														</div>
														<div class="modal-body">
																<div class="form-group">
																	<label class="col-sm-3 control-label">Username</label> 
																	<div class="col-sm-8">
																		<input placeholder="Username" value="<?php echo $admin_details['username']; ?>" class="form-control input-sm" type="input" name="uname" />
																	</div>
																</div>
																
															<!--<button type="submit" class="btn btn-default" name="submit">Add Employee</button>-->
														</div>
														<div class="modal-footer">
															<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
															<button type="submit" name="edit_uname" value="edit_uname" class="btn btn-primary btn-sm">Edit</button>
														</div>
														</form>	
													</div>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td width="20%"> Password</td>
										<td style="color: #88919a"> </td>
										<td width="10%"><div class="text-center"><a href="" data-toggle="modal" data-target="#myModaledit3"><small><span class="glyphicon glyphicon-edit"></span> Edit</small></a></div>
											<div class="modal fade" id="myModaledit3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('my_settings',$attributes) ?>
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Edit Password</h4>
														</div>
														<div class="modal-body">
																<div class="form-group">
																	<label class="col-sm-4 control-label">Current Password</label> 
																	<div class="col-sm-7">
																		<input placeholder="Enter current password" value="" class="form-control input-sm" type="password" name="current" />
																	</div>
																</div>
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

															<!--<button type="submit" class="btn btn-default" name="submit">Add Employee</button>-->
														</div>
														<div class="modal-footer">
															<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
															<button type="submit" name="edit_pass" value="edit_pass" class="btn btn-primary btn-sm">Edit</button>
														</div>
														</form>	
													</div>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td width="20%"> Birthdate</td>
										<td style="color: #88919a"><?php 
											if($admin_details['birthdate'] == null){
												echo 'No birthdate added.';
											}
											else{
												echo date('M d, Y', strtotime($admin_details['birthdate']));
											} ?></td>
										<td width="10%"><div class="text-center"> <a href="" data-toggle="modal" data-target="#myModaleditbday"><small><span class="glyphicon glyphicon-edit"></span> Edit</small></a></div>
											<div class="modal fade" id="myModaleditbday" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('my_settings',$attributes) ?>
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Edit Birthdate</h4>
														</div>
														<div class="modal-body">
																<div class="form-group">
																	<label class="col-sm-3 control-label">Birthdate</label> 
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
										<td width="20%"> Address</td>
										<td style="color: #88919a"><?php 
											if($admin_details['address'] == null){
												echo 'No address added.';
											}
											else{
												echo $admin_details['address'];
											} ?></td>
										<td width="10%"><div class="text-center"> <a href="" data-toggle="modal" data-target="#myModaledit5"><small><span class="glyphicon glyphicon-edit"></span> Edit</small></a></div>
											<div class="modal fade" id="myModaledit5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('my_settings',$attributes) ?>
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Edit Address</h4>
														</div>
														<div class="modal-body">
																<div class="form-group">
																	<label class="col-sm-3 control-label">Address</label> 
																	<div class="col-sm-8">
																		<input placeholder="Address" value="<?php echo $admin_details['address']; ?>" class="form-control input-sm" type="input" name="addr" />
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
										<td width="20%"> Mobile Number</td>
										<td style="color: #88919a"><?php 
											if($admin_details['mobile_num'] == null){
												echo 'No mobile number added.';
											}
											else{
												echo $admin_details['mobile_num'];
											} ?></td>
										<td width="10%"><div class="text-center"> <a href="" data-toggle="modal" data-target="#myModaledit6"><small><span class="glyphicon glyphicon-edit"></span> Edit</small></a></div>
											<div class="modal fade" id="myModaledit6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('my_settings',$attributes) ?>
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Edit Mobile Number</h4>
														</div>
														<div class="modal-body">
																<div class="form-group">
																	<label class="col-sm-3 control-label">Mobile Number</label> 
																	<div class="col-sm-8">
																		<input placeholder="Mobile Number" value="<?php echo $admin_details['mobile_num']; ?>" class="form-control input-sm" type="input" name="mobile_num" />
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
										<td width="20%"> Email Address</td>
										<td style="color: #88919a"> <?php 
											if($admin_details['work_email'] == null){
												echo 'No email address added.';
											}
											else{
												echo $admin_details['work_email'];
											} ?></td>
										<td width="10%"><div class="text-center"> <a href="" data-toggle="modal" data-target="#myModaledit7"><small><span class="glyphicon glyphicon-edit"></span> Edit</small></a></div>
											<div class="modal fade" id="myModaledit7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('my_settings',$attributes) ?>
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Edit Work Email Address</h4>
														</div>
														<div class="modal-body">
																<div class="form-group">
																	<label class="col-sm-3 control-label">Email Address</label> 
																	<div class="col-sm-8">
																		<input placeholder="Email Address" value="<?php echo $admin_details['work_email']; ?>" class="form-control input-sm" type="input" name="email" />
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
					<div class="col-md-2"></div>
				</div>
			</div>
		</div>
	</div>
</div>	