<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#337bb8; color: #fff;">
				<div class="row">
					<div class="col-md-3">
							<?php echo 'Inactive Employee List ('.$employee_num.')'?></span>
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-4">
						<div class="text-right">
						</div>
					</div>
				</div>	
			</div>

			<div class="panel-body" style="background-color:#f7f7f7">
				<div class="row">
				</div>
				<div class="row">
					<div class="col-md-12">&nbsp;</div>
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="panel panel-default">
							<div class="panel-body">
								<table class="table table-condensed table-hover">
									<thead>
										<tr>
											<th width="20%"><span class="glyphicon glyphicon-user"></span> Name</th>
											<th width="25%"><span class="glyphicon glyphicon-home"></span> Address</th>
											<th width="20%"><span class="glyphicon glyphicon-phone"></span> Mobile Number</th>
											<th width="20%"><span class="glyphicon glyphicon-envelope"></span> Work Email</th>
											<th width="15%"><span class="glyphicon glyphicon-pencil"></span> Action</th>						
										</tr>
									</thead>
									<?php if(count($results)<1){
											?> 
											<tr>
												<td colspan="5">
													&nbsp; <br />
													<div class="alert alert-warning">
														<a class="alert-link"><h5 class="text-center"><?php echo $empty; ?></h5></a>
													</div>
												</td>
											</tr>
										<?php } foreach ($results as $data): ?>
										<tr>
											<td><a href="<?php echo base_url().'index.php/employee/view_inactive_employee/'.$data['employee_id'] ?>"><?php echo $data['first_name']." ".$data['last_name']; ?></a></td>
											<td><?php echo $data['address']; ?></td>
											<td><?php echo $data['mobile_num']; ?></td>
											<td><?php echo $data['work_email']; ?></td>
											<td><a href="" data-toggle="modal" data-target="#myModal<?php echo $data['employee_id'];?>"><span class="glyphicon glyphicon-trash"></span><small> Delete</small></a>
												<div class="modal fade" id="myModal<?php echo $data['employee_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																<h4 class="modal-title" id="myModalLabel">Delete this Employee?</h4>
															</div>
															<div class="modal-body">
																<table width="100%">
																	<tr>
																		<td>Name:</td>
																		<td><?php echo $data['first_name'].' '.$data['last_name'];?></td>
																	</tr>
																	<tr>
																		<td>Address:</td>
																		<td><?php echo $data['address'];?></td>
																	</tr>
																	<tr>
																		<td>Mobile Number:</td>
																		<td><?php echo $data['mobile_num'];?></td>
																	</tr>
																	<tr>
																		<td>Work Email:</td>
																		<td><?php echo $data['work_email'];?></td>
																	</tr>
																</table>	
															</div>
															<div class="modal-footer">
																<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
																<a href="<?php echo base_url().'index.php/employee/permanent_delete_employee/'.$data['employee_id'];?>" class="btn btn-danger btn-sm" role="button">Delete</a>
															</div>
														</div>
													</div>
												</div>		
											</td>
										</tr>
										<?php endforeach ?>
										
										

								</table>
								<div class=text-center>
								<?php echo $links; ?>
								</div>
							</div>
						</div>		
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>		
		</div>
	</div>
</div>