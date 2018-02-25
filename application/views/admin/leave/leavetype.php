<div class="row">
	<div class="col-md-12">&nbsp;</div>
</div>	
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#4eb84e; color:#fff;">
				<div class="row">
					<div class="col-md-3"><?php echo 'Leave Types'; ?></span>
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
				<div class="row">&nbsp;</div>	
				<div class="alert alert-<?php echo $this->session->flashdata('msg2');?> alert-dismissable">
			 		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<div class="text-center"><?php echo $this->session->flashdata('msg'); ?></div>
				</div>
				<?php	} ?>
			<div class="row">
				<div class="text-center">
					<div class="col-sm-12">
						<?php $attributes = array('class' => 'form-inline', 'role' => 'form');
						echo form_open('leave/leave_type',$attributes) ?>
							<div class="form-group">
								<input placeholder="Leave type" class="form-control input-sm" type="input" name="ltype" />
							</div>
							<div class="form-group">
								<textarea placeholder="Description" class="form-control input-sm" rows="1" cols="50" name="desc" type="input"></textarea>
							</div>
							<div class="form-group">
								&nbsp; &nbsp; <button type="submit" name="add_leave" value="add_leave" class="btn btn-primary btn-sm">Add Type</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">&nbsp;</div>
			</div>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-body">
								<table class="table table-striped table-condensed table-hover">
									<thead>
									<tr style="background-color: #f7f7f7">
										<th width="30%"> Leave Type</th>
										<th width="50%"> Description</th>
										<th width="20%" colspan="2"> <div class="text-center">Action</div></th>
									</tr>
									</thead>
										<?php foreach ($all_leave_types as $leave_type): ?>
									<tr>
										<td><?php echo $leave_type['type'];?></td>
										<td><?php echo $leave_type['description'];?></td>
										<td>
											<?php if($leave_type['type'] == 'Sick' || $leave_type['type'] == 'Vacation' || $leave_type['type'] == 'Others'){ ?>
												
											<?php }
											else { ?>
												<a href="" data-toggle="modal" data-target="#myModaledit<?php echo $leave_type['leave_type_id'];?>"><small><span class="glyphicon glyphicon-edit"></span> Edit</small></a>
											<div class="modal fade" id="myModaledit<?php echo $leave_type['leave_type_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<?php $attributes = array('class' => 'form-horizontal', 'role' => 'form');
														echo form_open('leave/leave_type',$attributes) ?>
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Edit this Leave Type?</h4>
														</div>
														<div class="modal-body">
																<div class="form-group">
																	<label class="col-sm-3 control-label">Leave Type</label> 
																	<div class="col-sm-8">
																		<input placeholder="<?php echo $leave_type['type']; ?>" class="form-control input-sm" type="input" name="ltype" />
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-3 control-label">Description</label> 
																	<div class="col-sm-8">
																		<textarea placeholder="<?php echo $leave_type['description']; ?>" class="form-control" rows="3" name="desc" type="input"></textarea>
																	</div>
																</div>	
																<input type="hidden" name="type_id" value="<?php echo $leave_type['leave_type_id'] ?>">
															<!--<button type="submit" class="btn btn-default" name="submit">Add Employee</button>-->
														</div>
														<div class="modal-footer">
															<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
															<button type="submit" name="edit_leave" value="edit_leave" class="btn btn-primary btn-sm">Edit</button>
														</div>
														</form>	
													</div>
												</div>
											</div>
										</td>		
											<?php } ?>
										<td>
											<?php if($leave_type['type'] == 'Sick' || $leave_type['type'] == 'Vacation' || $leave_type['type'] == 'Others'){ ?>
											
											<?php }
											else { ?>
												<a href="" data-toggle="modal" data-target="#myModal<?php echo $leave_type['leave_type_id'];?>"><small><span class="glyphicon glyphicon-trash"></span> Delete</small></a>
											<div class="modal fade" id="myModal<?php echo $leave_type['leave_type_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Delete this holiday?</h4>
														</div>
														<div class="modal-body">
															<table width="100%">
																<tr>
																	<td>Holiday:</td>
																	<td><?php echo $leave_type['type'];?></td>
																</tr>
																<tr>
																	<td>Type:</td>
																	<td><?php echo $leave_type['description'];?></td>
																</tr>
															</table>	
														</div>
														<div class="modal-footer">
															<a href="" class="btn btn-default btn-sm" data-dismiss="modal" role="button">Cancel</a>
															<a href="<?php echo base_url().'index.php/leave/delete_leave_type/'.$leave_type['leave_type_id']?>" class="btn btn-danger btn-sm" role="button">Delete</a>
														</div>
													</div>
												</div>
											</div>		
										</td>	
											<?php } ?>	
									</tr>
										<?php endforeach ?> 
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