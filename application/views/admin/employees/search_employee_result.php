
				<!-- Alert Message! -->
				<?php if($this->session->flashdata('msg')){ ?>
				<div class="row">&nbsp;
				</div>	
				<div class="alert alert-success alert-dismissable">
			 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<div class="text-center"><?php echo $this->session->flashdata('msg'); ?></div>
				</div>
				<?php	} ?>
				<div class="row">
					<div class="col-md-12">&nbsp;</div>
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<table class="table table-condensed table-hover">
									<thead>
										<tr>
											<th width="15%"><span class="glyphicon glyphicon-user"></span> Name</th>
											<th width="10%"> Type</th>
											<th width="10%"> Status</th>
											<th width="20%"><span class="glyphicon glyphicon-home"></span> Address</th>
											<th width="15%"><span class="glyphicon glyphicon-phone"></span> Mobile Number</th>
											<th width="20%"><span class="glyphicon glyphicon-envelope"></span> Work Email</th>
											<th width="10%" colspan="2" class="text-center"><span class="glyphicon glyphicon-pencil"></span> Action</th>						
										</tr>
									</thead>
									<?php if (count($results)<1){
											?> 
											<tr>
												<td colspan="7">
													&nbsp; <br />
													<div class="alert alert-warning">
														<a class="alert-link"><h5 class="text-center"><?php echo $empty; ?></h5></a>
													</div>
												</td>
											</tr>
										<?php } foreach ($results as $data):?>
										<tr>
											<td><a href="<?php echo base_url().'index.php/employee/view/'.$data['employee_id'] ?>"><?php echo $data['first_name']." ".$data['last_name']; ?></a></td>
											<td><?php echo $data['employee_type']; ?></td>
											<td><?php echo $data['employee_status']; ?></td>
											<td><?php echo $data['address']; ?></td>
											<td><?php echo $data['mobile_num']; ?></td>
											<td><?php echo $data['work_email']; ?></td>
											<td><div class="text-center"><a href="" data-toggle="modal" data-target="#myModal<?php echo $data['employee_id'];?>"><small><span class="glyphicon glyphicon-trash"></span> Delete</small></div></a>
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
																<a href="<?php echo base_url().'index.php/employee/delete_employee/'.$data['employee_id'];?>" class="btn btn-danger btn-sm" role="button">Delete</a>
															</div>
														</div>
													</div>
												</div>		
											</td>
										</tr>
										<?php endforeach ?>
										
										

								</table>
								<div class=text-center>
								</div>
							</div>
						</div>		
					</div>
				</div>
			</div>		
		</div>
	</div>
</div>